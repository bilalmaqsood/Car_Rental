<template>
    <div>
        <div class="search_map">
            <div id="search_map" style="width: 100%; height: 100%;"></div>
            <div class="search_container">
                <div class="search_car" v-for="item in items" v-if="!detailsDisplay">
                    <a href="javascript:void(0)" @click="itemDetails(item)">
                    <div class="search_car_img" v-bind:style="{ 'background-image': 'url(' + item.images[0] + ')' }">
                        <img v-bind:src="item.images[0]" alt="">
                    </div>
                    </a>
                    <div class="search_car_content">
                        <h3><a  href="javascript:void(0)" @click="itemDetails(item)" >{{item.make}} {{item.model}} {{item.variant}}</a>
                        </h3>
                        <ul>
                            <li><p>Year: {{item.year}} </p>
                                <p>Mileage: {{item.mileage}}</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                         xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>£ {{item.rent }}</h3>
                                <span>/week</span>
                            </div>
                        </div>
                    </div>
                </div>
                <search-listing-details :vehicle="item" v-if="detailsDisplay"></search-listing-details>
                <div class="car_detail_thumb" v-show="detailsDisplay">
                    <a v-for="item in items" href="javascript:void(0)" @click="itemDetails(item)">
                        <img  src="http://img.autobytel.com//2016/bmw/228/2-376-threequartersview101-77888.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                vehicle: "",
                location: "",
                available: "",
                price: "",
                items: {},
                item: {},
                filterDisplay: 'none',
                detailsDisplay: false,
            };
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent(){
                var items = localStorage.getItem('search-list');
                this.items = JSON.parse(items).data.success.data;
            },
            showFiltersForm(){
                this.filterDisplay = this.filterDisplay == 'none' ? 'block' : 'none';
            },
            searchVehicles() {
                this.fetchVehicles();
            },
            drawMarker() {
                this.items.forEach(function (item, index) {
                    var lat = parseFloat(item.location.split(",")[0]);
                    var lng = parseFloat(item.location.split(",")[1]);
                    console.log(lat + "-" + lng);
                    new google.maps.Marker({
                        position: {lat: lat, lng: lng},
                        map: SearchMap,
                        title: item.make + " " + " " + item.model + " " + item.variant,
                    });
                });

            },
            checkMap() {
                console.log(SearchMap);
            },
            initMap() {
                let $map = document.createElement('script');
                $map.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDp8Pjc5ZmcmTb-ci-Fj-xNh2KLTUlguk0&callback=initMap';
                $map.async = true;
                $map.defer = true;
                document.body.appendChild($map);
            },
            searchFilters(){
                this.advanceSearch = !this.advanceSearch;
            },
            itemDetails(item){
                this.detailsDisplay=true;
                axios.get('/api/vehicle/'+item.id)
                    .then(response => {
                       this.item=response.data.success;

                    });
            },

            searchListing(response) {
                localStorage.setItem("search-list", JSON.stringify(response));
                window.location = "/search";
            },
            fetchVehicles(params) {
                var params = this.queryParams();
                axios.get('/api/search/vehicle' + params)
                    .then(this.searchListing);
            },
            queryParams(){
                var params = {};
                var lat = null;
                var lng = null;

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
