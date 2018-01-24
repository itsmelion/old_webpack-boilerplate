require('dotenv').config();

const path = require('path');
const webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const ExtractTextWebpackPlugin = require('extract-text-webpack-plugin');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const CompressionWebpackPlugin = require('compression-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const extractSass = new ExtractTextWebpackPlugin({
    filename: '[name].[contenthash:8].css',
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
    },
    output: {
        filename: '[name].[hash:8].js',
        path: path.join(__dirname, process.env.themeDirectory),
        publicPath: process.env.themeDirectory,
    },
    resolve: {
        extensions: ['.ts', '.php', '.js', '.json'],
    },
    plugins: [
        new CleanWebpackPlugin([process.env.themeDirectory]),
        new webpack.WatchIgnorePlugin([
            /\.d\.ts$/
        ]),
        new webpack.optimize.CommonsChunkPlugin({
            name: 'commons',
            filename: 'commons.[hash:8].js',
            minChunks: Infinity
        }),
        // new HtmlWebpackPlugin({
        //     template: `!!raw-loader!${path.join(__dirname, 'src/views/index.php')}`,
        //     filename: 'index.php',
        //     chunks: ['main', 'commons'],
        //     transpile: false,
        //     minify,
        // }),
        extractSass,
        new UglifyJSPlugin(),
        new CompressionWebpackPlugin({
            asset: '[path].gz',
        }),
        new CopyWebpackPlugin ([
            { from: './src/views', to: './' }
        ]),
        new ManifestPlugin(),
        new BrowserSyncPlugin({
            host: 'localhost',
            port: 3000,
            proxy: process.env.appURL,
            // watchOptions: {
            //     ignoreInitial: true,
            //     // ignored: './src'
            // },
            ui: false,
            ghostMode: false,
            logPrefix: process.env.appName,
            logFileChanges: true
        }, {
            reload: true
        })
    ],
    module: {
        rules: [{
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
            loader: 'ts-loader',
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
        },
        {
            test: /\.php$/,
            use: [
                'raw!html-minifier-loader'
            ]
        }
        ],
    },
};

if (process.env.NODE_ENV === 'development') {
    config.watch = true;
    config.devtool = 'source-map';
    config.plugins.push(new webpack.HotModuleReplacementPlugin());
} else if (process.env.NODE_ENV === 'hot') {
    config.watch = true;
    config.devtool = 'source-map';
    config.devServer = {
        hot: true,
        historyApiFallback: true
    };
    config.plugins.push(new webpack.HotModuleReplacementPlugin());
}

module.exports = config;