const path = require('path');
const webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const ExtractTextWebpackPlugin = require('extract-text-webpack-plugin');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const CompressionWebpackPlugin = require('compression-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

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
        new CleanWebpackPlugin(['dist']),
        new webpack.WatchIgnorePlugin([
            /\.d\.ts$/
        ]),
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
        new UglifyJSPlugin({
            sourceMap: true,
        }),
        new CompressionWebpackPlugin({
            asset: '[path].gz',
        }),
        new ManifestPlugin(),
        new BrowserSyncPlugin({
            host: 'localhost',
            port: 3000,
            proxy: 'http://localhost:8080/',
            watchOptions: {
                ignoreInitial: true,
                ignored: './src'
            },
            ui: false,
            ghostMode: false,
            logPrefix: "ΛLIΛ",
            logFileChanges: true
        }, {
            reload: false
        })
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
            include: path.resolve(__dirname, "src"),
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
            test: /\.tsx?$/,
            loader: 'ts-loader', // ts-loader ??
            exclude: /node_modules/
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
            }],
        },
        {
            test: /\.(woff|woff2|eot|ttf|otf)$/,
            use: [
                'file-loader'
            ]
        }
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