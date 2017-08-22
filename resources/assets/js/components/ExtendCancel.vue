<template>
    <div id="extend_cancel">

        <div v-if="user.state.auth.type=='client' && extend" class="extend_booking">
            <div class="extend_booking_content">Extend booking</div>

            <div class="extend_booking_content no-padding">
                <div class="book_now_calender">
                    <p>Select the day to extend to</p>
                    <div style="overflow:hidden;">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="extendCancelDate"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="extend_booking_content cursor-pointer btn-send" @click="extendBooking">Send request</button>
            <div @click="extend=!extend" class="cursor-pointer extend_booking_content">Cancel booking</div>

            
        </div>

        <div v-show="user.state.auth.type=='client' && !extend" class="extend_booking">
            <div class="extend_booking_content">Cancel booking</div>
            <div class="extend_booking_content no-padding">
                <div class="book_now_calender">
                    <p>Select the day to extend to</p>
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

    </div>
</template>

<script>

import User from '../user';

    export default {
        data() {
            return {
                user: User,
                extend: true,
                booked_slots: false,
                end_date: '',
                start_date: '',
                cancel_note: ''
            };
        },

        mounted() {
            let $this = this; 
            this.fetchBookedSlots();
            $('#extendCancelDate').datetimepicker({
                    inline: true,
                    sideBySide: false,
                    minDate: moment(new Date())
                }).on('dp.change', this.calenderChange)
                  .on('dp.update', function(){ $this.highlightOldDays($this.booked_slots) });
                $('[data-toggle="tooltip"]').tooltip();

                $('#CancelDate').datetimepicker({
                    inline: true,
                    sideBySide: false,
                    minDate: moment(new Date())
                }).on('dp.change', this.calenderChange)
                  .on('dp.update', function(){ $this.highlightOldDays($this.booked_slots) });
                
                $('[data-toggle="tooltip"]').tooltip();
        },

        methods: {
            
            extendBooking(e) {
                let $scope = this;

                if (this.user.state.currentBook !== null) {
                    $(e.target).attr('disabled', 'disabled').removeClass('cursor-pointer').html("Loading...");
                    $("#sideLoader").show();
                    axios.post('/api/booking/' + this.user.state.currentBook + '/status', this.extendParams())
                        .then(r => {
                            new Noty({
                                type: 'information',
                                text: r.data.success,
                            }).show();
                             $("#sideLoader").hide();
                            $scope.$emit("clearSideView");
                        });
                }
            },

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
                    note: this.cancle_note,
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
            highlightDays(bool) {
                let $t = this;
                let $e = $('.bootstrap-datetimepicker-widget .datepicker-days table tbody');

                if (bool) {
                    if (this.start_date.format('X') < this.end_date.format('X')) {
                        let StartDate = this.start_date;
                        let EndDate = this.end_date;
                        $e.find('td').each(function (i, e) {
                            let $elem = $(e);
                            let eDate = moment.utc($elem.data('day') + ' ' + moment().format('H:m:s'), 'MM/DD/YYYY H:m:s', true);
                            if (eDate.isValid() && StartDate.format('X') <= eDate.format('X') && EndDate.format('X') >= eDate.format('X')) $elem.addClass('highlight-day');
                        });
                        this.highlightOldDays(this.booked_slots);
                            new Noty({
                                type: 'information',
                                text: '<div><p><b>Selected Start Date:</b> ' + $t.start_date.format('M/D/Y') + '</p><p class="m-0"><b>Selected End Date:</b> ' + $t.end_date.format('M/D/Y') + '</p></div>',
                            }).show();
                            
                    } 
                } 
            },
            resetDatesLessSeven() {
                let $t = this;
                this.start_date = null;
                this.end_date = null;

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
            fetchBookedSlots(){
                axios.get('/api/booking/'+this.user.state.currentBook+"/time-slots").then(r=>{
                    this.booked_slots = r.data.success.totalSlots;

                        let theDate = new Date(_.last(r.data.success.bookedSlots).day);
                        theDate.setDate(theDate.getDate()+1);
                    this.start_date = moment(theDate);;
                    this.highlightOldDays(r.data.success.totalSlots);
                });
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
                            if (_.indexOf($pastDates,$elem.data('day'))>=0)
                                $elem.addClass('highlight-day');
                            else if(_.indexOf($dates,$elem.data('day'))<0)
                                    $elem.addClass('old disabled');
                        });
            }
        }
    }
</script>
