<template>
        <div class="extend_booking">
            <div class="extend_booking_content">Early Cancel booking</div>
            <div class="extend_booking_content no-padding">
                <div class="book_now_calender">
                    <p>Select the last day</p>
                    <div style="overflow:hidden;">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="CancelDate"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="extend_booking_content no-padding"><textarea class="form-control" placeholder="Reason for early cancellation" v-model="cancel_note"></textarea></div>

            <button class="extend_booking_content cursor-pointer btn-send" @click="cancelBooking">Send request</button>
        </div>
</template>

<script>

import User from '../user';

    export default {
        data() {
            return {
                user: User,
                extend: true,
                total_slots: false,
                booked_slots: false,
                end_date: '',
                start_date: '',
                cancel_note: ''
            };
        },

        mounted() {
            let $this = this; 
            
            $('#CancelDate').datetimepicker({
                    inline: true,
                    sideBySide: false,
                    useCurrent: false,
                    minDate: moment(new Date())
                }).on('dp.change', this.calenderChange)
                  .on('dp.update', function(){ $this.highlightOldDays($this.booked_slots) });
                $('[data-toggle="tooltip"]').tooltip();
                this.fetchBookedSlots();

        },

        methods: {
            cancelBooking(e) {
                if (this.user.state.currentBook !== null) {
                    $("#sideLoader").show();
                    $(e.target).attr('disabled', 'disabled').removeClass('cursor-pointer').html("Loading...");
                    axios.post('/api/booking/' + this.user.state.currentBook + '/status', this.cancelParams())
                        .then(r => {
                             new Noty({
                                type: 'warning',
                                text: r.data.success,
                            }).show();
                             $("#sideLoader").hide();
                             this.$emit("clearSideView");
                        });

                }
            },

            extendParams() {
                return {
                    start_date: this.start_date,
                    end_date: this.end_date,
                    status: 7
                }
            },

            cancelParams() {
                return {
                    note: this.cancel_note,
                    end_date: this.end_date,
                    status: 5
                }
            },
            calenderChange(e) {
                
                this.end_date = e.date.utc().startOf('day');
                this.highlightDays(true);

                // if (!this.start_date)
                    
                // else if (!this.end_date) {
                //     this.end_date = e.date.utc().endOf('day');
                //     this.highlightDays(true);
                // } else {
                //     this.highlightDays(false);
                //     this.start_date = null;
                //     this.end_date = null;
                // }
            },

            resetDatesLessSeven() {
                let $t = this;
                this.end_date = null;

                setTimeout(function () {
                    $t.highlightDays(false);
                    $t.highlightOldDays($t.booked_slots);
                }, 1000);
            },
            resetDates(e) {
                let $btn = $(e.target);

                $btn.removeClass('fa-undo').addClass('fa-refresh fa-spin');
                this.end_date = null;
                this.highlightDays(false);
                this.highlightOldDays(this.booked_slots);

                setTimeout(function () {
                    $btn.removeClass('fa-refresh fa-spin').addClass('fa-undo');
                    new Noty({
                        type: 'success',
                        text: 'Dates are reset.',
                        timeout: 600
                    }).show();
                }, 600);
            },
            fetchBookedSlots(){
                axios.get('/api/booking/'+this.user.state.currentBook+"/time-slots").then(r=>{
                    this.total_slots = r.data.success.totalSlots;
                    this.booked_slots = r.data.success.bookedSlots;
                    this.start_date = moment(r.data.success.firstDay);;
                    this.highlightOldDays(r.data.success.bookedSlots);
                });
            },
            highlightDays(bool) {
                let $t = this;
                let $e = $('.bootstrap-datetimepicker-widget .datepicker-days table tbody');

                if (bool) {
                    if (this.start_date.format('X') < this.end_date.format('X')) {
                        let StartDate = this.start_date;
                        let EndDate = this.end_date;
                        $e.find('td').each(function (i, e) {
                            let $elem = $(e);
                            let eDate = moment($elem.data('day') + ' ' + moment().format('H:m:s'), 'MM/DD/YYYY H:m:s', true);
                            if (eDate.isValid() && StartDate.format('X') <= eDate.format('X') && EndDate.format('X') >= eDate.format('X')){
                                console.log(eDate);
                                $elem.addClass('highlight-day');
                            } 
                        });
                        this.disabledExtraDays();
                        if(this.end_date.diff(this.start_date, 'days')>this.booked_slots.length)
                            {
                            new Noty({
                                type: 'warning',
                                text: 'You cannot select extra days.'
                            }).show();

                            this.resetDatesLessSeven();
                        }

                        if (this.end_date.diff(this.start_date, 'days') < 6 ) {
                            new Noty({
                                type: 'warning',
                                text: 'Booking should be at least one week.'
                            }).show();

                            this.resetDatesLessSeven();
                        } else{
                            new Noty({
                                type: 'success',
                                text: '<div><p class="m-0"><b>Selected End Date:</b> ' + $t.end_date.format('M/D/Y') + '</p></div>',
                            }).show();
                            }
                    } 
                } else {
                    $e.find('td').removeClass('highlight-day');
                    new Noty({
                        type: 'success',
                        text: 'Dates are reset.',
                        timeout: 600
                    }).show();
                }
            },
             highlightOldDays(r){
                let $t = this;
                let $e = $('.bootstrap-datetimepicker-widget .datepicker-days table tbody');
                let $dates=[];
                let $pastDates = [];

                _.forEach(r, function(date) {
                    if(date.status==2)
                    $pastDates.push(moment(date.day,"YYYY-MM-DD").format("MM/DD/YYYY"));
                    if(date.status==1)
                    $dates.push(moment(date.day,"YYYY-MM-DD").format("MM/DD/YYYY"));

                });

                  $e.find('td').each(function (i, e) {
                            let $elem = $(e);
                            $elem.removeClass('active');
                            if (_.indexOf($pastDates,$elem.data('day'))>=0)
                                $elem.addClass('highlight-day');
                            else 
                                    $elem.addClass('old disabled');
                        });
            },
            disabledExtraDays(){
                 let $t = this;
                let $e = $('.bootstrap-datetimepicker-widget .datepicker-days table tbody');

                let $pastDates = [];

                _.forEach(this.total_slots, function(date) {
                    if(date.status==2)
                    $pastDates.push(moment(date.day,"YYYY-MM-DD").format("MM/DD/YYYY"));
                  

                });

                  $e.find('td').each(function (i, e) {

                            // let $elem = $(e);
                            // if (_.indexOf($pastDates,$elem.data('day'))<0)
                            //         $elem.addClass('old disabled');
                        });
            }
        }
    }
</script>
