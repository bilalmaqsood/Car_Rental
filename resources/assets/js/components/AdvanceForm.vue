<template>
    <div>
        <div class="filter_hied_btn">
            <form>
                <ul>
                    <li>
                        <div class="form-group">
<div class="input-group login-input">
<div class="input-group-addon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                            </svg>
</div>
                            <input type="text"  v-on:keydown.enter="searchVehicles" class="form-control" placeholder="vehicle" v-model.trim="vehicle" >
</div>
                            
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
<div class="input-group login-input">
<div class="input-group-addon">                       
     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                            </svg>
</div>
                            <input type="text" id="gmap_geocoding_address2" v-on:keydown.enter="searchVehicles" class="form-control" placeholder="location" v-model.trim="location">
                        </div>
</div>
                    </li>
                    <li>
                        <div class="form-group">
<div class="input-group login-input">
<div class="input-group-addon">      
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                            </svg>
</div>
                            <input type="text"  v-on:keydown.enter="searchVehicles" class="form-control" placeholder="price range" v-model.trim="price">
</div>
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
      <div class="input-group login-input">
<div class="input-group-addon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                            </svg>
</div>
                            <input type="text"  v-on:keydown.enter="searchVehicles" class="form-control available-from" placeholder="available from" v-model.trim="available">
  </div>
                      </div>
                    </li>
                    <li>
                        <button type="button" class="submit" @click="searchVehicles">Apply filters</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</template>

<script>
    import User from '../user';

    export default {
        data() {
            return {
                price: '',
                vehicle: '',
                location: '',
                available: '',
            };
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {

                 var input = document.getElementById('gmap_geocoding_address2');
                   if (input) {
                       var options = {
                           componentRestrictions: {country: 'uk'}
                       };
                   var autocomplete2 = new google.maps.places.Autocomplete(input, options);

                   google.maps.event.addListener(autocomplete2, 'place_changed', (e,val)=> {
                    console.log(e);
                    console.log(val);
                        this.location =  $("#gmap_geocoding_address2").val();
                        
                    });
               }

                setTimeout(function () {
                    $('.available-from').datetimepicker();
                    console.log('loaded');
                }, 450);
            },

            searchVehicles() {
                $('#sideLoader').show();
                axios
                    .get('/api/search/vehicle' + this.queryParams())
                    .then(this.searchListing);
            },

            searchListing(response) {
                User.commit('listing', response.data.success.data);
                User.commit('home', false);
                User.commit('view', true);
                User.commit('menuView', '');

                setTimeout(function () {
                    $('#sideLoader').hide();
                    User.commit('advance');
                }, 800);
            },

            queryParams() {
                let params = {};

                if (this.vehicle.length > 0)
                    params.vehicle = this.vehicle;

                if (this.location.length > 0) {
                    $.ajax({
                        beforeSend: function (request) {
                            request.setRequestHeader('Access-Control-Request-Headers', '');
                        },
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
