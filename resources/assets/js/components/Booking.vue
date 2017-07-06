<template>
    <div class="search_map">
        <div class="main_booking_container">
            <div class="booking_container">

                <div v-for="booking in bookings" v-if="booking.status==BOOKING_CONFIRM">
                    <h2>Current booking</h2>
                    <div class="search_car">
                    <div class="search_car_img" v-bind:style="{ 'background-image': 'url(' + booking.vehicle.images[0] + ')' }">
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
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>£ {{ booking.vehicle.rent }}</h3>
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
                        <li v-for="item in payment_logs"><span>{{item.title}}</span><span>£ {{item.cost}}</span><span>{{date_format(item.due_date)}}</span><span>{{ item.paid?'Paid':'Pending'}}</span></li>
                    </ul>
                </div><!--rent_tabel-->


                <div class="booking_tab">
                    <ul class="nav nav-tabs">
                        <li><a data-toggle="tab" href="#car_inspection">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 25" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#booking_menu"></use>
                            </svg>
                            car inspection
                        </a></li>
                        <li><a data-toggle="tab" href="#extend_cancel">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                            </svg>
                            extend/cancel
                        </a></li>
                        <li><a data-toggle="tab" href="#documents">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use>
                            </svg>
                            documents
                        </a></li>
                        <li><a data-toggle="tab" href="#chat_tab">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                            </svg>
                            chat
                        </a></li>
                    </ul>
                    <div class="tab-content booking_tab_content">
                        <div id="car_inspection" class="tab-pane fade">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#car_front">Front</a></li>
                                <li><a data-toggle="tab" href="#car_rear">Rear</a></li>
                                <li><a data-toggle="tab" href="#car_driver_side">Driver side</a></li>
                                <li><a data-toggle="tab" href="#car_off_side">Off side</a></li>
                                <li><a data-toggle="tab" href="#car_notes">Notes</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="car_front" class="tab-pane fade in active">
                                    <div class="dummy_car">
                                        <img src="images/dummy_car.png" alt="">
                                    </div>
                                    <div class="front_back_size">
                                        <div class="add_description_icon">
                                            <p>add description</p>
                                            <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
								</span>
                                            <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
								</span>
                                            <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#paint_icon"></use>
									</svg>
								</span>
                                        </div>
                                        <p>Scratch 1.2 inches - front door</p>
                                        <p>Bump 0.2 inches rear bumper</p>
                                        <img src="images/car_img_1.png" alt="" />
                                    </div>
                                </div>
                                <div id="car_rear" class="tab-pane fade">
                                    <div class="dummy_car">
                                        <img src="images/dummy_car.png" alt="">
                                    </div>
                                </div>
                                <div id="car_driver_side" class="tab-pane fade">
                                    <div class="dummy_car">
                                        <img src="images/dummy_car.png" alt="">
                                    </div>
                                </div>
                                <div id="car_off_side" class="tab-pane fade">
                                    <div class="dummy_car">
                                        <img src="images/dummy_car.png" alt="">
                                    </div>
                                </div>
                                <div id="car_notes" class="tab-pane fade">
                                    <div class="dummy_car">
                                        <img src="images/dummy_car.png" alt="">
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div id="extend_cancel" class="tab-pane fade">
                            <div class="extend_booking">
                                <div class="extend_booking_content">Extend booking</div>
                                <div class="extend_booking_content">
                                    <div class="book_now_calender">
                                        <p>Select first and last day of booking</p>
                                        <div style="overflow:hidden;">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="datetimepicker12"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="extend_booking_content">Send request</div>
                                <div class="extend_booking_content">Cancel booking</div>
                                <div class="extend_booking_content">
                                    <div class="book_now_calender">
                                        <p>Select first and last day of booking</p>
                                        <div style="overflow:hidden;">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="datetimepicker13"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="extend_booking_content">Reason for early cancelation</div>
                                <div class="extend_booking_content">Send request</div>
                            </div>
                        </div>
                        <div id="documents" class="tab-pane fade">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 20" class="svg-icon">
                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download_icon"></use>
                                                </svg>
                                                Contract
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
							  	  <span>
									  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#edit_icon"></use>
									  </svg>
								  </span>
                                            <h3>This is a title</h3>
                                            <h4>This is a sub-title</h4>
                                            <p>Integer et odio viverra, feugiat ex sed, loborHs sapien. Cras vitae varius urna. Ut nec
                                                libero sed orci iaculis suscipit. Sed sit amet trisHque leo, id mollis ante. Duis ac porta
                                                nunc, non pulvinar leo. Duis ac ex id libero eleifend egestas efficitur a diam. Aenean
                                                eleifend lorem eu ultrices.</p>
                                            <p>Integer et odio viverra, feugiat ex sed, loborHs sapien. Cras vitae varius urna. Ut nec
                                                libero sed orci iaculis suscipit. Sed sit amet trisHque leo, id mollis ante. Duis ac porta
                                                nunc, non pulvinar leo. Duis ac ex id libero eleifend egestas efficitur a diam. Aenean
                                                eleifend lorem eu ultrices.</p>
                                            <p>Integer et odio viverra, feugiat ex sed, loborHs sapien. Cras vitae varius urna. Ut nec
                                                libero sed orci iaculis suscipit. Sed sit amet trisHque leo, id mollis ante. Duis ac porta
                                                nunc, non pulvinar leo. Duis ac ex id libero eleifend egestas efficitur a diam. Aenean
                                                eleifend lorem eu ultrices.</p>
                                            <p>Integer et odio viverra, feugiat ex sed, loborHs sapien. Cras vitae varius urna. Ut nec
                                                libero sed orci iaculis suscipit. Sed sit amet trisHque leo, id mollis ante. Duis ac porta
                                                nunc, non pulvinar leo. Duis ac ex id libero eleifend egestas efficitur a diam. Aenean
                                                eleifend lorem eu ultrices.</p>
                                            <p>Integer et odio viverra, feugiat ex sed, loborHs sapien. Cras vitae varius urna. Ut nec
                                                libero sed orci iaculis suscipit. Sed sit amet trisHque leo, id mollis ante. Duis ac porta
                                                nunc, non pulvinar leo. Duis ac ex id libero eleifend egestas efficitur a diam. Aenean
                                                eleifend lorem eu ultrices.</p>
                                            <p>Integer et odio viverra, feugiat ex sed, loborHs sapien. Cras vitae varius urna. Ut nec
                                                libero sed orci iaculis suscipit. Sed sit amet trisHque leo, id mollis ante. Duis ac porta
                                                nunc, non pulvinar leo. Duis ac ex id libero eleifend egestas efficitur a diam. Aenean
                                                eleifend lorem eu ultrices.</p>
                                            <p>Integer et odio viverra, feugiat ex sed, loborHs sapien. Cras vitae varius urna. Ut nec
                                                libero sed orci iaculis suscipit. Sed sit amet trisHque leo, id mollis ante. Duis ac porta
                                                nunc, non pulvinar leo. Duis ac ex id libero eleifend egestas efficitur a diam. Aenean
                                                eleifend lorem eu ultrices.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 20" class="svg-icon">
                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download_icon"></use>
                                                </svg>
                                                Document A
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
								  <span>
									  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#edit_icon"></use>
									  </svg>
								  </span>
                                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 20" class="svg-icon">
                                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download_icon"></use>
                                                </svg>
                                                Document B
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="panel-body">
								<span>
								  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#edit_icon"></use>
								  </svg>
							    </span>
                                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- panel-group -->
                        </div>
                        <div id="chat_tab" class="tab-pane fade">
                            <div class="chat_contrnt">
                                <div class="send_box">
                                    <p>Integer et odio viverra, feugiat ex sed, loborHs sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis suscipit. Sed sit amet trisHque leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.</p>
                                </div>
                                <span class="chat_date_time">John Doe | 05.06.2017 | 12:30</span>
                                <div class="receve_box">
                                    <p>Integer et odio viverra, feugiat ex sed, loborHs sapien. Cras vitae varius urna. Ut nec libero sed orci iaculis suscipit. Sed sit amet trisHque leo, id mollis ante. Duis ac porta nunc, non pulvinar leo. Duis ac ex id libero eleifend egestas efficitur a diam. Aenean eleifend lorem eu ultrices.</p>
                                </div>
                                <span class="chat_date_time chat_date_time_recive">John Doe | 05.06.2017 | 12:30</span>
                                <div class="chat_btn_wrapper">
                                    <textarea>Your message</textarea>
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#send"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--booking_tab-->



                <h2>Past booking</h2>

                <div v-for="booking in bookings" v-if="booking.status==BOOKING_CLOSED"  class="search_car">
                    <div class="search_car_img past_booking_car" v-bind:style="{ 'background-image': 'url(' + booking.vehicle.images[0] + ')' }">
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
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>£ {{ booking.vehicle.rent }} </h3>
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
                USER_TYPE: User.state.auth.type,
                payment_logs: false,
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
                }).then(this.getWeeklyPayment);

        },

        methods: {
            date_format(date){
                return moment(date).format("D.M.Y");
            },
            getWeeklyPayment(){
                if(active_id[0] !== undefined ){
               return axios.get('/api/booking/'+active_id[0].id+'/payment-weekly')
                    .then(function (response) {
                        $scope.payment_logs = response.data.success;
                    });
                }

            }
        }
    }
</script>
