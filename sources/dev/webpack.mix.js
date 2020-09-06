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
mix.js('resources/js/jotform/errorNavigation.js', 'public/js/jotform')
    .sass('resources/sass/jotform/jot.scss', 'public/css');
mix.js('resources/js/jotform/fileuploader.js', 'public/js/jotform');
mix.js('resources/js/jotform/imageinfo.js', 'public/js/jotform');
mix.js('resources/js/jotform/jotform.forms.js', 'public/js/jotform');
mix.js('resources/js/jotform/prototype.forms.js', 'public/js/jotform');
mix.js('resources/js/jotform/smoothscroll.min.js', 'public/js/jotform');


