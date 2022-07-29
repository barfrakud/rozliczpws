import './bootstrap';
import './main';

window.moment = require('moment/moment');

global.$ = global.jQuery = require('jquery');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
