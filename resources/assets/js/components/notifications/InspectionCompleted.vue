<template>
    <div class="booking-request-actions notification-shadow">
        <div class="btn-inlane-content btn-inlane-content-btn3 noty_warning">
            <div class="driver-profile-text">
                <h3>Owner updated vehicle inspection</h3>
                <p><b>{{notification.data.user}}</b>  has updated vehicle inspection  {{ notification.data.vehicle }}
                </p>
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
