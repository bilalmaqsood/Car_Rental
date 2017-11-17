<template>
    <div>

        <div class="search_car">

            <div class="search_car_content">
                <h3><a href="javascript:" @click="changeView">{{vehicleName}}</a></h3>
                <ul>
                    <li>
                        <p><b>Year:</b> {{booking.vehicle.year}}</p>
                        <p><b>Mileage:</b> {{booking.vehicle.mileage}}</p>
                    </li>
                    <li>
                        <p><b>Seats:</b> {{booking.vehicle.seats}}</p>
                        <p><b>Transmission:</b> {{booking.vehicle.transmission}}</p>
                    </li>
                    <li>
                        <p><b>Fuel type:</b> {{booking.vehicle.fuel}}</p>
                        <p><b>Consumption:</b> {{booking.vehicle.mpg}} mpg (ec.)</p>
                    </li>
                    <li>
                        <div class="badge badge-primary" data-toggle="tooltip" :title="tooltip">{{booking.status | bookingStatus}}</div>
                    </li>
                </ul>
                <div class="search-btn-container">
                    <div class="availablity_box">
                        <div class="availabe">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                            </svg>
                            <p>Start date: <span>{{booking.start_date | date('format', 'DD.MM.YYYY')}}</span></p>
                        </div>

                        <div class="availabe_item_price">
                            <h3>{{booking.vehicle.rent + booking.vehicle.insurance | currency}}</h3>
                            <span>/ week</span>
                        </div>
                    </div>
                </div>
            </div>

            <div @click="changeView" class="search_car_img cursor-pointer" :style="{'background-image': 'url(' + imagePath + ')'}">
                <img :src="imagePath" alt="">
            </div>

        </div>

        <transition name="flip">
            <div v-if="user.state.currentBook == booking.id">

                <transition name="flip">
                    <div class="rent_tabel" v-if="payments.length">
                        <h3>Rent book</h3>
                        <ul>
                            <li><span>Week no.</span><span>Cost</span><span>Discount</span><span>Due date</span><span>Status</span></li>
                            <li v-for="p in payments"><span>{{p.title}}</span><span>{{p.cost | currency}}</span><span>{{p.discount | currency}}</span><span>{{p.due_date | date('format', 'DD.MM.YYYY')}}</span>
                            <span v-if="p.paid"><b class="label label-success">Paid</b></span>
                            <span v-else-if="!p.overdue && User.state.auth.type=='owner'"><b class="label label-warning">Pending</b></span>
                            <span  v-else-if="User.state.auth.type=='client'" class="clickable" @click="payOverDue" @mouseleave="hover=''" @mouseover="hover='overdue'">
                            <b class="label" :class="{'label-warning': hover!='overdue','label-success': hover=='overdue'}">
                            {{ hover=='overdue'?'Pay Now': status(p) }}
                            </b>
                            </span>
                            <span  v-else-if="p.overdue && User.state.auth.type=='owner' && booking.status<6" class="clickable" @click="closeContract" @mouseleave="hover=''" @mouseover="hover='overdue'"><b class="label" :class="{'label-warning': hover!='overdue','label-success': hover=='overdue'}">{{ hover=='overdue'?'Close contract':'Overdue' }}</b></span>
                            <span v-else-if="booking.status==6"> <b class="label label-danger">Terminated</b></span>
                            </li>
                        </ul>
                    </div>
                </transition>

                <div class="booking_tab">
                    <ul class="nav nav-tabs">
                        <li v-if="booking.status >= 6 ">
                            <a @click="loadSideView('return_inspection')" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                                </svg>
                                Return inspection
                            </a>
                        </li>
                        
                         <li v-else-if="booking.handover_inspection || booking.status ==4"> <!-- 24 hours before booking start -->
                            <a @click="loadSideView('inspection')" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                                </svg>
                                Handover inspection
                            </a>
                        </li>
                        <li v-if="booking.status<CONSTANTS.BOOKING_ACTIVE && !booking.handover_inspection">
                            <a @click="loadSideView('last_inspection')" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                                </svg>
                                last inspection
                            </a>
                        </li>
                        <transition name="flip" v-if="User.state.auth.type=='client'">
                            <li v-if="canSign && isSignDone">
                                <a @click="loadSideView('sign')" href="javascript:">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                    </svg>
                                    sign contract
                                </a>
                            </li>
                            <li v-else-if="[4,5,7,8].includes(booking.status)">
                                <a @click="loadSideView('extend')" href="javascript:">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                    </svg>
                                    extend/cancel
                                </a>
                            </li>
                        </transition>
                        <transition name="flip" v-else-if="User.state.auth.type=='owner'">
                            <li v-if="canSign && isSignDone">
                                <a @click="loadSideView('sign')" href="javascript:">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                    </svg>
                                    sign contract
                                </a>
                            </li>
                            <li v-if="!canSign && [2].includes(booking.status)">
                                <a @click="loadSideView('sign')" href="javascript:">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                    </svg>
                                    edit contract
                                </a>
                            </li>
                            <li v-else-if="[0,5,7].includes(booking.status)">
                                <a @click="approveBooking" href="javascript:">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                    </svg>
                                    Approve {{booking.status | bookingStatus}}
                                </a>
                            </li>
                            <li v-else-if="[4,5,7].includes(booking.status)">
                                <a @click="cancleBooking" href="javascript:">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                    </svg>
                                    close booking
                                </a>
                            </li>
                        </transition>
                        <li v-if="booking.status >= 1 && booking.status<=4">
                            <a @click="loadSideView('documents')" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use>
                                </svg>
                                documents
                            </a>
                        </li>
                        <li v-if="User.state.auth.type == 'owner' && booking.status < 1 ">
                            <a @click="cancle_action(booking.id)" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                                </svg>
                                Cancel Request
                            </a>
                        </li>
                        <li>
                            <a @click="loadSideView('chat')" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                                </svg>
                                chat
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </transition>

    </div>
</template>

<script>

    import User from '../user';
    import CONSTANTS from '../constants';


    export default {
        props: ['Booking', 'user', 'index','signature'],

        data() {
            return {
                CONSTANTS,
                User: User,
                booking: this.Booking,
                isSignDone: this.signature,
                payments: [],
                hover: '',
            };
        },
        watch: {
            signature: function(signature) {
                this.isSignDone = signature;
                  axios.get('/api/booking/' + this.Booking.id).then(r => {
                        this.booking.status = r.data.success.status;
                        this.booking.signatures = r.data.success.signatures;
                    });

            }
        },
        computed: {
            
            tooltip(){
               if(this.booking.status==0) return "Booking requested"; 
               if(this.booking.status==1) return "Booking approved"; 
               if(this.booking.status==2) return "Contract signatures pending of owner"; 
               if(this.booking.status==3 && (typeof this.booking.signatures.client === 'undefined')) return "Contract signatures pending of driver"; 
               else if(this.booking.status==3 && this.booking.signatures.client)
                    return "Waiting for owner approvel.";
                else if(this.booking.status==4)
                    return "Booking in progress";
                else if(this.booking.status==5)
                    return "Early cancelation requested by driver";
                else if(this.booking.status==6)
                    return "Booking terminated.";
                else if(this.booking.status==7)
                    return "Booking extention requested by driver.";
                else if(this.booking.status==8)
                    return "Booking extention request approved.";
                else if(this.booking.status==10)
                    return "Booking is disputed, deposit return is not possible unless admin resolve.";

            },
            canSign() {
                if(this.booking.status >= 4 || this.booking.status < 1)
                    return false; 

                if(!this.booking.signatures && this.User.state.auth.type==='owner')
                    return true;
                else if(!this.booking.signatures && this.User.state.auth.type==='client')
                    return  false;
                else if(this.User.state.auth.type==='client' && (typeof this.booking.signatures.client === 'undefined'))
                    return  true;
                else
                return false;
            },

               canApprove() {

                if(!this.booking.signatures)
                    return false;
                else if(typeof this.booking.signatures.owner === 'undefined' || typeof this.booking.signatures.client === 'undefined')
                    return  false;
                else
                return true;
            },

            vehicleName() {
                return [this.booking.vehicle.make, this.booking.vehicle.model, this.booking.vehicle.variant].join(' ');
            },

            imagePath() {
                return this.booking.vehicle.images.length ? this.booking.vehicle.images[0] : '';
            }
        },

        mounted() {
            setTimeout(function() { $('[data-toggle="tooltip"]').tooltip(); }, 100);
            setTimeout(() => {
                if (this.user.state.currentBook === this.booking.id)
                    this.prepareComponent();
            }, 550);
        },

        methods: {
            prepareComponent() {
                $('#sideLoader').show();
                this.payments = [];
                axios.get('/api/booking/' + this.booking.id + '/payment-weekly').then(r => {
                    $('#sideLoader').hide();
                    this.payments = r.data.success;
                });
            },

            changeView() {
                this.$emit('otherBooking', {
                    id: this.booking.id,
                    index: this.index
                });
            },

            loadSideView(view) {
             $(".menu-component-container").animate({scrollTop: 0});

                this.$emit('sideView', {
                    id: this.booking.id,
                    index: this.index,
                    past: false,
                    view: view
                });
            },

            approveBooking() {
                var params = {};

                if (this.booking.status==0) {
                      params.status = 1;
                          params.note = 'Booking request is accepted.';
                          this.updateStatus(params); 
                    
                } else if (this.booking.status===5) {
                    this.approve_action(this.booking.id);
                } else if (this.booking.status===7) {
                    this.approve_action(this.booking.id);
                } else if ([4,6,8].includes(this.booking.status)) {
                    params.status = 9;
                    params.note = 'booking closed by owner';
                    this.updateStatus(params);
                }
                
            },
            cancleBooking() {
                let params = {};

               params.status = 9;
               params.note = 'Owner close contract of overdue payment.';

                $('#sideLoader').show();
                axios.patch('/api/booking/' + this.booking.id + '/status', params)
                    .then((r) => {
                        $('#sideLoader').hide();
                        this.booking.status = params.status;
                        this.$emit('bookingUpdated',this.booking);
                        this.isSignDone = false;
                        new Noty({
                            type: 'success',
                            text: r.data.success
                        }).show();
                    });
            },
            status(p){
                return p.overdue==true?'Overdue':'Pending';
            },
            updateStatus(params){
                
                $('#sideLoader').show();
                axios.patch('/api/booking/' + this.booking.id + '/status', params)
                    .then((r) => {
                        $('#sideLoader').hide();
                        this.booking.status = params.status;
                        new Noty({
                            type: 'success',
                            text: r.data.success
                        }).show();
                    });
            },
            approve_action(booking_id) {
                if (booking_id) {
                    $(".side-loader").show();
                    axios.get('/api/booking/' + booking_id + '/logs')
                        .then(this.approveRequest);
                    setTimeout(function () {
                        $(".side-loader").hide();
                    },500)
                }
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
              cancle_action(booking_id) {
                     if (booking_id) {
                    $(".side-loader").show();
                    axios.get('/api/booking/' + booking_id + '/logs')
                        .then(this.cancelRequest);

                    setTimeout(function () {
                        $(".side-loader").hide();
                    },500)
                }
            },
            sendRequest(booking_id, params) {
                axios.patch('/api/booking/' + booking_id + '/status', params)
                    .then((response) => {
                        if (response.status==200)
                            new Noty({type: 'success', text: response.data.success}).show();
                        if (response.status!==200)
                            new Noty({type: 'error', text: response.data.error}).show();
                    });
            },
            cancelRequest(response) {
                if (response.data.success.booking_log[0] !== undefined) {
                    let params = {log_id: response.data.success.booking_log[0].id, status: 4};
                    console.log(response.data.success);
                        this.sendRequest(response.data.success.id, params);

                }
            },
            payOverDue(){
                let $this = this;
               let booking_id = this.booking.id;
                        if(!User.state.auth.credit_cards.length){
                            User.commit('oldView', 'booking');
                            User.commit('menuView', 'payment');

                            new Noty({
                                    type: 'warning',
                                    text: 'Add credit card to process payment!'
                                }).show();
                            localStorage.setItem('overdue_item', JSON.stringify(this.booking));
                            return false;
                            // data.view='';
                            // $this.sideView = '';
                        } else{

            var n = new Noty({
                  text: '<b>Continue with the payment deposit?</b>',
                  timeout: false,
                  buttons: [
                    Noty.button('YES', 'btn btn-success', function () {
                      n.close();
                      $('#sideLoader').show();
                axios.post('/api/booking/' + booking_id+'/pay-overdue').then(r=>{
                    $this.prepareComponent();
                setTimeout(function() { 
                    $('#sideLoader').hide();
                         new Noty({
                                type: 'success',
                                text: r.data.success
                            }).show();
                }, 500);


                }).catch(r=>{
                    setTimeout(function() { 
                    $('#sideLoader').hide();
                        new Noty({
                                    type: 'danger',
                                    text: r.response.data.error
                                }).show();
                    }, 500);
                }); 
                    
                    }, {id: 'button1', 'data-status': 'ok'}),

                    Noty.button('NO', 'btn btn-error', function () {
                            n.close();
                        })
                     ]
                }).show();
                         
                     }
                    
            },

        closeContract(){
            let $this = this;
            var n = new Noty({
                  text: '<b>Continue with the contract close?</b>',
                  timeout: false,
                  buttons: [
                    Noty.button('YES', 'btn btn-success', function () {
                      n.close();
                      $('#sideLoader').show();
                            $this.cancleBooking(); 
                            $this.prepareComponent(); 
                    
                    }, {id: 'button1', 'data-status': 'ok'}),

                    Noty.button('NO', 'btn btn-error', function () {
                            n.close();
                        })
                     ]
                }).show();
                         

        }

        }
    }
</script>
