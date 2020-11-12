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

mix.sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/home.scss', 'public/css')
    .sass('resources/sass/customCarousel.scss', 'public/css')
    .sass('resources/sass/productsPage.scss', 'public/css')
    .sass('resources/sass/account.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .js('resources/js/admin/colors.js', 'public/js/admin')
    .js('resources/js/admin/sizes.js', 'public/js/admin');
