<template>
<form class="form-inline" v-on:submit.prevent="searchVehicles">
            <ul>
                <li>
                    <div class="form-group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                        </svg>
                        <input type="text" class="form-control" placeholder="vehicle" v-model="vehicle">
                    </div>
                </li>
                <li>
                    <div class="form-group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                        </svg>
                        <input type="text" class="form-control" placeholder="location" v-model="location">
                    </div>
                </li>
                <li>
                    <button class="secodery_btn" @click="searchVehicles">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search_icon"></use>
                        </svg>
                    </button>
                </li>
                <li>
                    <button type="button" class="primary_btn" @click="searchFilters">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#filters_icon"></use>
                        </svg>
                    </button>
                </li>
                <li v-show="advanceSearch">
                    <div class="form-group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                        </svg>
                        <input type="text" class="form-control" placeholder="price" v-model="price">
                    </div>
                </li>

                <li v-show="advanceSearch">
                    <div class="form-group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                        </svg>
                        <input type="text" class="form-control" placeholder="Available" v-model="available">
                    </div>
                </li>
            </ul>
        </form>
</template>

<script>
    export default {
        data() {
            return {
              vehicle: "",
              location: "",
                available: "",
                price: "",
                advanceSearch: false,
            };
        },

        mounted() {

        },

        ready() {

        },

        methods: {
            searchVehicles() {
                this.fetchVehicles();
            },
            searchFilters(){
              this.advanceSearch=!this.advanceSearch;
            },
            searchListing(response) {
                localStorage.setItem("search-list", JSON.stringify(response));
                window.location="/search";
            },

            fetchVehicles(params) {
                var params = this.queryParams();
                axios.get('/api/search/vehicle'+ params)
                    .then(this.searchListing);
            },
            queryParams(){
                var params = {};
                var lat = null;
                var lng = null;

                if(this.vehicle.length>0)
                    params.vehicle=this.vehicle;

                if(this.location.length>0) {
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
                if(this.price.length>0) {
                    params.price=this.price;
                }
                if(this.available.length>0) {
                    params.available=this.available;
                }
                if(!$.isEmptyObject(params)){
                    return "?"+$.param(params);
                }
                  return "";

            }
        }
    }
</script>
