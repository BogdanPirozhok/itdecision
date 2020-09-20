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

mix.js('resources/assets/js/Home/index.js', 'public/assets/js/home.js')
    .js('resources/assets/js/Login/index.js', 'public/assets/js/login.js')
    .extract(['vue']);

mix.sass('resources/assets/sass/Home/index.scss', 'public/assets/css/home.css');
