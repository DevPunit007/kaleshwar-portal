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

mix.js('resources/js/app.js', 'public/js');
mix.copy('resources/js/basic.js', 'public/js/basic.js');
mix.copy('resources/js/help-tours.js', 'public/js/help-tours.js');

mix.copy('resources/extensions/gull/js/vendor/perfect-scrollbar.min.js', 'public/js/perfect-scrollbar.min.js');
mix.copy('resources/extensions/hopscotch/dist/js/hopscotch.min.js', 'public/js/hopscotch.min.js');
mix.sass('resources/sass/app.scss', 'public/css');
mix.copyDirectory('resources/images', 'public/images');
mix.copyDirectory('resources/css', 'public/css');
