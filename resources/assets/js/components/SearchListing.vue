<style>
    .menu-component-container {
       
    }
</style>
<template>

    <div class="search_map ">
        <div id="search_map" style="width: 100%; height: 100%;"></div>

        <div class="search_container search_container_width">
            <transition-group name="list" tag="div">
                <div class="search_car" v-for="i in vehicles" :key="i.id">
                    <div class="search_car_content" :style="{width: user.state.detailsDisplay ? '0' : '', height: user.state.detailsDisplay ? '0px' : ''}">
                        <h3><a href="javascript:void(0)" @click="itemDetails(i)">{{i.make}} {{i.model}} {{i.variant}}</a></h3>
                        <ul>
                            <li>
                                <p><strong>Year:</strong> {{i.year}} </p>
                                <p><strong>Mileage:</strong> {{i.mileage}}</p>
                            </li>
                            <li>
                                <p><strong>Seats:</strong> {{i.seats}}</p>
                                <p><strong>Transmission:</strong> {{i.transmission}}</p>
                            </li>
                            <li>
                                <p><strong>Fuel type:</strong> {{i.fuel}} </p>
                                <p><strong>Consumption:</strong> {{i.mpg_eco}} mpg (ec.)</p>
                            </li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>{{i.available_from | date('fromNow')}}</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>{{i.rent | currency}}</h3>
                                <span>/week</span>
                            </div>
                        </div>
                    </div>

                    <a href="javascript:void(0)" @click="itemDetails(i)">
                        <div class="search_car_img" :style="{'background-image': 'url(' + getImage(i.images) + ')', width: user.state.detailsDisplay ? '20%' : '', 'min-height':  user.state.detailsDisplay ? '100px' : ''}">
                            <img class="img-responsive" :src="getImage(i.images)" alt="">
                            <div class="highlight-vehicle" v-if="user.state.detailsDisplay && i.id == user.state.vehicleData.id"></div>
                        </div>
                    </a>
                </div>
                <div  v-if="user.state.searchResults.data.length == 0" key="12121212">
                    <h1>Oops! no result found.. </h1>
                </div>
            </transition-group>
                <button @click="loadMore" v-show="next_page_url" class="primary-button">Load more..</button>
            <search-listing-details :user="user" v-if="user.state.detailsDisplay"></search-listing-details>
        </div>
    </div>

</template>

<script>
    import Local from '../local';
    import User from '../user';

    export default {
        data() {
            return {
                next_page_url: User.state.searchResults.next_page_url,
                user: User,
                vehicles: User.state.searchResults.data,
                item: {},
                filterDisplay: 'none',
                detailsDisplay: false,
                SearchMap: null
            };
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent(){
                let $t = this;
                setTimeout(function () {
                    $t.SearchMap = new google.maps.Map(document.getElementById('search_map'), {
                        zoom: 10,
                        center: {
                            lat: 51.508653,
                            lng: -0.083792
                        }
                    });
                    google.maps.event.addListenerOnce($t.SearchMap, 'idle', function () {
                        setTimeout(function () {
                            $t.drawMarker();
                        }, 500);
                    });
                    let vehicleData = Local.get('vehicleData');
                    if (vehicleData) {
                        setTimeout(function () {
                            User.commit('details', true);
                        }, 500);
                        User.commit('vehicle', vehicleData);
                    }
                }, 500);
            },

            getImage(images) {
                return images && images.length ? images[0] : '/vehicle/image/hash';
            },

            searchVehicles() {
                this.fetchVehicles();
            },

            drawMarker() {
                let $t = this;
                _.map($t.items, function (v) {
                    let lat = parseFloat(v.location.split(",")[0]);
                    let lng = parseFloat(v.location.split(",")[1]);
                    console.log(lat + "-" + lng);
                    new google.maps.Marker({
                        position: {lat: lat, lng: lng},
                        map: $t.SearchMap,
                        title: v.make + " " + v.model + " " + v.variant + " " + v.year,
                    });
                });
            },

            searchFilters() {
                this.advanceSearch = !this.advanceSearch;
            },

            itemDetails(item) {
                User.commit('details', false);
                let $t = this;
                let $s = $('#sideLoader').show();
                axios
                    .get('/api/vehicle/' + item.id)
                    .then(response => {
                        setTimeout(function () {
                            $s.hide();
                            User.commit('details', true);
                        }, 500);
                        User.commit('vehicle', response.data.success);
                    });
            },

            searchListing(response) {
                User.commit('listing', response.data.success.data);

                setTimeout(function () {
                    $('#sideLoader').hide();
                    User.commit('advance');
                }, 800);
            },

            fetchVehicles() {
                $('#sideLoader').show();
                axios
                    .get('/api/search/vehicle' + this.queryParams())
                    .then(this.searchListing);
            },

            queryParams() {
                let params = {};

                if (this.vehicle.length > 0)
                    params.vehicle = this.vehicle;

                if (this.location.length > 0) {
                    $.ajax({
                        url: 'https://maps.googleapis.com/maps/api/geocode/json?address=' + this.location + '&key=AIzaSyDp8Pjc5ZmcmTb-ci-Fj-xNh2KLTUlguk0',
                        type: 'GET',
                        dataType: 'json',
                        async: false,
                    })
                        .done(function (response) {
                            params.latitude = response.results[0].geometry.location.lat;
                            params.longitude = response.results[0].geometry.location.lng;
                        });
                }

                if (this.price.length > 0) {
                    params.price = this.price;
                }

                if (this.available.length > 0) {
                    params.available = this.available;
                }

                if (!$.isEmptyObject(params)) {
                    return "?" + $.param(params);
                }

                return "";
            },
            loadMore(){
               $('#sideLoader').show();
               
               axios.get(this.next_page_url).then(response=>{
                   this.vehicles = this.vehicles.concat(response.data.success.data);
                   this.next_page_url = response.data.success.next_page_url;
                   setTimeout(function() { $('#sideLoader').hide(); }, 500); 
               });
                
            }
        }
    }
</script>
