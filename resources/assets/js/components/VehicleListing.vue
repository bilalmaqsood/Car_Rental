<template>
<div>
    <div class="main_profile_container">
    <div class="booking-request-actions">
        <button @click="addVehicle=!addVehicle" type="button" class="add-new-vehile-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use></svg>
            <span>add new vehicle</span>
        </button>
    </div>
    <div class="requests-counter-wrap" v-for="vehicle in vehicles" >
        
            <div v-if="vehicle.images" class="clickable listing-img-box" v-bind:style="{'background': 'url('+vehicle.images[0]+')'}" @click="vechicleDetails(vehicle)">
                    <img :src="vehicle.images[0]" alt="">
                </div>
        <div class="car_detail">
            <div class="availablity_detail">
                <h3 @click="vechicleDetails(vehicle)" class="clickable"> {{vehicle.make}} {{vehicle.model}} {{vehicle.variant}}</h3>
                <ul>
                    <li>
                        <p><b>Year:</b>  {{vehicle.year}}</p>
                        <p><b>Mileage:</b> {{vehicle.mileage}}</p>
                        <p><b>Seats:</b> {{vehicle.seats}} </p>
                        <p><b>Transmission:</b> {{vehicle.transmission}}</p>
                    </li>
                    <li>
                        <p><b>Seats:</b> 5 </p>
                        <p><b>Transmission:</b> manual</p>
                    </li>
                    <li>
                         <p><b>Fuel type:</b> {{vehicle.fuel}} </p>
                         <p><b>Consumption:</b>  {{vehicle.mpg}} mpg (ec.)</p>
                    </li>
                </ul>
                <div class="availabe">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                    </svg>
                    <p>available from: <span>{{vehicle.available_from | date('fromNow')}}</span></p>
                </div>
            </div>
            <div class="availablity_price">
                <label class="quantity-label">10</label>
                <div class="availabe_item_price">
                     <h3>{{vehicle.rent | currency}}</h3>
                        <span>/week</span>
                        <span v-if="vehicle.insurance>0.0">insurance included</span>
                </div>
            </div>
        </div>
    </div>
    
    </div>
    <transition name="slide-fade" mode="in-out">
        <vehicle-input-form :vehicle="null" :isEdit="false" v-if="addVehicle"></vehicle-input-form>
    </transition>
</div>
</template>

<script>
    import Form from '../vehicle-fields';
    import User from '../user';

    var $scope;
    export default {
        data() {
            return {
                storage: User,
                addVehicle: false,
                vehicles: '',
                vehicle: false,
            };
        },
        created: function() {
            let $this = this;
            this.$on('vehicleAdded', function(value){
               this.menuView='';
                new Noty({
                    type: 'success',
                    text: value.make+" "+value.model+" "+value.make + " Added!",
                }).show();
                this.vehicle=value;
            });

            this.$on('vehicleUpdate', function(value){
               this.menuView='';
               this.isEdit=false;
                new Noty({
                    type: 'success',
                    text: value.make+" "+value.model+" "+value.make + " Updated!",
                }).show();
                this.vehicle=value;
            });
        },
        mounted() {
            $scope = this;
            $('#sideLoader').show();
            this.prepareComponent();
            setTimeout(function() { $('#sideLoader').hide(); }, 1000);
            
        },

        methods: {
            prepareComponent() {
                axios.get('/api/vehicle')
                    .then(this.vehiclesCallback);
            },
            vehiclesCallback(r) {
                    this.vehicles = r.data.success;
                    if(r.data.success[0]){
                        this.vehicle = r.data.success[0];
                    }
              
            }, 
            vechicleDetails(arg){
                this.vehicle = arg;
                User.commit('vehicle', arg);
                this.$parent.$emit("vehicleSelected");
            },

        }
    }
</script>
