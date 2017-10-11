<template>
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
                                <input type="text" v-on:keydown.enter="searchVehicles" id="gmap_geocoding_address2" v-on:keydown.enter="searchVehicles" class="form-control" placeholder="location" v-model.trim="location">
                            </div>
                        </div>
                    </li>
                    <li class="price-range-oct4">
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
                    <li>
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
                    <li>
                        <button type="button" class="submit" @click="searchVehicles">Apply filters</button>
                    </li>
                </ul>
            </form>
        </div>
</template>

<script>
    import User from '../user';

    import flatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';

    export default {
        data() {
            return {
                price: '',
                vehicle: '',
                location: '',
                available: '',
                start_date: '',
                end_date: '',
                price_min: 1,
                price_max: 1000,
                 date: new Date(),
                // Get more form https://chmln.github.io/flatpickr/options/
                config: {
                    wrap: true, // set wrap to true when using 'input-group'
                    altFormat: 'M   j, Y',
                    altInput: true,
                    dateFormat: "Y-m-d",
                    mode: 'range',
                },
            };
        },
        components: {
            flatPickr
        },
        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                    let $this = this;
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
                    $this.initPriceRange();
                }, 450);
            },

            searchVehicles() {
                $('#sideLoader').show();
                axios
                    .get('/api/search/vehicle' + this.queryParams())
                    .then(this.searchListing);
            },

            searchListing(response) {
                User.commit('listing', response.data.success);
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
