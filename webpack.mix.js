let mix = require('laravel-mix');

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

mix.js('resources/assets/js/front/script.js', 'public/front/js')
.sass('resources/assets/sass/front/style.scss', 'public/front/css').version();

mix.react('resources/assets/js/front/map.js', 'public/front/js')
.sass('resources/assets/sass/front/map.scss', 'public/front/css').version();

mix.js('resources/assets/js/store/script.js', 'public/store/js')
.sass('resources/assets/sass/store/style.scss', 'public/store/css').version();

mix.js('resources/assets/js/dashboard/script.js', 'public/dashboard/js')
.sass('resources/assets/sass/dashboard/style.scss', 'public/dashboard/css').version();

mix.disableNotifications();