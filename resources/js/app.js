import './bootstrap';
import './main';
global.$ = global.jQuery = require('jquery');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
