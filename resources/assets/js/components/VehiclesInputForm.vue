<template>
    <div class="tab-content booking_tab_content">
        <div id="car_inspection" class="tab-pane fade">
            <div class="vehicle_registration">
                <div class="registration_number">
                    Vehicle registration number
                    <a href="javascript:void(0);" @click="processForm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                        </svg>
                    </a>
                </div>
                <div class="card_recured">
                    <ul>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.registration.$error}">
                                <input type="text" class="form-control" placeholder="registration number" v-model="form.registration" @blur="$v.form.registration.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.registration.$error">Enter valid registration number</p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.make.$error}">
                                <input type="text" class="form-control" placeholder="vehicle make" v-model="form.make" @blur="$v.form.make.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.make.$error">Enter valid make of vehicle</p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.model.$error}">
                                <input type="text" class="form-control" placeholder="vehicle model" v-model="form.model"  @blur="$v.form.model.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.model.$error">Enter valid model of vehicle</p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.variant.$error}">
                                <input type="text" class="form-control" placeholder="vehicle variant" v-model="form.variant" @blur="$v.form.variant.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.variant.$error">Enter vehicle variant</p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.year.$error}">
                                <input type="text" class="form-control registration_year" placeholder="registration year" v-model="form.year" @blur="$v.form.year.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.year.$error">Enter vehicle year</p>
                                <span>
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
																<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
															</svg>
														</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.mileage.$error}">
                                <input type="text" class="form-control" placeholder="starting mileage" v-model="form.mileage" @blur="$v.form.mileage.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.mileage.$error">Enter vehicle mileage</p>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.service_mileage.$error}">
                                <input type="text" class="form-control" placeholder="service mileage" v-model="form.service_mileage" @blur="$v.form.service_mileage.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.service_mileage.$error">Enter service mileage</p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.fuel.$error}">
                                <input type="text" class="form-control" placeholder="fuel type" v-model="form.fuel"  @blur="$v.form.fuel.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.fuel.$error">Enter fuel type</p>

                                <span>
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29" class="svg-icon">
																<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#add_icon"></use>
															</svg>
														</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.mpg.$error}">
                                <input type="text" class="form-control" placeholder="mpg" v-model="form.mpg" @blur="$v.form.mpg.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.mpg.$error">Enter mpg </p>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.mpg_eco.$error}">
                                <input type="text" class="form-control" placeholder="mpg (economy)" v-model="form.mpg_eco" @blur="$v.form.mpg_eco.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.mpg_eco.$error">Enter mpg(economy) </p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.seats.$error}">
                                <input type="text" class="form-control" placeholder="5 seats" v-model="form.seats" @blur="$v.form.seats.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.seats.$error">Enter vehicle seats </p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="7 seats">
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.availability.$error}">
                                <input type="text" class="form-control availability" placeholder="availability" v-model="form.availability" @blur="$v.form.availability.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.availability.$error">Enter availability </p>
                                <span>
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
																<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
															</svg>
														</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.pickup_location.$error}">
                                <input type="text" class="form-control" placeholder="pickup location" v-model="form.pickup_location">
                                <p class=" help-block text-sm" v-if="$v.form.pickup_location.$error">Enter pickup location </p>

                                <span>
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
																<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
															</svg>
														</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.return_location.$error}">
                                <input type="text" class="form-control" placeholder="return location" v-model="form.return_location">
                                <p class=" help-block text-sm" v-if="$v.form.return_location.$error">Enter return location </p>
                                <span>
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
																<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
															</svg>
														</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.rent.$error}">
                                <input type="text" class="form-control" placeholder="rental cost/week" v-model="form.rent">
                                <p class=" help-block text-sm" v-if="$v.form.rent.$error">Enter vehicle rent </p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.insurance.$error}">
                                <input type="text" class="form-control" placeholder="insurance cost/week" v-model="form.insurance">
                                <p class=" help-block text-sm" v-if="$v.form.insurance.$error">Enter vehicle insurance </p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.deposit.$error}">
                                <input type="text" class="form-control" placeholder="deposit" v-model="form.deposit">
                                <p class=" help-block text-sm" v-if="$v.form.deposit.$error">Enter deposit amount </p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.discounts.$error}">
                                <input type="text" class="form-control" placeholder="discounts" v-model="form.discounts">
                                <p class=" help-block text-sm" v-if="$v.form.discounts.$error">Enter discounts</p>

                                <span>
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29" class="svg-icon">
																<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#add_icon"></use>
															</svg>
														</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="extend_cancel" class="tab-pane fade">
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
        </div>

        <div id="chat_tab" class="tab-pane fade">
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>@blur="$v.card.number.$touch()"
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
            <p>
                Integer et odio viverra, feugiat ex sed, lobor4s sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis
                suscipit. Sed sit amet tris4que leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero
                eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.
            </p>
        </div>
    </div>
</template>

<script>

    import Local from '../local';
    import {Boolean} from '../validators';
    import {required, minLength} from 'vuelidate/lib/validators';
    import User from '../user';

    var $scope;
    export default {
        props: ['profileHeight'],

        data() {
            return {
                User: User,
                form: {
                    make: '',
                    model: '',
                    variant: '',
                    year: '',
                    mileage: '',
                    service_mileage: '',
                    fuel: '',
                    mpg: '',
                    mpg_eco: '',
                    seats: '',
                    availability: '',
                    pickup_location: '',
                    return_location: '',
                    rent: '',
                    insurance: '',
                    deposit: '',
                    discounts:'',
                    registration: '',
                },
            };
        },

        validations: {
            form: {
                make: {
                    required,
                    minLength: minLength(6)
                },
                model: {
                    required,
                    minLength: minLength(6)
                },
                variant: {
                    required,
                    minLength: minLength(6)
                },
                year: {
                    required,
                    minLength: minLength(6)
                },
                mileage: {
                    required,
                    minLength: minLength(3)
                },
                service_mileage: {
                    required,
                    minLength: minLength(6)
                },
                fuel: {
                    required,
                    minLength: minLength(6)
                },
                mpg: {
                    required,
                    minLength: minLength(6)
                },
                mpg_eco: {
                    required,
                    minLength: minLength(6)
                },
                seats: {
                    required,
                    minLength: minLength(6)
                },
                availability: {
                    required,
                    minLength: minLength(6)
                },
                pickup_location: {
                    required,
                    minLength: minLength(6)
                },
                return_location: {
                    required,
                    minLength: minLength(6)
                },
                rent: {
                    required,
                    minLength: minLength(6)
                },
                insurance: {
                    required,
                    minLength: minLength(6)
                },
                deposit: {
                    required,
                    minLength: minLength(6)
                },
                discounts:{
                    required,
                    minLength: minLength(6)
                },
                registration:{
                    required,
                    minLength: minLength(6)
                },
            }
        },

        mounted() {
            $scope=this;

            $('.registration_year').datetimepicker({
                format: 'MM/DD/YYYY',
                viewMode: 'years'
            });
            $('.availability').datetimepicker({
                format: 'MM/DD/YYYY',
            });

        },

        methods: {
            processForm(){
                $scope.postForm();
            },
            postForm() {
                axios.post('/api/vehicle', this.prepareForm())
                    .then(response => {
                        this.response = response.data.success;
                        this.postSuccess = true;
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
