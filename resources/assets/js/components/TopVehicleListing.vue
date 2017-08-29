<template>
    <div class="vehicles_tabs">
        <h2>Top vehicles</h2>

        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a @click="queryVehicles('location')" href="javascript:void(0)" aria-controls="by_location" role="tab" data-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                    </svg>
                    by location
                </a>
            </li>
            <li role="presentation">
                <a @click="queryVehicles('rent')" href="javascript:void(0)" aria-controls="by_price" role="tab" data-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                    </svg>
                    by price
                </a>
            </li>
            <li role="presentation">
                <a @click="queryVehicles('rating')" href="javascript:void(0)" aria-controls="by_rating" role="tab" data-toggle="tab">
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    by rating
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="by_location">
                <div class="main_vehicles_container">
                    <transition-group name="list" tag="div">
                        <div v-for="vehicle in vehicles" :key="vehicle.id" class="main_vehicles list-item">
                            <div class="owl-carousel owl-slider">
                                <div v-for="img in vehicle.images " class="item">
                                <div class="liting-image" v-bind:style="{'background': 'url('+img+')'}"></div>
                                </div>
                            </div>
                            <h3 class="clickable" @click="itemSelected(vehicle)">{{vehicle.make}} {{vehicle.model}} {{vehicle.variant}}</h3>
                            <ul>
                                <li>
                                    <p><strong>Year:</strong> {{vehicle.year}} </p>
                                    <p><strong>Mileage:</strong> {{vehicle.mileage}}</p>
                                </li>
                                <li>
                                    <p><strong>Seats:</strong> {{vehicle.seats}}</p>
                                    <p><strong>Transmission:</strong> {{vehicle.transmission}}</p>
                                </li>
                                <li>
                                    <p><strong>Fuel type:</strong> {{vehicle.fuel}} </p>
                                    <p><strong>Consumption:</strong> {{vehicle.mpg_eco}} mpg (ec.)</p>
                                </li>
                            </ul>
                            <div class="availablity_box">
                                <div class="availabe">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                    </svg>
                                    <p> <strong>available from: </strong><span>{{vehicle.available_from | date('fromNow')}}</span></p>
                                </div>
                                <div class="availabe_item_price">
                                    <h3>{{vehicle.rent | currency}}</h3>
                                    <strong><span>/week</span>
                                    <span v-if="vehicle.insurance>0.0">insurance included</span>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </transition-group>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                vehicles: [],
            };
        },

        mounted() {
            this.queryVehicles('location');
        },

        methods: {
            queryVehicles(by) {
                $('#sideLoader').show();
                let params = "?" + by + '=desc';

                if (by === "rent")
                    params = "?" + by + '=asc';

                axios.get('/vehicles' + params).then(this.listVehicles);
            },

            listVehicles(response) {
                this.vehicles = response.data.success;

                setTimeout(function () {
                    $(".owl-slider").owlCarousel({
                        items: 1,
                        margin: 0,
                        navigation: false
                    });
                    $('#sideLoader').hide();
                }, 10);
            },
            itemSelected(vehicle){
                this.$emit("vehicleSelect",vehicle);
            }   
        }
    }
</script>
