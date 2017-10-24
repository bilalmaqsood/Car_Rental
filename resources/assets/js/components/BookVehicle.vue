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
                                <input class="form-control" placeholder="promotional code" type="text" @blur="checkPromoCode" v-model.trim="promo_code" @keypress.enter="checkPromoCode">
                            </div>
                        </div>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                        </svg>
                        <span>Pick up from: {{ fetchAddress(pickup_location) }}</span>
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
                <h3>My Cards</h3>
                    <div class="list-group">
                        <transition-group name="list" tag="div">
                            <a href="javascript:" @click="fillCard(c, $event)" class="list-group-item" v-for="c in credit_cards" :key="c.id" :class="{active: c.id == card.id}">
                                <h4 class="list-group-item-heading">{{ c.expiry }}</h4>
                                <p class="list-group-item-text">{{ c.number }}</p>
                            </a>
                        </transition-group>
                    </div>
                </div>
                <div class="card_recured">
                    <ul>
                        <li>
                            <div class="form-group">
<div class="input-group login-input">
<div class="input-group-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                </svg>
</div>
                                <input @keyup="card.name = $event.target.value.toUpperCase()" @blur="$v.card.name.$touch()" v-model.trim="card.name" type="text" class="form-control" placeholder="name on card" name="name">
</div>
                                <span class="help-block text-sm" v-if="$v.card.name.$error">Enter valid name</span>

                            </div>
                        </li>
                        <li>
                            <div class="form-group">
<div class="input-group login-input">
<div class="input-group-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                                </svg>
</div>
                                <input @blur="$v.card.number.$touch()" v-model.trim="card.number" type="text" class="form-control cc-num" placeholder="card number" name="number">
</div>
                                <span class="help-block text-sm" v-if="$v.card.number.$error">Enter valid card number</span>

                            </div>
                        </li>
                        <li>
                            <div class="form-group">
<div class="input-group login-input">
<div class="input-group-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
</div>
                                <input @blur="$v.card.expiry.$touch()" v-model.trim="card.expiry" type="text" class="form-control cc-exp" placeholder="card expiration date (MM/YYYY)" name="expiry">
</div>
                                <span class="help-block text-sm" v-if="$v.card.expiry.$error">Enter valid expiry date</span>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
<div class="input-group login-input">
<div class="input-group-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 30" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#security_form_icon"></use>
                                </svg>
</div>
                                <input  maxlength="3" size="3" @blur="$v.card.cvc.$touch()" v-model.trim="card.cvc" type="password" class="form-control cc-cvc" placeholder="CVV2" name="cvc">
</div>
                                <span class="help-block text-sm" v-if="$v.card.cvc.$error">Enter valid CVV2 </span>
                            </div>
                        </li>
                         <li>
                            <div class="form-group">
                                <div class="input-group login-input">
                                    <div class="input-group-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                                        </svg>
                                    </div>
                                     <input @blur="$v.card.address.$touch()" type="text" v-model="card.address" class="form-control" placeholder="billing address">

                                </div>
                                <span class="help-block text-sm" v-if="$v.card.address.$error">Enter valid address </span>
                            </div>
                        </li>
                        
                        <li>
                            <svg @click="card.terms = !card.terms" :class="{active: card.terms}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon cursor-pointer">
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

                
               
                <li v-if="promo_code_reward">
                    <p><label>Sub Total</label> <label>{{ subTotalBooking | currency }}</label></p>
                    <span>Total amount without discount</span>
                </li>
                <li v-if="promo_code_reward">
                    <p><label>Discount</label><label> - {{promo_code_reward | currency}}</label></p>
                    <span>Discount on the promocode</span>
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
    import Local from '../local';
    import {Boolean} from '../validators';
    import {required, minLength} from 'vuelidate/lib/validators';

    export default {
        props: ['vehicle', 'pickup_location'],

        data() {
            return {
                available_slots: this.vehicle.time_slots,
                isCard: false,
                location: null,
                promo_code: null,
                promo_code_reward: 0,
                start_date: null,
                end_date: null,
                credit_cards: null,
                card: {
                    id: '',
                    name: '',
                    number: '',
                    expiry: '',
                    cvc: '',
                    address: '',
                    terms: false,
                }
            };
        },

        validations: {
            card: {
                name: {
                    required
                },
                address: {
                    required
                },
                number: {
                    required,
                    minLength: minLength(14)
                },
                expiry: {
                    required,
                    minLength: minLength(7)
                },
                cvc: {
                    required,
                    minLength: minLength(3)
                },
                terms: {
                    required,
                    Boolean
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

            subTotalBooking() {
                return (
                    this.totalRent +
                    this.totalInsurance +
                    this.vehicle.deposit
                );
            },
            totalBooking() {
                return (
                    this.totalRent +
                    this.totalInsurance +
                    this.vehicle.deposit -
                    this.promo_code_reward
                );
            },


            validBooking() {
                return this.days >= 7;
            }
        },

        mounted() {
            this.prepareComponent();
            this.highlightOldDays(this.available_slots);
        },

        methods: {
            prepareComponent() {
                this.initializeJquery();
                let bookingData = Local.get('bookingData');
                if (bookingData) {
                    setTimeout(() => {
                        this.calenderChange({date: moment(bookingData.start_date + ' ' + moment().format('H:m:s'), 'MM/DD/YYYY H:m:s', true)});
                        this.calenderChange({date: moment(bookingData.end_date + ' ' + moment().format('H:m:s'), 'MM/DD/YYYY H:m:s', true)});
                        this.location = bookingData.location;
                        this.promo_code = bookingData.promo_code;
                        this.promo_code_reward = bookingData.promo_code_reward;
                        setTimeout(() => {
                            this.processBooking();
                            localStorage.removeItem('reloadData');
                        }, 500);
                    }, 500);
                }


            },

            initializeJquery() {
                let $scope = this;
                 $('#booking_range_calender').datetimepicker({
                    inline: true,
                     useCurrent: false,
                     sideBySide: false,
                    minDate: moment(new Date())
                }).on('dp.change', this.calenderChange)
                  .on('dp.update', function(){ $scope.highlightOldDays($scope.available_slots) });
                $('[data-toggle="tooltip"]').tooltip();
            },

            resetDatesLessSeven() {
                let $t = this;
                this.start_date = null;
                this.end_date = null;

                setTimeout(function () {
                    $t.highlightDays(false);
                    $t.highlightOldDays($t.available_slots);
                }, 1000);
            },

            resetDates(e) {
                let $btn = $(e.target);

                $btn.removeClass('fa-undo').addClass('fa-refresh fa-spin');

                this.start_date = null;
                this.end_date = null;
                this.highlightDays(false);

            },

            calenderChange(e) {
                if (!this.start_date)
                    this.start_date = e.date.utc().startOf('day');
                else if (!this.end_date) {
                    this.end_date = e.date.utc().endOf('day');
                    this.highlightDays(true);
                } else {
                    this.highlightDays(false);
                    this.start_date = null;
                    this.end_date = null;
                }
            },

            highlightDays(bool) {
                let $e = $('.bootstrap-datetimepicker-widget .datepicker-days table tbody');
                let $t = this;

                if (bool) {
                    if (this.start_date.format('X') < this.end_date.format('X')) {
                        let StartDate = this.start_date;
                        let EndDate = this.end_date;
                        $e.find('td').each(function (i, e) {
                            let $elem = $(e);
                            let eDate = moment.utc($elem.data('day') + ' ' + moment().format('H:m:s'), 'MM/DD/YYYY H:m:s', true);
                            if (eDate.isValid() && StartDate.format('X') <= eDate.format('X') && EndDate.format('X') >= eDate.format('X')) $elem.addClass('highlight-day');
                        });
                        $t.highlightOldDays($t.available_slots);
                        if (this.end_date.diff(this.start_date, 'days') < 6) {
                            new Noty({
                                type: 'warning',
                                text: 'Booking should be at least one week.'
                            }).show();

                            this.resetDatesLessSeven();
                        } else
                            axios.post('/api/time-slot/verify', {
                                vehicle_id: this.vehicle.id,
                                start_date: this.start_date.format('YYYY-MM-DD'),
                                end_date: this.end_date.format('YYYY-MM-DD')
                            }).then(r => {
                                if (r.data.success)
                                    new Noty({
                                        type: 'success',
                                        text: '<div><p><b>Selected Start Date:</b> ' + this.start_date.format('M/D/Y') + '</p><p class="m-0"><b>Selected End Date:</b> ' + this.end_date.format('M/D/Y') + '</p></div>',
                                    }).show();
                                else {
                                    new Noty({
                                        type: 'warning',
                                        text: 'Requested time slots are not available for booking.'
                                    }).show();
                                    this.resetDatesLessSeven();
                                }
                            });
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
                        type: 'warning',
                        text: 'Dates are reset.',
                        timeout: 600
                    }).show();
                }
            },

            processBooking() {
                let $t = this;

                if (User.state.auth) {
                    this.isCard = !this.isCard;

                    this.getListCreditCards();

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

            getListCreditCards() {
                axios.get('/api/credit-card').then(this.listCreditCards);
            },

            listCreditCards(r) {
                this.credit_cards = r.data.success;
            },

            fillCard(card, e) {
                this.card.address = card.address;
                this.card.name = card.name;
                this.card.number = card.number;
                this.card.expiry = card.expiry;
                this.card.id = card.id;
            },

            checkPromoCode() {
                if (this.promo_code)
                    axios.get('/api/promo-code/' + this.promo_code)
                        .then(r => {
                            if (r.data.success && r.data.success.is_active) {
                                new Noty({
                                    type: 'success',
                                    text: 'Promo code available.'
                                }).show();
                                this.promo_code_reward = r.data.success.reward;
                            } else
                                this.resetPromoCodeFields();
                        })
                        .catch(r => {
                            if (r.response.status === 404){
                                new Noty({
                                    type: 'error',
                                    text: 'Invalid promo code.'
                                }).show();
                                this.resetPromoCodeFields();
                            }
                        });
                else
                    this.resetPromoCodeFields();
            },

            resetPromoCodeFields() {
                this.promo_code = null;
                this.promo_code_reward = 0;
            },

            processPayment(e) {
                let $t = this;
                let $btn = $(e.target).button('loading');

                if (this.card.id)
                    axios
                        .post('/api/credit-card/' + this.card.id + '/default')
                        .then(() => {
                            $t.bookingRequest($btn);
                        });
                else
                    axios
                        .post('/api/credit-card', {
                            name: this.card.name,
                            number: this.card.number.replace(/\s/g, ''),
                            expiry: this.card.expiry.replace(/\s/g, ''),
                            cvc: this.card.cvc,
                            default: 1
                        }).then(() => {
                        $t.bookingRequest($btn);
                    });
            },

            bookingRequest($btn) {
                let data = {
                    vehicle_id: this.vehicle.id,
                    start_date: this.start_date.format('YYYY-MM-DD'),
                    end_date: this.end_date.format('YYYY-MM-DD')
                };

                if (this.location)
                    data.location = this.location;

                if (this.promo_code)
                    data.promo_code = this.promo_code;

                axios.post('/api/booking', data).then((r) => {
                    $btn.button('reset');
                    User.commit('details', false);
                    new Noty({
                        type: 'success',
                        text: 'Booking created successfully for ' + User.state.auth.name,
                    }).show();
                }).catch(r => {
                    $btn.button('reset');
                });
            },

            saveBookingToStorage() {
                User.commit('saveBooking', {
                    start_date: this.start_date.format('MM/DD/YYYY'),
                    end_date: this.end_date.format('MM/DD/YYYY'),
                    promo_code: this.promo_code,
                    promo_code_reward: this.promo_code_reward,
                    location: this.location
                });
            },
            fetchAddress(arg){

                let $t = this;
                let location;
                $.ajax({
                    beforeSend: function(request) {
                        request.setRequestHeader('Access-Control-Request-Headers', '');
                    },
                    url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + arg + '&key=AIzaSyDp8Pjc5ZmcmTb-ci-Fj-xNh2KLTUlguk0',
                    type: 'GET',
                    dataType: 'json',
                    async: false,
                }).done(function (r) {
                    location = r.results[0].formatted_address;
                });

                return location;
            },
             highlightOldDays(response){
                let $t = this;
                let $e = $('.bootstrap-datetimepicker-widget .datepicker-days table tbody');
                let $dates=[];
                _.forEach(response, function(value) {
                    if(value.status==1)
                    $dates.push(moment(value.day, "YYYY-MM-DD").format("MM/DD/YYYY") );
                    });

                  $e.find('td').each(function (i, e) {
                            let $elem = $(e);
                      $elem.removeClass('active');
                      $elem.removeClass('today');

                      if (_.indexOf($dates,$elem.data('day'))<0)
                                $elem.addClass('old disabled');

                        });
            }
        }
    }
</script>
