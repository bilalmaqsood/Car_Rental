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
                            <li v-for="p in payments"><span>{{p.title}}</span><span>{{p.cost | currency}}</span><span>{{p.due_date | date('format', 'DD.MM.YYYY')}}</span><span v-if="p.paid">Paid</span><span v-else>Pending</span></li>
                        </ul>
                    </div>
                </transition>

                <div class="booking_tab">
                    <ul class="nav nav-tabs">
                        <li>
                            <a @click="loadSideView('inspection')" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                                </svg>
                                car inspection
                            </a>
                        </li>
                        <li>
                            <a @click="loadSideView('extend')" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                extend/cancel
                            </a>
                        </li>
                        <li>
                            <a @click="loadSideView('documents')" href="javascript:">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use>
                                </svg>
                                documents
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
    export default {
        props: ['booking', 'user', 'index'],

        data() {
            return {
                payments: []
            };
        },

        computed: {
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
                    view: view
                });
            }
        }
    }
</script>
