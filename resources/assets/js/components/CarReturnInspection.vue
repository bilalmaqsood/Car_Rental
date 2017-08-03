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

                     <div v-if="front.data.length > 0 " v-for="inspection in front.data"   :style="{'top': inspection[2], 'left': inspection[3], 'z-index': 99}" class="mydraggable  ">
                        <div id="mydragcontrols">
                            <span id="mydeldrag" style="color: red" @click="deleteSpot(inspection)">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>

                    <img src="/images/front.png" alt="" style="margin: 0px;">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">

<div class="input-group login-input">
                        <input type="text" palceholder="add description" v-model="description" class="form-control">
<div class="input-group-addon">
                        <span>
                                    <button @click="front.status=!front.status"> <i v-if="front.status" class="fa fa-check"></i> dispute</button>
                        </span>
</div>
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
                    <div v-if="rear.data.length > 0 " v-for="inspection in rear.data"   :style="{'top': inspection[2], 'left': inspection[3], 'z-index': 99}" class="mydraggable  ">
                        <div id="mydragcontrols">
                            <span id="mydeldrag" style="color: red"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </div>
                    </div>
                    <img src="/images/rear.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">
<div class="input-group login-input">
                        <input type="text" class="form-control" palceholder="add description" v-model="description">
                        <div class="input-group-addon">
                        <span>
                                    <button @click="rear.status=!rear.status"> <i v-if="rear.status" class="fa fa-check"></i> dispute</button>
                        </span>
                        </div>
<div class="input-group-addon">
<span>
									<svg  @click="saveSpots('rear')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
                        </span>
</div>
<div class="input-group-addon">
                        <span>
									<svg @click="uploadImage('rear')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
                                    <input type="file" class="hidden" id="rearUploader" name="">
                        </span>
</div>
<div class="input-group-addon">
                        <span>
									<svg :class="{'clickable': !sportPending}" @click="drawSpots('rear')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class=" svg-icon">
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
                    <div v-if="driver_side.data.length > 0 " v-for="inspection in driver_side.data"   :style="{'top': inspection[2], 'left': inspection[3], 'z-index': 99}" class="mydraggable  ">
                        <div id="mydragcontrols">
                            <span id="mydeldrag" style="color: red"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </div>
                    </div>
                    <img src="/images/driver_side.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">
<div class="input-group login-input">
                        <input type="text" palceholder="add description" v-model="description" class="form-control">
                         <div class="input-group-addon">
                        <span>
                                    <button @click="driver_side.status=!driver_side.status"> <i v-if="driver_side.status" class="fa fa-check"></i> dispute</button>
                        </span>
                        </div>
<div class="input-group-addon">
                        <span>
									<svg  @click="saveSpots('driver_side')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
                        </span>
</div>
<div class="input-group-addon">
                        <span>
									<svg @click="uploadImage('driver_side')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
                                    <input type="file" class="hidden" id="driver_sideUploader" name="">
                        </span>
</div>
<div class="input-group-addon">
                        <span>
									<svg :class="{'clickable': !sportPending}" @click="drawSpots('driver_side')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class=" svg-icon">
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
                    <div v-if="off_side.data.length > 0 " v-for="inspection in off_side.data"   :style="{'top': inspection[2], 'left': inspection[3], 'z-index': 99}" class="mydraggable  ">
                        <div id="mydragcontrols">
                            <span id="mydeldrag" style="color: red"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </div>
                    </div>
                    <img src="/images/off_side.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">
<div class="input-group login-input">
                        <input type="text" class="form-control" palceholder="add description" v-model="description">
                        <div class="input-group-addon">
                        <span>
                                    <button @click="off_side.status=!off_side.status"> <i v-if="off_side.status" class="fa fa-check"></i> dispute</button>
                        </span>
                        </div>
<div class="input-group-addon">
                        <span>
									<svg  @click="saveSpots('off_side')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
                        </span>
</div>
<div class="input-group-addon">
                        <span>
									<svg @click="uploadImage('off_side')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
                                    <input type="file" class="hidden" id="off_sideUploader" name="">
                        </span>
</div>
<div class="input-group-addon">
                        <span>
									<svg :class="{'clickable': !sportPending}" @click="drawSpots('off_side')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class=" svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#paint_icon"></use>
									</svg>
                        </span>
</div>
                    </div> </div>
</div>
                </div>
            </div>

            <div id="car_notes" class="tab-pane fade in active" v-if="menuView=='notes'">
                <div class="dummy_car carcondition-img" >
                    <div v-if="notes.data.length > 0 " v-for="inspection in notes.data"   :style="{'top': inspection[2], 'left': inspection[3], 'z-index': 99}" class="mydraggable  ">
                        <div id="mydragcontrols">
                            <span id="mydeldrag" style="color: red"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </div>
                    </div>
                    <img src="/images/front.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">
<div class="input-group login-input">
                        <input type="text" palceholder="add description" v-model="description" class="form-control">
                        <div class="input-group-addon">
                        <span>
                                    <button @click="notes.status=!notes.status"> <i v-if="notes.status" class="fa fa-check"></i> dispute</button>
                        </span>
                        </div>
<div class="input-group-addon">
    <span>
									<svg  @click="saveSpots('notes')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
                        </span>
</div>
<div class="input-group-addon">
  <span>
									<svg @click="uploadImage('notes')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
                                    <input type="file" class="hidden" id="notesUploader" name="">
                        </span>
</div>

<div class="input-group-addon">



                        <span>
									<svg :class="{'clickable': !sportPending}" @click="drawSpots('notes')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class=" svg-icon">
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
                <img src="/images/front.png" alt="" />
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
                front: { type: '',status: false,data: [] },
                rear: { type: '',status: false,data: [] },
                driver_side: { type: '',status: false,data: [] },
                off_side: { type: '', status: false,data: [] },
                notes: { type: '',status: false,data: [] },
            };
        },

        mounted() {
            console.log(this.booking);
            let $scope = this;
            axios.get('/api/booking/'+this.booking.id+'/return').then(function (r) {
                console.log('all inspections');
                for (let value of r.data.success) {
                    console.log(value);
                    $scope[value.type] = value;
                }
            })
        },

        methods: {
            logit(obj){ console.log(obj) },
            changeMenu(view) {
                if(this.sportPending){
                    var result = confirm("Inspection is pending, do you want to contnue");
                    if(result){
                        this.clearSpot();
                        this.sportPending = false;
                    } else { return false; }
                }
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
                    stop: function ( event, ui ) {
                        console.log(ui);
                        console.log(event);
                        let l = ( 100 * parseFloat($(this).position().left / parseFloat($(this).parent().width())) ) + "%" ;
                        let t = ( 100 * parseFloat($(this).position().top / parseFloat($(this).parent().height())) ) + "%" ;
                       $scope.X_Axis = t;
                       $scope.Y_Axis = l;
                        $(this).css("left", l);
                        $(this).css("top", t);
                    }
                });
                    $scope[$scope.menuView].type = spotSide;
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
            deleteSpot(spot){
                var result = confirm("Are you sure to delete this spot");
                    if(result){
                     let index = this[this.menuView].data.indexOf(spot);
                        this[this.menuView].data.splice(index,1);
                        this.processSpot();
                    } else { return false; }
            },
            saveSpots(side){

                if(this.X_Axis=='' || this.Y_Axis==''){
                    new Noty({
                            type: 'warning',
                            text: 'Draw spot first',
                        }).show();
                    return false;
                }

                if(this.description==''){
                    new Noty({
                            type: 'warning',
                            text: 'Enter description',
                        }).show();
                    return false;
                }

                var data = [this.spot_image,this.description,this.X_Axis,this.Y_Axis];

                if(this[this.menuView].status)
                    this[this.menuView].status = 2;
                    else
                    delete this[this.menuView].status;

                 if(data) this[this.menuView].data.push(data);
                data = null;

                this.processSpot();
//                $scope.clearSpot();
            },
            processSpot(){
                let $scope = this;
                console.log(this[this.menuView]);
                axios.post('/api/booking/'+this.booking.id+'/return',this[this.menuView]).then(function(r){
                      $scope.sportPending = false;
                      console.log(r);
                      console.log("it done");
                });
            },
            clearSpot(){
                    this.description = '';
                    this.X_Axis = '';
                    this.Y_Axis = '';
                    this.spot_image = '';
            },

        }
    }
</script>
