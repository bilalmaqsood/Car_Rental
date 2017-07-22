<template>
    <div id="extend_cancel">
        <div class="extend_booking">
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

            <div class="extend_booking_content cursor-pointer btn-send" @click="extendBooking">Send request</div>

            <div class="extend_booking_content">Cancel booking</div>

            <div class="extend_booking_content no-padding"><textarea class="form-control" placeholder="Reason for early cancellation" v-model="cancel_note"></textarea></div>

            <div class="extend_booking_content cursor-pointer btn-send" @click="cancelBooking">Send request</div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['user'],

        data() {
            return {
                end_date: '',
                start_date: '',
                cancel_note: ''
            };
        },

        mounted() {

            $('#extendCancelDate').datetimepicker({
                inline: true,
                sideBySide: false
            })
//                .on("dp.change",function (event) {
//                if(start_date.length<=0)
//                    start_date = event.date.format("Y-M-D");
//                else if(end_date.length<=0)
//                    end_date = event.date.format("Y-M-D");
//
//                $scope.start_date=start_date;
//                $scope.end_date=end_date;
//            });
        },

        methods: {
            extendBooking() {
                if (this.user.state.currentBook !== null) {
                    axios.post('/api/booking/' + this.user.state.currentBook + '/status', this.extendParams())
                        .then(response => {
                            console.log(response);
                        });
                }
            },

            cancelBooking() {
                if (this.user.state.currentBook !== null) {
                    axios.post('/api/booking/' + this.user.state.currentBook + '/status', this.cancelParams())
                        .then(response => {
                            console.log(response);
                        });
                }
            },

            extendParams() {
                return {
                    start_date: this.start_date,
                    end_date: this.end_date,
                    status: 5
                }
            },

            cancelParams() {
                return {
                    note: this.cancle_note,
                    status: 3
                }
            }
        }
    }
</script>
