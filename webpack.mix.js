const {mix} = require('laravel-mix');

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

mix
    .js('resources/assets/js/qwikkar.js', 'public/js')
    .js('resources/assets/js/admin.js', 'public/js')

    .extract(['lodash', 'jquery', 'vue', 'vuelidate', 'axios', 'noty'])

    .sass('resources/assets/sass/qwikkar.scss', 'public/css')
    .sass('resources/assets/sass/admin.scss', 'public/css')

    .less('resources/assets/less/style.scss', 'public/css')

    .copy('resources/assets/images', 'public/images')
;

if (mix.inProduction()) {
    mix.version();
}
