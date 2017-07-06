<template>
    <div id="extend_cancel" class="tab-pane fade active in">
        <div class="extend_booking">
            <div class="extend_booking_content">Extend booking</div>
            <div class="extend_booking_content">
                <div class="book_now_calender">
                    <p>Select first and last day of booking</p>
                    <div style="overflow:hidden;">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="datetimepicker12"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="extend_booking_content">Send request</div>
            <div class="extend_booking_content">Cancel booking</div>
            <div class="extend_booking_content">
                <div class="book_now_calender">
                    <p>Select first and last day of booking</p>
                    <div style="overflow:hidden;">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="datetimepicker13"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="extend_booking_content">Reason for early cancelation</div>
            <div class="extend_booking_content">Send request</div>
        </div>
    </div>
</template>

<script>

    var $scope;

    export default {

        data() {
            return {

            };
        },

        mounted() {
            $scope=this;
            var start_date="";
            var end_date="";
            window.picker =  $('#datetimepicker12').datetimepicker({
                inline: true,
                sideBySide: false
            });

            picker.on("dp.change",function (event) {


                if(start_date.length<=0)
                    start_date = event.date.format("Y-M-D");
                else if(end_date.length<=0)
                    end_date = event.date.format("Y-M-D");

                vm.start_date=start_date;
                vm.end_date=end_date;

                console.log("end_date"+end_date+"& start_date"+start_date);

            });
        },

        methods: {

        }
    }
</script>
