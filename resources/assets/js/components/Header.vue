<template>
    <div class="nav_wrapper">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    <img src="/images/white_logo.png" alt="" class="default_logo"/>
                    <img src="/images/logo.png" alt="" class="hover_logo"/>
                </a>
            </div>
            <div id="navbar" class="customize_nav">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cog_setting"></use>
                            </svg>
                            about us
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                            </svg>
                            contact us
                        </a>
                    </li>
                    <li class="active">
                        <a href="javascript:;" @click="loginSection = !loginSection">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                            </svg>
                            Login
                        </a>
                        <transition name="slide-fade">
                            <div class="login-section" v-show="loginSection||forgotSection">
                                <div class="button_box">
                                    <button class="secodery_btn" v-if="forgotSection">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                                        </svg>
                                        done
                                    </button>
                                    <button class="secodery_btn" v-else-if="loginSection" @click="loginUser">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                                        </svg>
                                        Login
                                    </button>
                                    <button class="primary_btn" @click="signUpSection">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use>
                                        </svg>
                                        Signup
                                    </button>
                                </div>
                                <div class="login_form" v-if="loginSection">
                                    <form class="form-inline">
                                        <div class="form-group" :class="{ 'has-error': $v.form.emailValue.$error }">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                            </svg>
                                            <input class="form-control" placeholder="email" type="email" @blur="$v.form.emailValue.$touch()" v-model.trim="form.emailValue">
                                        </div>
                                        <div class="form-group" :class="{ 'has-error': $v.form.password.$error }">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon cursor-pointer" @click="forgotSection = true; loginSection = false">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use>
                                            </svg>
                                            <input class="form-control" placeholder="password" type="password" @blur="$v.form.password.$touch()" v-model.trim="form.password">
                                        </div>
                                        <p><span class="forgot-message">forgot your password? click the <span>padlock</span> icon to recover</span></p>
                                    </form>
                                </div>
                                <div class="login_form" v-else-if="forgotSection">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use>
                                            </svg>
                                            <input type="password" class="form-control" placeholder="new password">
                                        </div>
                                        <div class="form-group">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use>
                                            </svg>
                                            <input type="password" class="form-control" placeholder="re-type password">
                                        </div>
                                        <p><span class="forgot-message">have a password? click <span class="cursor-pointer" @click="forgotSection = false; loginSection = true">here</span> to login</span></p>
                                    </form>
                                </div>
                            </div>
                        </transition>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
    import store from '../store';
    const { required, email, minLength } = require("vuelidate/lib/validators");

    export default {
        data() {
            return {
                message: null,
                loginSection: false,
                forgotSection: false,
                form: {
                    emailValue: '',
                    password: ''
                }
            };
        },

        validations: {
            form: {
                emailValue: {
                    required,
                    email
                },
                password: {
                    required,
                    minLength: minLength(6)
                }
            }
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

            signUpSection() {
                console.log('sign up section');
            },

            loginUser() {
                console.log(store.state.count);
                console.log(this.form);
                console.log(this.$v.$invalid);
            },

            fetchAuthUser() {
                axios.get('/api/user')
                    .then(response => {
                        console.log(response.data);
                        this.message = JSON.stringify(response.data, null, 4);
                    });
            }
        }
    }
</script>
