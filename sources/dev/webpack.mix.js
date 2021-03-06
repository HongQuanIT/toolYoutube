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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
mix.js('resources/js/pages/youtube.js', 'public/js/pages')
    .sass('resources/sass/youtube.scss', 'public/css/pages');
mix.sass('resources/sass/material-dashboard.scss', 'public/material/css');
mix.js('resources/js/pages/render.js', 'public/js/pages')
    .sass('resources/sass/render.scss', 'public/css/pages');


