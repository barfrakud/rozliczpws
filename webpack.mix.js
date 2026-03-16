const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css', {
        sassOptions: {
            quietDeps: true,
            logger: {
                warn: () => {},
                debug: () => {},
            },
        },
    })
    .postCss('resources/css/app.css', 'public/css/custom.css')
    .options({
        processCssUrls: false,
    })
    .disableNotifications()
    .sourceMaps();

mix.autoload({
    jquery: ['$', 'window.$', 'window.jQuery'],
});
