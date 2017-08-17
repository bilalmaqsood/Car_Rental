<template>
    <div class="main_booking_container">
        <div class="booking_container">
            <div>
                <transition name="flip" mode="out-in">
                    <div v-if="showView" key="booking-list">
                        <div class="current_booking" v-if="bookings.length">
                            <h2>Current booking</h2>
                            <transition-group name="list" tag="div">
                                <booking v-for="(book,i) in bookings" :key="book.id" :booking="book" :user="storage" :index="i" @otherBooking="loadOtherBooking" @sideView="loadSideView" ref="booking"></booking>
                            </transition-group>
                        </div>
                        <div v-if="pastBookings.length">
                            <h2>Past booking</h2>
                            <transition-group name="list" tag="div">
                                <past-booking v-for="(book,i) in pastBookings" :key="book.id" :booking="book" :index="i" @sideView="loadSideView"></past-booking>
                            </transition-group>
                        </div>
                    </div>

                    <div key="no-booking" v-else>
                        <h2>No booking untill now</h2>
                    </div>
                </transition>
            </div>
        </div>

        <div class="booking_tab_content">
            <transition name="flip">
                <div class="cursor-pointer btn-close" v-if="sideView!=''" @click="clearSideView">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close_icon"></use>
                    </svg>
                </div>
            </transition>

            <transition name="flip" mode="out-in">
                <sign-contract v-if="sideView=='sign'" key="sign-contract" @closeContract="clearSideView" :booking="booking"></sign-contract>
                <car-inspection v-if="sideView=='return_inspection' || sideView=='inspection'" key="car-inspection" :booking="booking"></car-inspection>
                <extend-cancel-booking v-if="sideView=='extend'" key="booking-extend" :user="storage" @clearSideView="clearSideView"></extend-cancel-booking>
                <booking-documents v-if="sideView=='documents'" key="booking-documents" :documents="documents"></booking-documents>
                <chat-booking v-if="sideView=='chat'" key="booking-chat" :viewHeight="viewHeight" :user="storage" :bookingId="inProcess.id"></chat-booking>
            </transition>
        </div>
    </div>
</template>

<script>
    import User from '../user';

    export default {
        props: ['viewHeight'],

        data() {
            return {
                sideView: '',
                showView: false,
                booking: {},
                bookings: [],
                pastBookings: [],
                storage: User,
                inProcess: null
            };
        },

        computed: {
            documents() {
                let docs = [];

                _.each(this.booking.documents, d => {
                    docs.push(d);
                });

                _.each(this.booking.vehicle.documents, d => {
                    docs.push(d);
                });

                return docs;
            }
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                User.commit('updateCurrentBook', null);
                $('#sideLoader').show();
                axios.get('/api/booking').then(r => {
                    if (r.data.success.length) {
                        this.showView = true;
                        setTimeout(() => {
                            _.each(r.data.success, (b) => {
                                if ( b.status === 12)
                                    this.pastBookings.push(b);
                                else
                                    this.bookings.push(b);
                            });
                            setTimeout(() => {
                                if (this.bookings.length) {
                                    User.commit('updateCurrentBook', this.bookings[0].id);
                                    this.loadBookingDetail();
                                }
                            }, 500);
                        }, 450);
                    }
                    $('#sideLoader').hide();
                });
            },

            loadOtherBooking(data) {
                if (User.state.currentBook !== data.id) {
                    if (this.inProcess && this.inProcess.id === User.state.currentBook) this.clearSideView();
                    User.commit('updateCurrentBook', data.id);
                    this.$refs.booking[data.index].prepareComponent();
                    this.loadBookingDetail();
                }
            },

            loadBookingDetail() {
                axios.get('/api/booking/' + User.state.currentBook).then(r => {
                    this.booking = r.data.success;
                });
            },

            loadSideView(data) {
                if (!this.inProcess || this.inProcess.id !== data.id || this.sideView !== data.view) {
                    if (this.sideView === data.view) {
                        this.sideView = '';
                        setTimeout(() => {
                            this.sideView = data.view;
                        }, 450);
                    }
                    else this.sideView = data.view;
                    this.inProcess = data;
                }
            },

            clearSideView(e) {
                if (typeof e !== 'undefined' && e === 'sign') {
                    if (User.state.auth.type === 'owner')
                        this.bookings[this.inProcess.index].status = 3;
                    else if (User.state.auth.type === 'client')
                        this.bookings[this.inProcess.index].status = 2;
                }
                this.sideView = '';
                this.inProcess = null;
            }
        }
    }
</script>
