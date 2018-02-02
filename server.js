require('dotenv').config();
const express = require('express');
const path = require('path');
const compression = require('compression');

const app = express();
app.use(compression());
app.set('view engine', 'ejs');
app.set('views', './views'); // specify the views directory
app.set('port', process.env.PORT || 80);

// if (process.env.NODE_ENV === 'development') {
//     const config = require('./webpack.config.js');
//     const webpack = require('webpack');
//     const webpackDevMiddleware = require('webpack-dev-middleware');
//     const compiler = webpack(config);

//     // Tell express to use the webpack-dev-middleware and use the webpack.config.js
//     // configuration file as a base.
//     app.use(webpackDevMiddleware(compiler, {
//         publicPath: config.output.publicPath
//     }));
// } else {
app.use(express.static('./'));
// }

app.get('/', (req, res) => {
    res.render(path.join(__dirname, 'dist/index.ejs'));
});

app.listen(app.get('port'), () => {
    console.log(`Listening on port ${app.get('port')}`);
});
