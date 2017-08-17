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

if (!mix.inProduction()) {
    mix.sourceMaps();
}

mix
    .js('resources/assets/js/qwikkar.js', 'public/js')
    .js('resources/assets/js/admin.js', 'public/js')

    .extract(['lodash', 'jquery', 'vue', 'vuelidate', 'axios', 'noty'])

    .sass('resources/assets/sass/qwikkar.scss', 'public/css')

    .less('resources/assets/less/admin.less', 'public/css')

    .copy('resources/assets/images', 'public/images')
    .copy('node_modules/noty/lib/noty.css', 'public/css')
;

if (mix.inProduction()) {
    mix.version();
}
