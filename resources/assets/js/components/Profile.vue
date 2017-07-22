<template>
    <div class="main_profile_container">
        <div class="profile_top_content">
            <img v-if="!!vuex.state.auth.avatar" :src="vuex.state.auth.avatar" alt="">
            <div v-else style="width:100%;height:250px;text-align:center;">
                <img src="/images/avatar-default.png" style="width:auto;" alt="">
            </div>
            <div class="update_profile">
                <h3>{{vuex.state.auth.name}}</h3>
                <p><span v-if="age">Age: <i>{{age}}</i>&nbsp; |</span> <span class="phone-number" v-if="vuex.state.auth.phone"><i>{{vuex.state.auth.phone}}</i></span></p>
                <button class="secodery_btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
                    </svg>
                </button>
            </div>
        </div>

        <transition-group name="slide-fade" tag="div">
            <div v-for="notif in notifications" :class="notif.data.noti_type" v-bind:key="notif.id" class="cursor-pointer pofile_content_wrapper">
                <div v-if="propExist(notif.data,'image')" class="img_box" v-bind:style="{ 'background-image': 'url(' + notif.data.image + ')' }">
                    <img :src="notif.data.image" alt="">
                </div>

                <div class="profile_content">
                    <h3 :class="{clickable: notif.data.vehicle}" v-if="notif.data.title" @click="notify_action(notif)">{{notif.data.title}}</h3>
                    <p v-if="propExist(notif.data,'user')"><span>{{notif.data.user}}</span> sent you booking request</p>
                    <p v-if="propExist(notif.data,'vehicle')">{{notif.data.vehicle}}</p>
                    <p v-if="propExist(notif.data,'contract_start')">Contract start: {{ date_format(notif.data.contract_start) }} </p>
                    <p v-if="propExist(notif.data,'contract_end')">Contract end: {{ date_format(notif.data.contract_end) }}</p>
                    <p v-if="propExist(notif.data,'deposit')">You can now check and sign the contract and set your <span>Direct Debit.</span> A deposit of <span>{{ notif.data.deposit | currency }}</span> have been taken from your card ending in <span>1234</span></p>
                    <p><a href="javascript:" class="pull-right" @click="markRead(notif)">Mark read</a></p>
                    <div v-if="isActionable(notif)" class="btn-group">
                        <button v-if="notif.data.vehicle" @click="approve_action(notif)">Approve</button>
                        <button v-if="notif.data.vehicle" @click="cancle_action(notif)">Cancle</button>
                    </div>
                </div>
            </div>
        </transition-group>

    </div>
</template>

<script>
    import User from '../user';

    let $scope;
    export default {
        data() {
            return {
                notifications: '',
                booking_log: '',
                vuex: User,
            };
        },

        computed: {
            age() {
                if (!User.state.auth)
                    return 0;
                else if (typeof User.state.auth.dob !== 'undefined')
                    return moment.utc().diff(moment.utc(User.state.auth.dob, 'YYYY-MM-DD H:m:s', true), 'years');
            }
        },

        mounted() {
            $scope = this;
            this.prepareComponent();
        },

        methods: {
            isActionable(notification){
                let allowed = [3, 5];
                if (notification.data.old_status && User.state.auth.type == 'owner') {
                    let status = parseInt(notification.data.old_status);
                    return allowed.includes(status);
                }
                return false;
            },
            prepareComponent() {
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
                if (notification.data.id) {
                    axios.get('/api/booking/' + notification.data.id + '/logs')
                        .then($scope.approveRequest);
                }
            },
            cancle_action(notification){
//                TODO: need to do this
                if (notification.data.id) {
                    axios.patch('/api/booking/' + notification.data.id + '/status', this.cancleParams())
                        .then(response => {
                            console.log(response);
                        });
                }
            },
            approveRequest(response){
                if (response.data.success.booking_log[0] !== undefined) {
                    let data = response.data.success.booking_log[0];
                    let booking_id = response.data.success.booking_log[0].booking_id;
                    let status = response.data.success.booking_log[0].requested_data.status;
                    let log_id = response.data.success.booking_log[0].id;
                    let params = {log_id: log_id, status: ""};
                    console.log(response.data.success);
                    if (status === 5) {
                        params.status = 6;
                        $scope.sendRequest(response.data.success.id, params);
                    }
                    if (status === 3) {
                        params.status = 4;
                        $scope.sendRequest(response.data.success.id, params);
                    }
                }
            },
            sendRequest(booking_id, params){
                axios.patch('/api/booking/' + booking_id + '/status', params)
                    .then(function (response) {

                        if (response.error)
                            new Noty({type: 'error', text: response.error}).show();
                        if (response.success)
                            new Noty({type: 'success', text: response.success}).show();

                    });
            },
            markRead(notification){

                let params = {notify_id: notification.id};
                axios.post('/api/notifications', params)
                    .then(function (response) {
                        let index = $scope.notifications.indexOf(notification);
                        $scope.notifications.splice(index, 1);

                    });
            }
        },
    }
</script>
