const {mix} = require('laravel-mix');
const Mixer = require('./mix.extend.js');

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

Mixer.run();

mix
    .js('resources/assets/js/qwikkar.js', 'public/js')
    .extract(['lodash', 'jquery', 'vue', 'axios', 'react', 'react-dom'])
    .react('resources/assets/js/react-app.jsx', 'public/js')
    .sass('resources/assets/sass/qwikkar.scss', 'public/css')
    .scripts([
        'public/js/jst.js'
    ], 'public/js/jst.js')
    .copy('resources/assets/images', 'public/images')
    .version()
;
