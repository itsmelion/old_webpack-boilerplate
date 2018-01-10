const path = require('path');
const webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const ExtractTextWebpackPlugin = require('extract-text-webpack-plugin');
const UglifyJsWebpackPlugin = require('uglifyjs-webpack-plugin');
const CompressionWebpackPlugin = require('compression-webpack-plugin');

const extractSass = new ExtractTextWebpackPlugin({
    filename: '[name].[contenthash:8].bundle.css',
    disable: false,
});

const minify = {
    collapseWhitespace: true,
    conservativeCollapse: true,
    removeComments: true,
};
const config = {
    entry: {
        main: './src/index.ts',
        // oldMessages: './src/old-messages.ts',
        vendor: ['whatwg-fetch'],
    },
    output: {
        filename: '[name].[hash:8].bundle.js',
        path: path.join(__dirname, 'dist'),
        publicPath: '/',
    },
    resolve: {
        extensions: ['.ts', '.js', ".json"],
    },
    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            name: 'commons',
            filename: 'commons.[hash:8].bundle.js',
            minChunks: 2,
        }),
        new HtmlWebpackPlugin({
            template: path.join(__dirname, 'src', 'index.html'),
            filename: 'index.html',
            chunks: ['main', 'commons', 'vendor'],
            minify,
        }),
        // new HtmlWebpackPlugin({
        //     template: path.join(__dirname, 'src', 'old-messages.html'),
        //     filename: 'old-messages.html',
        //     chunks: ['oldMessages', 'commons', 'vendor'],
        //     minify,
        // }),
        extractSass,
        new UglifyJsWebpackPlugin({
            sourceMap: true,
        }),
        new CompressionWebpackPlugin({
            asset: '[path].gz',
        }),
    ],
    module: {
        rules: [{
            test: /\.html$/,
            loader: 'html-es6-template-loader',
            exclude(filePath) {
                return filePath === path.join(__dirname, 'src', 'index.html');
            },
            query: {
                transpile: true,
            },
        },
        {
            test: /\.js$/,
            loader: 'babel-loader',
            options: {
                presets: [
                    ['es2017', {
                        modules: false,
                    }],
                ],
            },
            exclude: /node_modules/,
        },
        {
            test: /\.ts$/,
            loader: 'awesome-typescript-loader',
        },
        {
            test: /\.s[ac]ss$/,
            loader: extractSass.extract({
                use: [{
                    loader: 'css-loader',
                    options: {
                        importLoaders: 1
                    }
                },
                {
                    loader: 'postcss-loader'
                },
                {
                    loader: 'sass-loader'
                },
                ],
                fallback: 'style-loader',
            }),
        },
        {
            test: /\.(jpe?g|png|gif|svg)/,
            use: [{
                loader: 'url-loader',
                query: {
                    limit: 5000,
                    name: '[name].[hash:8].[ext]',
                },
            },
            {
                loader: 'image-webpack-loader',
                query: {
                    mozjpeg: {
                        quality: 65,
                    },
                },
            },
            ],
        },
        ],
    },
};

if (process.env.NODE_ENV === 'development') {
    config.watch = true;
    config.devtool = 'source-map';
} else if (process.env.NODE_ENV === 'hot') {
    config.devtool = 'source-map';
    config.devServer = {
        hot: true,
    };
    config.plugins.push(new webpack.HotModuleReplacementPlugin());
}

module.exports = config;