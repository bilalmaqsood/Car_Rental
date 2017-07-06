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
                                    <div id="extendcancledate"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="extend_booking_content clickable" @click="extendBooking">Send request</div>
            <div class="extend_booking_content ">Cancel booking</div>
            <div class="extend_booking_content clickable">
               
            </div>
            <div class="extend_booking_content ">Reason for early cancelation <input type="text" v-model="cancle_note"></div>
            <div class="extend_booking_content clickable" @click="cancleBooking">Send request</div>
        </div>
    </div>
</template>

<script>

    var $scope;

    export default {
        props:['CURRENT_BOOKING'],
        data() {
            return {
                start_date: "",
                end_date: "",
                cancle_note: ""
            };
        },

        mounted() {
            $scope=this;
            var start_date="";
            var end_date="";
            window.ExtendCanclepicker =  $('#extendcancledate').datetimepicker({
                inline: true,
                sideBySide: false
            });

            ExtendCanclepicker.on("dp.change",function (event) {
                if(start_date.length<=0)
                    start_date = event.date.format("Y-M-D");
                else if(end_date.length<=0)
                    end_date = event.date.format("Y-M-D");

                $scope.start_date=start_date;
                $scope.end_date=end_date;

            });
        },

        methods: {
            extendBooking(){

                if(this.CURRENT_BOOKING !== undefined ) {
                    axios.post('/api/booking/' + this.CURRENT_BOOKING.id + '/status', this.extendParams())
                        .then(response => {
                            console.log(response);
                        });
                }
            },
            cancleBooking(){
                if(this.CURRENT_BOOKING !== undefined ) {
                    axios.patch('/api/booking/' + this.CURRENT_BOOKING.id + '/status', this.cancleParams())
                        .then(response => {
                            console.log(response);
                        });
                }
            },
            extendParams(){
                return {
                    start_date: $scope.start_date,
                    end_date: $scope.end_date,
                    status: 5
                }
            },
            cancleParams(){
                return {
                    note: $scope.cancle_note,
                    status: 4
                }
            }

        }
    }
</script>
