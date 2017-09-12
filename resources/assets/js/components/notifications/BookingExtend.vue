<template>
    <div class="booking-request-actions notification-shadow">
    <div class="approved-actions-img">
        <img :src="notification.data.image" alt="">
    </div>
        <div class="inlane-btn-wrap inlane-btn-wrap-btn2 ">
            <ul class="two-btn-inlane">

                 <li>
                    <a  href="javascript:void(0)"  @click="approveEvent">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                        </svg>
                        approve
                    </a>
                </li>
                <li>
                    <a  href="javascript:void(0)" @click="declineEvent">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close_icon"></use></svg>
                        decline
                    </a>
                </li>
            </ul>
        </div>
        <div class="btn-inlane-content btn-inlane-content-btn3 noty_warning">
            <div class="driver-profile-text">
                <h3>Extension requested</h3>
                <p><b>{{notification.data.user}}</b> has requested to extend the contract for  {{ notification.data.vehicle }}
                </p>
                <p><b>Contract end:</b> {{notification.data.contract_end.date | date('format', 'DD.MM.YYYY') }} |  <b> Extend until:</b> {{notification.data.extend.contract_end | date('format', 'DD.MM.YYYY') }}</p>
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
