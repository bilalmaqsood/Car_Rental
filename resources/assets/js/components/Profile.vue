<template>
    <div>
        <div class="main_profile_container" v-bind:style="{'min-height': viewHeight+'px'}">
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

            <transition name="slide-fade" mode="in-out">
            <inspection-code :notification="notif" v-if="notif.data.status===CONSTANTS.INSPECTION_CODE_GENERATED"></inspection-code>

<!--             <booking-request :notification="notif" v-if="notif.data.status===1 && vuex.state.auth.type === 'owner'" ></booking-request>
 -->
            <booking-accepted :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_ACCEPTED && notif.data.old_status === CONSTANTS.BOOKING_REQUESTED && vuex.state.auth.type === 'client'" ></booking-accepted>    

            <booking-unsuccessfull :notification="notif" v-if="notif.data.status === CONSTANTS.BOOKING_UNSUCCESSFULL"></booking-unsuccessfull>

            <booking-request-pending-driver :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_PENDING && vuex.state.auth.type === 'client'"></booking-request-pending-driver>

            <booking-request-pending :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_PENDING"></booking-request-pending>

            <booking-request :notification="notif" v-if="notif.data.status=== CONSTANTS.BOOKING_REQUESTED && notif.data.old_status === CONSTANTS.BOOKING_REQUESTED && vuex.state.auth.type === 'owner'" ></booking-request>

            <booking-signature-owner :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_SIGN_BY_CLIENT"></booking-signature-owner>

            <booking-signature-client :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_SIGN_BY_OWNER"></booking-signature-client>

            <booking-extend-declined :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_ACTIVE && notif.data.old_status === CONSTANTS.BOOKING_EXTEND_REQUESTED"></booking-extend-declined>

              <booking-cancel-decline :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_ACTIVE && notif.data.old_status=== CONSTANTS.BOOKING_EARLY_TERMINATION_REQUESTED"></booking-cancel-decline>

            <booking-approved :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_ACTIVE"></booking-approved>

            <booking-cancel-request :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_EARLY_TERMINATION_REQUESTED"></booking-cancel-request>

            <booking-cancel-approved :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_EARLY_TERMINATION_APPROVED && notif.data.old_status === CONSTANTS.BOOKING_EARLY_TERMINATION_REQUESTED"></booking-cancel-approved>

            <booking-decline :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_EARLY_TERMINATION_APPROVED"></booking-decline>

            <booking-extend :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_EXTEND_REQUESTED"></booking-extend>

            <booking-ending :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_ENDING"></booking-ending>

            <booking-extended :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_EXTEND_APPROVED"></booking-extended>

            <booking-closed :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_CLOSED && notif.data.old_status === CONSTANTS.BOOKING_ACTIVE"></booking-closed>

            <booking-deposit-return :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_DEPOSIT_RETURNED && notif.data.old_status ===CONSTANTS.BOOKING_CLOSED "></booking-deposit-return>

            <booking-rating :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_DEPOSIT_RETURNED && notif.data.old_status ===CONSTANTS.BOOKING_DEPOSIT_RETURNED "></booking-rating>

            <booking-deposit :notification="notif" v-else-if="notif.data.status===CONSTANTS.BOOKING_DEPOSIT_MADE"></booking-deposit>

            <booking-payment-made :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_PAYMENT_MADE"></booking-payment-made>

                <booking-disputed :notification="notif" v-else-if="notif.data.status=== CONSTANTS.VEHICLE_DISPUTED"></booking-disputed>

            <inspection-amending :notification="notif" v-else-if="notif.data.status=== CONSTANTS.BOOKING_AMENDED && notif.data.old_status ===CONSTANTS.BOOKING_AMENDED "></inspection-amending>

            <inspection-complete :notification="notif" v-else-if="notif.data.status=== CONSTANTS.INSPECTION_COMPLETED"></inspection-complete>

            <inspection-open :notification="notif" v-else-if="notif.data.status=== CONSTANTS.INSPECTION_OPEN"></inspection-open>
            
            <inspection-confirmed :notification="notif" v-else-if="notif.data.status=== CONSTANTS.INSPECTION_CONFIRMED"></inspection-confirmed>
            
            <inspection-resolved :notification="notif" v-else-if="notif.data.status=== CONSTANTS.DISPUTED_RESOLVED"></inspection-resolved>
            </transition>

            </div>






            
        </div>

        <transition name="slide-fade" mode="in-out">
             <extend-cancel-booking v-if="menuView=='extend'" key="booking-extend" :user="vuex" class="send-requst-oct28" ></extend-cancel-booking>
        </transition>

        <transition name="slide-fade" mode="in-out">
            <sign-contract class="contract-on-profile" v-if="menuView=='contract'" :booking="booking" @closeContract="cleanViewContract"></sign-contract>
        </transition>

        <transition name="slide-fade" mode="in-out">
            <chat-window v-if="menuView=='chat'" ref="chatWindowRef" :chat="chatView" :index="indexView" :utility="true" @closeChat="resetChat"></chat-window>
        </transition>

        <transition name="slide-fade" mode="in-out">
            <driver-profile v-if="driver_info" :booking_id="driver_info"></driver-profile>
        </transition>

        <transition name="slide-fade" mode="in-out">
            <car-inspection class="left-window" v-if="menuView=='inspection'" key="car-inspection" :booking="booking"></car-inspection>
        </transition>



    </div>
</template>

<script>
    import User from '../user';
    import CONSTANTS from '../constants';

    export default {
        props: ["viewHeight"],
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
                chatView: null,
                indexView: null,
                menuView: "",
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
            this.$on("changeView",(view)=>{
                this.menuView=view;
            });
            this.$on("inspection",(noti)=>{
                if(this.menuView == "inspection"){
                    this.menuView = ""; return false;
                }
                this.showInspection(noti);
            });

            this.$on("contract",(noti)=>{
                if(this.menuView == "contract"){
                    this.menuView = ""; return false;
                }
                this.viewContract(noti);
            });

            this.$on("chat",(noti)=>{
                if(this.menuView == "chat"){
                    this.menuView = ""; return false;
                }
                if(User.state.auth.type=='client')
                axios.get('/api/vehicle/'+noti.data.vehicle_id).then(r=>{
                    User.commit('addChatUser', {user: r.data.success.owner.user, messages: []});
                    this.openChat(r.data.success.owner.user);
                });
                else
                    axios.get('/api/booking/'+noti.data.id).then(r=>{
                        User.commit('addChatUser', {user: r.data.success.user, messages: []});
                        this.openChat(r.data.success.user);
                    });
            });
            this.$on("markread",(noti)=>{
                this.markRead(noti);
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
                        
                        this.notifications = response.data.success;
                        
                        setTimeout(function() {$('#sideLoader').hide();}, 500);
                    });




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
                            if([0,5,7].includes(notification.data.status))
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
                            if([0,5,7].includes(notification.data.status))
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
                        this.menuView = "contract";
                        setTimeout(function() {
                           $(".menu-component-container").animate({scrollTop: 0});
                        }, 500);
                    });
            },

            cleanViewContract() {
                this.menuView = null;
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
             NotyClass(notif){
                if([5,9].includes(notif.data.status))
                    return "noty_warning";
                else if([6,10,7].includes(notif.data.status))
                    return "noty_danger";
                else if([12,0].includes(notif.data.status))
                    return "noty_info";

            }
            ,
            resetChat() {
                this.indexView = null;
                setTimeout(() => {
                    this.chatView = null;
                }, 300);
            },



            openChat(user){
                
                window.qwikkarChat.addUserChat({
                    id: user.id,
                    name: user.name
                });
               
            },
            showInspection(notification){
                $('#sideLoader').show();
                this.booking=null;
                axios.get('/api/booking/' + notification.data.id)
                    .then((r) => {
                        $('#sideLoader').hide();
                        this.booking = r.data.success;
                        this.menuView = "inspection";
                        setTimeout(function() {
                            $(".menu-component-container").animate({scrollTop: 0});
                        }, 500);
                    });
            }
        },
    }
</script>
