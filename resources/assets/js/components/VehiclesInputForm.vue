<template>
    <div class="tab-content booking_tab_content">
        <div id="car_inspection" class="tab-pane fade active in">
            <div class="spinner-container center-loader" id="centerLoader">
                <div class="spinner-frame">
                    <div class="spinner-cover"></div>
                    <div class="spinner-bar"></div>
                </div>
            </div>
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
                            <div class="form-group" :class="{'has-error': $v.form.transmission.$error}">
                                <input type="text" class="form-control" placeholder="transmission" v-model="form.transmission" @blur="$v.form.transmission.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.transmission.$error">Enter transmission </p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.seats.$error}">
                                <input type="text" class="form-control" placeholder="5 seats" v-model="form.seats" @blur="$v.form.seats.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.seats.$error">Enter vehicle seats </p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.available_from.$error}">
                                <input type="text" class="form-control available_from" placeholder="Available from" v-model="form.available_from" @blur="$v.form.available_from.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.available_from.$error">Enter available from </p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.available_to.$error}">
                                <input type="text" class="form-control available_to" placeholder="available to" v-model="form.available_to" @blur="$v.form.available_to.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.available_to.$error">Enter available to</p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" >
                                <input type="checkbox" class="form-control" id="pickup" placeholder="yes / no if pick by owner" v-model="form.pickup" >
                                Pickup by owner


                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <input type="checkbox" class="form-control" id="delivery" placeholder="yes / no if delivery by owner" v-model="form.delivery" >
                                 Delivery by owner

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.pickup_location.$error}">
                                <input type="text" class="form-control" placeholder="pickup location" v-model="form.pickup_location" @blur="$v.form.pickup_location.$touch()">
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
                                <input type="text" class="form-control" placeholder="return location" v-model="form.return_location" @blur="$v.form.return_location.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.return_location.$error">Enter return location </p>
                                <span>
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
																<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
															</svg>
								</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.location.$error}">
                                <input type="text" class="form-control" placeholder="vehicle location in latitude and longitude" v-model="form.location" @blur="$v.form.location.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.location.$error">Enter vehicle location in latitude and longitude </p>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                                    </svg>
								</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.delivery_charges.$error}">
                                <input type="text" class="form-control" placeholder="delivery charges per week" v-model="form.delivery_charges"  @blur="$v.form.delivery_charges.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.delivery_charges.$error">Delivery charges per week</p>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.rent.$error}">
                                <input type="text" class="form-control" placeholder="rental cost/week" v-model="form.rent" @blur="$v.form.rent.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.rent.$error">Rent per week</p>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.insurance.$error}">
                                <input type="text" class="form-control" placeholder="insurance cost/week" v-model="form.insurance" @blur="$v.form.insurance.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.insurance.$error">Enter vehicle insurance </p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.mile_cap.$error}">
                                <input type="text" class="form-control" placeholder="mileage Cap/week" v-model="form.mile_cap" @blur="$v.form.mile_cap.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.mile_cap.$error">Enter mileage Cap per week </p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.after_mile.$error}">
                                <input type="text" class="form-control" placeholder="After mileage per mile price" v-model="form.after_mile" @blur="$v.form.after_mile.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.after_mile.$error">after mileage per mile price</p>
                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.deposit.$error}">
                                <input type="text" class="form-control" placeholder="deposit on vehicle booking" v-model="form.deposit" @blur="$v.form.deposit.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.deposit.$error">Enter deposit on vehicle booking </p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group discount-group" >

                                <input type="text" class="form-control" placeholder="percent" v-model="percent" >
                                <div v-if="form.discounts.length>0" v-for="discount in form.discounts"  class="label label-success discount" >
                                    <p>Week {{discount.week}} {{discount.percent}}</p>
                                    <i class="fa fa-remove clickable" @click="pop(discount)"></i>
                                </div>


                                <span @click="push()">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#add_icon"></use>
									</svg>
								</span>
                                <div class="clearfix"></div>
                            </div>

                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.extension.$error}">
                                <input type="text" class="form-control" placeholder="Contract Extension Weeks" v-model="form.extension" @blur="$v.form.extension.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.extension.$error">Enter Contract Extension Weeks  </p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.license_years.$error}">
                                <input type="text" class="form-control" placeholder="license older than years" v-model="form.license_years" @blur="$v.form.license_years.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.license_years.$error">Enter license older than years</p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.pco_years.$error}">
                                <input type="text" class="form-control" placeholder="license older than years" v-model="form.pco_years" @blur="$v.form.pco_years.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.pco_years.$error">PCO license older than years</p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.driver_year.$error}">
                                <input type="text" class="form-control" placeholder="license older than years" v-model="form.driver_year" @blur="$v.form.driver_year.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.driver_year.$error">PCO license older than years</p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.license_points.$error}">
                                <input type="text" class="form-control" placeholder="maximum points on license" v-model="form.license_points" @blur="$v.form.license_points.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.license_points.$error">maximum points on license</p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.no_fault_accident.$error}">
                                <input type="text" class="form-control" placeholder="year since last accident with no driver fault" v-model="form.no_fault_accident" @blur="$v.form.no_fault_accident.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.no_fault_accident.$error">maximum points on license</p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.fault_accident.$error}">
                                <input type="text" class="form-control" placeholder="year since last accident with driver fault" v-model="form.fault_accident" @blur="$v.form.fault_accident.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.fault_accident.$error">year since last accident with driver fault</p>

                            </div>
                        </li>
                        <li>
                            <div class="form-group" :class="{'has-error': $v.form.notes.$error}">
                                <input type="text" class="form-control" placeholder="important notes for vehicle" v-model="form.notes" @blur="$v.form.notes.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.notes.$error">important notes for vehicle</p>

                            </div>
                        </li>
                        <li>
                            <button id="uploadImages">Upload Images</button>
                            <input type="file"  class="hidden hiddenUpload" name="files[]" multiple="multiple" value="upload">
                             <button id="documents">Upload documents</button>
                            <input type="file"  class="hidden documentsUpload" name="documents[]" multiple="multiple"></li>
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
    import Form from '../vehicle-fields';

    var $scope;
    export default {
        props: ['profileHeight','vehicle','isEdit'],

        data() {
            return {
                User: User,
                week: '',
                percent: '',
                form: JSON.parse(JSON.stringify(Form)),
            };
        },

        validations: {
            form: {
                make: {
                    required,
                    minLength: minLength(1)
                },
                model: {
                    required,
                    minLength: minLength(1)
                },
                variant: {
                    required,
                    minLength: minLength(1)
                },
                year: {
                    required,
                    minLength: minLength(1)
                },
                mileage: {
                    required,
                    minLength: minLength(1)
                },
                fuel: {
                    required,
                    minLength: minLength(1)
                },
                mpg: {
                    required,
                    minLength: minLength(1)
                },
                mpg_eco: {
                    required,
                    minLength: minLength(1)
                },
                transmission: {
                    required,
                    minLength: minLength(1)
                },
                seats: {
                    required,
                    minLength: minLength(1)
                },
                available_from: {
                    minLength: minLength(1)
                },
                available_to: {
                    required,
                    minLength: minLength(1)
                },
                pickup: {
                    required,
                    minLength: minLength(1)
                }, delivery: {
                    required,
                    minLength: minLength(1)
                },

                pickup_location: {
                    required,
                    minLength: minLength(1)
                },
                return_location: {
                    required,
                    minLength: minLength(1)
                },
                location: {
                    required,
                    minLength: minLength(1)
                },
                delivery_charges: {
                    required,
                    minLength: minLength(1)
                },
                rent: {
                    required,
                    minLength: minLength(1)
                },
                insurance: {
                    required,
                    minLength: minLength(1)
                },
                mile_cap: {
                    required,
                    minLength: minLength(1)
                },
                after_mile: {
                    required,
                    minLength: minLength(1)
                },
                deposit: {
                    required,
                    minLength: minLength(1)
                },

                extension:{
                    required,
                    minLength: minLength(1)
                },
                license_years:{
                    required,
                    minLength: minLength(1)
                },
                pco_years:{
                    required,
                    minLength: minLength(1)
                },
                driver_year:{
                    required,
                    minLength: minLength(1)
                },
                license_points:{
                    required,
                    minLength: minLength(1)
                },
                no_fault_accident:{
                    required,
                    minLength: minLength(1)
                },
                fault_accident:{
                    required,
                    minLength: minLength(1)
                },
                notes:{
                    required,
                    minLength: minLength(1)
                },
                registration:{
                    required,
                    minLength: minLength(1)
                },
                images:{
                    required,
                    minLength: minLength(1)
                },
            }
        },
        watch: {
            'vehicle': function (val, oldVal) {
                if(this.isEdit){
                    this.form=JSON.parse(JSON.stringify(Form));
                    this.form = val;
                }
            }
        },
        mounted() {
            $scope=this;
            if(this.isEdit){
                this.form=JSON.parse(JSON.stringify(Form));
                this.form = this.vehicle;
            }
            this.prepareComponent();
        },

        methods: {
            processForm(){
                $scope.postForm();
            },
            postForm() {
                if(this.isEdit){
                    axios.patch('/api/vehicle/'+this.form.id, this.prepareForm())
                        .then(this.responseHandler);
                } else {
                axios.post('/api/vehicle', this.prepareForm())
                    .then(this.responseHandler);
                }
            },
            responseHandler(response){
                this.response = response.data.success;
                this.form = JSON.parse(JSON.stringify(Form));
                this.$parent.$emit('vehicleAdded', response.data.success);
                this.postSuccess = true;
            },
            prepareForm() {
                let input = this.form;

                Object.keys(input).forEach(function (key) {
                    if (input[key]==null || input[key].length <= 0) {
                        delete input[key];
                    }
                });
                delete input.id;
                return input;
            },
            push(){
                let count=$scope.form.discounts.length+1;
                $scope.form.discounts.push({week: count,percent: $scope.percent});
                $scope.percent='';
                $scope.week='';
                count='';
            },
            pop(discount){
                $scope.form.discounts.splice($scope.form.discounts.indexOf(discount),1);
                $scope.reCalculate();
            },
            reCalculate(){
                var discounts = [];
                $scope.form.discounts.map(function(value, key) {
                    discounts.push({week: key+1 ,percent: value.percent});
                });
                $scope.form.discounts = discounts;
            },
            imagesResponse(r){
                this.form.images.push(r.data.success);
                },
            documentsResponse(r){
                this.form.documents.push(r.data.success);

            },
            prepareComponent(){


                $('.registration_year').datetimepicker({
                    format: 'YYYY',
                    viewMode: 'years'
                });

                $('.available_to').datetimepicker({
                    format: 'YYYY-MM-DD',
                }).on('dp.change',function (e) {
                    $scope.form.available_to=$(".available_to").val();
                });
                $('.available_from').datetimepicker({
                    format: 'YYYY-MM-DD',
                }).on('dp.change',function (e) {
                    $scope.form.available_from=$(".available_from").val();
                });

                $("#documents").click(function () {
                    $('#centerLoader').show();
                    $(".documentsUpload").click();
                    $(".documentsUpload").change(function () {
                        $.map(this.files, function (val) {
                            var reader = new FileReader();
                            reader.readAsDataURL(val);
                            var fd = new window.FormData();
                            fd.append('upload', val);
                            reader.onload = function (e) {
                                axios.post('/api/upload/document',fd).then($scope.documentsResponse);

                            };
                        });
                        $('#centerLoader').hide();
                    });
                });

                $("#uploadImages").click(function () {
                    $('#centerLoader').show();
                    $(".hiddenUpload").click();
                    $(".hiddenUpload").change(function () {
                        $.map(this.files, function (val) {
                            var reader = new FileReader();
                            reader.readAsDataURL(val);
                            var fd = new window.FormData();
                            fd.append('upload', val);
                            reader.onload = function (e) {
                                axios.post('/api/upload/image',fd).then($scope.imagesResponse);

                            };
                        });
                        $('#centerLoader').hide();
                    });
                });

            }

            }

    }
</script>
