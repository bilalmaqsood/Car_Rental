<template>
    <div class="booking-request-actions notification-shadow">
        <div class="btn-inlane-content noty_successfull">
            <div class="driver-profile-text">
                <h3>Inspection Confirmed</h3>
                <p>Handover inspection is confirmed by <b>{{ notification.data.user }}</b> for the vehicle 
                <b>{{ notification.data.vehicle }}</b>
                </p>
                <p>Booking is now avtive (On Going)</p>
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
