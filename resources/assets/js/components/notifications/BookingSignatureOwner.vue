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
                    <a href="javascript:void(0)">
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
                <h3>Contract signed</h3>
                 <p><b>{{notification.data.user}} </b>has signed the contract for the booking of {{ notification.data.vehicle }}
                 </p>
                 <p><b>Contract start:</b> {{notification.data.contract_start.date | date('format', 'DD.MM.YYYY') }} </p>
                <p><b>Contract end:</b> {{notification.data.contract_end.date | date('format', 'DD.MM.YYYY') }}</p> <br>
                <p>
                You can now check and sign the contract and set your <b>Direct Debit</b>.</p>
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
                $(".menu-component-container").animate({scrollTop: 0});
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
