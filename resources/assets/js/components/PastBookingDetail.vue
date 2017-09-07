<template>
    <div class="search_car past-bookings">
        <div class="search_car_content">
            <h3><a href="javascript:">{{vehicleName}}</a></h3>

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

                <div class="pickup_loction_btn">
                    <ul>
                        <li>
                            <button @click="loadSideView('bookNow')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#issue"></use>
                                </svg>
                                <span>book now</span>
                            </button>
                        </li>
                        <li>
                            <button @click="loadSideView('chat')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                                </svg>
                                <span>chat</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="search_car_img cursor-pointer" :style="{'background-image': 'url(' + imagePath + ')'}">
            <img :src="imagePath" alt="">
        </div>
    </div>
</template>

<script>
    export default {
        props: ['booking', 'index'],

        data() {
            return {};
        },

        computed: {
            vehicleName() {
                return [this.booking.vehicle.make, this.booking.vehicle.model, this.booking.vehicle.variant].join(' ');
            },

            imagePath() {
                return this.booking.vehicle.images.length ? this.booking.vehicle.images[0] : '';
            }
        },

        mounted() {},

        methods: {
            loadSideView(view) {
                this.$emit('sideView', {
                    id: this.booking.id,
                    data: this.booking,
                    index: this.index,
                    past: true,
                    view: view
                });
            }
        }
    }
</script>
