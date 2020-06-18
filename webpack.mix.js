const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
}

mix.disableNotifications();
