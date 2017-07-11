<template>
    <div>
        <transition name="slide-fade" mode="out-in">
            <div key="detail" v-if="!user.state.bookNow" class="car_detail_container">

                <div class="detail_img">
                    <img :src="user.state.vehicleData.images[0]" alt="">
                </div>

                <div class="car_detail">
                    <div class="availablity_detail">
                        <h3>{{user.state.vehicleData.make}} {{user.state.vehicleData.model}} {{user.state.vehicleData.variant}}</h3>
                        <ul>
                            <li>
                                <p>Year: {{user.state.vehicleData.year}} </p>
                                <p>Mileage: {{user.state.vehicleData.mileage}}</p>
                            </li>
                            <li>
                                <p>Seats: {{user.state.vehicleData.seats}} </p>
                                <p>Transmission: {{user.state.vehicleData.transmission}}</p>
                            </li>
                            <li>
                                <p>Fuel type: {{user.state.vehicleData.fuel}} </p>
                                <p>Consumption: {{user.state.vehicleData.mpg}} mpg (ec.)</p>
                            </li>
                        </ul>
                        <div class="availabe">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                            </svg>
                            <p>available from: <span>{{user.state.vehicleData.available_from | date('fromNow')}}</span></p>
                        </div>
                    </div>
                    <div class="availablity_price">
                        <div class="availabe_item_price">
                            <h3>{{user.state.vehicleData.rent | currency}}</h3>
                            <span>/week</span>
                            <span v-if="user.state.vehicleData.insurance>0.0">insurance included</span>
                        </div>
                    </div>
                </div>

                <div class="pickup_loction">
                    <button class="secodery_btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                        </svg>
                    </button>
                    <ul>
                        <li><span>Pickup from:</span> <span class="pickup_location">{{pickup_location}}</span></li>
                        <li><span>Return to:</span> <span class="return_location">{{return_location}}</span></li>
                    </ul>
                </div>

                <div class="pickup_loction_map">
                    <iframe width="100%" height="450" frameborder="0" style="border:0" :src="'https://www.google.com/maps/embed/v1/place?q='+user.state.vehicleData.location.split(',')[0]+','+user.state.vehicleData.location.split(',')[1]+'&amp;key=AIzaSyDFkedYDgj286xDo9Sp9XRWsOiPfu9T3Ak'"></iframe>

                    <p>Phasellus nisi leo, aliquet ac erat ut, moles2e ma3s enim. Proin sit amet tempor mi, a egestas tortor. Ves2bulum et congue urna. Nunc elementum por3tor urna sed euismod. Curabitur bibendum leo iaculis pulvinar fringilla. Nullam eu interdum lectus. Duis posuere, enim at fermentum efficitur, magna nisl lobor2s metus, in hendrerit est ante et magna. Ut ma3s, justo non por3tor suscipit, augue ipsum sodales justo, a rutrum.</p>
                </div>

                <div class="pickup_loction_datebox">
                    <div class="availabe">
                        <p>John Doe <span>16.05.2017</span></p>
                    </div>
                    <div class="ratting" data-score="1" style="cursor: pointer;">
                        <i class="fa fa-fw fa-star" title="bad" data-score="1"></i>
                        <i class="fa fa-fw fa-star-o" title="poor" data-score="2"></i>
                        <i class="fa fa-fw fa-star-o" title="regular" data-score="3"></i>
                        <i class="fa fa-fw fa-star-o" title="good" data-score="4"></i>
                        <i class="fa fa-fw fa-star-o" title="gorgeous" data-score="5"></i>
                        <input type="hidden" name="score" value="1">
                    </div>
                </div>

                <div class="pickup_loction_btn">
                    <ul>
                        <li>
                            <button @click="doBooking" type="button" v-if="user.state.auth === null || user.state.auth.type === 'client'">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#issue"></use>
                                </svg>
                                <span>Book now</span>
                            </button>
                        </li>
                        <li>
                            <button type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                                </svg>
                                <span>Contact owner</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <search-listing-booking key="booking" v-if="user.state.bookNow" :vehicle="user.state.vehicleData" :pickup_location="pickup_location"></search-listing-booking>
        </transition>
    </div>

</template>

<script>
    import Local from '../local';

    export default {
        props: ['user'],

        data() {
            return {
                isBooking: false,
                pickup_location: '',
                return_location: ''
            };
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                let $t = this;
                let bookingData = Local.get('bookingData');

                if (bookingData && this.user.state.auth.type === 'client') {
                    setTimeout(function () {
                        $t.doBooking();
                    }, 500);
                } else {
                    localStorage.removeItem('reloadData');

                    if ($t.user.state.vehicleData.pickup_location)
                        $.ajax({
                            url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + $t.user.state.vehicleData.pickup_location + '&key=AIzaSyDp8Pjc5ZmcmTb-ci-Fj-xNh2KLTUlguk0',
                            type: 'GET',
                            dataType: 'json',
                            async: false,
                        }).done(function (r) {
                            $t.pickup_location = r.results[0].formatted_address;
                        });

                    if ($t.user.state.vehicleData.return_location)
                        $.ajax({
                            url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + $t.user.state.vehicleData.return_location + '&key=AIzaSyDp8Pjc5ZmcmTb-ci-Fj-xNh2KLTUlguk0',
                            type: 'GET',
                            dataType: 'json',
                            async: false,
                        }).done(function (r) {
                            $t.return_location = r.results[0].formatted_address;
                        });
                }
            },

            doBooking() {
                this.user.commit('booking', true);
            }
        }
    }
</script>
