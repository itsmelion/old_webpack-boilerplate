import moment from 'moment';
// import { Message } from './model';

import './main.scss';

window.document.getElementsByTagName('body') [0]
    .innerHTML = '<h2>Right now is: <b>' +
    moment().format('DD/MM/YYYY hh:mm:ss') + '</b></h2>';

// const template: any = require('./messages.html');
// const logo: any = require('./images/especializa_logo.jpg');

if (module && module.hot) {
    module.hot.accept();
}
