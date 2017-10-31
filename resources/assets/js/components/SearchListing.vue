<template>
    <div class="search_map ">
        <map-markers ref='marker' :hover="hover_vehicle"></map-markers>
        <div class="search_container search_container_width">
            <transition-group name="list" tag="div">
            <advance-form v-if="user.state.showAdvance && user.state.menuView=='advance'" key="advance"></advance-form>

            <div :class="{'search-result-listing-scroll': user.state.detailsDisplay}" key="998789">
                <div :id="i.id"  @mouseover="hover_vehicle=i" class="search_car" v-for="i in user.state.searchResults.data" :key="i.id">
                    <div  :class="{'highlighted-vehicle': user.state.highlighted==i.id}" class="search_car_content" :style="{width: user.state.detailsDisplay ? '0' : '', height: user.state.detailsDisplay ? '0px' : ''}">
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
                                <p>available from: <span v-if="i.can_book">{{i.can_book | date('fromNow')}}</span>  <span v-else>Not available</span> </p>
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
            </div>

                <div  v-if="user.state.searchResults.data.length == 0" key="12121212">
                    <h1>Oops! no result found.. </h1>
                </div>
            </transition-group>
                <button @click="loadMore" v-show="user.state.searchResults.next_page_url" class="primary-button">Load more..</button>
            <search-listing-details :user="user" v-if="user.state.detailsDisplay"></search-listing-details>
        </div>
         <transition name="slide-fade" mode="out-in">
              <last-inspection class="driver-last-inspection" :vehicle="user.state.vehicleData" v-if="last_inspection"></last-inspection>
        </transition>
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
                item: {},
                filterDisplay: 'none',
                detailsDisplay: false,
                SearchMap: null,
                hover_vehicle: false,
                last_inspection: false,
            };
        },

        mounted() {
            this.prepareComponent();
        },
        created: function(){
            this.$on("lastinspection",()=>{
                 this.last_inspection = !this.last_inspection;   
            });
            this.$on('clearLastInspection',()=>{
                this.last_inspection = false;
            });
        },
        methods: {
            prepareComponent(){
                let $t = this;
                setTimeout(function () {
                    let vehicleData = localStorage.vehicleData;
                    if (vehicleData && vehicleData.length) {
                        setTimeout(function () {
                            User.commit('details', true);
                        }, 500);
                        User.commit('vehicle', JSON.parse(vehicleData));
                    }
                }, 500);
            },

            getImage(images) {
                return images && images.length ? images[0] : '/vehicle/image/hash';
            },

            searchVehicles() {
                alert("called");
                this.fetchVehicles();
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
                let $this = this;
               axios.get(User.state.searchResults.next_page_url).then(response=>{
                   User.state.searchResults.data = User.state.searchResults.data.concat(response.data.success.data);
                   this.next_page_url = response.data.success.next_page_url;
//                   User.commit('home', true);
//                   User.commit('home', false);
//                   User.commit('listing', User.state.searchResults);
                   setTimeout(function() { $('#sideLoader').hide(); $this.$refs.marker.prepareComponent(); }, 100);
               });
                
            },
        }
    }
</script>
