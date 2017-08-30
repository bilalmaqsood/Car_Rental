<template>
    <div id="car_inspection" class="tab-pane fade active in">
        <div class="spinner-container center-loader" id="centerLoader">
            <div class="spinner-frame">
                <div class="spinner-cover"></div>
                <div class="spinner-bar"></div>
            </div>
        </div>
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
        <input type="file" class="hidden" id="FileUploader" name="">
            <div id="car_front" class="tab-pane fade in active" v-if="menuView=='front'">
                <div class="dummy_car carcondition-img" id="front">

                     <div v-if="isShowable(inspection)" v-for="inspection in inspections.data"   :style="{'top': inspection.x_axis+'%', 'left': inspection.y_axis+'%', 'z-index': 99}" :class="{'return_point': inspection.is_return==1, 'handover_point': inspection.is_return==0, mydraggable: true}">
                        <div id="mydragcontrols">
                            <span v-if="User.state.auth.type=='owner'" id="mydeldrag" style="color: red" @click="deleteSpot(inspection)">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            </span>
                            <span id="mydeldrag" style="color: green" @click="spotAction(inspection)">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>

                    <img src="/images/front.png" alt="" style="margin: 0px;">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon" v-if="User.state.auth.type=='owner'">

<div class="input-group login-input">
                        <input type="text" placeholder="add description" v-model="description" class="form-control">
                    <button v-if="is_return" @click="dispute_status=!dispute_status" class="primary-button">
                     <i v-if="dispute_status" class="fa fa-check "></i>
                      {{ dispute_status==true?'Disputed':'Dispute'}}
                    </button>
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
                            <p>{{content}}</p>
                            <img :src="spot_image" />
                </div>
            </div>

            <div id="car_rear" class="tab-pane fade in active" v-if="menuView=='rear'">
                <div class="dummy_car carcondition-img" id="rear">
                    <div v-if="isShowable(inspection)" v-for="inspection in inspections.data"   :style="{'top': inspection.x_axis+'%', 'left': inspection.y_axis+'%', 'z-index': 99}" :class="{'return_point': inspection.is_return==1, 'handover_point': inspection.is_return==0, mydraggable: true}">
                        <div id="mydragcontrols">
                            <span v-if="User.state.auth.type=='owner'" id="mydeldrag" style="color: red" @click="deleteSpot(inspection)">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            </span>
                            <span id="mydeldrag" style="color: green" @click="spotAction(inspection)">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <img src="/images/rear.png" alt="">
                </div>
                <div class="front_back_size" >
                    <div class="add_description_icon" v-if="User.state.auth.type=='owner'">
                    <button v-if="is_return" @click="dispute_status=!dispute_status" class="primary-button">
                     <i v-if="dispute_status" class="fa fa-check "></i>
                      {{ dispute_status==true?'Disputed':'Dispute'}}
                    </button>
<div class="input-group login-input">
                        <input type="text" class="form-control" placeholder="add description" v-model="description">
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
                <p>{{content}}</p>
                            <img :src="spot_image"  />

                </div>
            </div>

            <div id="car_driver_side" class="tab-pane fade in active" v-if="menuView=='driver_side'">
                <div class="dummy_car carcondition-img" id="driver_side">
                    <div v-if="isShowable(inspection)" v-for="inspection in inspections.data"   :style="{'top': inspection.x_axis+'%', 'left': inspection.y_axis+'%', 'z-index': 99}" :class="{'return_point': inspection.is_return==1, 'handover_point': inspection.is_return==0, mydraggable: true}">
                        <div id="mydragcontrols">
                            <span v-if="User.state.auth.type=='owner'" id="mydeldrag" style="color: red" @click="deleteSpot(inspection)">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            </span>
                            <span id="mydeldrag" style="color: green" @click="spotAction(inspection)">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <img src="/images/driver_side.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon" v-if="User.state.auth.type=='owner'">
<div class="input-group login-input">
                        <input type="text" placeholder="add description" v-model="description" class="form-control">
                        <button v-if="is_return" @click="dispute_status=!dispute_status" class="primary-button">
                     <i v-if="dispute_status" class="fa fa-check "></i>
                      {{ dispute_status==true?'Disputed':'Dispute'}}
                    </button>
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
                    <p>{{content}}</p>
                            <img :src="spot_image"  />
                </div>
            </div>

            <div id="car_off_side" class="tab-pane fade in active" v-if="menuView=='off_side'">
                <div class="dummy_car carcondition-img" id="off_side">
                    <div v-if="isShowable(inspection)" v-for="inspection in inspections.data"   :style="{'top': inspection.x_axis+'%', 'left': inspection.y_axis+'%', 'z-index': 99}" :class="{'return_point': inspection.is_return==1, 'handover_point': inspection.is_return==0, mydraggable: true}">
                        <div id="mydragcontrols">
                            <span v-if="User.state.auth.type=='owner'" id="mydeldrag" style="color: red" @click="deleteSpot(inspection)">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            </span>
                            <span id="mydeldrag" style="color: green" @click="spotAction(inspection)">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <img src="/images/off_side.png" alt="">
                </div>
                <div class="front_back_size">
                    <div v-if="User.state.auth.type=='owner'" class="add_description_icon">
<div class="input-group login-input">
                        <input type="text" class="form-control" placeholder="add description" v-model="description">
                        <button v-if="is_return" @click="dispute_status=!dispute_status" class="primary-button">
                     <i v-if="dispute_status" class="fa fa-check "></i>
                      {{ dispute_status==true?'Disputed':'Dispute'}}
                    </button>
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
                    <p>{{content}}</p>
                            <img :src="spot_image"  />
</div>
                </div>
            </div>

            <div id="car_notes" class="tab-pane fade in active" v-if="menuView=='notes'">
                    <div class="chat_contrnt">
                            <div v-if="isShowable(inspection)" v-for="inspection in inspections.data">
                                <div class="bs-callout bs-callout-danger" id="callout-glyphicons-dont-mix">
                                   <div @click="spotAction(inspection)" class="clickable send_box">
                                      <p>{{ inspection.note}}</p>
                                   </div>
                                   <span class="chat_date_time"></span>
                                  </div>
                            </div>
                    </div>

                
                <div class="front_back_size">
                    <div class="add_description_icon" v-if="User.state.auth.type=='owner'">
<div class="input-group login-input">
                        <input type="text" placeholder="add description" v-model="description" class="form-control">
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
                            <p>{{content}}</p>
                            <img :src="spot_image"  />
                </div>
            </div>

            
        </div>

    </div>
</template>

<script>
    import User from '../user';


    export default {
        props: ['profileHeight','booking'],

        data() {
            return {
                User: User,
                menuView: 'front',
                is_return: false,
                dispute_status: false,
                sportPending: false,
                inspections: {
                    data: [],
                },
                inspection: {
                    data: [],
                },
                description: '',
                content: '',
                X_Axis: '',
                Y_Axis: '',
                spot_image: '',
            };
        },

        mounted() {
            let $scope = this;
            if(this.booking.status>=6){
                this.is_return=true;
            }
            axios.get('/api/booking/'+this.booking.id+'/inspection').then(function (r) {
                $scope.inspections.data = r.data.success;
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
                } else { this.clearSpot(); }
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


                $('#' + spotSide).prepend('<div id="mydraggable" data-drag-id="' + sportNum +'" style="top:50%; left:50%; z-index: 99;" class="mydraggable draggable' + sportNum + '"><div id="mydragcontrols"><span id="myfix" data-drag-id="' + sportNum + '" style="color: green"></span><span id="mydeldrag" style="color: red"><i id="remove" class="fa fa-times" aria-hidden="true"></i></span></div></div>');
                $('.mydraggable').show();
                sportNum++;
                    $('.mydraggable').draggable({
                    containment: 'parent',
                    stop: function ( event, ui ) {
                        console.log(ui);
                        console.log(event);
                        let l = ( 100 * parseFloat($(this).position().left / parseFloat($(this).parent().width())) );
                        let t = ( 100 * parseFloat($(this).position().top / parseFloat($(this).parent().height())) );
                       $scope.X_Axis = t;
                       $scope.Y_Axis = l;
                        $(this).css("left", l+'%');
                        $(this).css("top", t+'%');
                    }
                });

                    $("#remove").on('click', function(event) {
                       $(this).parents("#mydraggable").remove();
                       $scope.sportPending = false;
                    });
                    
                    $scope.sportPending = true;
            },
            
            uploadImage(side){
                let $scope = this;
                $('#FileUploader').click();
                $('#FileUploader').change(function () {
                    
                    console.log(this.files[0]);
                        
                            var reader = new FileReader();
                            reader.readAsDataURL(this.files[0]);
                            var fd = new window.FormData();
                            fd.append('upload', this.files[0]);
                            reader.onload = function (e) {
                                $('#centerLoader').show();
                                axios.post('/api/upload/image',fd).then(function(r){
                                    
                                    $('#FileUploader').val('');
                                    $scope.hideLoader(1000);
                                    $scope.spot_image = r.data.success;
                                });

                            };
                        
                    

                    });
            },
            deleteSpot(spot){
                let $this = this;
                var result = confirm("Are you sure to delete this spot");
                console.log(spot);
                    if(result){
                        axios.delete('/api/booking/'+this.booking.id+'/inspection/'+spot.id).then(function () {
                            let index = $this.inspections.data.indexOf(spot);
                            $this.inspections.data.splice(index,1);
                            new Noty({
                                type: 'success',
                                text: 'Spot delted successfully',
                            }).show();
                        });


                    } else { return false; }
            },
            saveSpots(side){

                if(this.X_Axis=='' && this.menuView!=='notes'){
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
                this.processSpot();
            },
            processSpot(){
                let $this = this;
                let param = {
                    type: this.menuView,
                    status: this.dispute_status===true?1:0,
                    is_return: this.is_return,
                    x_axis: this.X_Axis,
                    y_axis: this.Y_Axis,
                    path: this.spot_image,
                    note: this.description,
                };


                $("#centerLoader").show();
                
                axios.post('/api/booking/'+this.booking.id+'/inspection',{data: [param]}).then(function(r){
                      $this.sportPending = false;
                      $("#remove").click();
                    $this.inspections.data.push(param);
                      new Noty({
                            type: 'success',
                            text: 'Inspection added success',
                        }).show();  
                        $this.clearSpot();
                  })
                .catch(r => {
                    this.clearSpot();
                                new Noty({
                                    type: 'error',
                                    text: r.response.data.error,
                                }).show();
                            
                        });
                $this.hideLoader(1000);
            },
            clearSpot(){
                    this.description = '';
                    this.X_Axis = '';
                    this.Y_Axis = '';
                    this.spot_image = '';
                    $("#remove").click();
            },

            spotAction(inspection){
                this.spot_image = inspection.path;
                this.content = inspection.note;
                this.dispute_status = inspection.status===1?true:false;
            },
            hideLoader(time){
                setTimeout(function () {
                    $('#centerLoader').hide();
                }, time);
            },
            isShowable(inspection){
                return inspection.type==this.menuView;

            },

        }
    }
</script>
