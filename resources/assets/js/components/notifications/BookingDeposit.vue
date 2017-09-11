<template>
    <div class="booking-request-actions">
        <div class="btn-inlane-content btn-inlane-content-btn3 noty_warning">
            <div class="driver-profile-text">
                <h3>{{notification.data.title}}</h3>
                <p>Deposit <b>{{notification.data.deposit | currency}}</b> For vehicle <b> {{notification.data.vehicle}} </b></p>
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

            contractEvent(){
                this.$parent.$emit("contract",this.notification);

            },
            chatEvent(){
                this.$parent.$emit("chat",this.notification);

            },

        }
    }
</script>
