<template>
    <div>
        <transition name="flip" mode="out-in">

            <div class="user-want-container" key="step-1" v-if="step=='type'">
                <div class="user_type_selection text-left user-want-rent">
                    <div class="btn-group" style="padding-top: 1rem">
                        <label class="btn btn-primary" :class="{active:user_type=='client', focus:user_type=='client'}" @click="user_type='client'">I want to rent</label>
                        <label class="btn btn-primary" :class="{active:user_type=='owner', focus:user_type=='owner'}" @click="user_type='owner'">I own a car</label>
                    </div>
                </div>

                <div class="user_type_selection text-left user-rent-btn">
                    <button class="primary_btn" @click="changeView">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                        </svg>
                        login
                    </button>
                    <button class="secodery_btn" @click="changeStep">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                        </svg>
                        done
                    </button>
                </div>
            </div>
            <register-terms v-if="step=='terms'" @term="termsvalue"></register-terms>
            <div class="basic_info" key="step-2" v-if="step=='basic_info'">
                <form>
                    <div class="form-group" :class="{ 'has-error': $v.basic_info.name.$error }">
                        <div class="input-group login-input">
                            <span class="input-group-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use> </svg>
                            </span>
                        <input v-model="basic_info.name" @blur="$v.basic_info.name.$touch()" type="text" class="form-control" placeholder="full name">
                        </div>
                        <span class="help-block text-sm" v-if="$v.basic_info.name.$error">Enter valid name</span>
                    </div>
                    <div class="form-group" :class="{ 'has-error': $v.basic_info.email.$error }">
                        <div class="input-group login-input">
                            <span class="input-group-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 25" class="svg-icon"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#form_envelope"></use> </svg>
                            </span>
                            <input v-model="basic_info.email" @blur="$v.basic_info.email.$touch()" type="email" class="form-control" placeholder="e-mail">
                        </div>
                        <span class="help-block text-sm" v-if="$v.basic_info.email.$error">Enter valid email</span>
                    </div>
                    <div class="form-group" :class="{ 'has-error': $v.basic_info.phone.$error }">
                        <div class="input-group login-input">
                            <span class="input-group-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 25" class="svg-icon"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#mobile"></use> </svg>
                            </span>
                        <input v-model="basic_info.phone" @blur="$v.basic_info.phone.$touch()" type="text" class="form-control phone-number" placeholder="phone number">
                        </div>
                        <span class="help-block text-sm" v-if="$v.basic_info.phone.$error">Enter valid phone</span>
                    </div>
                    <div class="form-group date-of-birth-form" :class="{ 'has-error': $v.basic_info.dob.$error }" v-if="user_type=='client'">
                        <div class="input-group login-input">
                            <span class="input-group-addon">
                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use> </svg>
                            </span>
                            <input type="text" @blur="updateDOB" class="form-control date-of-birth" placeholder="date of birth">
                        </div>
                        <span class="help-block text-sm" v-if="$v.basic_info.dob.$error">Enter valid date of birth</span>
                    </div>
                    <div class="form-group" :class="{ 'has-error': $v.basic_info.password.$error }">
                        <div class="input-group login-input">
                            <span class="input-group-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use> </svg>
                            </span>
                            <input v-model="basic_info.password" @blur="$v.basic_info.password.$touch()" type="password" class="form-control" placeholder="password">
                        </div>
                        <span class="help-block text-sm" v-if="$v.basic_info.password.$error">Enter valid password of 6 digits long</span>
                    </div>
                    <button type="button" class="secodery_btn" @click="changeStep" :disabled="$v.basic_info.$invalid" data-loading-text="owner signing up ...">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                        </svg>
                        next
                    </button>
                    <button type="button" class="primary_btn" @click="changeView">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                        </svg>
                        Login
                    </button>
                </form>
            </div>

            <div class="basic_info" key="step-3" v-if="step=='driver_info'">
                <form>
                    <div class="form-group">
                        <div class="input-group login-input">
                            <span class="input-group-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon svg-icon-booking"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use> </svg>
                            </span>
                            <input type="text" class="form-control" placeholder="national insurance number" v-model="driver_info.insurance">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group login-input">
                            <span class="input-group-addon">
                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon svg-icon-booking"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use> </svg>
                            </span>
                            <input type="text" class="form-control" placeholder="PCO certificate number" v-model="driver_info.pco_number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group login-input">
                            <span class="input-group-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use> </svg>
                            </span>
                            <input type="text" class="form-control certificate-expiration" placeholder="PCO certificate expiration date" @blur="updateCertificateExpiration">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="input-group login-input">
                            <span class="input-group-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use> </svg>
                            </span>
                            <input type="text" class="form-control" placeholder="driver’s license number" v-model="driver_info.driving">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group login-input">
                            <span class="input-group-addon">
                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use> </svg>
                            </span>
                            <input type="text" class="form-control" placeholder="postcode on driver’s license" v-model="driver_info.postcode">
                        </div>
                    </div>
                    <button type="button" class="secodery_btn" @click="changeStep" data-loading-text="driver signing up ...">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                        </svg>
                        done
                    </button>
                    <button type="button" class="secodery_btn" @click="skipStep" style="right: 100px; z-index: 9999">
                        Skip
                    </button>
                    <button type="button" class="primary_btn" @click="changeView">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                        </svg>
                        Login
                    </button>
                </form>
            </div>

        </transition>

    </div>
</template>

<script>
    import User from '../user';
    import {DateValidator, AlphaSpaceValidator} from '../validators';
    import {required, email, minLength, sameAs} from 'vuelidate/lib/validators';

    export default {
        data() {
            return {
                step: 'type',
                oldstep: '',
                terms: false,
                user_type: 'client',
                basic_info: {
                    name: null,
                    email: null,
                    phone: null,
                    dob: null,
                    password: null
                },
                driver_info: {
                    driving: null,
                    postcode: null,
                    insurance: null,
                    pco_number: null,
                    pco_expiry_date: null
                }
            };
        },

        validations: {
            basic_info: {
                name: {
                    required,
                    AlphaSpaceValidator
                },
                email: {
                    required,
                    email
                },
                phone: {},
                dob: {
                    DateValidator,
                },
                password: {
                    required,
                    minLength: minLength(6)
                }
            },
            driver_info: {
                driving: {
                    required
                },
                postcode: {
                    required
                },
                insurance: {},
                pco_number: {},
                pco_expiry_date: {}
            }
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                console.log('register componenet mounted');
            },

            updateCertificateExpiration(e) {
                this.driver_info.pco_expiry_date = e.target.value;
            },

            updateDOB(e) {
                this.basic_info.dob = e.target.value;
            },

            changeView() {
                this.$emit('updateView');
            },

            changeStep(e) {
                switch (this.step) {
                    case 'type':
                        this.step = 'basic_info';

                        setTimeout(function () {
                            new Inputmask({
                                mask: [{mask: '0### ### ####'}],
                                greedy: false,
                                definitions: {'#': {validator: "[0-9]", cardinality: 1}}
                            }).mask(document.querySelector('.phone-number'));

                            $('.date-of-birth').datetimepicker({
                                format: 'MM/DD/YYYY',
                                viewMode: 'years'
                            });
                        }, 455);

                        break;

                    case 'basic_info':
                        this.process2ndStep(e);
                        break;
                    case 'terms':
                        this.step = 'terms';
                    break;
                    case 'driver_info':
                        this.validateClient();
                        break;
                }
            },

            process2ndStep(e) {
                if (this.user_type === 'owner') {
                    this.validateOwner(e);
//                    let $t = this;
//                    let $btn = $(e.target).button('loading');
//
//                    let postData = JSON.parse(JSON.stringify(this.basic_info));
//                    postData.phone = postData.phone ? postData.phone.replace(/[\s\(\)]/g, '') : null;
//
//                    axios.post('/api/register/' + this.user_type, this.cleanParams(postData)).then(function (r) {
//                        $t.successRegister();
//                        $btn.button('reset');
//                    }).catch(function (r) {
//                        $btn.button('reset');
//                    });
                }
                else if (this.user_type === 'client') {
                    let $this=this;
                    let $btn = $(e.target).button('loading');
                    axios.post('/api/validate/register/' + this.user_type, this.basic_info).then(function (r) {
                        $this.step = 'driver_info';
                    }).catch(function (r) {
                        $btn.button('reset');
                    });
                    
                    setTimeout(function() {
                        $('.certificate-expiration').datetimepicker({
                            format: 'MM/DD/YYYY',
                            viewMode: 'years'
                        });
                    }, 1000);
                }
            },

            cleanParams(data) {
                let cleaned = {};

                _.each(data, function (v, k) {
                    if (v && (k === 'dob' || k === 'pco_expiry_date'))
                        v = moment.utc(v, 'MM/DD/YYYY', true).format('YYYY-MM-DD');
                    if (v)
                        cleaned[k] = v;
                });

                return cleaned;
            },
            processOwner(){
                let $t = this;
                    let postData = JSON.parse(JSON.stringify(this.basic_info));
                    postData.phone = postData.phone ? postData.phone.replace(/[\s\(\)]/g, '') : null;
                    axios.post('/api/register/' + this.user_type, this.cleanParams(postData)).then(function (r) {
                        $t.successRegister();
                    }).catch(function (r) {
                    });
            },
            processClient(){
                        let $t = this;
                        let postData = JSON.parse(JSON.stringify(_.merge(this.basic_info, this.driver_info)));
                        postData.phone = postData.phone ? postData.phone.replace(/[\s\(\)]/g, '') : null;
                                axios.post('/api/register/' + this.user_type, this.cleanParams(postData)).then(function (r) {
                                    $t.successRegister();
                                }).catch(function (r) {
                                });
            },
            validateClient(){
                let $t = this;
                let postData = JSON.parse(JSON.stringify(_.merge(this.basic_info, this.driver_info)));
                postData.phone = postData.phone ? postData.phone.replace(/[\s\(\)]/g, '') : null;
                axios.post('/api/validate/register/' + this.user_type, this.cleanParams(postData)).then(function (r) {
                    $t.oldstep = 'owner_info';
                    $t.step = 'terms';
                }).catch(function (r) {

                });
            },
            validateOwner(e){
                let $t = this;
                let $btn = $(e.target).button('loading');

                let postData = JSON.parse(JSON.stringify(this.basic_info));
                postData.phone = postData.phone ? postData.phone.replace(/[\s\(\)]/g, '') : null;

                axios.post('/api/validate/register/' + this.user_type, this.cleanParams(postData)).then(function (r) {
                    $t.oldstep = 'owner_info';
                    $t.step = 'terms';
                }).catch(function (r) {
                    $btn.button('reset');
                });
            },
            successRegister() {
                let $t = this;

                new Noty({
                    type: 'information',
                    text: this.basic_info.name + ' has been registered successfully.',
                }).show();

                setTimeout(function () {
                    $t.$emit('hideView');
                }, 150);

                axios.post('/login', {
                    email: this.basic_info.email,
                    password: this.basic_info.password
                }).then(function () {
                    localStorage.reloadData = JSON.stringify(User.state);
                    window.location.href = '/';
                });
            },
            termsvalue(value){
                if(value && this.oldstep=='driver_info'){
                    this.processClient();
                }
                if(value && this.oldstep=='owner_info'){
                    this.processOwner();
                }
            },
            skipStep(){
                if(confirm("Are you sure to skip this step")){
                    this.changeStep();
                }
            }
        }
    }
</script>
