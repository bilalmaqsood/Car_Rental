<template>
    <div id="car_inspection" class="tab-pane fade active in">
        <ul class="nav nav-tabs">
            <li :class="{'active': menuView=='front'}">
            <a @click="changeMenu('front')" href="javascript:void(0)">Front</a></li>
            <li :class="{'active': menuView=='rear'}">
            <a @click="changeMenu('rear')" href="javascript:void(0)">Rear</a></li>
            <li :class="{'active': menuView=='driver_side'}">
            <a @click="changeMenu('driver_side')" href="javascript:void(0)">Driver side</a></li>
            <li :class="{'active': menuView=='off_side'}">
            <a @click="changeMenu('off_side')" href="javascript:void(0)">Off side</a></li>
            <li :class="{'active': menuView=='notes'}">
            <a @click="changeMenu('notes')" href="javascript:void(0)">Notes</a></li>
        </ul>

        <div class="tab-content">
            <div id="car_front" class="tab-pane fade in active" v-if="menuView=='front'">
                <div class="dummy_car carcondition-img" id="front">
                    <img src="images/front.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">

<div class="input-group login-input">
                        <input type="text" palceholder="add description" v-model="description" class="form-control">
<div class="input-group-addon">
<span>
									<svg  @click="saveSpots('front')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
                        </span>
</div>
<div class="input-group-addon">
                        <span>
									<svg @click="uploadImage('front')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
                                    <input type="file" class="hidden" id="frontUploader" name="">
                        </span>
</div>
<div class="input-group-addon">
                        <span>
									<svg :class="{'clickable': !sportPending}" @click="drawSpots('front')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class=" svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#paint_icon"></use>
									</svg>
                        </span>
</div>
</div>

                        
                    </div>

                </div>
            </div>

            <div id="car_rear" class="tab-pane fade in active" v-if="menuView=='rear'">
                <div class="dummy_car carcondition-img" id="rear">
                    <img src="images/rear.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">
<div class="input-group login-input">
                        <input type="text" class="form-control" palceholder="add description" v-model="description">
<div class="input-group-addon">                        
<span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
								</span>
</div>
<div class="input-group-addon">
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
								</span>
</div>
<div class="input-group-addon">
                        <span>
									<svg @click="drawSpots('rear')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class=" clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#paint_icon"></use>
									</svg>
								</span>
</div>
                    </div>
</div>

                </div>
            </div>

            <div id="car_driver_side" class="tab-pane fade in active" v-if="menuView=='driver_side'">
                <div class="dummy_car carcondition-img" id="driver_side">
                    <img src="images/driver_side.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">
<div class="input-group login-input">
                        <input type="text" palceholder="add description" v-model="description" class="form-control">
<div class="input-group-addon"> 
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
								</span>
</div>
<div class="input-group-addon">
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
								</span>
</div>
<div class="input-group-addon">
                        <span>
									<svg @click="drawSpots('driver_side')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class=" clickable svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#paint_icon"></use>
                                    </svg>
								</span>
</div>
                    </div>
                    </div>

                </div>
            </div>

            <div id="car_off_side" class="tab-pane fade in active" v-if="menuView=='off_side'">
                <div class="dummy_car carcondition-img" id="off_side">
                    <img src="images/off_side.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">
<div class="input-group login-input">
                        <input type="text" class="form-control" palceholder="add description" v-model="description">
<div class="input-group-addon">
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
								</span>
</div>
<div class="input-group-addon">
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
								</span>
</div>
<div class="input-group-addon">
                        <span>
									<svg @click="drawSpots('off_side')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class=" clickable svg-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#paint_icon"></use>
                                    </svg>
								</span>
</div>
                    </div> </div>
</div>
                </div>
            </div>

            <div id="car_notes" class="tab-pane fade in active" v-if="menuView=='notes'">
                <div class="dummy_car">
                    <img src="images/dummy_car.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">
<div class="input-group login-input">
                        <input type="text" palceholder="add description" v-model="description" class="form-control">
<div class="input-group-addon">
    <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
								</span>
</div>
<div class="input-group-addon">
  <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
								</span>
</div>

<div class="input-group-addon">

                    
                      
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#paint_icon"></use>
									</svg>
								</span>
</div></div>
                    </div>

                </div>
            </div>

            <div class="hidden spots_area">
                <p>Scratch 1.2 inches - front door</p>
                <p>Bump 0.2 inches rear bumper</p>
                <img src="images/front.png" alt="" />
            </div>
        </div>

    </div>
</template>

<script>



    export default {
        props: ['profileHeight','booking'],

        data() {
            return {
                menuView: 'front',
                sportPending: false,
                description: '',
                X_Axis: '',
                Y_Axis: '',
                spot_image: '',
                inspections: [],
                inspection: {
                type: '',
                data: [],
                }
            };
        },

        mounted() {

        },

        methods: {
             changeMenu(view) {
                if (this.menuView && this.menuView === view)
                    this.menuView = '';
                else
                    this.menuView = view;
            },
            drawSpots(spotSide){

                if (this.sportPending) 
                {

                    new Noty({
                            type: 'warning',
                            text: 'Save old spot before creating new one!',
                        }).show();

                    return false;
                 }


                let GtotalWidth, GtotalHeight;
                let sportNum = 1;
                let $scope = this;

                GtotalWidth = parseInt($('.carcondition-img').width());
                GtotalHeight = parseInt($('.carcondition-img').height());


                $('#' + spotSide).prepend('<div id="mydraggable" data-drag-id="' + sportNum +'" style="top:50%; left:50%; z-index: 99;" class="mydraggable draggable' + sportNum + '"><div id="mydragcontrols"><span id="myfix" data-drag-id="' + sportNum + '" style="color: green"><i class="fa fa-check" aria-hidden="true"></i></span><span id="mydeldrag" style="color: red"><i class="fa fa-times" aria-hidden="true"></i></span></div></div>');
                $('.mydraggable').show();
                sportNum++;
                    $('.mydraggable').draggable({
                    containment: 'parent',
                    stop: function () {
                        let l = ( 100 * parseFloat($(this).position().left / parseFloat($(this).parent().width())) ) + "%" ;
                        let t = ( 100 * parseFloat($(this).position().top / parseFloat($(this).parent().height())) ) + "%" ;
                       $scope.X_Axis = l;
                       $scope.Y_Axis = t;
                        $(this).css("left", l);
                        $(this).css("top", t);
                    }
                });
                    $scope.inspection.type = spotSide;
                    $scope.sportPending = true;
            },
            
            uploadImage(side){
                let $scope = this;
                $('#'+side+'Uploader').click();
                $('#'+side+'Uploader').change(function () {
                        $.map(this.files, function (val) {
                            var reader = new FileReader();
                            reader.readAsDataURL(val);
                            var fd = new window.FormData();
                            fd.append('upload', val);
                            reader.onload = function (e) {
                                axios.post('/api/upload/image',fd).then(function(r){
                                    $scope.spot_image = r.data.success;
                                });

                            };
                        });
                        $('#centerLoader').hide();
                    });
            },
            saveSpots(side){
                if(this.X_Axis=='' || this.Y_Axis==''){
                    new Noty({
                            type: 'warning',
                            text: 'Draw spot first',
                        }).show();
                }

                if(this.description==''){
                    new Noty({
                            type: 'warning',
                            text: 'Enter description',
                        }).show();
                }

                var data = [this.spot_image,this.description,this.X_Axis,this.Y_Axis];
                this.inspection.data[this.inspection.data.length] = data;

                this.processSpot();
            },
            processSpot(){
                let $scope = this;
                axios.post('/api/booking/'+this.booking.id+'/inspection',this.inspection).then(function(r){
                       
                      $scope.inspections.push(r);
                      $scope.sportPending = false;

                });
            },
            clearSpot(){
                    this.inspection.type = '';
                    this.inspection.data = [];
                    this.description = '';
                    this.X_Axis = '';
                    this.Y_Axis = '';
                    this.spot_image = '';
            }
        }
    }
</script>
