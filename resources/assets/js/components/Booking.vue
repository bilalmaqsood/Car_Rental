<template>
    <div class="search_map">
        <div class="main_booking_container">
            <div class="booking_container">

                <div v-for="booking in bookings" v-if="booking.status==BOOKING_CONFIRM">
                    <h2>Current booking</h2>
                    <div class="search_car">
                    <div class="search_car_img" v-bind:style="imgStyle(booking)">
                        <img :src="booking.vehicle.images[0]" alt="">
                    </div>
                    <div class="search_car_content">
                        <h3> {{booking.vehicle.make}} {{booking.vehicle.model}} {{booking.vehicle.variant}}</h3>
                        <ul>
                            <li><p>Year:  {{booking.vehicle.year}}</p><p>Mileage: {{booking.vehicle.mileage}}</p></li>
                            <li><p>Seats: {{booking.vehicle.seats}} </p><p>Transmission: {{booking.vehicle.transmission}}</p></li>
                            <li><p>Fuel type: {{booking.vehicle.fuel}} </p><p>Consumption:  {{booking.vehicle.mpg}} mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>{{vehicle.available_from | date('fromNow')}}</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>{{ booking.vehicle.rent | currency }}</h3>
                                <span>/week</span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="rent_tabel" v-if="payment_logs">
                    <h3>Rent book</h3>
                    <ul>
                        <li><span>Week no.</span><span>Cost</span><span>Due date</span><span>Status</span></li>
                        <li v-for="item in payment_logs"><span>{{item.title}}</span><span>{{item.cost | currency  }}</span><span>{{date_format(item.due_date)}}</span><span>{{ item.paid?'Paid':'Pending'}}</span></li>
                    </ul>
                </div><!--rent_tabel-->


                <div class="booking_tab">
                    <ul class="nav nav-tabs">
                        <li><a href="javascript:void(0)" @click="car_inpec=!car_inpec">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                            </svg>
                            car inspection
                        </a></li>
                        <li><a href="javascript:void(0)" @click="extend_cancel=!extend_cancel">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                            </svg>
                            extend/cancel
                        </a></li>
                        <li><a href="javascript:void(0)" @click="booking_docs=!booking_docs">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use>
                            </svg>
                            documents
                        </a></li>
                        <li><a href="javascript:void(0)" @click="booking_chat=!booking_chat" >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                            </svg>
                            chat
                        </a></li>
                    </ul>

                    <div class="tab-content booking_tab_content">
                        <transition name="slide-fade">
                        <car-inspection v-show="car_inpec"></car-inspection>
                        </transition><transition name="slide-fade">
                        <booking-documents  v-show="booking_docs"></booking-documents>
                        </transition><transition name="slide-fade">
                        <booking-chat  v-show="booking_chat" ></booking-chat>
                        </transition><transition name="slide-fade">
                        <extend-cancel-booking v-show="extend_cancel" :CURRENT_BOOKING="CURRENT_BOOKING"></extend-cancel-booking>
                        </transition>
                    </div>

                </div>



                <h2>Past booking</h2>

                <div v-for="booking in bookings" v-if="booking.status==BOOKING_CLOSED"  class="search_car">
                    <div class="search_car_img past_booking_car" v-bind:style="imgStyle(booking)">
                        <img :src="booking.vehicle.images[0]" alt="">
                    </div>
                    <div class="search_car_content">
                        <h3> {{booking.vehicle.make}} {{booking.vehicle.model}} {{booking.vehicle.variant}}</h3>
                        <ul>
                            <li><p>Year:  {{booking.vehicle.year}}</p><p>Mileage: {{booking.vehicle.mileage}}</p></li>
                            <li><p>Seats: {{booking.vehicle.seats}} </p><p>Transmission: {{booking.vehicle.transmission}}</p></li>
                            <li><p>Fuel type: {{booking.vehicle.fuel}} </p><p>Consumption:  {{booking.vehicle.mpg}} mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>{{booking.vehicle.available_from | date('fromNow')}}</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>{{ booking.vehicle.rent | currency  }} </h3>
                                <span>/week</span>
                            </div>
                        </div>
                        <div v-if="USER_TYPE=='client'" class="pickup_loction_btn">
                            <ul>
                                <li>
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 20" class="svg-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#issue"></use>
                                        </svg>
                                        <span>Book now</span>
                                    </button>
                                </li>
                                <li>
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                                        </svg>
                                        <span>Contact owner</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!--search_car-->
            </div>
        </div>
    </div>

</template>

<script>
    import User from '../user';

    var $scope;
    var active_id;

    export default {
        props: ['profileHeight'],

        data() {
            return {
                bookings: "",
                User: User,
                BOOKING_CONFIRM: 1,
                BOOKING_CLOSED: 7,
                CURRENT_BOOKING: "",
                USER_TYPE: User.state.auth.type,
                payment_logs: false,
                car_inpec: false,
                booking_docs: false,
                booking_chat: false,
                extend_cancel: false,
            };
        },

        mounted() {
            $scope=this;
            axios.get('/api/booking')
                .then(function (response) {
                    $scope.bookings = response.data.success;
                    active_id = response.data.success.filter(function (item) {
                        return item.status.match($scope.BOOKING_CONFIRM)
                    });
                    $scope.CURRENT_BOOKING = active_id[0]?active_id[0]:undefined;
                }).then(this.getWeeklyPayment);

        },

        methods: {
            imgStyle(booking) {
                if($scope.USER_TYPE=='client')
                    return { 'background-image': 'url(' + booking.vehicle.images[0] + ')', };
                return { 'background-image': 'url(' + booking.vehicle.images[0] + ')', 'min-height' : '236px'};
            },
            date_format(date){
                return moment(date).format("D.M.Y");
            },
            getWeeklyPayment(){
                if($scope.CURRENT_BOOKING !== undefined ){
               return axios.get('/api/booking/'+$scope.CURRENT_BOOKING.id+'/payment-weekly')
                    .then(function (response) {
                        if(response.data.success.length>0)
                        $scope.payment_logs = response.data.success;
                    else
                        $scope.payment_logs = false;
                    });
                }

            }
        }
    }
</script>
