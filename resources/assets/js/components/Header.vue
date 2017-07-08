<template>
    <div>
        <div class="nav_wrapper">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">
                        <img :src="baseURL + '/images/white_logo.png'" alt="" class="default_logo">
                        <img :src="baseURL + '/images/logo.png'" alt="" class="hover_logo">
                    </a>
                </div>

                <transition name="flip" mode="out-in">
                    <div class="search_filter" v-if="storage.state.searchView && !storage.state.detailsDisplay" @click="showAdvanceForm" key="advance">
                        <button class="search_filter_btn primary_btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#filters_icon"></use>
                            </svg>
                        </button>
                    </div>
                    <div class="search_filter" v-if="storage.state.detailsDisplay" @click="closeDetailForm" key="close">
                        <button class="search_filter_btn primary_btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close_icon"></use>
                            </svg>
                        </button>
                    </div>
                </transition>

                <div id="navbar" class="customize_nav">
                    <transition name="flip" mode="out-in">
                        <ul class="nav navbar-nav navbar-right" key="unauthenticated" v-if="storage.state.auth==null">
                            <li>
                                <a href="javascript:;" @click="scrollOnPage('about_section_wrapper')">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cog_setting"></use>
                                    </svg>
                                    about us
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" @click="scrollOnPage('contact_us')">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                                    </svg>
                                    contact us
                                </a>
                            </li>
                            <li :class="{active: storage.state.authSection}">
                                <a href="javascript:;" @click="changeView">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                    </svg>
                                    login
                                </a>
                                <transition name="slide-fade">
                                    <div v-if="storage.state.authSection" class="auth-container">
                                        <transition name="flip" mode="in-out">
                                            <user-register @hideView="hideViewParentChild" @updateView="updateAuthViewChild" v-if="authSectionView=='signup'" key="signup"></user-register>

                                            <div class="login-section" v-if="authSectionView!='signup'" key="not-signup" :style="{width:(authSectionView=='reset' ? '40%' : '')}">
                                                <div class="button_box">

                                                    <transition name="flip" mode="out-in">

                                                        <button data-loading-text="doing ..." :disabled="$v.forgot.$invalid" class="secodery_btn" v-if="authSectionView=='forgot'" @click="resetUserPassword" key="forgot">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                                                            </svg>
                                                            done
                                                        </button>

                                                        <button data-loading-text="logging in..." :disabled="$v.login.$invalid" class="secodery_btn" v-if="authSectionView=='login'" @click="loginUser" key="login">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                                                            </svg>
                                                            login
                                                        </button>

                                                        <button data-loading-text="resetting ..." :disabled="$v.login.email.$invalid" class="secodery_btn" v-if="authSectionView=='reset'" @click="resetUser" key="reset">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                                                            </svg>
                                                            reset
                                                        </button>

                                                    </transition>

                                                    <button class="primary_btn" @click="authSectionView='signup'" v-if="authSectionView!='forgot'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use>
                                                        </svg>
                                                        Signup
                                                    </button>
                                                </div>

                                                <transition name="flip" mode="out-in">
                                                    <div class="login_form" v-if="authSectionView=='reset'" key="reset-form" :style="{width:(authSectionView=='reset' ? '63%' : '')}">
                                                        <form class="form-inline">
                                                            <div class="form-group" :class="{ 'has-error': $v.login.email.$error }">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                                                </svg>
                                                                <input class="form-control" placeholder="email" type="email" @blur="$v.login.email.$touch()" v-model.trim="login.email">
                                                            </div>
                                                            <p><span class="forgot-message">have a password? click <span class="cursor-pointer" @click="authSectionView='login'">here</span> to login</span></p>
                                                        </form>
                                                    </div>

                                                    <div class="login_form" v-if="authSectionView=='login'" key="login-form">
                                                        <form class="form-inline">
                                                            <div class="form-group" :class="{ 'has-error': $v.login.email.$error }">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                                                </svg>
                                                                <input class="form-control" placeholder="email" type="email" @blur="$v.login.email.$touch()" v-model.trim="login.email">
                                                            </div>
                                                            <div class="form-group" :class="{ 'has-error': $v.login.password.$error }">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon cursor-pointer" @click="authSectionView='reset'">
                                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use>
                                                                </svg>
                                                                <input class="form-control" placeholder="password" type="password" @blur="$v.login.password.$touch()" v-model.trim="login.password">
                                                            </div>
                                                            <p><span class="forgot-message">forgot your password? click the <span>padlock</span> icon to recover</span></p>
                                                        </form>
                                                    </div>

                                                    <div class="login_form" v-if="authSectionView=='forgot'" key="forgot-form" :style="{width:(authSectionView=='forgot' ? '85%' : '')}">
                                                        <form class="form-inline">
                                                            <div class="form-group" :class="{ 'has-error': $v.forgot.email.$error }">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                                                </svg>
                                                                <input class="form-control" placeholder="email" type="email" @blur="$v.forgot.email.$touch()" v-model.trim="forgot.email">
                                                            </div>
                                                            <div class="form-group" :class="{ 'has-error': $v.forgot.password.$error }">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon">
                                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use>
                                                                </svg>
                                                                <input type="password" class="form-control" placeholder="new password" @blur="$v.forgot.password.$touch()" v-model.trim="forgot.password">
                                                            </div>
                                                            <div class="form-group" :class="{ 'has-error': $v.forgot.password_confirmation.$error }">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon">
                                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use>
                                                                </svg>
                                                                <input type="password" class="form-control" placeholder="re-type password" @blur="$v.forgot.password_confirmation.$touch()" v-model.trim="forgot.password_confirmation">
                                                            </div>
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

                <div class="spinner-container side-loader" id="sideLoader">
                    <div class="spinner-frame">
                        <div class="spinner-cover"></div>
                        <div class="spinner-bar"></div>
                    </div>
                </div>
            </nav>
        </div>

        <home-page ref="home"></home-page>
    </div>
</template>

<script>
    import User from '../user';
    import {required, email, minLength, sameAs} from 'vuelidate/lib/validators';

    export default {
        data() {
            return {
                storage: User,
                baseURL: window.Qwikkar.baseUrl,
                message: null,
                authSectionView: 'login',
                profile: false,
                height: 0,
                login: {
                    email: '',
                    password: ''
                },
                forgot: {
                    email: '',
                    token: '',
                    password: '',
                    password_confirmation: ''
                }
            };
        },

        validations: {
            login: {
                email: {
                    required,
                    email
                },
                password: {
                    required,
                    minLength: minLength(6)
                }
            },
            forgot: {
                email: {
                    required,
                    email
                },
                password: {
                    required,
                    minLength: minLength(6)
                },
                password_confirmation: {
                    required,
                    minLength: minLength(6),
                    sameAsPassword: sameAs('password')
                }
            }
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                this.refreshUserData();
                this.renderResetPasswordIf();
                this.height = window.innerHeight - $('.nav.navbar-nav.navbar-right').height();
            },

            hideViewParentChild() {
                User.commit('updateAuthView', false);
                this.authSectionView = 'login';
            },

            changeView() {
                User.commit('updateAuthView', !User.state.authSection);
            },

            updateAuthViewChild() {
                this.authSectionView = 'login';
            },

            renderResetPasswordIf: function () {
                let hash = window.location.hash;
                if (hash.indexOf('#reset-password-') !== -1) {
                    this.forgot.token = hash.replace('#reset-password-', '');
                    User.commit('updateAuthView', true);
                    this.authSectionView = 'forgot';
                }
            },

            scrollOnPage(to) {
                $("html, body").animate({scrollTop: $('#' + to).offset().top - 50}, 1000);
            },

            loginUser(e) {
                let $this = this;
                let $btn = $(e.target).button('loading');
                axios.post('/login', this.login).then(function (r) {
                    console.log(r);
                    $btn.button('reset');
//                    $this.setUserData(r);
                    new Noty({
                        type: 'information',
                        text: '<b>' + r.data.success.name + '</b> has been logged in.',
                    }).show();
                    $this.resetAuthView();
                    $this.saveSettingsLocally();
                    window.location.href = '/';
                }).catch(function (r) {
                    $btn.button('reset');
                });
            },

            saveSettingsLocally() {
                localStorage.reloadData = JSON.stringify(User.state);
            },

            resetUser(e) {
                let $this = this;
                let $btn = $(e.target).button('loading');
                axios.post('/api/forgot', {email: this.login.email}).then(function (r) {
                    $btn.button('reset');
                    new Noty({
                        type: 'information',
                        text: r.data.success,
                    }).show();
                    $this.resetAuthView();
                }).catch(function (r) {
                    $btn.button('reset');
                });
            },

            resetUserPassword(e) {
                let $this = this;
                let $btn = $(e.target).button('loading');
                axios.post('/password/reset', this.forgot).then(function (r) {
                    $btn.button('reset');
                    new Noty({
                        type: 'information',
                        text: r.data.success,
                    }).show();
                    $this.resetAuthView();
                    window.location.href = '/';
                }).catch(function (r) {
                    $btn.button('reset');
                });
            },

            refreshUserData() {
                axios.get('/api/user').then(this.setUserData);
            },

            resetAuthView() {
                User.commit('updateAuthView', false);
                this.authSectionView = 'login';
            },

            setUserData(r) {
                if (r.data.success.type === 'owner' || r.data.success.type === 'client') {
                    User.commit('update', r.data.success);
                    this.$refs.home.prepareComponent();
                } else
                    window.location.href = '/logout';
            },

            showAdvanceForm(e) {
                User.commit('advance');
            },

            closeDetailForm(e) {
                User.commit('details', false);
            }
        }
    }
</script>
