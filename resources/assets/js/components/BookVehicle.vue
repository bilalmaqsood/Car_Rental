<template>
    <div>
        <div v-show="!isBooking" class="car_detail_container">
            <div class="car_detail_clander">
                <ul>
                    <li>
                        <div class="book_now_calender">
                            <p class="m-b-1">Select first and last day of booking <i @click="resetDates" class="fa fa-undo cursor-pointer pull-right m-r-1" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="reset booking first and last date"></i></p>
                            <div class="clearfix"></div>
                            <div style="overflow:hidden;">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" id="datetimepicker12">
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
                                <input class="form-control" placeholder="promotional code" type="text">
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
            <div class="car_cost_tabel">
                <ul>
                    <li>
                        <p><label>Rental cost </label><label>&pound;{{totalRent}}</label></p>
                        <span>{{days}} days * &pound;{{vehicle.rent}}</span>
                    </li>
                    <li>
                        <p><label>Insurance</label><label>&pound;{{totalInsurance}}</label></p>
                        <span>{{days}} days * &pound;{{vehicle.insurance}}</span>
                    </li>
                    <li>
                        <p><label>Deposit</label><label>&pound;{{vehicle.deposit}}</label></p>
                        <span>will be paid when placing the request</span>
                    </li>
                    <li>
                        <p><label>Total</label> <label>&pound;{{ totalBooking }}</label></p>
                        <span>amount that will be paid by the end of the contract</span>
                    </li>
                </ul>
                <button class="secodery_btn" @click="processBooking" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                    </svg>
                    <span>Proceed to deposit</span>
                </button>
            </div>
        </div>

        <search-listing-card-details v-if="isBooking" :start_date="start_date" :end_date="end_date" :vehicle="vehicle"></search-listing-card-details>
    </div>
</template>

<script>
    export default {
        props: ['vehicle'],

        data() {
            return {
                isBooking: false,
                start_date: null,
                end_date: null,
                days: 0
            };
        },

        computed: {
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
            }
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                $('#datetimepicker12').datetimepicker({
                    inline: true,
                    sideBySide: false
                }).on('dp.change', this.calenderChange);
                $('[data-toggle="tooltip"]').tooltip();
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

                        new Noty({
                            type: 'information',
                            text: '<div><p><b>Selected Start Date:</b> ' + this.start_date.format('M/D/Y') + '</p><p><b>Selected End Date:</b> ' + this.end_date.format('M/D/Y') + '</p></div>',
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
                } else
                    $e.find('td').removeClass('highlight-day');
            },

            processBooking() {
                this.days++;
            }
        }
    }
</script>
