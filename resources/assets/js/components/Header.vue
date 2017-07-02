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
                        <a href="javascript:;" @click="authSection = !authSection">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                            </svg>
                            Login
                        </a>
                        <transition name="slide-fade">
                            <div v-if="authSection" class="auth-container">
                                <transition name="flip" mode="in-out">

                                    <div v-if="authSectionView=='signup'" key="signup">
                                        <div class="user_type_selection text-left">
                                            <p class="cursor-pointer">I want to rent</p>
                                            <button class="secodery_btn" @click="authSectionView='login'">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                                </svg>
                                                login
                                            </button>
                                        </div>
                                        <div class="user_type_selection text-left">
                                            <p class="cursor-pointer">I own a car</p>
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

                                            <transition name="flip" mode="in-out">

                                                <button class="secodery_btn" v-if="authSectionView=='forgot'" key="forgot">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                                                    </svg>
                                                    done
                                                </button>

                                                <button class="secodery_btn" v-if="authSectionView=='login'" @click="loginUser" key="login">
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

                                        <div class="login_form" v-if="authSectionView=='login'">
                                            <form class="form-inline">
                                                <div class="form-group" :class="{ 'has-error': $v.form.emailValue.$error }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                                    </svg>
                                                    <input class="form-control" placeholder="email" type="email" @blur="$v.form.emailValue.$touch()" v-model.trim="form.emailValue">
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

                                        <div class="login_form" v-if="authSectionView=='forgot'">
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
                                    </div>
                                </transition>

                            </div>
                        </transition>

                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
    import {User, App} from '../user';
    import {required, email, minLength} from 'vuelidate/lib/validators';

    export default {
        data() {
            return {
                baseURL: App.state.baseUrl,
                message: null,
                authSection: false,
                authSectionView: 'login',
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

        methods: {
            prepareComponent() {
                this.fetchAuthUser();
            },

            signUpUser() {
                console.log('sign up section');
            },

            loginUser() {
                console.log(User.state.auth);
                console.log(this.form);
                console.log(this.$v.$invalid);
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
                User.commit('update', r.data);
                localStorage.setItem('user', JSON.stringify(r.data));
            }
        }
    }
</script>
