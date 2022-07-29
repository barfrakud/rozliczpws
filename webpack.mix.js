const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js/app.js')
    .js('resources/js/national.js', 'public/js/app.js')
    .js('resources/js/foreign.js', 'public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css/app.css')
    .postCss('resources/css/app.css', 'public/css/app.css')
    .postCss('resources/css/national.css', 'public/css/app.css')
    .options({
        processCssUrls: false
    })
    .sourceMaps();

mix.autoload({
    jquery: ['$', 'window.$', 'window.jQuery']
});
