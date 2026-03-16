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
    const appName = footerText.dataset.appName || footerText.textContent.trim();
    const footerVersion = footerText.dataset.footerVersion || '';

    footerText.textContent = [appName, footerVersion].filter(Boolean).join(' ');
}

// Preserve split files while the frontend is still jQuery-driven.
require('./main');
require('./national');
require('./foreign');
