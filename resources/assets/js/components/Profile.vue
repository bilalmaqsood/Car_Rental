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

<div class="booking-request-actions">
    <div class="inlane-btn-wrap inlane-btn-wrap-btn3">
        <ul class="three-btn-inlane">
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg>
                    view driver
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                    </svg>
                    approve
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close_icon"></use></svg>
                    decline
                </a>
            </li>
        </ul>
    </div>
    <div class="btn-inlane-content btn-inlane-content-btn3 noty_successfull">
        <div class="driver-profile-text">
            <h3>Booking terminated</h3>
            <p>TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016 TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016</p> 
            <p><b>Contract start:</b> 20.8.2017 </p> 
            <p><b>Contract end:</b> 26.8.2017</p>
        </div>
    </div>
</div>
<div class="booking-request-actions">
    <div class="inlane-btn-wrap inlane-btn-wrap-btn2">
        <ul class="two-btn-inlane">
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg>
                    view driver
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
                    </svg>
                    approve
                </a>
            </li>
        </ul>
    </div>
    <div class="btn-inlane-content btn-inlane-content-btn2 noty_warning">
        <div class="driver-profile-text">
            <h3>Booking terminated</h3>
            <p>TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016 TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016</p> 
            <p><b>Contract start:</b> 20.8.2017 </p> 
            <p><b>Contract end:</b> 26.8.2017</p>
        </div>
    </div>
</div>
<div class="booking-request-actions">
    <div class="inlane-btn-wrap inlane-btn-wrap-btn1">
        <ul class="one-btn-inlane">
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg>
                    view driver
                </a>
            </li>
        </ul>
    </div>
    <div class="btn-inlane-content btn-inlane-content-btn1 noty_danger">
        <div class="driver-profile-text">
            <h3>Booking terminated</h3>
            <p>TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016 TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016</p> 
            <p><b>Contract start:</b> 20.8.2017 </p> 
            <p><b>Contract end:</b> 26.8.2017</p>
        </div>
    </div>
</div>
<div class="booking-request-actions">
    <div class="btn-inlane-content noty_successfull">
        <div class="driver-profile-text">
            <h3>Booking terminated</h3>
            <p>TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016 TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016</p> 
            <p><b>Contract start:</b> 20.8.2017 </p> 
            <p><b>Contract end:</b> 26.8.2017</p>
        </div>
    </div>
</div>
<div class="booking-request-actions">
    <div class="approved-actions-img">
        <img src="/images/hero-img.jpg" alt="">
    </div>
    <div class="inlane-btn-wrap inlane-btn-wrap-btn2">
        <ul class="two-btn-inlane">
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                    </svg>
                    contract
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                    </svg>
                    chat
                </a>
            </li>
        </ul>
    </div>
    <div class="btn-inlane-content btn-inlane-content-btn2 noty_successfull">
        <div class="driver-profile-text">
            <h3>Booking terminated</h3>
            <p>TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016 TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016</p> 
            <p><b>Contract start:</b> 20.8.2017 </p> 
            <p><b>Contract end:</b> 26.8.2017</p>
        </div>
    </div>
</div>
<div class="booking-request-actions">
    <div class="approved-actions-img">
        <img src="/images/hero-img.jpg" alt="">
    </div>
    <div class="btn-inlane-content noty_successfull">
        <div class="driver-profile-text">
            <h3>Booking terminated</h3>
            <p>TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016 TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016</p> 
            <p><b>Contract start:</b> 20.8.2017 </p> 
            <p><b>Contract end:</b> 26.8.2017</p>
        </div>
    </div>
</div>
<div class="booking-request-actions">
    <div class="inlane-btn-wrap inlane-btn-wrap-btn2">
        <ul class="two-btn-inlane">
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#extendrenew"></use></svg>
                    extend/renew
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use></svg>
                    </svg>
                    chat
                </a>
            </li>
        </ul>
    </div>
    <div class="btn-inlane-content btn-inlane-content-btn2 noty_warning">
        <div class="driver-profile-text">
            <h3>Booking terminated</h3>
            <p>TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016 TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016</p> 
            <p><b>Contract start:</b> 20.8.2017 </p> 
            <p><b>Contract end:</b> 26.8.2017</p>
        </div>
    </div>
</div>
<div class="booking-request-actions booking-request-actions-2">
    <div class="approved-actions-img">
        <img src="/images/hero-img.jpg" alt="">
    </div>
    <div class="btn-inlane-content btn-inlane-content-btn2 noty_successfull">
        <div class="driver-profile-text">
            <h3>Booking terminated</h3>
            <p>TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016 TOYOTA PRIUS ACTIVE VVT-I CVT GLI 2016</p> 
            <p><b>Contract start:</b> 20.8.2017 </p> 
            <p><b>Contract end:</b> 26.8.2017</p>
        </div>
    </div>
    <div class="inlane-btn-wrap inlane-btn-wrap-btn2">
        <ul class="two-btn-inlane">
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search_icon"></use></svg>
                    find similar
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                    </svg>
                    chat
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="pofile_content_wrapper">
    <div class="img_box booking-request-img-box" style="background: url(images/car_img_1.png)">
        <img src="images/car_img_1.png" alt="">
    </div>
    <div class="profile_content">
        <h3>Booking approved</h3>
        <p><span>Mike Myers</span> approved your request to book</p>
        <p>Toyota Prius 1.8 Hybrid</p>
        <p>Contract start: 06.05.2017 </p>
        <p>Contract end: 20.05.2017</p>
        <p>You can now check and sign the contract and set your
        <span>Direct Debit.</span> A deposit of <span>£250.00</span> have been taken from your card ending in <span>1234</span></p>
    </div>
</div>
<div class="booking-request-actions">
    <button type="button" class="add-new-vehile-btn">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use></svg>
        <span>add new vehicle</span>
    </button>
</div>
<div class="requests-counter-wrap">
    <div class="detail_img">
        <img src="images/car_img.png" alt="">
    </div>
    <div class="car_detail">
        <div class="availablity_detail">
            <h3>Toyota Prius 1.8 Hybrid</h3>
            <ul>
                <li>
                    <p><b>Year:</b> 2015 </p>
                    <p><b>Mileage:</b> 35,044</p>
                    <p><b>Seats:</b> 5 </p>
                    <p><b>Transmission:</b> manual</p>
                </li>
                <li>
                    <p><b>Seats:</b> 5 </p>
                    <p><b>Transmission:</b> manual</p>
                </li>
                <li>
                    <p><b>Fuel type:</b> hybrid </p>
                    <p><b>Consumption:</b> 95.2 mpg (ec.)</p>
                </li>
            </ul>
            <div class="availabe">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                </svg>
                <p>available from: <span>16.05.2017</span></p>
            </div>
        </div>
        <div class="availablity_price">
            <label class="quantity-label">10</label>
            <div class="availabe_item_price">
                <h3>£ 320</h3>
                <span>/week</span>
                <span>insurance included</span>
            </div>
        </div>
    </div>
</div>
<div class="requests-counter-wrap">
    <div class="detail_img">
        <img src="images/car_img.png" alt="">
    </div>
    <div class="car_detail">
        <div class="availablity_detail">
            <h3>Toyota Prius 1.8 Hybrid</h3>
            <ul>
                <li>
                    <p><b>Year:</b> 2015 </p>
                    <p><b>Mileage:</b> 35,044</p>
                    <p><b>Seats:</b> 5 </p>
                    <p><b>Transmission:</b> manual</p>
                </li>
                <li>
                    <p><b>Seats:</b> 5 </p>
                    <p><b>Transmission:</b> manual</p>
                </li>
                <li>
                    <p><b>Fuel type:</b> hybrid </p>
                    <p><b>Consumption:</b> 95.2 mpg (ec.)</p>
                </li>
            </ul>
            <div class="availabe">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                </svg>
                <p>available from: <span>16.05.2017</span></p>
            </div>
        </div>
        <div class="availablity_price">
            <label class="quantity-label">15</label>
            <div class="availabe_item_price">
                <h3>£ 320</h3>
                <span>/week</span>
                <span>insurance included</span>
            </div>
        </div>
    </div>
</div>


            <transition-group name="slide-fade" tag="div">
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
            </transition-group>
        </div>

        <transition name="slide-fade" mode="in-out">
            <sign-contract v-if="booking" :booking="booking" @closeContract="cleanViewContract"></sign-contract>
        </transition>

        <transition name="slide-fade" mode="in-out">
            <driver-profile></driver-profile>
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
                booking: null,
                notify: null,
                rating: null,
                note: null,
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
                if (notification.data.id) {
                    $(".side-loader").show();
                    axios.get('/api/booking/' + notification.data.id + '/logs')
                        .then(this.approveRequest);

                    setTimeout(function () {
                        $(".side-loader").hide();
                    },500)
                }
            },

            cancle_action(notification) {
//                TODO: need to do this
                    
                     if (notification.data.id) {
                    $(".side-loader").show();
                    axios.get('/api/booking/' + notification.data.id + '/logs')
                        .then(this.cancelRequest);

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
                    console.log(response.data.success);
                    if (status === 5)
                        params.status = 6;

                    if (status === 3)
                        params.status = 4;

                    if (status === 7)
                        params.status = 8;

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
                    console.log(response);

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
