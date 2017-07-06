<template>
    <div>
        <transition name="slide-fade">
            <div class="filter_hied_btn" v-if="user.state.showAdvance">
                <form>
                    <ul>
                        <li>
                            <div class="form-group">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                                </svg>
                                <input type="text" class="form-control" placeholder="vehicle" v-model.trim="vehicle">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                                </svg>
                                <input type="text" class="form-control" placeholder="location" v-model.trim="location">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                                </svg>
                                <input type="text" class="form-control" placeholder="price range" v-model.trim="price">
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <input type="text" class="form-control available-from" placeholder="available from" v-model.trim="available">
                            </div>
                        </li>
                        <li>
                            <button type="button" class="submit" @click="searchVehicles">Apply filters</button>
                        </li>
                    </ul>
                </form>
            </div>
        </transition>

        <div class="search_map">
            <div id="search_map" style="width: 100%; height: 100%;"></div>

            <div class="search_container">
                <div class="search_car" v-for="i in items">
                    <div class="search_car_content" :style="{width: detailsDisplay ? '0px' : '', height: detailsDisplay ? '0px' : ''}">
                        <h3><a href="javascript:void(0)" @click="itemDetails(i)">{{i.make}} {{i.model}} {{i.variant}}</a>
                        </h3>
                        <ul>
                            <li>
                                <p>Year: {{i.year}} </p>
                                <p>Mileage: {{i.mileage}}</p>
                            </li>
                            <li>
                                <p>Seats: 5 </p>
                                <p>Transmission: manual</p>
                            </li>
                            <li>
                                <p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p>
                            </li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>£ {{i.rent }}</h3>
                                <span>/week</span>
                            </div>
                        </div>
                    </div>

                    <a href="javascript:void(0)" @click="itemDetails(i)">
                        <div class="search_car_img" v-bind:style="{'background-image': 'url(' + i.images[0] + ')', width: detailsDisplay ? '20%' : '', 'min-height':  detailsDisplay ? '100px' : ''}">
                            <img class="img-responsive" v-bind:src="i.images[0]" alt="">
                            <div class="highlight-vehicle" v-if="i.id == item.id"></div>
                        </div>
                    </a>
                </div>

                <search-listing-details :vehicle="item" v-if="detailsDisplay"></search-listing-details>
            </div>

            <div class="spinner-container side-loader" id="sideLoader">
                <div class="spinner-frame">
                    <div class="spinner-cover"></div>
                    <div class="spinner-bar"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import User from '../user';

    export default {
        data() {
            return {
                user: User,
                vehicle: "",
                location: "",
                available: "",
                price: "",
                items: {},
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
                this.items = User.state.searchResults.data;
                User.commit('listing', []);

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
                }, 500);
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

            searchFilters(){
                this.advanceSearch = !this.advanceSearch;
            },

            itemDetails(item){
                let $t = this;
                let $s = $('#sideLoader').show();
                axios
                    .get('/api/vehicle/' + item.id)
                    .then(response => {
                        $t.detailsDisplay = true;
                        $t.item = response.data.success;
                        $s.hide();
                    });
            },

            searchListing(response) {
                this.items = response.data.success.data;
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

            queryParams(){
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
            }
        }
    }
</script>
