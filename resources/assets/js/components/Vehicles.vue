<template>
    <div class="vehicles_container">
        <div class="car_detail_container">
            <div class="detail_img" v-if="vehicle.images">
                <img :src="vehicle.images[0]" alt="">
            </div>
            <div class="booking_tab">
                <ul class="nav nav-tabs">
                    <li>
                        <a data-toggle="tab" href="#car_inspection">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                            </svg>
                            add new
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#extend_cancel">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#edit_icon"></use>
                            </svg>
                            edit vehicle
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#chat_tab">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#delete_icon"></use>
                            </svg>
                            delete
                        </a>
                    </li>
                </ul>

                <vehicle-input-form ></vehicle-input-form>
            </div>

            <div class="car_detail" v-if="vehicle">
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
                            <p>Seats: 5 </p>
                            <p>Transmission: manual</p>
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
                <ul>
                    <li><span>Pickup from:</span> <span class="pickup_location">{{ fetchAddress(vehicle.pickup_location)}}</span></li>
                    <li><span>Return to:</span> <span class="return_location">{{fetchAddress(vehicle.return_location)}}</span></li>
                </ul>
            </div>
            <div class="pickup_loction_map" v-if="vehicle">
                <iframe width="100%" height="450" frameborder="0" style="border:0" :src="'https://www.google.com/maps/embed/v1/place?q='+vehicle.location.split(',')[0]+','+vehicle.location.split(',')[1]+'&amp;key=AIzaSyDFkedYDgj286xDo9Sp9XRWsOiPfu9T3Ak'"></iframe>
                <p>{{ vehicle.notes }}</p>
            </div>

            <div class="pickup_loction_datebox">
                <div class="availabe">
                    <p>John Doe <span>16.05.2017</span></p>
                </div>
                <div class="ratting" data-score="1"></div>
            </div>

            <div class="pofile_content_wrapper" v-for="vehicle in vehicles">
                <div v-if="vehicle.images" class="clickable img_box" v-bind:style="{'background': 'url('+vehicle.images[0]+')'}" @click="vechicleDetails(vehicle)">
                    <img :src="vehicle.images[0]" alt="">
                </div>
                <div class="profile_content">
                    <h3 @click="vechicleDetails(vehicle)" class="clickable"> {{vehicle.make}} {{vehicle.model}} {{vehicle.variant}}</h3>
                    <ul>
                        <li>
                            <p>Year:  {{vehicle.year}}</p>
                            <p>Mileage: {{vehicle.mileage}}</p>
                        </li>
                        <li>
                            <p>Seats: {{vehicle.seats}} </p>
                            <p>Transmission: {{vehicle.transmission}}</p>
                        </li>
                        <li>
                            <p>Fuel type: {{vehicle.fuel}} </p>
                            <p>Consumption:  {{vehicle.mpg}} mpg (ec.)</p>
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</template>

<script>
    var $scope;
    export default {
        data() {
            return {
                vehicles: '',
                vehicle: false,
            };
        },
        created: function() {
            this.$on('vehicleAdded', function(value){
                console.log(value);
                this.vehicle=value;
                this.addTimeSlots(this.vehicle);
            });
        },
        mounted() {
            $scope = this;
            this.prepareComponent();
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
            addTimeSlots(vehicle){
                var dateArr=[];
                var fromDate = moment(vehicle.available_from).format('YYYY-MM-DD');
                var toDate = moment(fromDate).add(90, 'days').format('YYYY-MM-DD');
                while(fromDate < toDate) {
                    dateArr.push(moment(fromDate).format('YYYY-MM-DD'));
                    fromDate = moment(fromDate).add(1, 'days').format('YYYY-MM-DD');
                }
                axios.post('/api/time-slot',{vehicle_id: vehicle.id,days: dateArr}).then(function () {
                    
                });
            }
        }
    }
</script>
