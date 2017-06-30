<template>
    <div>
        <div class="car_detail_container">
            <div class="detail_img">
                <img :src="item.images[0]" alt="">
            </div>
            <div class="car_detail">
                <div class="availablity_detail">
                    <h3>{{item.make}} {{item.model}} {{item.variant}}</h3>
                    <ul>
                        <li><p>Year: {{item.year}} </p><p>Mileage: {{item.mileage}}</p>
                         <p>Seats: {{item.seats}} </p><p>Transmission: {{item.transmission}}</p></li>
                        <li><p>Seats: {{item.seats}} </p><p>Transmission: {{item.transmission}}</p></li>
                        <li><p>Fuel type: {{item.fuel}} </p><p>Consumption: {{item.mpg}} mpg (ec.)</p></li>
                    </ul>
                    <div class="availabe">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                        </svg>
                        <p>available from: <span>{{item.available_from}}</span></p>
                    </div>
                </div>
                <div class="availablity_price">
                    <div class="availabe_item_price">
                        <h3>£ {{item.rent}}</h3>
                        <span>/week</span>
                        <span v-if="item.insurance>0.0">insurance included</span>
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
                    <li><span>Pickup from:</span> {{item.pickup_location}}</li>
                    <li><span>Return to:</span> {{item.return_location}}</li>
                </ul>
            </div>
            <div class="pickup_loction_map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4825851.352956702!2d-4.064941!3d53.800650999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2suk!4v1495513518623" width="100%" frameborder="0" style="border:0" allowfullscreen=""></iframe>
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
                        <button onclick="location.href='search_result_booking_calender.html'" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 20" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#issue"></use>
                            </svg>
                            <span>Book now</span>
                        </button>
                    </li>
                    <li>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                            </svg>
                            <span>Contact owner</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['item'],
        data() {
            return this.item;
        },

        mounted() {

        },

        methods:{

        }
    }
</script>
