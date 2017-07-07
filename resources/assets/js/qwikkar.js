
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
Vue.component('home-page', require('./components/HomePage.vue'));
Vue.component('user-register', require('./components/Register.vue'));
Vue.component('user-profile', require('./components/Profile.vue'));
Vue.component('vehicles-search-form', require('./components/SearchForm.vue'));
Vue.component('search-listing', require('./components/SearchListing.vue'));
Vue.component('search-listing-details', require('./components/SearchListingDetails.vue'));
Vue.component('contact-us-form', require('./components/ContactForm.vue'));
Vue.component('search-listing-booking', require('./components/BookVehicle.vue'));
Vue.component('top-vehicles-listing', require('./components/TopVehicleListing.vue'));
Vue.component('vehicle-crud', require('./components/vehicles.vue'));
Vue.component('vehicle-input-form', require('./components/VehiclesInputForm.vue'));

Vue.filter('currency', require('./filters/currency'));

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
