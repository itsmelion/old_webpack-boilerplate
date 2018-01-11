import moment from 'moment';
// import { Message } from './model';

import './main.scss';

const main: HTMLMainElement = document.createElement('main');
const button: HTMLButtonElement = document.createElement('button');
main.innerHTML =    `<h2>Right now is:<br>
                    <b>${moment().format('DD/MM/YYYY hh:mm:ss')}</b></h2>`;
button.innerHTML = 'Lazy load something..';
main.appendChild(button);

// {Tried to async.. not very functional}
button.onclick = e => require(/* webpackChunkName: "print"*/ './print')
.then((module) => module() );

// const template: any = require('./messages.html');
// const logo: any = require('./images/especializa_logo.jpg');

if (module && module.hot) {
    module.hot.accept();
}
