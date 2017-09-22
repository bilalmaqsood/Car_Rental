<template>
    <div>
        <div class="main_profile_container">
            <div class="profile_top_content">
                <div class="background_img" v-if="!!vuex.state.auth.avatar" :style="{'background-image': 'url(' + vuex.state.auth.avatar + ')'}"  alt=""></div>
                <div v-else style="width:100%;height:250px;text-align:center;">
                    <img src="/images/avatar-default.png" style="width:auto;" alt="">
                </div>
                <div class="update_profile">
                    <h3>{{vuex.state.auth.name}}</h3>
                    <p><span v-if="age">Age: <i>{{age}}</i>&nbsp; |</span> <span class="phone-number" v-if="vuex.state.auth.phone"><i>{{vuex.state.auth.phone}}</i></span></p>
                    <button id="uploadImages" class="secodery_btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
                        </svg>
                    </button>
                    <input type="file" class="hidden hiddenUpload" name="files[]"
                           value="upload">
                </div>
            </div>


            <div v-for="notif in notifications">

            <booking-unsuccessfull :notification="notif" v-if="notif.data.status === CONSTANTS.BOOKING_UNSUCCESSFULL"></booking-unsuccessfull>

            <booking-request-pending :notification="notif" v-if="notif.data.status=== CONSTANTS.BOOKING_PENDING"></booking-request-pending>

            <booking-request :notification="notif" v-if="notif.data.status=== CONSTANTS.BOOKING_REQUESTED && vuex.state.auth.type === 'owner'" ></booking-request>

            <booking-signature-owner :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_SIGN_BY_CLIENT"></booking-signature-owner>

            <booking-signature-client :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_SIGN_BY_OWNER"></booking-signature-client>

            <booking-extend-declined :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_ACTIVE && notif.data.old_status === CONSTANTS.BOOKING_EXTEND_REQUESTED"></booking-extend-declined>

            <booking-approved :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_ACTIVE"></booking-approved>

            <booking-cancel-request :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_EARLY_TERMINATION_REQUESTED"></booking-cancel-request>

            <booking-cancel-approved :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_EARLY_TERMINATION_APPROVED && notif.data.old_status === CONSTANTS.BOOKING_EARLY_TERMINATION_REQUESTED"></booking-cancel-approved>

            <booking-decline :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_EARLY_TERMINATION_APPROVED"></booking-decline>

            <booking-extend :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_EXTEND_REQUESTED"></booking-extend>

            <booking-extended :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_EXTEND_APPROVED"></booking-extended>

            <booking-closed :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_CLOSED && notif.data.old_status === CONSTANTS.BOOKING_ACTIVE"></booking-closed>

            <booking-deposit-return :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_DEPOSIT_RETURNED && notif.data.old_status ===CONSTANTS.BOOKING_CLOSED "></booking-deposit-return>

            <booking-rating :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_DEPOSIT_RETURNED && notif.data.old_status ===CONSTANTS.BOOKING_DEPOSIT_RETURNED "></booking-rating>

            <booking-deposit :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_DEPOSIT_MADE"></booking-deposit>

            <booking-payment-made :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_PAYMENT_MADE"></booking-payment-made>
            </div>





            <!-- <transition-group name="slide-fade" tag="div">
                <div v-for="notif in notifications" :class="NotyClass(notif)" v-bind:key="notif.id" class="pofile_content_wrapper">
                    <div v-if="propExist(notif.data,'image')" class="img_box" v-bind:style="{ 'background-image': 'url(' + notif.data.image + ')' }">
                        <img :src="notif.data.image" alt="">
                    </div>

                    <div class="profile_content">
                        <h3 :class="{clickable: notif.data.vehicle}" v-if="notif.data.title" >{{notif.data.title}}</h3>
                        <div v-if="notif.data.status===12">
                            <p>You booking is successfully closed</p>
                            <div class="ratting"></div>
                            <input type="text" v-model="note">
                            <button class="primary-button" @click="processRating(notif)">
                                Rate now
                            </button>
                        </div>
                        <p v-if="[1].includes(notif.data.status)"><span>{{notif.data.user}}</span> sent you booking request</p>
                        <p v-if="propExist(notif.data,'vehicle')">{{notif.data.vehicle}}</p>
                        <p v-if="propExist(notif.data,'contract_start')"><b>Contract start:</b> {{ date_format(notif.data.contract_start) }} </p>
                        <p v-if="propExist(notif.data,'contract_end')"><b>Contract end:</b> {{ date_format(notif.data.contract_end) }}</p>
                        <p v-if="[1].includes(notif.data.status)" class="m-t-1">You can now check and sign the contract and set your <span>Direct Debit.</span> A deposit of <span>{{ notif.data.deposit | currency }}</span> have been taken from your default card.</p>

                        <div class="btn-group" v-if="showActionButtons(notif)">
                          <button type="button" class="btn btn-success" @click="approve_action(notif)">Approve</button>
                          <button type="button" class="btn btn-danger" @click="cancle_action(notif)">Decline</button>
                        </div>

                        <p class="m-t-1">
                            <a href="javascript:" class="primary-button" v-if="isActionable(notif)" @click="viewContract(notif)">view contract</a>
                            <a href="javascript:" class="primary-button" @click="markRead(notif)">mark read</a>
                        </p>
                    </div>
                </div>
            </transition-group> -->
        </div>

        <transition name="slide-fade" mode="in-out">
            <sign-contract v-if="booking" :booking="booking" @closeContract="cleanViewContract"></sign-contract>
        </transition>

        <transition name="slide-fade" mode="in-out">
            <driver-profile v-if="driver_info" :booking_id="driver_info"></driver-profile>
        </transition>

    </div>
</template>

<script>
    import User from '../user';
    import CONSTANTS from '../constants';

    export default {
        data() {
            return {
                CONSTANTS,
                in_action: null,
                notifications: '',
                booking_log: '',
                driver_info: false,
                vuex: User,
                booking: null,
                notify: null,
                rating: null,
                note: null,
            };
        },
        created: function(){
            this.$on("viewPofile",(noti)=>{
                if(this.driver_info==noti.booking_id)
                    this.driver_info = false;
                else
                this.driver_info = noti.booking_id;

            });

            this.$on("approve",(noti)=>{
                this.approve_action(noti);
            });

            this.$on("decline",(noti)=>{
                this.cancle_action(noti);
            });

            this.$on("contract",(noti)=>{
                this.viewContract(noti);
            });
            this.$on("chat",(noti)=>{
                this.viewContract(noti);
            });
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
            showActionButtons(noti){
                let allowed = [5, 7];
                return allowed.includes(noti.data.status) &&  User.state.auth.type=='owner';
            },
            isActionable(notification) {
                let allowed = [1, 2, 3];

                return (notification.data.old_status && notification.data.type === 'Booking' && allowed.includes(notification.data.status));
            },

            prepareComponent() {
            let $scope = this;

            $("#uploadImages").click(function () {

                $(".hiddenUpload").click();
                $(".hiddenUpload").change(function () {

                        let val = this.files[0];
                        console.log(val);
                        var reader = new FileReader();
                        reader.readAsDataURL(val);
                        var fd = new window.FormData();
                        fd.append('upload', val);
                        reader.onload = function (e) {
                            $('#sideLoader').show();
                            axios.post('/api/upload/image', fd).then($scope.processAvatar);
                            setTimeout(function () {
                    $('#sideLoader').hide();

                }, 1000);
                        };
                });


            });


                $('#sideLoader').show();
                axios.get('/api/notifications')
                    .then(response => {
                        $('#sideLoader').hide();
                        this.notifications = response.data.success;
                        setTimeout(function() {


                $('.ratting').starrr({
                  change: function(e, value){
                    $scope.rating = value;
                        }
                });

                }, 1500);
                    });




            },



            propExist(obj, prop) {
                return obj.hasOwnProperty(prop);
            },

            date_format(date) {
                return moment.utc(date.date).format("D.M.Y");
            },

            approve_action(notification) {
                this.in_action = notification;
                if (notification.data.id) {
                    $(".side-loader").show();
                    axios.get('/api/booking/' + notification.data.id + '/logs')
                        .then(this.approveRequest)
                        .then(()=>{
                            if([0].includes(notification.data.status))
                            setTimeout(()=>{
                             this.markRead(notification); 
                         }, 2000);
                            
                        });

                    setTimeout(function () {
                        $(".side-loader").hide();
                    },500)
                }
            },

            cancle_action(notification) {
                    this.in_action = notification;
                     if (notification.data.id) {
                    $(".side-loader").show();
                    axios.get('/api/booking/' + notification.data.id + '/logs')
                        .then(this.cancelRequest)
                        .then(()=>{
                            if([0].includes(notification.data.status))
                           setTimeout(()=>{ this.markRead(notification); }, 2000);

                        });

                    setTimeout(function () {
                        $(".side-loader").hide();
                    },500)
                }

                // if (notification.data.id) {
                //     axios.patch('/api/booking/' + notification.data.id + '/status', this.cancleParams())
                //         .then(response => {
                //             console.log(response);
                //         });
                // }
            },

            approveRequest(response) {
                if (response.data.success.booking_log[0] !== undefined) {
                    
                    let data = response.data.success.booking_log[0];
                    let booking_id = response.data.success.booking_log[0].booking_id;
                    let status = response.data.success.booking_log[0].requested_data.status;
                    let log_id = response.data.success.booking_log[0].id;
                    let params = {log_id: response.data.success.booking_log[0].id, status: ""};
                    
                    if (status === CONSTANTS.BOOKING_ACCEPTED)
                        params.status = CONSTANTS.BOOKING_ACCEPTED;

                    if (status === CONSTANTS.BOOKING_EARLY_TERMINATION_REQUESTED)
                        params.status = CONSTANTS.BOOKING_EARLY_TERMINATION_APPROVED;

                    if (status === CONSTANTS.BOOKING_SIGN_BY_OWNER)
                        params.status = CONSTANTS.BOOKING_ACTIVE;

                    if (status === CONSTANTS.BOOKING_EXTEND_REQUESTED)
                        params.status = CONSTANTS.BOOKING_EXTEND_APPROVED;

                    if(params.status)
                        this.sendRequest(response.data.success.id, params);

                }
            },

            cancelRequest(response) {
                if (response.data.success.booking_log[0] !== undefined) {
                    let params = {log_id: response.data.success.booking_log[0].id, status: 4};
                    console.log(response.data.success);
                        this.sendRequest(response.data.success.id, params);

                }
            },

            sendRequest(booking_id, params) {
                axios.patch('/api/booking/' + booking_id + '/status', params)
                    .then((response) => {
                    
                        if([1].includes(params.status)){
                           $('#sideLoader').show();
                                setTimeout(()=>{ 
                                 this.viewContract(this.in_action);
                                 $('#sideLoader').hide();
                             }, 5000);
                        } 

                        if (response.status==200)
                            new Noty({type: 'success', text: response.data.success}).show();
                        if (response.status!==200)
                            new Noty({type: 'error', text: response.data.error}).show();
                    });
            },

            markRead(notification) {

                $('#sideLoader').show();
                if (typeof notification === 'undefined' && this.notify)
                    notification = this.notify;

                let params = {notify_id: [notification.id]};
                axios.post('/api/notifications', params)
                    .then(() => {
                        $('#sideLoader').hide();
                        let index = this.notifications.indexOf(notification);
                        this.notifications.splice(index, 1);
                        notification = null;
                    });
            },

            viewContract(notify) {
                $('#sideLoader').show();
                this.notify = notify;
                this.booking=null;
                axios.get('/api/booking/' + notify.data.id)
                    .then((r) => {
                        $('#sideLoader').hide();
                        this.booking = r.data.success;
                        setTimeout(function() {
                           $(".menu-component-container").animate({scrollTop: 0});
                        }, 500);
                    });
            },

            cleanViewContract() {
                this.booking = null;
            },
            processAvatar(r){
                let param = {avatar: r.data.success};
                if(User.state.auth.type === "owner")
                    axios.patch('/api/profile/owner', param)
                        .then((r) => {
                            console.log(r);
                            User.state.auth.avatar = param.avatar;
                            User.commit('update', User.state.auth);
                        });
                else if(User.state.auth.type === "client")
                    axios.patch('/api/profile/client', param)
                        .then((r) => {
                            console.log(r);
                            User.state.auth.avatar = param.avatar;
                            User.commit('update', User.state.auth);
                        });
            },
            processRating(notification){
                let $this = this;
                let param ={rating: $this.rating, note: $this.note};
                $('#sideLoader').show();
                 axios.post('/api/booking/'+notification.data.booking_id+'/feedback', param)
                        .then((r) => {
                            $this.note=null;

                            setTimeout(function() {
                                $('#sideLoader').hide();
                                new Noty({
                                    type: 'success',
                                    text: 'Rating saved successfully.',

                                }).show();
                                 $this.markRead(notification);
                             }, 1000);
                        });
            },
             NotyClass(notif){
                if([5,9].includes(notif.data.status))
                    return "noty_warning";
                else if([6,10,7].includes(notif.data.status))
                    return "noty_danger";
                else if([12,0].includes(notif.data.status))
                    return "noty_info";

            }
        },
    }
</script>
