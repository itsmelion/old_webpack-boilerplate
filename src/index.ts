if (module && module.hot) {
    module.hot.accept();
}

// Importing images
const importAll = (r: any) => {
    return r.keys().map(r);
};

const images = importAll(
    require.context(
        './images',
        true,
        /\.(jpe?g|png|gif|svg)/,
    ),
);

import moment from 'moment';
import "pace-js"; // pace-js/pace.js
import './main.scss';

window.document.getElementsByTagName('main')[0]
    .innerHTML = `<h2>Right now is: <b>
    ${moment().format('DD/MM/YYYY hh:mm:ss')}</b></h2>`;
