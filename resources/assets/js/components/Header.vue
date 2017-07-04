<template>
    <div class="nav_wrapper">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    <img :src="baseURL + '/images/white_logo.png'" alt="" class="default_logo">
                    <img :src="baseURL + '/images/logo.png'" alt="" class="hover_logo">
                </a>
            </div>
            <div id="navbar" class="customize_nav">
                <transition name="flip" mode="out-in">
                    <ul class="nav navbar-nav navbar-right" key="unauthenticated" v-if="storage.auth==null">
                        <li>
                            <a href="javascript:;" @click="signUpUser">
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
                            <a href="javascript:;" @click="authSection = !authSection">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                </svg>
                                Login
                            </a>
                            <transition name="slide-fade">
                                <div v-if="authSection" class="auth-container">
                                    <transition name="flip" mode="in-out">

                                        <div class="user-want-container" v-if="authSectionView=='signup'" key="signup">
                                            <div class="user_type_selection text-left user-want-rent">
                                                <div class="btn-group" data-toggle="buttons" style="padding-top: 1rem">
                                                    <label class="btn btn-primary">
                                                        <input name="stylist" autocomplete="off" value="on" type="checkbox"> I want to rent
                                                    </label>
                                                    <label class="btn btn-primary">
                                                        <input name="beautician" autocomplete="off" value="on" type="checkbox"> I own a car
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="user_type_selection text-left user-rent-btn">
                                                <button class="primary_btn" @click="authSectionView='login'">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                                    </svg>
                                                    login
                                                </button>
                                                <button class="secodery_btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                                                    </svg>
                                                    done
                                                </button>
                                            </div>
                                        </div>

                                        <div class="login-section" v-if="authSectionView!='signup'" key="not-signup">
                                            <div class="button_box">

                                                <transition name="flip" mode="out-in">

                                                    <button class="secodery_btn" v-if="authSectionView=='forgot'" key="forgot">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                                                        </svg>
                                                        done
                                                    </button>

                                                    <button data-loading-text="Logging in..." :disabled="$v.form.$invalid" class="secodery_btn" v-if="authSectionView=='login'" @click="loginUser" key="login">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                                                        </svg>
                                                        Login
                                                    </button>

                                                </transition>

                                                <button class="primary_btn" @click="authSectionView='signup'">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon">
                                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use>
                                                    </svg>
                                                    Signup
                                                </button>
                                            </div>

                                            <transition name="flip" mode="out-in">
                                                <div class="login_form" v-if="authSectionView=='login'" key="login-form">
                                                    <form class="form-inline">
                                                        <div class="form-group" :class="{ 'has-error': $v.form.email.$error }">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                                            </svg>
                                                            <input class="form-control" placeholder="email" type="email" @blur="$v.form.email.$touch()" v-model.trim="form.email">
                                                        </div>
                                                        <div class="form-group" :class="{ 'has-error': $v.form.password.$error }">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon cursor-pointer" @click="authSectionView='forgot'">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use>
                                                            </svg>
                                                            <input class="form-control" placeholder="password" type="password" @blur="$v.form.password.$touch()" v-model.trim="form.password">
                                                        </div>
                                                        <p><span class="forgot-message">forgot your password? click the <span>padlock</span> icon to recover</span></p>
                                                    </form>
                                                </div>

                                                <div class="login_form" v-if="authSectionView=='forgot'" key="forgot-form">
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
                                                        <p><span class="forgot-message">have a password? click <span class="cursor-pointer" @click="authSectionView='login'">here</span> to login</span></p>
                                                    </form>
                                                </div>
                                            </transition>
                                        </div>
                                    </transition>
                                </div>
                            </transition>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right" key="authenticated" v-else>
                        <li>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cog_setting"></use>
                                </svg>
                                settings
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                                </svg>
                                payment
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon svg-icon-booking">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                                </svg>
                                bookings
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search_icon"></use>
                                </svg>
                                search
                            </a>
                        </li>
                        <li :class="{active: profile}">
                            <a href="javascript:;" @click="profile = !profile">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                </svg>
                                profile
                            </a>
                            <transition name="slide-fade">
                                <user-profile v-if="profile" :profileHeight="height"></user-profile>
                            </transition>
                        </li>
                    </ul>
                </transition>
            </div>
        </nav>
    </div>
</template>

<script>
    import User from '../user';
    import {required, email, minLength} from 'vuelidate/lib/validators';

    export default {
        data() {
            return {
                storage: User.state,
                baseURL: window.Qwikkar.baseUrl,
                message: null,
                authSection: false,
                authSectionView: 'login',
                profile: false,
                height: 0,
                form: {
                    email: '',
                    password: ''
                }
            };
        },

        validations: {
            form: {
                email: {
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

        methods: {
            prepareComponent() {
                this.refreshUserData();
                this.height = window.innerHeight - $('.nav.navbar-nav.navbar-right').height();
            },

            signUpUser() {
                console.log('sign up section');
                new Noty({
                    type: 'information',
                    text: 'Some notification text',
                }).show();
            },

            loginUser(e) {
                let $btn = $(e.target).button('loading');
                axios.post('/login', this.form).then(function (r) {
                    $btn.button('reset');
                    this.setUserData(r);
                });
            },

            fetchAuthUser() {
                let userLocal = localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : null;

                if (!userLocal)
                    this.refreshUserData();
                else
                    User.commit('update', userLocal);
            },

            refreshUserData() {
                axios.get('/api/user').then(this.setUserData);
            },

            setUserData(r) {
                User.commit('update', r.data.success);
//                localStorage.setItem('user', JSON.stringify(r.data));
            }
        }
    }
</script>
