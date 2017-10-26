<template>
    <div class="booking-request-actions notification-shadow">
            <div class="inlane-btn-wrap inlane-btn-wrap-btn2">
            <ul class="two-btn-inlane">
                <li>
                <a  href="javascript:void(0)"  @click="contractEvent">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                    </svg>
                    contract
                </a>
                </li>
                <li>
                    <a href="javascript:void(0)" @click="chatEvent">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                        </svg>
                        chat
                    </a>
                </li>
            </ul>
        </div>
        <div class="btn-inlane-content btn-inlane-content-btn3 noty_successfull">
            <div class="driver-profile-text">
            <h3>Booking approved</h3>
            <p>{{ notification.data.user}} approved your request to book <b> {{notification.data.vehicle}} </b>

            <ul class="contract_start_end">
                <li><b>Contract start:</b> {{notification.data.contract_start.date | date('format', 'DD.MM.YYYY') }} </li>
                <li><b>Contract end:</b> {{notification.data.contract_end.date | date('format', 'DD.MM.YYYY') }}</li>
            </ul>
            You can now check and sign the contract and set your Direct Debit. A
            deposit of <b>{{notification.data.deposit | currency}}</b> have been taken from your card ending in <b>{{notification.data.card_ending}}</b></p>
        </div>
    </div>
</div>
</template>

<script>
    import User from '../../user';

    export default {
        props: ["notification"],
        data() {
            return {

            };
        },

        computed: {

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
            chatEvent(){
                this.$parent.$emit("chat",this.notification);
            }

        }
    }
</script>
