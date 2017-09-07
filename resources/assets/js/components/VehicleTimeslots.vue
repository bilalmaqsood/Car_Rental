<template>
    <div class="tab-content booking_tab_content">
        <div id="extend_cancel" class="tab-pane fade in active">
            <div class="extend_booking">
                <div class="extend_booking_content">Add Vehicle Timeslots </div>
                <div class="extend_booking_content">
                    <div class="book_now_calender">
                        <p>Select date range</p>
                        <div style="overflow:hidden;">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="timeslots_picker"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div @click="processTimeslots" class="clickable text-center extend_booking_content">Add Timeslots</div>

            </div>
        </div>

    </div>
</template>

<script>

    var $scope;
    export default {
        props: ["vehicle"],
        data() {
            return {
                contractTemplate: false,
                start_date: '',
                end_date: '',
                old_slots: null,
            };
        },

        mounted() {
            $scope = this;
                        axios.get('/api/vehicle/'+this.vehicle.id+"/time-slot").then(r=>{
                            this.old_slots = r;
                            this.highlightOldDays(r);
                        }).catch(function(){
                            $scope.highlightOldDays(null);
                        });
                    this.prepareComponent();


            // $("th.next").on("click", function(event) {
            //     $scope.highlightOldDays($scope.old_slots);
            // });
            // $("th.prev").on("click", function(event) {
            //     $scope.highlightOldDays($scope.old_slots);
            // });

        },

        methods: {

            prepareComponent() {
                this.initializeJquery();
            },

            initializeJquery() {
           let $scope = this;

                var $picker = $('#timeslots_picker').datetimepicker({
                    inline: true,
                    sideBySide: false,
                    minDate: moment(new Date())
                }).on('dp.change', this.calenderChange)
                  .on('dp.update', function(){ $scope.highlightOldDays($scope.old_slots) });
                $('[data-toggle="tooltip"]').tooltip();
            },

            resetDatesLessSeven() {
                let $t = this;
                this.start_date = null;
                this.end_date = null;

                setTimeout(function () {
                    $t.highlightDays(false);
                    $t.highlightOldDays($t.old_slots);
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
                        type: 'success',
                        text: 'Dates are reset.',
                        timeout: 600
                    }).show();
                }, 600);
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
                        $t.highlightOldDays($t.old_slots);
                        if (this.end_date.diff(this.start_date, 'days') < 6) {
                            new Noty({
                                type: 'warning',
                                text: 'Booking should be at least one week.'
                            }).show();

                            this.resetDatesLessSeven();
                            
                        } else{
                            new Noty({
                                type: 'success',
                                text: '<div><p><b>Selected Start Date:</b> ' + $t.start_date.format('M/D/Y') + '</p><p class="m-0"><b>Selected End Date:</b> ' + $t.end_date.format('M/D/Y') + '</p></div>',
                            }).show();

                            }
                    } else {
                        new Noty({
                            type: 'warning',
                            text: '<div><p>Start date should greater than end date.</p><p>Please select dates again.</p></div>',
                        }).show();
                        this.start_date = null;
                        this.end_date = null;
                        $t.highlightOldDays($t.old_slots);
                        
                    }
                } else {
                    $t.highlightOldDays($t.old_slots);
                    new Noty({
                        type: 'success',
                        text: 'Dates are reset.',
                        timeout: 600
                    }).show();
                }
            },

            processTimeslots(){
                let $this = this;
                if(this.end_date=='' && this.end_date==''){
                    new Noty({
                        type: 'warning',
                        text: 'Please select valid start and end dates.'
                    }).show();
                }
                else if (this.end_date.diff(this.start_date, 'days') < 6) {
                    new Noty({
                        type: 'warning',
                        text: 'Booking should be at least one week.'
                    }).show();

                    this.resetDatesLessSeven();
                } else {
                    $('#sideLoader').show();
                    var dateArr=[];
                    var fromDate = this.start_date.format('YYYY-MM-DD');
                    var toDate = this.end_date.format('YYYY-MM-DD');
                    while(fromDate <= toDate) {
                        dateArr.push(moment(fromDate).format('YYYY-MM-DD'));
                        fromDate = moment(fromDate).add(1, 'days').format('YYYY-MM-DD');
                    }
                    axios.post('/api/time-slot',{vehicle_id: this.vehicle.id,days: dateArr}).then(function (r) {
                        new Noty({
                            type: 'success',
                            text: r.data.success,
                        }).show();
                        $this.$emit("changeView");
                    });
                    setTimeout(function() { $('#sideLoader').hide(); }, 500);
                }
            },
            highlightOldDays(response,active=true){
                let $t = this;
                let $e = $('.bootstrap-datetimepicker-widget .datepicker-days table tbody');
                let $dates=[];
                if(response){
                _.forEach(response.data.success, function(value) {
                    $dates.push(moment(value.day, "YYYY-MM-DD").format("MM/DD/YYYY") );
                    });
                    }
                  $e.find('td').each(function (i, e) {
                            let $elem = $(e);
                            if(active)
                            $elem.removeClass('active');
                            if (_.indexOf($dates,$elem.data('day'))>0) 
                                $elem.addClass('highlight-day');
                        });
            }
        }
    }
</script>
