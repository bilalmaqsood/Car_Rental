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

            <div v-for="notification in notifications" :class="notification.data.noti_type" class=" pofile_content_wrapper" >

                <div v-if="propExist(notification.data,'image')" class="img_box" v-bind:style="{ 'background-image': 'url(' + notification.data.image + ')' }">
                    <img :src="notification.data.image" alt="">
                </div>

                <div class="profile_content">
                    <h3 :class="{clickable: notification.data.vehicle}" v-if="notification.data.title" @click="notify_action(notification)">{{notification.data.title}}</h3>
                    <p v-if="propExist(notification.data,'user')" ><span>{{notification.data.user}}</span> sent you booking request</p>
                    <p v-if="propExist(notification.data,'vehicle')">{{notification.data.vehicle}}</p>
                    <p v-if="propExist(notification.data,'contract_start')">Contract start: {{ date_format(notification.data.contract_start) }} </p>
                    <p v-if="propExist(notification.data,'contract_end')">Contract end: {{ date_format(notification.data.contract_end) }}</p>
                    <p v-if="propExist(notification.data,'deposit')">You can now check and sign the contract and set your <span>Direct Debit.</span> A deposit of <span>£{{ notification.data.deposit }}</span> have been taken from your card ending in <span>1234</span></p>
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
                booking_log: "",
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
            propExist(obj,prop){
                return obj.hasOwnProperty(prop);;
            },
            date_format(date){
                return moment(date.date).format("D.M.Y");
            },
            notify_action(notification){
                if(notification.data.id){
                    axios.get('/api/booking/'+notification.data.id+'/logs')
                        .then(function (response) {
                            $scope.booking_log = response.data.success;
                        });
                }
            }
        }
    }
</script>
