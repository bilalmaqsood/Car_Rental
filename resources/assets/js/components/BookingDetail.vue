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
                        <div class="badge badge-primary">{{booking.status | bookingStatus}}</div>
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
                            <h3>{{booking.vehicle.rent | currency}}</h3>
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
                            <li><span>Week no.</span><span>Cost</span><span>Due date</span><span>Status</span></li>
                            <li v-for="p in payments"><span>{{p.title}}</span><span>{{p.cost | currency}}</span><span>{{p.due_date | date('format', 'DD.MM.YYYY')}}</span><span v-if="p.paid"><b class="label label-success">Paid</b></span><span v-else><b class="label label-danger">Pending</b></span></li>
                        </ul>
                    </div>
                </transition>

                <div class="booking_tab">
                    <ul class="nav nav-tabs">
                        <li v-if="User.state.auth.type == 'owner' && booking.status >= 6 ">
                            <a @click="loadSideView('return_inspection')" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                                </svg>
                                return inspection
                            </a>
                        </li>
                        <li v-else>
                            <a @click="loadSideView('inspection')" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                                </svg>
                                car inspection
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
                            <li v-else-if="[3].includes(booking.status)">
                                <a @click="approveBooking" href="javascript:">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                    </svg>
                                    accept booking
                                </a>
                            </li>
                            <li v-else-if="[5,7].includes(booking.status)">
                                <a @click="approveBooking" href="javascript:">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                    </svg>
                                    Approve {{booking.status | bookingStatus}}
                                </a>
                            </li>
                            <li v-else-if="[4,6,8].includes(booking.status)">
                                <a @click="approveBooking" href="javascript:">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                    </svg>
                                    close booking
                                </a>
                            </li>
                        </transition>
                        <li>
                            <a @click="loadSideView('documents')" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use>
                                </svg>
                                documents
                            </a>
                        </li>
                        <li v-if="User.state.auth.type == 'owner' && booking.status < 4 ">
                            <a @click="cancleBooking" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                                </svg>
                                cancel Request
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

    export default {
        props: ['booking', 'user', 'index','signature'],

        data() {
            return {
                User: User,
                isSignDone: this.signature,
                payments: []
            };
        },
        watch: {
            signature: function(signature) {
                console.log("signature are now "+ signature);
                this.isSignDone = signature;
            }
        },
        computed: {
            
            canSign() {
                if(this.booking.status >= 4)
                    return false; 

                if(!this.booking.signatures)
                    return true;
                else if(this.User.state.auth.type==='owner' && (typeof this.booking.signatures.owner === 'undefined'))
                    return  true;
                else if(this.User.state.auth.type==='client' && (typeof this.booking.signatures.client === 'undefined'))
                    return  true;
                else
                return false;
            },

            vehicleName() {
                return [this.booking.vehicle.make, this.booking.vehicle.model, this.booking.vehicle.variant].join(' ');
            },

            imagePath() {
                return this.booking.vehicle.images.length ? this.booking.vehicle.images[0] : '';
            }
        },

        mounted() {
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
                this.$emit('sideView', {
                    id: this.booking.id,
                    index: this.index,
                    past: false,
                    view: view
                });
            },

            approveBooking() {
                var params = {};

                if ([2,3].includes(this.booking.status)) {
                    
                      axios.get('api/booking/'+this.booking.id+'/inspection').then(r=>{
                        if(!r.data.success.length){
                            new Noty({
                                type: 'warning',
                                text: 'Add inspection before accepting booking!'
                            }).show();
                            this.loadSideView("inspection");
                            return false;
                         } else{
                          params.status = 4;
                          params.note = 'booking approved after signatures.';
                          this.updateStatus(params);
                      }
                    });  
                    
                } else if (this.booking.status===5) {
                    params.status = 6;
                    params.note = 'booking canceled from cancel request by client.';
                } else if (this.booking.status===7) {
                    params.status = 8;
                    params.note = 'booking extended from extend request by client.';
                } else if ([4,6,8].includes(this.booking.status)) {
                    params.status = 9;
                    params.note = 'booking closed by owner';
                }


                if(params.length)
                this.updateStatus(params);
                
            },
            cancleBooking() {
                let params = {};

               params.status = 6;
               params.note = 'booking request canceled .';

                $('#sideLoader').show();
                axios.patch('/api/booking/' + this.booking.id + '/status', params)
                    .then((r) => {
                        $('#sideLoader').hide();
                        this.booking.status = params.status;
                        this.isSignDone = false;
                        new Noty({
                            type: 'information',
                            text: r.data.success
                        }).show();
                    });
            },
            updateStatus(params){
                $('#sideLoader').show();
                axios.patch('/api/booking/' + this.booking.id + '/status', params)
                    .then((r) => {
                        $('#sideLoader').hide();
                        this.booking.status = params.status;
                        new Noty({
                            type: 'information',
                            text: r.data.success
                        }).show();
                    });
            }
        }
    }
</script>
