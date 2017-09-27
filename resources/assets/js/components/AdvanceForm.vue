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
                            
                            <input id="slider-range" type="text" class="span2" value="" data-slider-min="1" data-slider-max="1000" data-slider-step="5" data-slider-value="[1,1000]"/>
                            <span>{{price_min}}</span>-
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
                                                    <input type="text"  v-on:keydown.enter="searchVehicles" class="form-control available-from" placeholder="available from">
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
            };
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
                    $('.available-from').datetimepicker({
                            inline: true,
                            sideBySide: false,
                            format: 'D-M-Y',
                            minDate: moment(new Date())
                        }).on('dp.change', $this.calenderChange)
                    $this.initPriceRange();
                }, 450);
            },
            calenderChange(e) {
                    
                if (!this.start_date)
                    this.start_date = e.date.utc().startOf('day');
                else if (!this.end_date) {
                    this.end_date = e.date.utc().endOf('day');
                    this.highlightDays(true);
                } else {
                    
                    this.start_date = null;
                    this.end_date = null;
                }

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

                if (this.start_date  && this.end_date ) {
                    params.booking_start = this.start_date.format("D-M-Y");
                    params.booking_end = this.end_date.format("D-M-Y");;
                }

                if (!$.isEmptyObject(params)) {
                    return "?" + $.param(params);
                }

                return "";
            },

            highlightDays(bool) {
                let $t = this;
                let $e = $('.bootstrap-datetimepicker-widget .datepicker-days table tbody');

                if (bool) {
                    if (this.start_date.format('X') < this.end_date.format('X')) {
                        let StartDate = this.start_date;
                        let EndDate = this.end_date;
                        $e.find('td').each(function (i, e) {
                            let $elem = $(e);
                            let eDate = moment.utc($elem.data('day') + ' ' + moment().format('H:m:s'), 'MM/DD/YYYY H:m:s', true);
                            if (eDate.isValid() && StartDate.format('X') <= eDate.format('X') && EndDate.format('X') >= eDate.format('X')) $elem.addClass('highlight-day');
                        });
                        
                        
                            new Noty({
                                type: 'success',
                                text: '<div><p><b>Selected Start Date:</b> ' + $t.start_date.format('M/D/Y') + '</p><p class="m-0"><b>Selected End Date:</b> ' + $t.end_date.format('M/D/Y') + '</p></div>',
                            }).show();

                            $(".available-from").val($t.start_date.format("D-M-Y") + " - " + $t.end_date.format("D-M-Y"));

                    } else {
                        new Noty({
                            type: 'warning',
                            text: '<div><p>Start date should greater than end date.</p><p>Please select dates again.</p></div>',
                        }).show();
                        this.start_date = null;
                        this.end_date = null;
                        
                        
                    }
                } else {
                    $e.find('td').each(function (i, e) {
                            let $elem = $(e);       
                            $elem.removeClass('active');
                        });
                    $(".available").val('');
                        this.start_date=null;
                        this.end_date=null;
                    new Noty({
                        type: 'success',
                        text: 'Dates are reset.',
                        timeout: 600
                    }).show();
                }
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
