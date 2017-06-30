@extends('layouts.web-layout')

@section('content')
    <div class="slide_wrapper">
        <div class="top_location">
            <vehicles-search-form></vehicles-search-form>
        </div>
    </div>

    <div class="vehicles_tabs">
        <h2>Top vehicles</h2>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#by_location" aria-controls="by_location" role="tab" data-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                    </svg>
                    by location
                </a>
            </li>
            <li role="presentation">
                <a href="#by_price" aria-controls="by_price" role="tab" data-toggle="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                    </svg>
                    by price
                </a>
            </li>
            <li role="presentation">
                <a href="#by_rating" aria-controls="by_rating" role="tab" data-toggle="tab">
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    by rating
                </a>
            </li>
        </ul>


        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="by_location">
                <div class="main_vehicles_container">

                    <div class="main_vehicles">
                        <div class="owl-carousel owl-slider">
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                        </div>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li>
                                <p>Year: 2015 </p>
                                <p>Mileage: 35,044</p>
                            </li>
                            <li>
                                <p>Seats: 5 </p>
                                <p>Transmission: manual</p>
                            </li>
                            <li>
                                <p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p>
                            </li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <div class="owl-carousel owl-slider">
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                        </div>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <div class="owl-carousel owl-slider">
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                        </div>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <div class="owl-carousel owl-slider">
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                        </div>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <div class="owl-carousel owl-slider">
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                        </div>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <div class="owl-carousel owl-slider">
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                            <div class="item"><img src="{!! url("/images/car_img.png") !!}" alt=""></div>
                        </div>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="by_price">

                <div class="main_vehicles_container">

                    <div class="main_vehicles">
                        <img src="{!! url("/images/car_img.png") !!}" alt=""/>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <img src="{!! url("/images/car_img.png") !!}" alt=""/>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <img src="{!! url("/images/car_img.png") !!}" alt=""/>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <img src="{!! url("/images/car_img.png") !!}" alt=""/>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <img src="{!! url("/images/car_img.png") !!}" alt=""/>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <img src="{!! url("/images/car_img.png") !!}" alt=""/>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <div role="tabpanel" class="tab-pane" id="by_rating">

                <div class="main_vehicles_container">

                    <div class="main_vehicles">
                        <img src="{!! url("/images/car_img.png") !!}" alt=""/>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <img src="{!! url("/images/car_img.png") !!}" alt=""/>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <img src="{!! url("/images/car_img.png") !!}" alt=""/>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <img src="{!! url("/images/car_img.png") !!}" alt=""/>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <img src="{!! url("/images/car_img.png") !!}" alt=""/>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_vehicles">
                        <img src="{!! url("/images/car_img.png") !!}" alt=""/>
                        <h3>Toyota Prius 1.8 Hybrid</h3>
                        <ul>
                            <li><p>Year: 2015 </p>
                                <p>Mileage: 35,044</p></li>
                            <li><p>Seats: 5 </p>
                                <p>Transmission: manual</p></li>
                            <li><p>Fuel type: hybrid </p>
                                <p>Consumption: 95.2 mpg (ec.)</p></li>
                        </ul>
                        <div class="availablity_box">
                            <div class="availabe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                </svg>
                                <p>available from: <span>now</span></p>
                            </div>
                            <div class="availabe_item_price">
                                <h3>&pound; 320</h3>
                                <span>/week</span>
                                <span>insurance included</span>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

    <div class="about_section_wrapper">
        <h2>About Qwik<span>k</span>ar</h2>
        <div class="about_content_section">
            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis convallis iactulis commodo. Nam augue lacus, tempor id metus sed, dignissim imperdiet nunc. Cras preEum
                tellus sit amet congue vehicula. Nunc commodo molesEe elit at consectetur. Fusce varius justo sed sagiHs consequat. Nulla eget lacus id odio Encidunt mollis gravida
                sagiHs enim. Duis preEum nulla augue, pulvinar placerat nulla consectetur ut. Nulla vitae purus ante. Praesent nec dui nunc. Suspendisse potenE.</p>
            <p>Nunc volutpat vehicula erat at facilisis. Quisque congue et turpis non maHs. Quisque egestas eleifend purus, eu finibus magna. In cursus fringilla leo consequat sollicitudin.
                Nunc in massa orci. Aenean pulvinar egestas rutrum. Aliquam elit libero, porta ac neque ut, fringilla laoreet lectus. Sed ut metus vitae risus iaculis vulputate. Curabitur
                preEum turpis nec velit commodo, nec egestas quam fringilla. Cras molesEe turpis eu lacus fringilla sodales. EEam a vesEbulum felis. Suspendisse laoreet dignissim nibh in
                posuere. Aenean a nisl dignissim, hendrerit magna vitae, interdum nisi. Suspendisse volutpat tortor vel libero dignissim, a viverra ex gravida.</p>
        </div>
    </div>

    <div class="get_intuch_wrapper">
        <div class="getin_touch_section">

            <h2>Get in touch</h2>

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#contact_us" aria-controls="contact_us" role="tab" data-toggle="tab">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#send"></use>
                        </svg>
                        contact us
                    </a></li>
                <li role="presentation"><a href="#report_issue" aria-controls="report_issue" role="tab" data-toggle="tab">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#issue"></use>
                        </svg>
                        report issue
                    </a></li>
                <li role="presentation"><a href="#faqs_tab" aria-controls="faqs_tab" role="tab" data-toggle="tab">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="svg-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#info_icon"></use>
                        </svg>
                        FAQs
                    </a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="contact_us">
                    <div class="contact_form">
                        <form class="form-inline">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
                                    </svg>
                                    <input type="text" class="form-control" placeholder="full name">
                                </div>
                                <div class="form-group">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 25" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#form_envelope"></use>
                                    </svg>
                                    <input type="email" class="form-control" placeholder="e-mail">
                                </div>
                                <div class="form-group">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 25" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#mobile"></use>
                                    </svg>
                                    <input type="text" class="form-control" placeholder="phone number">
                                </div>
                                <div class="form-group">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#sign_contract_icon"></use>
                                    </svg>
                                    <input type="text" class="form-control" placeholder="subject">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" class="svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chat"></use>
                                    </svg>
                                    <textarea placeholder="your message"></textarea>
                                </div>
                                <button type="submit" class="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="report_issue">
                    <p>Nunc volutpat vehicula erat at facilisis. Quisque congue et turpis non maHs. Quisque egestas eleifend purus, eu finibus magna. In cursus fringilla leo consequat sollicitudin. Nunc in massa orci. Aenean pulvinar egestas rutrum. Aliquam elit libero, porta ac neque ut, fringilla laoreet lectus. Sed ut metus vitae risus iaculis vulputate. Curabitur preEum turpis nec velit commodo, nec egestas quam fringilla. Cras molesEe turpis eu lacus fringilla sodales. EEam a vesEbulum
                        felis.
                        Suspendisse laoreet dignissim nibh in posuere. Aenean a nisl dignissim, hendrerit magna vitae, interdum nisi. Suspendisse volutpat tortor vel libero dignissim, a viverra ex gravida.</p>
                </div>
                <div role="tabpanel" class="tab-pane" id="faqs_tab">
                    <p>Nunc volutpat vehicula erat at facilisis. Quisque congue et turpis non maHs. Quisque egestas eleifend purus, eu finibus magna. In cursus fringilla leo consequat sollicitudin. Nunc in massa orci. Aenean pulvinar egestas rutrum.</p>
                </div>
            </div>

        </div>
    </div>
@endsection
