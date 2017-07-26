<template>
    <div>
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
                <div v-for="notif in notifications" :class="notif.data.noti_type" v-bind:key="notif.id" class="pofile_content_wrapper">
                    <div v-if="propExist(notif.data,'image')" class="img_box" v-bind:style="{ 'background-image': 'url(' + notif.data.image + ')' }">
                        <img :src="notif.data.image" alt="">
                    </div>

                    <div class="profile_content">
                        <h3 :class="{clickable: notif.data.vehicle}" v-if="notif.data.title" @click="notify_action(notif)">{{notif.data.title}}</h3>
                        <p v-if="propExist(notif.data,'user')"><span>{{notif.data.user}}</span> sent you booking request</p>
                        <p v-if="propExist(notif.data,'vehicle')">{{notif.data.vehicle}}</p>
                        <p v-if="propExist(notif.data,'contract_start')"><b>Contract start:</b> {{ date_format(notif.data.contract_start) }} </p>
                        <p v-if="propExist(notif.data,'contract_end')"><b>Contract end:</b> {{ date_format(notif.data.contract_end) }}</p>
                        <p v-if="propExist(notif.data,'deposit')" class="m-t-1">You can now check and sign the contract and set your <span>Direct Debit.</span> A deposit of <span>{{ notif.data.deposit | currency }}</span> have been taken from your default card.</p>
                        <p class="m-t-1">
                            <a href="javascript:" class="primary-button" v-if="isActionable(notif)" @click="viewContract(notif)">View Contract</a>
                            <a href="javascript:" class="primary-button" @click="markRead(notif)" v-else>Mark read</a>
                        </p>
                    </div>
                </div>
            </transition-group>
        </div>

        <transition name="slide-fade">
            <sign-contract v-if="booking" :booking="booking" @closeContract="cleanViewContract"></sign-contract>
        </transition>
    </div>
</template>

<script>
    import User from '../user';

    export default {
        data() {
            return {
                notifications: '',
                booking_log: '',
                vuex: User,
                booking: null
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
            this.prepareComponent();
        },

        methods: {
            isActionable(notification) {
                let allowed = [1, 2, 3];

                return (notification.data.old_status && notification.data.type === 'Booking' && allowed.includes(notification.data.status));
            },

            prepareComponent() {
                $('#sideLoader').show();
                axios.get('/api/notifications')
                    .then(response => {
                        $('#sideLoader').hide();
                        this.notifications = response.data.success;
                    });
            },

            propExist(obj, prop) {
                return obj.hasOwnProperty(prop);
            },

            date_format(date) {
                return moment.utc(date.date).format("D.M.Y");
            },

            approve_action(notification) {
                if (notification.data.id) {
                    axios.get('/api/booking/' + notification.data.id + '/logs')
                        .then(this.approveRequest);
                }
            },

            cancle_action(notification) {
//                TODO: need to do this
                if (notification.data.id) {
                    axios.patch('/api/booking/' + notification.data.id + '/status', this.cancleParams())
                        .then(response => {
                            console.log(response);
                        });
                }
            },

            approveRequest(response) {
                if (response.data.success.booking_log[0] !== undefined) {
                    let data = response.data.success.booking_log[0];
                    let booking_id = response.data.success.booking_log[0].booking_id;
                    let status = response.data.success.booking_log[0].requested_data.status;
                    let log_id = response.data.success.booking_log[0].id;
                    let params = {log_id: log_id, status: ""};
                    console.log(response.data.success);
                    if (status === 5) {
                        params.status = 6;
                        this.sendRequest(response.data.success.id, params);
                    }
                    if (status === 3) {
                        params.status = 4;
                        this.sendRequest(response.data.success.id, params);
                    }
                }
            },

            sendRequest(booking_id, params) {
                axios.patch('/api/booking/' + booking_id + '/status', params)
                    .then((response) => {
                        if (response.error)
                            new Noty({type: 'error', text: response.error}).show();
                        if (response.success)
                            new Noty({type: 'success', text: response.success}).show();
                    });
            },

            markRead(notification) {
                let params = {notify_id: notification.id};
                axios.post('/api/notifications', params)
                    .then(() => {
                        let index = this.notifications.indexOf(notification);
                        this.notifications.splice(index, 1);
                    });
            },

            viewContract(notify) {
                $('#sideLoader').show();
                axios.get('/api/booking/' + notify.data.id)
                    .then((r) => {
                        $('#sideLoader').hide();
                        this.booking = r.data.success;
                    });
            },

            cleanViewContract() {
                this.booking = null;
            }
        },
    }
</script>
