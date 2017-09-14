<template>
    <div class="vehicles_tabs">
        <h2>Top vehicles</h2>

        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation">
                <a @click="queryVehicles('location')" href="javascript:void(0)" aria-controls="by_location" role="tab" data-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                    </svg>
                    by location
                </a>
            </li>
            <li role="presentation">
                <a @click="queryVehicles('rent')" href="javascript:void(0)" aria-controls="by_price" role="tab" data-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                    </svg>
                    by price
                </a>
            </li>
            <li role="presentation">
                <a @click="queryVehicles('rating')" href="javascript:void(0)" aria-controls="by_rating" role="tab" data-toggle="tab">
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    by rating
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="by_location">
                <div class="main_vehicles_container">
                    <transition-group name="list" tag="div">
                        <div v-for="vehicle in vehicles" :key="vehicle.id" class="main_vehicles list-item">
                            <div class="owl-carousel owl-slider">
                                <div v-for="img in vehicle.images " class="item">
                                <div class="liting-image" v-bind:style="{'background': 'url('+img+')'}"></div>
                                </div>
                            </div>
                            <h3 class="clickable" @click="itemSelected(vehicle)">{{vehicle.make}} {{vehicle.model}} {{vehicle.variant}}</h3>
                            <ul>
                                <li>
                                    <p><strong>Year:</strong> {{vehicle.year}} </p>
                                    <p><strong>Mileage:</strong> {{vehicle.mileage}}</p>
                                </li>
                                <li>
                                    <p><strong>Seats:</strong> {{vehicle.seats}}</p>
                                    <p><strong>Transmission:</strong> {{vehicle.transmission}}</p>
                                </li>
                                <li>
                                    <p><strong>Fuel type:</strong> {{vehicle.fuel}} </p>
                                    <p><strong>Consumption:</strong> {{vehicle.mpg_eco}} mpg (ec.)</p>
                                </li>
                            </ul>
                            <div class="availablity_box">
                                <div class="availabe">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                    </svg>
                                    <p> <strong>available from: </strong><span v-if="vehicle.can_book">{{vehicle.can_book | date('fromNow')}}</span><span v-else>Not available</span></p>
                                </div>
                                <div class="availabe_item_price">
                                    <h3>{{vehicle.rent | currency}}</h3>
                                    <strong><span>/week</span>
                                    <span v-if="vehicle.insurance>0.0">insurance included</span>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </transition-group>
                    <button @click="loadMore" v-show="next_page_url" class="primary-button">Load more..</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                current_page: '',
                total: '',
                next_page_url: '',
                vehicles: [],
                sort: 'desc',
            };
        },

        mounted() {
            this.queryVehicles();
            var make = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            // url points to a json file that contains an array of country names, see
            // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
            prefetch: Qwikkar.baseUrl + '/search/vehicle-titles'
          });
          $('#prefetch-make .typeahead').typeahead(null, {
            name: 'make',
            source: make
          });
        },

        methods: {
            queryVehicles(by) {
                $('#sideLoader').show();
                
                if(this.sort === 'desc')
                    this.sort='asc'
                else
                    this.sort='desc'


                let params="?";

                if (by === "rent" || by === "rating")
                    params = "?" + by +"="+this.sort;

                if (by === "location")
                    params = "?" + this.currentLocation();

                axios.get('/vehicles' + params).then(this.listVehicles);
            },

            listVehicles(response) {
                this.vehicles = response.data.success.data;
                this.next_page_url = response.data.success.next_page_url;
                setTimeout(function () {
                    $(".owl-slider").owlCarousel({
                        items: 1,
                        margin: 0,
                        navigation: false
                    });
                    $('#sideLoader').hide();
                }, 100);
            },
            itemSelected(vehicle){
                this.$emit("vehicleSelect",vehicle);
            },
            currentLocation(){

                let param;
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position){
                            param.latitude = position.coords.latitude;
                            param.longitude = position.coords.longitude;
                        });
                    } else { 
                       return false;
                    }
                    return $.param(param);
            },
            loadMore(){
               $('#sideLoader').show();
               
               axios.get(this.next_page_url).then(response=>{
                // _.merge
                   this.vehicles = this.vehicles.concat(response.data.success.data);
                   this.next_page_url = response.data.success.next_page_url;
                   setTimeout(function() { $('#sideLoader').hide(); }, 500);
                   $(".owl-slider").owlCarousel().trigger('destroy.owl.carousel').trigger('refresh');
                setTimeout(()=>{  this.initSlider(); },400); 
               });
                
            },
            initSlider(){
                let $slider = $(".owl-slider").owlCarousel({
                    items: 1,
                    margin: 0,
                    navigation: false,
                    autoplay:true,
                }).trigger('refresh');
            },   
        }
    }
</script>
