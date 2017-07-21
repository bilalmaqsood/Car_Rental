<template>
    <div class="main_booking_container">
        <div class="booking_container">
            <div>
                <transition name="flip" mode="out-in">
                    <div v-if="showView" key="booking-list">
                        <h2>Current booking</h2>
                        <transition-group name="list" tag="div">
                            <booking v-for="(book , i) in bookings" :key="book" :booking="book" :user="storage" :index="i" @otherBooking="loadOtherBooking" @sideView="loadSideView" ref="booking"></booking>
                        </transition-group>

                        <div v-if="pastBookings.length">
                            <h2>Past booking</h2>
                            <transition-group name="list" tag="div">
                                <past-booking v-for="book in pastBookings" :key="book" :booking="book"></past-booking>
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
            <chat :viewHeight="viewHeight"></chat>
        </div>
    </div>
</template>

<script>
    import User from '../user';

    export default {
        props: ['viewHeight'],

        data() {
            return {
                showView: false,
                bookings: [],
                pastBookings: [],
                storage: User
            };
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
                        $('#sideLoader').hide();
                        setTimeout(() => {
                            _.each(r.data.success, (b) => {
                                if (b.status === 9)
                                    this.pastBookings.push(b);
                                else
                                    this.bookings.push(b);
                            });
                            setTimeout(() => {
                                if (this.bookings.length)
                                    User.commit('updateCurrentBook', this.bookings[0].id);
                            }, 500);
                        }, 450);
                    }
                });
            },

            loadOtherBooking(data) {
                if (User.state.currentBook !== data.id) {
                    User.commit('updateCurrentBook', data.id);
                    this.$refs.booking[data.index].prepareComponent();
                }
            },

            loadSideView(data) {
                console.log(data);
            }
        }
    }
</script>
