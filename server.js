/* eslint global-require: 0, import/no-extraneous-dependencies: 0 */
const express = require('express');
const path = require('path');


const app = express();

app.set('port', process.env.PORT || 80);

if (process.env.NODE_ENV === 'development') {
    const config = require('./webpack.config.js');
    const webpack = require('webpack');
    const compiler = webpack(config);
    const webpackDevMiddleware = require('webpack-dev-middleware');

    // Tell express to use the webpack-dev-middleware and use the webpack.config.js
    // configuration file as a base.
    app.use(webpackDevMiddleware(compiler, {
        publicPath: config.output.publicPath
    }));
} else {
    app.use(express.static('dist'));
}

app.get('*', (req, res) => {
    res.sendFile(path.join(__dirname, 'src/index.html'));
});


app.listen(app.get('port'), () => {
    console.log(`Listening on port ${app.get('port')}`);
});