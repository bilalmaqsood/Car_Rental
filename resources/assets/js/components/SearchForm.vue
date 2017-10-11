<template>
    <form>
        <ul>
            <li>
                <div class="form-group">
                    <div class="input-group login-input" id="prefetch-make">
                        <div class="input-group-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                            </svg>
                        </div>
                        <input v-on:keydown.enter="searchVehicles" type="text" class="form-control typeahead" placeholder="vehicle" v-model="vehicle">
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
                        <input v-on:keydown.enter="searchVehicles" type="text" class="form-control" id="gmap_geocoding_address" placeholder="location" v-model="location">
                    </div>
                </div>
            </li>

            <transition name="slide-fade">
                <li v-if="advanceSearch" class="price-range-oct4">
                    <span class="price-range-label-oct4">Price range</span>
                    <div class="form-group">
                        <div class="input-group login-input">
                            <!--<div class="input-group-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                                </svg>
                            </div>-->
                            
                            <input id="slider-range" type="text" class="span2" value="" data-slider-min="1" data-slider-max="1000" data-slider-step="5" data-slider-value="[1,1000]"/>
                            <span style="margin-left: 20px;">£{{price_min}}</span>-
                            <span>{{price_max}}</span>
                        </div>

                    </div>
                </li>
            </transition>

            <transition name="slide-fade">
                <li v-if="advanceSearch">
                    <div class="form-group">
                        <div class="input-group login-input">
                            <div class="input-group-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                            </div>
                            <flat-pickr
                                v-model="available"
                                placeholder="available from"
                                :config="config"
                                :required="true"
                                input-class="form-control"
                                name="insurance_expiry_date">
                            </flat-pickr>
                        </div>
                    </div>
                </li>
            </transition>
            <li class="button-search">
                <button type="button" class="secodery_btn" @click="searchVehicles" data-loading-text="searching ...">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search_icon"></use>
                    </svg>
                </button>
            </li>
            <li class="button-search">
                <button type="button" class="primary_btn" @click="searchFilters" :class="{active:advanceSearch}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#filters_icon"></use>
                    </svg>
                </button>
            </li>
        </ul>
        <div class="clearfix"></div>
    </form>
</template>

<script>
    import User from '../user';

    import flatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';

    export default {
        data() {
            return {
                date: new Date(),
                // Get more form https://chmln.github.io/flatpickr/options/
                config: {
                    wrap: true, // set wrap to true when using 'input-group'
                    altFormat: 'M   j, Y',
                    altInput: true,
                    dateFormat: "Y-m-d",
                    mode: 'range',
                },
                vehicle: "",
                location: "",
                available: "",
                price: "",
                price_min: 1,
                price_max: 1000,
                advanceSearch: false,
            };
        },
        components: {
            flatPickr
        },
        mounted(){

            var input = document.getElementById('gmap_geocoding_address');
               if (input) {
                   var options = {
                       componentRestrictions: {country: 'uk'}
                   };
                   var autocomplete = new google.maps.places.Autocomplete(input, options);

                     google.maps.event.addListener(autocomplete, 'place_changed', ()=> {
                        this.location =  $("#gmap_geocoding_address").val();
                        
                    });

               }
            // this.initPriceRange();
        },
        methods: {
            searchVehicles(e) {
                this.fetchVehicles(e);
            },

            searchFilters() {
                var $this = this;
                this.advanceSearch = !this.advanceSearch;

                if(this.advanceSearch)
                    $this.initPriceRange();
            },
            fetchVehicles(e) {
                let $t = this;
                let $btn = $(e.target).button('loading');
                axios
                    .get('/api/search/vehicle' + this.queryParams())
                    .then(function (r) {
                        User.commit('view', true);
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

                if (this.price_min || this.price_max) {
                    params.price_min = this.price_min;
                    params.price_max = this.price_max;

                }

                if (this.available) {
                    let dates = this.available.split("to");
                    params.booking_start = dates[0].trim();
                    params.booking_end = dates[1].trim();
                }

                if (!$.isEmptyObject(params)) {
                    return "?" + $.param(params);
                }

                return "";
            },
            initPriceRange(){
                let $this = this;
                $( function() {
                    let $slider = $( "#slider-range" ).bootstrapSlider();
                    $slider.on("slide", function(slideEvt) {
                            $this.price_min = slideEvt.value[0];
                            $this.price_max = slideEvt.value[1];
                        });

                  } );
            }
        }
    }
</script>
