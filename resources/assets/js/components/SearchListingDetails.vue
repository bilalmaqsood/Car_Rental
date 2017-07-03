<template>
    <div>
        <div v-show="!isBooking" class="car_detail_container">
            <div class="detail_img">
                <!-- To Do -->
                <img :src="vehicle.images" alt="">
            </div>
            <div class="car_detail">
                <div class="availablity_detail">
                    <h3>{{vehicle.make}} {{vehicle.model}} {{vehicle.variant}}</h3>
                    <ul>
                        <li><p>Year: {{vehicle.year}} </p><p>Mileage: {{vehicle.mileage}}</p>
                         <p>Seats: {{vehicle.seats}} </p><p>Transmission: {{vehicle.transmission}}</p></li>
                        <li><p>Seats: {{vehicle.seats}} </p><p>Transmission: {{vehicle.transmission}}</p></li>
                        <li><p>Fuel type: {{vehicle.fuel}} </p><p>Consumption: {{vehicle.mpg}} mpg (ec.)</p></li>
                    </ul>
                    <div class="availabe">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                        </svg>
                        <p>available from: <span>{{vehicle.available_from}}</span></p>
                    </div>
                </div>
                <div class="availablity_price">
                    <div class="availabe_item_price">
                        <h3>£ {{vehicle.rent}}</h3>
                        <span>/week</span>
                        <span v-if="vehicle.insurance>0.0">insurance included</span>
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
                    <li><span>Pickup from:</span> {{vehicle.pickup_location}}</li>
                    <li><span>Return to:</span> {{vehicle.return_location}}</li>
                </ul>
            </div>
            <div class="pickup_loction_map">
                <iframe width="100%" height="450" frameborder="0" style="border:0" v-bind:src="'https://www.google.com/maps/embed/v1/place?q='+vehicle.location.split(',')[0]+','+vehicle.location.split(',')[1]+'&amp;key=AIzaSyDFkedYDgj286xDo9Sp9XRWsOiPfu9T3Ak'"></iframe>

                <p>Phasellus nisi leo, aliquet ac erat ut, moles2e ma3s enim. Proin sit amet tempor mi, a egestas tortor. Ves2bulum et congue urna. Nunc elementum por3tor
                    urna sed euismod. Curabitur bibendum leo iaculis pulvinar fringilla. Nullam eu interdum lectus. Duis posuere, enim at fermentum efficitur, magna nisl lobor2s
                    metus, in hendrerit est ante et magna. Ut ma3s, justo non por3tor suscipit, augue ipsum sodales justo, a rutrum.</p>
            </div>
            <div class="pickup_loction_datebox">
                <div class="availabe">
                    <p>John Doe <span>16.05.2017</span></p>
                </div>
                <div class="ratting" data-score="1" style="cursor: pointer;"><i class="fa fa-fw fa-star" title="bad" data-score="1"></i>&nbsp;<i class="fa fa-fw fa-star-o" title="poor" data-score="2"></i>&nbsp;<i class="fa fa-fw fa-star-o" title="regular" data-score="3"></i>&nbsp;<i class="fa fa-fw fa-star-o" title="good" data-score="4"></i>&nbsp;<i class="fa fa-fw fa-star-o" title="gorgeous" data-score="5"></i><input type="hidden" name="score" value="1"></div>
            </div>
            <div class="pickup_loction_btn">
                <ul>
                    <li>
                        <button @click="doBooking" type="button">
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

        <search-listing-booking  v-show="isBooking" :vehicle="vehicle"></search-listing-booking>


    </div>

</template>

<script>
    export default {
        props: ['vehicle'],
        data() {
          return { isBooking: false };
        },

        mounted() {

        },

        methods:{
            doBooking(){
                this.isBooking=true;
            }
        }
    }
</script>
