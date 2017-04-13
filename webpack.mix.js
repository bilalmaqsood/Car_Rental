const {mix} = require('laravel-mix');
const Extend = require('./webpack.extend.js');

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

Extend.run();

mix
    .js('resources/assets/js/qwikkar.js', 'public/js')
    .sass('resources/assets/sass/qwikkar.scss', 'public/css')
    .version()
;
