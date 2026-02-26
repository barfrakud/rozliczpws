import './bootstrap';

window.moment = require('moment/moment');

const $ = require('jquery');

window.$ = window.jQuery = $;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const footerText = document.getElementById('idFooterText');
if (footerText) {
    footerText.textContent = 'rozliczPWS.pl v2.1.2 © barfrakud';
}

require('./main');
require('./national');
require('./foreign');
