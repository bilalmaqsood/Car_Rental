<template>
    <form class="form-inline">
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
                <button type="button" class="secodery_btn" @click="searchVehicles" data-loading-text="searching ...">
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
    import User from '../user';

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

        methods: {
            searchVehicles(e) {
                this.fetchVehicles(e);
            },

            searchFilters() {
                this.advanceSearch = !this.advanceSearch;
            },

            fetchVehicles(e) {
                let $t = this;
                let $btn = $(e.target).button('loading');
                axios
                    .get('/api/search/vehicle' + this.queryParams())
                    .then(function (r) {
                        User.commit('listing', r.data.success);
                        $t.$emit('showListing');
                        $btn.button('reset');
                    });
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
            }
        }
    }
</script>
