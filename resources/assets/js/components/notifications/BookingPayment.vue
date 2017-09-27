<template>
    <div class="booking-request-actions notification-shadow">
        <div class="btn-inlane-content btn-inlane-content-btn3 noty_warning">
            <div class="driver-profile-text">
                <h3>{{notification.data.title}}</h3>
                <p>Deposit <b>{{notification.data.amount | currency}}</b> For vehicle <b> {{notification.data.vehicle}} </b></p>
                <p>You can now check and sign the contract . A deposit of <b> {{ notification.data.amount | currency }}</b> have been taken
                from your card ending in <b>{{notification.data.card_ending}}</b></p>
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

            contractEvent(){
                this.$parent.$emit("contract",this.notification);

            },
            chatEvent(){
                this.$parent.$emit("chat",this.notification);

            },

        }
    }
</script>
