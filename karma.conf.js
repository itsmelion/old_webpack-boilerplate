const ExtractTextWebpackPlugin = require('extract-text-webpack-plugin');

const extractSass = new ExtractTextWebpackPlugin({
    filename: '[name].css',
    disable: false,
});

const minify = {
    collapseWhitespace: true,
    conservativeCollapse: true,
    removeComments: true,
};

const webpackConf = require('./webpack.config');

// Karma configuration
module.exports = function (config) {
    config.set({
        basePath: './src/',
        frameworks: ['jasmine', 'karma-typescript', 'browserify'],
        files: [
            'test.ts',
            // { pattern: 'src/test.ts', included: true, watched: true },
        ],

        preprocessors: {
        // add webpack as preprocessor
            'test.ts': ['webpack', 'karma-typescript', 'browserify'],
        },

        webpack: {
            resolve: webpackConf.resolve,
            module: webpackConf.module,
        },
        reporters: ['progress', 'kjhtml'],
        webpackMiddleware: {
            stats: 'errors-only',
        },
        browsers: ['ChromeCanary'],
        babelPreprocessor: {
            options: {
                presets: ['latest'],
                sourceMap: 'inline',
            },
            sourceFileName (file) {
              return file.originalPath;
            },
        },
        logLevel: config.LOG_DEBUG,
    });
};
