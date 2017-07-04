<template>
    <div class="search_map">
        <div class="main_profile_container text-left" :style="{ height: profileHeight + 'px' }">
            <div class="profile_top_content">
                <img :src="User.state.auth.avatar" alt="">
                <div class="update_ropfile">
                    <h3>{{User.state.auth.name}}</h3>
                    <p><span>Age: <i>29</i></span><span> Uber ra5ng: <i>4.6</i></span><span>07402046843</span></p>
                    <button class="secodery_btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
                        </svg>
                    </button>
                </div>
            </div>

            <div v-for="notification in notifications" class="pofile_content_wrapper" v-if="isBooking(notification)">

                <div class="img_box" v-bind:style="{ 'background-image': 'url(' + notification.data.image + ')' }">
                    <img :src="notification.data.image" alt="">
                </div>
                <div class="profile_content">
                    <h3>{{notification.data.title}}</h3>
                    <p><span>{{notification.data.user}}</span> sent you booking request</p>
                    <p>{{notification.data.vehicle}}</p>
                    <p>Contract start: {{ date_format(notification.data.contract_start) }} </p>
                    <p>Contract end: {{ date_format(notification.data.contract_end) }}</p>
                    <p>You can now check and sign the contract and set your <span>Direct Debit.</span> A deposit of <span>£{{ notification.data.deposit }}</span> have been taken from your card ending in <span>1234</span></p>
                </div>

            </div>

            <div class="pofile_content_wrapper oring_border">
                <div class="profile_content">
                    <h3>Contract ending</h3>
                    <p>Your contract for <span>Toyota Prius 1.8 Hybrid</span> will end in <span>1 day(s) - Contract ending:</span> 06.05.2017</p>
                    <p>You can request to extend or renew the contract. If you do not take any acHons, then please return the vehicle at the pre-set date and locaHon.</p>
                </div>
            </div>

            <div class="pofile_content_wrapper green_border">
                <div class="profile_content">
                    <h3>You have new messages</h3>
                    <p>On 05.05.2017 <span>Mike Myers</span> wrote:</p>
                    <p>Hello Andrei. I made the required changes to the contract and it is ready for you to sign it. If you have any further inquiries, do not hesitate to get in touch. </p>
                </div>
            </div>

            <div class="pofile_content_wrapper white_boredr">
                <div class="img_box" style="background: url(/images/car_img_1.png)">
                    <img src="/images/car_img_1.png" alt="">
                </div>
                <div class="profile_content">
                    <h3>Request unsuccessfull</h3>
                    <p>Unfortunately, your request to book</p>
                    <p><span>Toyota Prius 1.8 Hybrid </span></p>
                    <p>has beenunsuccessful.</p>
                    <p>Please check our vehicles database for a similar vehicle that you can book.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import User from '../user';

    var $scope;
    export default {
        props: ['profileHeight'],

        data() {
            return {
                notifications: "",
                User: User,
            };
        },

        mounted() {
            console.log(User.state);
            $scope=this;
            console.log(this.profileHeight);
            this.prepareComponent();
            axios.get('/api/notifications')
                .then(function (response) {
                    $scope.notifications = response.data.success;
                });
        },

        methods: {
            prepareComponent() {
                console.log('profile componenet mounted');
            },
            isBooking(notification){
                return notification.data.type=='Booking';
            },
            date_format(date){
                return moment(date.date).format("D.M.Y");
            }
        }
    }
</script>
