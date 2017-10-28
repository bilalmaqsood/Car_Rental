<template>
    <div class="booking-request-actions notification-shadow">
        <div v-if="show" class="inlane-btn-wrap inlane-btn-wrap-btn2 noty_danger">
            <ul class="two-btn-inlane">

                 <li>
                    <a  href="javascript:void(0)" @click="extendEvent" >
                        <i style="font-size: 35px;" class="fa fa-clock-o" aria-hidden="true"></i>
                        extend/renew
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
        <div class="btn-inlane-content btn-inlane-content-btn3 noty_warning">
            <div @click="show = !show" class="clickable driver-profile-text">
                <h3>Booking Ending soon</h3>
                <p>Contract for the vehicle <b>{{ notification.data.vehicle }}</b> ending on <b>{{notification.data.contract_end.date | date('format', 'DD.MM.YYYY') }}</b>
                </p>
                <p>you can extend/renew contract</p>
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
            },
            extendEvent(){
                User.commit('updateCurrentBook', this.notification.data.id);
                this.$parent.$emit("changeView",'extend');
            }
        }
    }
</script>
