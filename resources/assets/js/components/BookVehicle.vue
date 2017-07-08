<template>
    <div class="car_detail_container">

        <transition name="flip" mode="out-in">
            <div class="car_detail_clander" v-if="!isCard" key="booking_detail">
                <ul>
                    <li>
                        <div class="book_now_calender">
                            <p class="m-b-1">Select first and last day of booking <i @click="resetDates" class="fa fa-undo cursor-pointer pull-right m-r-1" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="reset booking first and last date"></i></p>
                            <div class="clearfix"></div>
                            <div style="overflow:hidden;">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" id="booking_range_calender">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="form-group promo-code">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#tag_icon"></use>
                                    </svg>
                                </div>
                                <input class="form-control" placeholder="promotional code" type="text" @blur="checkPromoCode" v-model.trim="promo_code">
                            </div>
                        </div>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                        </svg>
                        <span>Pick up from: {{vehicle.pickup_location}}</span>
                    </li>
                    <li>
                        <div class="pickup_loction_map">
                            <iframe width="100%" height="450" frameborder="0" style="border:none" v-bind:src="'https://www.google.com/maps/embed/v1/place?q='+vehicle.location.split(',')[0]+','+vehicle.location.split(',')[1]+'&amp;key=AIzaSyDFkedYDgj286xDo9Sp9XRWsOiPfu9T3Ak'"></iframe>
                        </div>
                    </li>
                </ul>
            </div>

            <div key="card_detail" v-else>
                <div class="fill_card">
                </div>
                <div class="card_recured">
                    <ul>
                        <li>
                            <div class="form-group">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                </svg>
                                <input @keyup="card.name = $event.target.value.toUpperCase()" @blur="$v.card.name.$touch()" v-model.trim="card.name" type="text" class="form-control" placeholder="name on card" name="name">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                                </svg>
                                <input @blur="$v.card.number.$touch()" v-model.trim="card.number" type="text" class="form-control cc-num" placeholder="card number" name="number">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <input @blur="$v.card.expiry.$touch()" v-model.trim="card.expiry" type="text" class="form-control cc-exp" placeholder="card expira/on date" name="expiry">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use>
                                </svg>
                                <input @blur="$v.card.cvc.$touch()" v-model.trim="card.cvc" type="password" class="form-control cc-cvc" placeholder="cvc" name="cvc">
                            </div>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                            </svg>
                            <p>I have read and understood the</p>
                            <a href="/terms-and-conditions" target="_blank">Terms & Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </transition>

        <div class="car_cost_tabel">
            <ul>
                <li>
                    <p><label>Rental cost </label><label>{{totalRent | currency}}</label></p>
                    <span>{{days}} days * {{vehicle.rent | currency}}</span>
                </li>
                <li>
                    <p><label>Insurance</label><label>{{totalInsurance | currency}}</label></p>
                    <span>{{days}} days * {{vehicle.insurance | currency}}</span>
                </li>
                <li>
                    <p><label>Deposit</label><label>{{vehicle.deposit | currency}}</label></p>
                    <span>will be paid when placing the request</span>
                </li>
                <li>
                    <p><label>Total</label> <label>{{ totalBooking | currency }}</label></p>
                    <span>amount that will be paid by the end of the contract</span>
                </li>
            </ul>

            <transition name="flip" mode="out-in">
                <button class="secodery_btn" key="deposit_button" v-if="!isCard" @click="processBooking" type="button" :disabled="!validBooking">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                    </svg>
                    <span>Proceed to deposit</span>
                </button>

                <button data-loading-text="&lt;span class=&quot;fa fa-refresh fa-2x fa-spin&quot;&gt;&lt;/span&gt; &lt;span class=&quot;fa-2x&quot;&gt;confirming booking and deposit ...&lt;/span&gt;" class="secodery_btn" key="card_button" v-else @click="processPayment" type="button" :disabled="$v.card.$invalid">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                    </svg>
                    <span>Confirm deposit payment</span>
                </button>
            </transition>
        </div>
    </div>
</template>

<script>
    import User from '../user';
    import {required, minLength} from 'vuelidate/lib/validators';

    export default {
        props: ['vehicle'],

        data() {
            return {
                isCard: false,
                location: null,
                promo_code: null,
                start_date: null,
                end_date: null,
                card: {
                    name: '',
                    number: '',
                    expiry: '',
                    cvc: '',
                }
            };
        },

        validations: {
            card: {
                name: {
                    required
                },
                number: {
                    required,
                    minLength: minLength(19)
                },
                expiry: {
                    required,
                    minLength: minLength(9)
                },
                cvc: {
                    required,
                    minLength: minLength(3)
                },
            }
        },

        computed: {
            days() {
                if (this.start_date && this.end_date)
                    return this.end_date.diff(this.start_date, 'days') + 1;
                else
                    return 0;
            },

            totalRent() {
                return this.vehicle.rent * this.days;
            },

            totalInsurance() {
                return this.vehicle.insurance * this.days;
            },

            totalBooking() {
                return (
                    (this.vehicle.rent * this.days) +
                    (this.vehicle.insurance * this.days) +
                    this.vehicle.deposit
                );
            },

            validBooking() {
                return this.days >= 7;
            }
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                User.commit('vehicle', this.vehicle);
                this.initializeJquery();
            },

            initializeJquery() {
                $('#booking_range_calender').datetimepicker({
                    inline: true,
                    sideBySide: false
                }).on('dp.change', this.calenderChange);
                $('[data-toggle="tooltip"]').tooltip();
            },

            resetDatesLessSeven: function () {
                let $t = this;
                this.start_date = null;
                this.end_date = null;

                new Noty({
                    type: 'warning',
                    text: 'Booking should be at least one week.'
                }).show();

                setTimeout(function () {
                    $t.highlightDays(false);
                }, 1000);
            },

            resetDates(e) {
                let $btn = $(e.target);

                $btn.removeClass('fa-undo').addClass('fa-refresh fa-spin');

                this.start_date = null;
                this.end_date = null;
                this.highlightDays(false);

                setTimeout(function () {
                    $btn.removeClass('fa-refresh fa-spin').addClass('fa-undo');
                    new Noty({
                        type: 'information',
                        text: 'Dates are reset.',
                        timeout: 600
                    }).show();
                }, 600);
            },

            calenderChange(e) {
                if (!this.start_date)
                    this.start_date = e.date;
                else if (!this.end_date) {
                    this.end_date = e.date;
                    this.highlightDays(true);
                } else {
                    this.highlightDays(false);
                    this.start_date = null;
                    this.end_date = null;
                }
            },

            highlightDays(bool) {
                let $e = $('.bootstrap-datetimepicker-widget .datepicker-days table tbody');

                if (bool) {
                    if (this.start_date.format('X') < this.end_date.format('X')) {
                        let StartDate = moment(this.start_date.format()).subtract(1, 'days');
                        let EndDate = this.end_date;
                        $e.find('td').each(function (i, e) {
                            let $elem = $(e);
                            let eDate = moment($elem.data('day'), 'MM/DD/YYYY', true);
                            if (eDate.isValid() && StartDate.format('X') <= eDate.format('X') && EndDate.format('X') >= eDate.format('X'))
                                $elem.addClass('highlight-day');
                        });

                        if (this.end_date.diff(this.start_date, 'days') < 6)
                            this.resetDatesLessSeven();
                        else
                            new Noty({
                                type: 'information',
                                text: '<div><p><b>Selected Start Date:</b> ' + this.start_date.format('M/D/Y') + '</p><p class="m-0"><b>Selected End Date:</b> ' + this.end_date.format('M/D/Y') + '</p></div>',
                            }).show();
                    } else {
                        new Noty({
                            type: 'warning',
                            text: '<div><p>Start date should greater than end date.</p><p>Please select dates again.</p></div>',
                        }).show();
                        this.start_date = null;
                        this.end_date = null;
                        $e.find('td').removeClass('highlight-day');
                    }
                } else {
                    $e.find('td').removeClass('highlight-day');
                    new Noty({
                        type: 'information',
                        text: 'Dates are reset.',
                        timeout: 600
                    }).show();
                }
            },

            processBooking() {
                let $t = this;

                if (User.state.auth) {
                    this.isCard = !this.isCard;

                    if (this.isCard) {
                        setTimeout(function () {
                            $('input.cc-num').payment('formatCardNumber');
                            $('input.cc-exp').payment('formatCardExpiry');
                            $('input.cc-cvc').payment('formatCardCVC');
                        }, 450);
                    } else
                        setTimeout(function () {
                            $t.initializeJquery();
                        }, 450);
                } else {
                    new Noty({
                        type: 'warning',
                        text: '<div class="text-center"><b>Please login or register first to proceed next.</b></div>'
                    }).show();
                    this.saveBookingToStorage();
                    User.commit('updateAuthView', true);
                }
            },

            checkPromoCode() {
                console.log('process promo code');
            },

            processPayment(e) {
                let $btn = $(e.target).button('loading');
                setTimeout(function () {
                    $btn.button('reset');
                    console.log(JSON.stringify(User.state));
                }, 1000);
                console.log('process payment');
            },

            saveBookingToStorage() {
                User.commit('saveBooking', {
                    start_date: this.start_date.format('MM/DD/YYYY'),
                    end_date: this.end_date.format('MM/DD/YYYY'),
                    promo_code: this.promo_code,
                    location: this.location
                });
            }
        }
    }
</script>
