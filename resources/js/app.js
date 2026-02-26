import './bootstrap';

window.moment = require('moment/moment');

const $ = require('jquery');

window.$ = window.jQuery = $;

$.ajaxSetup({
    headers: {
        // Keep CSRF header for legacy jQuery AJAX calls.
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const footerText = document.getElementById('idFooterText');
if (footerText) {
    footerText.textContent = 'rozliczPWS.pl v2.1.2 © barfrakud';
}

// Preserve split files while the frontend is still jQuery-driven.
require('./main');
require('./national');
require('./foreign');
