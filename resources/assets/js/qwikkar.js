
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./design');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app-header', require('./components/Header.vue'));

const app = new Vue({
    el: '#app'
});

// setTimeout(function () {
//     console.log('timeout triggered');
//     $('#app-navbar-collapse').html(_.template(Qwikkar['panel.html']({
//         data: {
//             name: 'oknasir',
//             description: 'panel description for oknasir'
//         }
//     })));
// }, 3000);
