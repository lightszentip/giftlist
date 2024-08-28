import * as bootstrap from 'bootstrap';
import {Tooltip} from 'bootstrap';

import Popper from '@popperjs/core/dist/umd/popper.js';

try {
    window.Popper = Popper;
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
} catch (e) {
}




window.bootstrap = bootstrap;


// Now use Tooltip plugin
document.querySelectorAll('.btn-clipboard').forEach((button) => {
    // Notice no 'bootstrap.' prefix; plugin was imported as just Tooltip
    let tooltip = new Tooltip(button);

    button.addEventListener('mouseleave', () => {
        tooltip.hide();
    });
});
require('dropzone');


//https://stackoverflow.com/questions/46643667/javascript-function-is-not-defined-with-laravel-mix
