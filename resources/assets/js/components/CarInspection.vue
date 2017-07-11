<template>
    <div id="car_inspection" class="tab-pane fade active in">
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
</template>

<script>

    var $scope;

    export default {

        data() {
            return {

            };
        },

        mounted() {
            $scope=this;


        },

        methods: {

        }
    }
</script>
