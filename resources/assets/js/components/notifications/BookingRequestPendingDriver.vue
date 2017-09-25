    <template>
    <div class="booking-request-actions notification-shadow">
    <div class="inlane-btn-wrap inlane-btn-wrap-btn2">
            <ul class="three-btn-inlane">
                <li>
                    <a href="javascript:void(0)">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg>
                        wait 30 min
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
        <div class="btn-inlane-content btn-inlane-content-btn2 noty_danger">
            <div class="driver-profile-text">
                <h3>No response from owner</h3>
                <p><b>{{notification.data.user}}</b>  has not taken any action regarding your booking request for <b>{{ notification.data.vehicle }}</b></p>
                <p>You can cancel your request now or allow the owner more time to reply</p>
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
                axios.delete('/api/booking/'+this.notification.data.id+'/cancel-request').then(r=>{
                         new Noty({
                                type: 'warning',
                                text: 'Booking request is has been cancel',
                            }).show();
                         this.$parent.$emit("markread",this.notification);
                        console.log(r);
                    });
            }
    }
}
</script>