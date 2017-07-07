window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

require('bootstrap-sass');

require('eonasdan-bootstrap-datetimepicker');

require('jquery.easing');

require('owl.carousel');

window.Inputmask = require('inputmask');
window.numeral = require('numeral');
window.moment = require('moment');

/**
 * NOTY is a notification library that makes it easy to
 * create alert - success - error - warning - information - confirmation
 * messages as an alternative the standard alert dialog.
 */

window.Noty = require('noty');

Noty.overrideDefaults({
    layout: 'topRight',
    theme: 'mint',
    timeout: 4000
});

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');

const {Vuelidate} = require('vuelidate');

Vue.use(Vuelidate);

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.baseURL = window.Qwikkar.baseUrl;
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Qwikkar.csrfToken;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    if (error.response && error.response.status === 422) {
        $.each(error.response.data, function (k, v) {
            new Noty({
                type: 'error',
                text: '<div><p class="m-0"><b>' + k.toCapitalizeCase() + ' : </b></p><p class="m-0">' + v + '</p></div>'
            }).show();
        });
    }
    $('#sideLoader').hide();
    return Promise.reject(error);
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });

/**
 * Define prototypes for Class objects
 */

String.prototype.toCapitalizeCase = function () {
    return this.charAt(0).toUpperCase() + this.slice(1);
};
