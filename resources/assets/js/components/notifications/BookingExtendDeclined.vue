<template>
    <div class="booking-request-actions notification-shadow">
    <div class="approved-actions-img">
        <img :src="notification.data.image" alt="">
    </div>
        <div class="btn-inlane-content btn-inlane-content-btn3 noty_danger">
            <div class="driver-profile-text">
                <h3>Extension request decline</h3>

                Your request for the contract for <b>{{ notification.data.vehicle }}</b> extend until <b>{{notification.data.requested_data.end_date | date('format', 'DD.MM.YYYY') }}</b>  has been decline.
                
            </div>
        </div>
    </div>
</template>

<script>
    import User from '../../user';

    export default {
        props: ['notification'],
        data() {
            return {

            };
        },

        computed: {
            sender(){

            },
        },

        mounted() {
            console.log(this.notification);

        },

        methods: {
            viewProfileEvent(){
                this.$parent.$emit("viewPofile",{booking_id: this.notification.data.id});
            },
            approveEvent(){
                this.$parent.$emit("approve",this.notification);

            },
            declineEvent(){
                this.$parent.$emit("decline",this.notification);

            },
            contractEvent(){
                this.$parent.$emit("contract",this.notification);

            },

        }
    }
</script>
