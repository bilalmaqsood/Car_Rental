<template>
    <div class="vehicles_container">
        <div class="car_detail_container">
            <div class="detail_img" v-if="vehicle.images">
                <img :src="vehicle.images[0]" alt="">
            </div>
            <div class="booking_tab">
                <ul class="nav nav-tabs">
                    <li :class="{active: menuView == 'add' && menuView !== '' }">
                        <a data-toggle="tab" href="javascript:void(0)" @click="changeMenuView('add')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                            </svg>
                            add new
                        </a>
                    </li>
                    <li  :class="{active: menuView == 'edit'}">
                        <a @click="changeMenuView('edit')" data-toggle="tab" href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#edit_icon"></use>
                            </svg>
                            edit vehicle
                        </a>
                    </li>
                    <li :class="{active: menuView == 'editcontract'}" >
                        <a @click="changeMenuView('editcontract')"  data-toggle="tab" href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#edit_icon"></use>
                            </svg>
                            edit contract
                        </a>
                    </li>
                    <li :class="{active: menuView == 'timeslots'}" >
                        <a @click="changeMenuView('timeslots')" data-toggle="tab" href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#edit_icon"></use>
                            </svg>
                            Add Timeslots
                        </a>
                    </li>
                    <li @click="deleteVehicle">
                        <a data-toggle="tab" href="javascript:void()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#delete_icon"></use>
                            </svg>
                            delete
                        </a>
                    </li>
                </ul>
                <transition name="slide-fade" mode="out-in">
                <vehicle-contract v-if="menuView=='editcontract'" :vehicle="vehicle"></vehicle-contract>
                </transition>
                <transition name="slide-fade" mode="out-in">
                <vehicle-timeslots v-if="menuView=='timeslots'" :vehicle="vehicle"></vehicle-timeslots>
                </transition>
                <transition name="slide-fade" mode="out-in">
                <vehicle-input-form :vehicle="vehicle" :isEdit="isEdit" v-if="(menuView=='edit' && isEdit)|| menuView=='add'"></vehicle-input-form>
                </transition>
            </div>

            <div class="car_detail"  v-if="vehicle">
                <div class="availablity_detail">
                    <h3>{{vehicle.make}} {{vehicle.model}} {{vehicle.variant}}</h3>
                    <ul>
                        <li>
                            <p>Year: {{vehicle.year}} </p>
                            <p>Mileage: {{vehicle.mileage}}</p>
                            <p>Seats: {{vehicle.seats}}</p>
                            <p>Transmission: {{vehicle.transmission}}</p>
                        </li>
                        <li>
                            <p>Fuel type: {{vehicle.fuel}} </p>
                            <p>Consumption: {{vehicle.mpg_eco}} mpg (ec.)</p>
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
                    <div class="availabe_item_price">
                        <h3>{{vehicle.rent | currency}}</h3>
                        <span>/week</span>
                        <span v-if="vehicle.insurance>0.0">insurance included</span>
                    </div>
                </div>
            </div>
            <div class="pickup_loction" v-if="vehicle">
                <button class="secodery_btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                    </svg>
                </button>
                    <vehicle-location :pickup_location="vehicle.pickup_location" :return_location="vehicle.return_location"></vehicle-location>
            </div>
            <div class="pickup_loction_map" v-if="vehicle">
                <iframe width="100%" height="450" frameborder="0" style="border:0" :src="'https://www.google.com/maps/embed/v1/place?q='+vehicle.location.split(',')[0]+','+vehicle.location.split(',')[1]+'&amp;key=AIzaSyDFkedYDgj286xDo9Sp9XRWsOiPfu9T3Ak'"></iframe>
                <p>{{ vehicle.notes }}</p>
            </div>

            <div class="pickup_loction_datebox">
                <div class="availabe">
                    <p>John Doe <span>16.05.2017</span></p>
                </div>
                <div class="ratting"></div>
            </div>

            <div class="pofile_content_wrapper" v-for="vehicle in vehicles">
                <div v-if="vehicle.images" class="clickable img_box" v-bind:style="{'background': 'url('+vehicle.images[0]+')'}" @click="vechicleDetails(vehicle)">
                    <img :src="vehicle.images[0]" alt="">
                </div>
                <div class="profile_content">
                    <h3 @click="vechicleDetails(vehicle)" class="clickable"> {{vehicle.make}} {{vehicle.model}} {{vehicle.variant}}</h3>
                    <ul class="priusactive">
                        <li>
                            <p><b>Year:</b>  {{vehicle.year}}</p>
                            <p><b>Mileage:</b> {{vehicle.mileage}}</p>
                        </li>
                        <li>
                            <p><b>Seats:</b> {{vehicle.seats}} </p>
                            <p><b>Transmission:</b> {{vehicle.transmission}}</p>
                        </li>
                        <li>
                            <p><b>Fuel type:</b> {{vehicle.fuel}} </p>
                            <p><b>Consumption:</b>  {{vehicle.mpg}} mpg (ec.)</p>
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import Form from '../vehicle-fields';
    import User from '../user';

    var $scope;
    export default {
        data() {
            return {
                menuView: '',
                isEdit: false,
                vehicles: '',
                avg_rating: User.state.auth.avg_rating,
                vehicle: false,
            };
        },
        created: function() {
            let $this = this;
            this.$on('vehicleAdded', function(value){
               this.menuView='';
                new Noty({
                    type: 'information',
                    text: value.make+" "+value.model+" "+value.make + " Added!",
                }).show();
                this.vehicle=value;
            });

            this.$on('vehicleUpdate', function(value){
               this.menuView='';
               this.isEdit=false;
                new Noty({
                    type: 'information',
                    text: value.make+" "+value.model+" "+value.make + " Updated!",
                }).show();
                this.vehicle=value;
            });
        },
        mounted() {
            $scope = this;
            this.prepareComponent();
            console.log(User);
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
                let rating = this.avg_rating;
                $('.ratting').starrr({
                    rating: rating
                });
            },
            fetchAddress(arg){
                console.log(arg);
                let $t = this;
                let location;
                    $.ajax({
                        url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + arg + '&key=AIzaSyDp8Pjc5ZmcmTb-ci-Fj-xNh2KLTUlguk0',
                        type: 'GET',
                        dataType: 'json',
                        async: false,
                    }).done(function (r) {
                        location = r.results[0].formatted_address;
                    });

            return location;
            },
            date_format(date){
                return moment.utc(date.date).format("D.M.Y");
            },
            vechicleDetails(arg){
                this.vehicle = arg;
            },

            editVehicle(){
                this.isEdit=! this.isEdit;
                this.changeMenuView('edit');

            },
            deleteVehicle(){
                let value = confirm('Are you sure you want to delte '+ this.vehicle.make+" "+this.vehicle.model+" "+this.vehicle.make);
                if(value){
                        axios.delete('/api/vehicle/'+this.vehicle.id).then(function () {
                           let index = $scope.vehicles.indexOf($scope.vehicle);
                            $scope.vehicles.splice(index, 1);
                            if($scope.vehicles.length>0)
                                $scope.vehicle = $scope.vehicles[0];
                        });
                }
            },
            changeMenuView(view) {
                if(view=='edit')
                    this.isEdit=! this.isEdit;
                else 
                    this.isEdit= false;

                let oldView = this.menuView;
                this.menuView = null;
                setTimeout(()=>{

                if (oldView === view)
                    this.menuView = '';
                else
                    this.menuView = view;
            }, 550);
            },
        }
    }
</script>
