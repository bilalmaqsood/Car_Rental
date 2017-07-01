
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.swal = require('sweetalert2');
require('./design');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app-header', require('./components/Header.vue'));
Vue.component('vehicles-search-form', require('./components/SearchForm.vue'));

const app = new Vue({
    el: '#app',
    data: function () {
        return {
            message: null,
            loginSection: false,
        };
    },
    mounted() {
        this.prepareComponent();
    },

    ready() {
        this.prepareComponent();
    },
    methods: {
        prepareComponent() {
            this.fetchAuthUser();
        },

        fetchAuthUser() {
            axios.get('/api/user')
                .then(response => {
                    console.log(response.data);
                    this.message = JSON.stringify(response.data, null, 4);
                });
        },
        doLogin(){
            var email = $('#frmLogin input[name="email"]').val();
            var pass = $('#frmLogin input[name="password"]').val();
            console.log(email+pass);
            $.ajax({
                url: window.baseUrl+'/login',
                data: {_token: Qwikkar.csrfToken,email:email,password: pass},
                error: function(error) {
                    swal("Sorry!", "Invalid Username/Password.", "error");
                },
                type: 'POST',
                success: function(data) {

                    swal({
                        title: "",
                        text: "Login Successfully.",
                        type: "success"});
                    window.setTimeout(function(){
                        window.location=window.baseUrl;
                    } ,3000);

                }
            });
        },

    }
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
