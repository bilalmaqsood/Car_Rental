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

            <div v-for="notification in notifications" :class="notification.data.noti_type" class=" pofile_content_wrapper">

                <div v-if="propExist(notification.data,'image')" class="img_box" v-bind:style="{ 'background-image': 'url(' + notification.data.image + ')' }">
                    <img :src="notification.data.image" alt="">
                </div>

                <div class="profile_content">
                    <h3  :class="{clickable: notification.data.vehicle}"v-if="notification.data.title" @click="notify_action(notification)">{{notification.data.title}}</h3>
                    <p v-if="propExist(notification.data,'user')" ><span>{{notification.data.user}}</span> sent you booking request</p>
                    <p v-if="propExist(notification.data,'vehicle')">{{notification.data.vehicle}}</p>
                    <p v-if="propExist(notification.data,'contract_start')">Contract start: {{ date_format(notification.data.contract_start) }} </p>
                    <p v-if="propExist(notification.data,'contract_end')">Contract end: {{ date_format(notification.data.contract_end) }}</p>
                    <p v-if="propExist(notification.data,'deposit')">You can now check and sign the contract and set your <span>Direct Debit.</span> A deposit of <span>{{ notification.data.deposit | currency }}</span> have been taken from your card ending in <span>1234</span></p>
                    <div v-if="notification.data.title.includes('request')" class="btn-group">
                    <button v-if="notification.data.vehicle" @click="approve_action(notification)">Approve</button>
                    <button v-if="notification.data.vehicle"  @click="cancle_action(notification)">Cancle</button>
                    </div>
                </div>

            </div>


        </div>
    </div>
</template>

<script>
    import User from '../user';

    export default {
        props: ['profileHeight'],

        data() {
            return {
                notifications: '',
                User: User,
                booking_log: '',
            };
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                let $scope = this;
                axios.get('/api/notifications')
                    .then(response => {
                        $scope.notifications = response.data.success;
                    });
            },

            propExist(obj, prop) {
                return obj.hasOwnProperty(prop);
            },

            date_format(date) {
                return moment.utc(date.date).format("D.M.Y");
            },
            approve_action(notification){
                if(notification.data.id){
                    axios.get('/api/booking/'+notification.data.id+'/logs')
                        .then($scope.approveRequest);
                }
            },
            cancle_action(notification){
//                TODO: need to do this
                if(notification.data.id) {
                    axios.patch('/api/booking/' + notification.data.id + '/status', this.cancleParams())
                        .then(response => {
                            console.log(response);
                        });
                }
            },
            approveRequest(response){
                if(response.data.success.booking_log[0]!==undefined) {
                    var data = response.data.success.booking_log[0];
                    var booking_id = data.booking_id;
                    var status = data.requested_data.status;
                    var log_id = data.id;
                    var params = {log_id: log_id, status: ""};

                    if (status === 5) {
                        console.log("calling 6");
                        params.status = 6;
                        $scope.sendRequest(booking_id, params);
                    }
                    if (status === 3) {
                        console.log("calling 6");
                        params.status = 4;
                        $scope.sendRequest(booking_id, params);
                    }
                }
            },
            sendRequest(booking_id,params){
                console.log("calling this request");
                axios.patch('/api/booking/'+booking_id+'/status',params)
                    .then(function (response) {
                        new Noty({type: 'error',text: response.error}).show();
                        if(response.error)
                        new Noty({type: 'error',text: response.error}).show();
                        if(response.success)
                            new Noty({type: 'success',text: response.success}).show();

                    });
            }
        }
    }
</script>
