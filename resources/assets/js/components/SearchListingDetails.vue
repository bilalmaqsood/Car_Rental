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
                            <p>available from: <span v-if="user.state.vehicleData.can_book">{{user.state.vehicleData.can_book | date('fromNow')}}</span><span v-else>Not available</span></p>
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

                <div class="pickup_loction pickup_loction_29sep">
                    <button class="secodery_btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                        </svg>
                    </button>
                    <vehicle-location :pickup_location="user.state.vehicleData.pickup_location" :return_location="user.state.vehicleData.return_location"></vehicle-location>
                </div>

                <div class="pickup_loction_map">
                    <iframe width="100%" height="450" frameborder="0" style="border:0" :src="'https://www.google.com/maps/embed/v1/place?q='+user.state.vehicleData.location.split(',')[0]+','+user.state.vehicleData.location.split(',')[1]+'&amp;key=AIzaSyDFkedYDgj286xDo9Sp9XRWsOiPfu9T3Ak'"></iframe>

                    <p>{{ user.state.vehicleData.notes }}</p>
                </div>

                <div class="pickup_loction_datebox">
                    <div class="availabe">
                        <p>{{ user.state.vehicleData.owner.user.name }} <span> {{ date_format(user.state.vehicleData.created_at) }}</span></p>
                    </div>
                    <div class="ratting">
                    </div>

                </div>

                <div class="pickup_loction_btn pickup_loction_btn_3_sep">
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
                        <li v-if="user.state.auth">
                            <button type="button" @click="openLastInspection">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                                </svg>
                                <span>Last Inspection</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <search-listing-booking key="booking" v-if="user.state.bookNow" :vehicle="user.state.vehicleData" :pickup_location="user.state.vehicleData.pickup_location"></search-listing-booking>
        </transition>
    </div>

</template>

<script>
    import Local from '../local';
    import User from '../user';

    export default {
        props: ['user'],

        data() {
            return {
                isBooking: false,
            };
        },

        mounted() {
            
            this.prepareComponent();
            this.inilizeRating();
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

                }
            },

            doBooking() {
                if(User.state.auth){
                    if(!User.state.auth.dlc){
                        User.commit('menuView', 'settings');
                    User.commit('oldView', 'booking');
                    new Noty({
                                type: 'warning',
                                text: 'Upload you driving documents before booking!'
                            }).show();
                    return false;
                    }
                }
                
                this.user.commit('booking', true);
            },
            date_format(date){
                return moment.utc(date).format("D.M.Y");
            },
            inilizeRating(){

            let rating = this.user.state.vehicleData.owner.avg_rating;
            $('.ratting').starrr({
                  rating: rating,
                  readOnly: true
                });
            },
        openLastInspection(){
            this.$parent.$emit("lastinspection");
        }
    }
}
</script>
