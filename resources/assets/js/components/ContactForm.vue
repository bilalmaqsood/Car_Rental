<template>
    <div class="get_intuch_wrapper">
        <div class="getin_touch_section">
            <h2>Get in touch</h2>

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#contact_us" aria-controls="contact_us" role="tab" data-toggle="tab">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#send"></use>
                        </svg>
                        contact us
                    </a>
                </li>
                <li role="presentation">
                    <a href="#report_issue" aria-controls="report_issue" role="tab" data-toggle="tab">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#issue"></use>
                        </svg>
                        report issue
                    </a>
                </li>
                <li role="presentation">
                    <a href="#faqs_tab" aria-controls="faqs_tab" role="tab" data-toggle="tab">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#info_icon"></use>
                        </svg>
                        FAQs
                    </a>
                </li>
            </ul>

            <div class="tab-content">
            <transition name="flip" mode="out-in">
                <div v-if="postSuccess" class="alert alert-success" role="alert">
                    <h4>{{response}}</h4>
                    <div class="clearfix"></div>
                </div>
            </transition>
                <div role="tabpanel" class="tab-pane active" id="contact_us">
                    <div class="contact_form">
                        <form>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group" :class="{ 'has-error': $v.form.name.$error }">
<div class="input-group login-input">
<div class="input-group-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                    </svg>
</div>
                                    <input type="text" class="form-control" placeholder="full name" v-model="form.name">
</div>                                
</div>
                                <div class="form-group" :class="{ 'has-error': $v.form.email.$error }">
<div class="input-group login-input">
<div class="input-group-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 25" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#form_envelope"></use>
                                    </svg>
</div>
                                    <input type="email" class="form-control" placeholder="e-mail" v-model.trim="form.email">
</div>
                                </div>
                                <div class="form-group" :class="{ 'has-error': $v.form.phone.$error }">
<div class="input-group login-input">
<div class="input-group-addon">                                   
 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 25" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#mobile"></use>
                                    </svg>
</div>
                                    <input type="text" class="form-control" placeholder="phone number" v-model.trim="form.phone">
</div>
                                </div>
                                <div class="form-group" :class="{ 'has-error': $v.form.subject.$error }">
<div class="input-group login-input">
<div class="input-group-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#sign_contract_icon"></use>
                                    </svg>
</div>
                                    <input type="text" class="form-control" placeholder="subject" v-model="form.subject">
</div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-textarea">
                                <div class="form-group" :class="{ 'has-error': $v.form.message.$error }">
<div class="input-group login-input">
<div class="input-group-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                                    </svg>
</div>
                                    <textarea class="form-control" placeholder="your message" v-model="form.message"></textarea>
</div>
                                </div>
                                <button type="button" class="submit" @click="postForm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="report_issue">
                    <p>Nunc volutpat vehicula erat at facilisis. Quisque congue et turpis non maHs. Quisque egestas eleifend purus, eu finibus magna. In cursus fringilla leo consequat sollicitudin. Nunc in massa orci. Aenean pulvinar egestas rutrum. Aliquam elit libero, porta ac neque ut, fringilla laoreet lectus. Sed ut metus vitae risus iaculis vulputate. Curabitur preEum turpis nec velit commodo, nec egestas quam fringilla. Cras molesEe turpis eu lacus fringilla sodales. EEam a vesEbulum felis. Suspendisse laoreet dignissim nibh in posuere. Aenean a nisl dignissim, hendrerit magna vitae, interdum nisi. Suspendisse volutpat tortor vel libero dignissim, a viverra ex gravida.</p>
                </div>

                <div role="tabpanel" class="tab-pane" id="faqs_tab">
                    <p>Nunc volutpat vehicula erat at facilisis. Quisque congue et turpis non maHs. Quisque egestas eleifend purus, eu finibus magna. In cursus fringilla leo consequat sollicitudin. Nunc in massa orci. Aenean pulvinar egestas rutrum.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {required, email, minLength} from 'vuelidate/lib/validators';

    export default {
        data() {
            return {
                form: {
                    name: '',
                    phone: '',
                    subject: '',
                    message: '',
                    email: '',
                },
                postSuccess: false,
                response: ''
            };
        },

        validations: {
            form: {
                email: {
                    required,
                    email
                },
                name: {
                    required,
                    minLength: minLength(6)
                },
                phone: {
                    minLength: minLength(6)
                },
                subject: {
                    minLength: minLength(3)
                },
                message: {
                    required,
                    minLength: minLength(6)
                }
            }
        },

        mounted() {
        },

        methods: {
            postForm() {
                let $this = this;
                axios.post('/api/contact', this.prepareForm())
                    .then(response => {
                        this.response = response.data.success;
                        this.postSuccess = true;
                        setTimeout(function(){ 
                            $this.postSuccess = false;
                        }, 3000);
                    });
            },

            prepareForm() {
                let input = this.form;

                Object.keys(input).forEach(function (key) {
                    if (input[key].length <= 0) {
                        delete input[key];
                    }
                });

                return input;
            }
        }
    }
</script>
