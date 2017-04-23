const { mix } = require('laravel-mix');

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

mix.copy('resources/assets/vendor/bootstrap/fonts', 'public/fonts');
mix.copy('resources/assets/vendor/font-awesome/fonts', 'public/fonts');

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sourceMaps()
    .extract(['vue', 'vue-router', 'vuex', 'localforage', 'axios', 'jquery', 'bootstrap-sass', 'lodash'])
    .version();

mix.styles([
    'resources/assets/vendor/bootstrap/css/bootstrap.css',
    'resources/assets/vendor/animate/animate.css',
    'resources/assets/vendor/font-awesome/css/font-awesome.css',
], 'public/css/vendor.css');
