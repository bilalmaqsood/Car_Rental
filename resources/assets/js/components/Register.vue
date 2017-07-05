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

            <div class="basic_info" key="step-2" v-if="step=='basic_info'">
                <div class="form-group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                    </svg>
                    <input type="text" class="form-control" placeholder="full name">
                </div>
                <div class="form-group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 25" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#form_envelope"></use>
                    </svg>
                    <input type="email" class="form-control" placeholder="e-mail">
                </div>
                <div class="form-group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 25" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#mobile"></use>
                    </svg>
                    <input type="text" class="form-control" placeholder="phone number">
                </div>
                <div class="form-group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                    </svg>
                    <input type="text" class="form-control" placeholder="date of birth">
                </div>
                <div class="form-group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use>
                    </svg>
                    <input type="password" class="form-control" placeholder="password">
                </div>
                <button class="secodery_btn" @click="changeStep">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                    </svg>
                    next
                </button>
                <button class="primary_btn" @click="changeView">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                    </svg>
                    Login
                </button>
            </div>

        </transition>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                step: 'type',
                user_type: 'client',
            };
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                console.log('register componenet mounted');
            },

            changeView() {
                this.$emit('updateView');
            },

            changeStep() {
                switch (this.step) {
                    case 'type':
                        this.step = 'basic_info';
                        break;
                }
//                if (this.step === 'type') {
//                    this.step = 'basic_info';
//                }
            }
        }
    }
</script>
