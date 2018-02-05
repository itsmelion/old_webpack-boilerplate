// Karma configuration
module.exports = function (config) {
    config.set({
        basePath: './',
        frameworks: ['jasmine', 'karma-typescript', 'browserify'],
        files: [
            'src/test.ts',
            // { pattern: 'src/*.test.ts', watched: false },
            // { pattern: 'src/**/*.test.ts', watched: true },
        ],

        preprocessors: {
        // add webpack as preprocessor
            'src/test.ts': ['webpack', 'karma-typescript', 'browserify'],
        },

        webpack: require('./webpack.config'),

        webpackMiddleware: {
            stats: 'errors-only',
        },
        browsers: ['ChromeCanary'],
        babelPreprocessor: {
            options: {
              presets: ['latest'],
              sourceMap: 'inline'
            },
            sourceFileName: function (file) {
              return file.originalPath;
            }
          },
    });
};
