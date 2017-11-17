<template>
    <div class="booking-request-actions notification-shadow">
        <div v-if="show"  class="inlane-btn-wrap inlane-btn-wrap-btn3">
            <ul class="three-btn-inlane">
                <li>
                    <a href="javascript:void(0)" @click="viewProfileEvent">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg>
                        view driver
                    </a>
                </li>
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
        <div class="btn-inlane-content btn-inlane-content-btn3 noty_successfull">
            <div @click="show = !show" class="clickable driver-profile-text">
                <h3>Booking requested</h3>
                <p><b>{{notification.data.user}}</b> requested to book <b>{{ notification.data.vehicle }}</b></p>
                <br>
                <ul class="contract_start_end">
                <li><b>Contract start:</b> {{notification.data.contract_start.date | date('format', 'DD.MM.YYYY') }} </li>
                <li><b>Contract end:</b> {{notification.data.contract_end.date | date('format', 'DD.MM.YYYY') }}</li>
                </ul>
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
                show: false,
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
