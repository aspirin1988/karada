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
    .js('resources/js/app_.js', 'public/js')
    .js('resources/js/app_icons.js', 'public/js')
    .js('resources/js/courses.js', 'public/js')
    .js('resources/js/profile.js', 'public/js')
    .js('resources/js/main.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/courses.scss', 'public/css')
   .sass('resources/sass/test.scss', 'public/css')
   .sass('resources/sass/profile.scss', 'public/css')
   .sass('resources/sass/admin.scss', 'public/css');
