<template>
    <div class="tab-content booking_tab_content">
        <div id="car_inspection" class="tab-pane fade">
            <div class="vehicle_registration">
                <div class="registration_number">
                    Vehicle registration number
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                    </svg>
                </div>
                <div class="card_recured">
                    <ul>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="vehicle make" v-model="form.make">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="vehicle model" v-model="form.model"  >
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="vehicle variant" v-model="form.variant">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="registration year" v-model="form.year">
                                <span>
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
																<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
															</svg>
														</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="starting mileage" v-model="form.starting_mileage">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="service mileage" v-model="form.service_mileage">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="fuel type" v-model="form.fuel">
                                <span>
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29" class="svg-icon">
																<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#add_icon"></use>
															</svg>
														</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="mpg" v-model="form.mpg">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="mpg (economy)" v-model="form.mpg_eco">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="5 seats" v-model="form.seats">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="availability" v-model="form.availability">
                                <span>
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
																<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
															</svg>
														</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="pickup location" v-model="form.pickup_location">
                                <span>
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
																<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
															</svg>
														</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="return location" v-model="form.return_location">
                                <span>
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
																<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
															</svg>
														</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="rental cost/week" v-model="form.rent">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="insurance cost/week" v-model="form.insurance">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="deposit" v-model="form.deposit">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="discounts" v-model="form.discounts">
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
    </div>
</template>

<script>
    import {required, email, minLength} from 'vuelidate/lib/validators';
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
                    starting_mileage: '',
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
                    minLength: minLength(6)
                },
                year: {
                    minLength: minLength(6)
                },
                starting_mileage: {
                    minLength: minLength(3)
                },
                service_mileage: {
                    minLength: minLength(6)
                },
                fuel: {
                    minLength: minLength(6)
                },
                    mpg: {
                    minLength: minLength(6)
                },
                    mpg_eco: {
                    minLength: minLength(6)
                },
                    seats: {
                    minLength: minLength(6)
                },
                    availability: {
                    minLength: minLength(6)
                },
                    pickup_location: {
                    minLength: minLength(6)
                },
                    return_location: {
                    minLength: minLength(6)
                },
                    rent: {
                    minLength: minLength(6)
                },
                    insurance: {
                    minLength: minLength(6)
                },
                    deposit: {
                    minLength: minLength(6)
                },
                    discounts:{
                    minLength: minLength(6)
                },
            }
        },

        mounted() {

        },

        methods: {

        }
    }
</script>
