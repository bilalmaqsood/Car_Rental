<template>
    <div id="car_inspection" class="tab-pane fade active in">
        <div class="spinner-container center-loader" id="centerLoader">
            <div class="spinner-frame">
                <div class="spinner-cover"></div>
                <div class="spinner-bar"></div>
            </div>
        </div>

    <div v-if="confirm_inspection" class="inspection-digits-confirmation">
        <span>Please input the code provided to you by the driver to confirm the vehicle inspection. This confirmation represents the acceptance of both parties that the vehicle inspection has been completes and the contract will start immediately.</span>
        <ul>
            <li>
                <div class="input-group">
                    <input type="text" class="form-control digit" maxlength="1">
                </div>
            </li>
            <li>
                <div class="input-group">
                    <input type="text" class="form-control digit" maxlength="1">
                </div>
            </li>
            <li>
                <div class="input-group">
                    <input type="text" class="form-control digit" maxlength="1">
                </div>
            </li>
            <li>
                <div class="input-group">
                    <input type="text" class="form-control digit" maxlength="1">
                </div>
            </li>
        </ul>
        <button class="btn" @click="confirmInspection">Confirm vehicle inspection</button>
    </div>



    <!-- <div class="agreement-form-wrap agreement-form-wrap-2">
        <p>Contract</p>
        <p>Please check the information below for accuracy and make the necessary amendments.</p>
        <div class="uploader-box">
            <ul>
                <li class="vehicle-details-row1">
                    <div class="form-group">
                        <p>Business name</p>
                        <b>John Doe ltd.</b>
                    </div>
                </li>
                <li>
                    <div class="form-group">
                        <p>Business registration number</p>
                        <b>1234567</b>
                    </div>
                </li>
            </ul>
            <div class="file-uploader-wrap">
                <div class="form-group">
                    <div class="fileUpload">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 98.328 98.329" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#images-upload"></use>
                        </svg>
                        <span>Business logo</span>
                        <input type="file" class="upload">
                    </div>
                </div>
            </div>
        </div>
        <ul>
            <li class="vehicle-details-row1">
                <div class="form-group">
                    <p>Business address</p>
                    <b>1 Fore Street, London, EC2Y 9DT, United Kingdom</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Business e-mail</p>
                    <b>Office@johndeo.co.uk</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Business phone number</p>
                    <b>020 1234 5678</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Vehicle registration number</p>
                    <b>1234567890123</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Vehicle colour</p>
                    <b>Blue</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Vehicle make</p>
                    <b>Ford</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Vehicle mode</p>
                    <b>Galaxy</b>
                </div>
            </li>
            <li class="vehicle-details-row1">
                <div class="form-group">
                    <p>Client name</p>
                    <b>Michael Myers</b>
                </div>
            </li>
            <li class="vehicle-details-row1">
                <div class="form-group">
                    <p>Client address</p>
                    <b>45 King William Street, London, EC4r 9AN, United Kingdom</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Driving license number</p>
                    <b>STANE803108A99RV</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Driving license expiration date</p>
                    <b>13.08.2025</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>PCO license number</p>
                    <b>234567</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>PCO license expiration date</p>
                    <b>10.10.2020</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Refundable deposit value</p>
                    <b>£ 1,234.00</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Deposit paid date</p>
                    <b>01.09.2017</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Agreement start date</p>
                    <b>08.09.2017</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Agreement end date</p>
                    <b>25.10.2017</b>
                </div>
            </li>
            <li class="vehicle-details-row1">
                <div class="form-group">
                    <p>Insurance company name</p>
                    <b>Briliant Insurance ltd.</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Insurance policy number</p>
                    <b>BRIL-123456</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Insurance expiry date</p>
                    <b>13.06.2018</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Weekly rent cost</p>
                    <b>£ 550.00</b>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <p>Insurance excess cost</p>
                    <b>£ 850.00</b>
                </div>
            </li>
        </ul>
        <div class="inlain-black-btn2">
            <ul>
                <li><a href="javascript:void(0)" class="btn">Preview contract</a></li> 
                <li><a href="javascript:void(0)" class="btn">Confirm contract</a></li>
            </ul>
        </div>
    </div> -->


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

                     <div  data-toggle="tooltip" :title="spotTitle(inspection)" v-if="isShowable(inspection)" v-for="inspection in inspections.data"   :style="{'top': inspection.x_axis+'%', 'left': inspection.y_axis+'%', 'z-index': 99}" 
                     :class="soptColor(inspection)">
                        <div id="mydragcontrols">
                            <span v-if="User.state.auth.type=='owner' && inspection.status===CONSTANTS.BOOKING_AMENDED"  id="mydeldrag" style="color: red" @click="approveSpot(inspection)">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            </span>
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
                    <div class="add_description_icon" v-if="(User.state.auth.type=='owner' && [3,6,9,10].includes(booking.status)) || ammending">

<div class="input-group login-input">
                        <input type="text" placeholder="add description" v-model="description" class="form-control">

                        <div class="input-group-addon">
                            <button v-if="is_return && User.state.auth.type=='owner'" @click="dispute_status=!dispute_status" class="primary-button dispute-btn">
                             <i v-if="dispute_status" class="fa fa-check "></i>
                              {{ dispute_status==true?'Disputed':'Dispute'}}
                            </button>
                            
                        </div>
                        <div class="input-group-addon">
                             <button :disabled="!is_disputed" @click="resolveSpot" v-if="is_return && User.state.auth.type=='owner'" class="primary-button dispute-btn">
                             
                              Resolve
                            </button>
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

                     <div class="inlain-black-btn2" v-if="User.state.auth.type=='owner' && booking.status < 4">
                            <ul>
                                <li>
                                    <a class="btn" href="javascript:void(0)" @click="sendInspection">Send inspection to driver</a>
                                </li>
                                <li>
                                    <a class="btn btn-span" href="javascript:void(0)" @click="confirm_inspection = ! confirm_inspection">Confirm vehicle inspection
                                    <span>using the 4-digits code provided by driver</span>
                                    </a>
                                </li>   
                            </ul>
                      </div>
                      <div class="inlain-black-btn2" v-else-if="User.state.auth.type=='client' && [2,3].includes(booking.status)">
                            <ul>
                                <li v-if="!ammending">
                                    <a class="btn" href="javascript:void(0)" @click="ammending=!ammending">Inspection needs ammending</a>
                                </li>
                                <li v-if="ammending">
                                    <a class="btn" href="javascript:void(0)" @click="sendInspection">Send inspection to owner</a>
                                </li>
                                <li>
                                    <a class="btn btn-span" href="javascript:void(0)" @click="confirm_inspection = ! confirm_inspection">Confirm vehicle inspection
                                    <span>using the 4-digits code provided by driver</span>
                                    </a>
                                </li>   
                            </ul>
                      </div>
                      <div v-if="spot_image || content " class="inspection2">
                            <p>{{content}}</p>
                            <img :src="spot_image" />
                      </div>    
                </div>
            </div>

            <div id="car_rear" class="tab-pane fade in active" v-if="menuView=='rear'">
                <div class="dummy_car carcondition-img" id="rear">
                    <div  data-toggle="tooltip" :title="spotTitle(inspection)" v-if="isShowable(inspection)" v-for="inspection in inspections.data"   :style="{'top': inspection.x_axis+'%', 'left': inspection.y_axis+'%', 'z-index': 99}" 
                     :class="soptColor(inspection)">
                        <div id="mydragcontrols">
                            <span v-if="User.state.auth.type=='owner' && inspection.status===CONSTANTS.BOOKING_AMENDED"  id="mydeldrag" style="color: red" @click="approveSpot(inspection)">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            </span>
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

                    <div class="add_description_icon" v-if="(User.state.auth.type=='owner' && [3,6,9,10].includes(booking.status)) || ammending">
                    
<div class="input-group login-input">

                        <input type="text" class="form-control" placeholder="add description" v-model="description">
                        <div class="input-group-addon">
                            <button v-if="is_return && User.state.auth.type=='owner'" @click="dispute_status=!dispute_status" class="primary-button dispute-btn">
                             <i v-if="dispute_status" class="fa fa-check "></i>
                              {{ dispute_status==true?'Disputed':'Dispute'}}
                            </button>
                            
                        </div>
                        <div class="input-group-addon">
                             <button :disabled="!is_disputed" @click="resolveSpot" v-if="is_return && User.state.auth.type=='owner'" class="primary-button dispute-btn">
                             
                              Resolve
                            </button>
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



                      <div class="inlain-black-btn2" v-if="User.state.auth.type=='owner' && booking.status < 4">
                            <ul>
                                <li>
                                    <a class="btn" href="javascript:void(0)" @click="sendInspection">Send inspection to driver</a>
                                </li>
                                <li>
                                    <a class="btn btn-span" href="javascript:void(0)" @click="confirm_inspection = ! confirm_inspection">Confirm vehicle inspection
                                    <span>using the 4-digits code provided by driver</span>
                                    </a>
                                </li>   
                            </ul>
                      </div>
                      <div class="inlain-black-btn2" v-else-if="User.state.auth.type=='client' && [2,3].includes(booking.status)">
                            <ul>
                                <li v-if="!ammending">
                                    <a class="btn" href="javascript:void(0)" @click="ammending=!ammending">Inspection needs ammending</a>
                                </li>
                                <li v-if="ammending">
                                    <a class="btn" href="javascript:void(0)" @click="sendInspection">Send inspection to owner</a>
                                </li>
                                <li>
                                    <a class="btn btn-span" href="javascript:void(0)" @click="confirm_inspection = ! confirm_inspection">Confirm vehicle inspection
                                    <span>using the 4-digits code provided by driver</span>
                                    </a>
                                </li>   
                            </ul>
                      </div>
                      <div v-if="spot_image || content " class="inspection2">
                            <p>{{content}}</p>
                            <img :src="spot_image" />
                      </div> 
                </div>
            </div>

            <div id="car_driver_side" class="tab-pane fade in active" v-if="menuView=='driver_side'">
                <div class="dummy_car carcondition-img" id="driver_side">
                    <div  data-toggle="tooltip" :title="spotTitle(inspection)" v-if="isShowable(inspection)" v-for="inspection in inspections.data"   :style="{'top': inspection.x_axis+'%', 'left': inspection.y_axis+'%', 'z-index': 99}" 
                     :class="soptColor(inspection)">
                        <div id="mydragcontrols">
                            <span v-if="User.state.auth.type=='owner' && inspection.status===CONSTANTS.BOOKING_AMENDED"  id="mydeldrag" style="color: red" @click="approveSpot(inspection)">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            </span>
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
                    <div class="add_description_icon" v-if="(User.state.auth.type=='owner' && [3,6,9,10].includes(booking.status)) || ammending">
<div class="input-group login-input">
                        <input type="text" placeholder="add description" v-model="description" class="form-control">
                        <div class="input-group-addon">
                            <button v-if="is_return && User.state.auth.type=='owner'" @click="dispute_status=!dispute_status" class="primary-button dispute-btn">
                             <i v-if="dispute_status" class="fa fa-check "></i>
                              {{ dispute_status==true?'Disputed':'Dispute'}}
                            </button>
                            
                        </div>
                        <div class="input-group-addon">
                             <button :disabled="!is_disputed" @click="resolveSpot" v-if="is_return && User.state.auth.type=='owner'" class="primary-button dispute-btn">
                             
                              Resolve
                            </button>
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

                      <div class="inlain-black-btn2" v-if="User.state.auth.type=='owner' && booking.status < 4">
                            <ul>
                                <li>
                                    <a class="btn" href="javascript:void(0)" @click="sendInspection">Send inspection to driver</a>
                                </li>
                                <li>
                                    <a class="btn btn-span" href="javascript:void(0)" @click="confirm_inspection = ! confirm_inspection">Confirm vehicle inspection
                                    <span>using the 4-digits code provided by driver</span>
                                    </a>
                                </li>   
                            </ul>
                      </div>
                      <div class="inlain-black-btn2" v-else-if="User.state.auth.type=='client' && [2,3].includes(booking.status)">
                            <ul>
                                <li v-if="!ammending">
                                    <a class="btn" href="javascript:void(0)" @click="ammending=!ammending">Inspection needs ammending</a>
                                </li>
                                <li v-if="ammending">
                                    <a class="btn" href="javascript:void(0)" @click="sendInspection">Send inspection to owner</a>
                                </li>
                                <li>
                                    <a class="btn btn-span" href="javascript:void(0)" @click="confirm_inspection = ! confirm_inspection">Confirm vehicle inspection
                                    <span>using the 4-digits code provided by driver</span>
                                    </a>
                                </li>   
                            </ul>
                      </div>
                      <div v-if="spot_image || content " class="inspection2">
                            <p>{{content}}</p>
                            <img :src="spot_image" />
                      </div>     
                </div>
            </div>

            <div id="car_off_side" class="tab-pane fade in active" v-if="menuView=='off_side'">
                <div class="dummy_car carcondition-img" id="off_side">
                    <div  data-toggle="tooltip" :title="spotTitle(inspection)" v-if="isShowable(inspection)" v-for="inspection in inspections.data"   :style="{'top': inspection.x_axis+'%', 'left': inspection.y_axis+'%', 'z-index': 99}" 
                     :class="soptColor(inspection)">
                        <div id="mydragcontrols">
                            <span v-if="User.state.auth.type=='owner' && inspection.status===CONSTANTS.BOOKING_AMENDED"  id="mydeldrag" style="color: red" @click="approveSpot(inspection)">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            </span>
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
                    <div class="add_description_icon" v-if="(User.state.auth.type=='owner' && [3,6,9,10].includes(booking.status)) || ammending">
                        <div class="input-group login-input">
                                <input type="text" class="form-control" placeholder="add description" v-model="description">
                                    <div class="input-group-addon">
                                        <button v-if="is_return && User.state.auth.type=='owner'" @click="dispute_status=!dispute_status" class="primary-button dispute-btn">
                                         <i v-if="dispute_status" class="fa fa-check "></i>
                                          {{ dispute_status==true?'Disputed':'Dispute'}}
                                        </button>
                            
                                 </div>
                                <div class="input-group-addon">
                                     <button :disabled="!is_disputed" @click="resolveSpot" v-if="is_return && User.state.auth.type=='owner'" class="primary-button dispute-btn">
                                     
                                      Resolve
                                    </button>
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
                        </div> 
                    </div>

                    <div class="inlain-black-btn2" v-if="User.state.auth.type=='owner' && booking.status < 4">
                            <ul>
                                <li>
                                    <a class="btn" href="javascript:void(0)" @click="sendInspection">Send inspection to driver</a>
                                </li>
                                <li>
                                    <a class="btn btn-span" href="javascript:void(0)" @click="confirm_inspection = ! confirm_inspection">Confirm vehicle inspection
                                    <span>using the 4-digits code provided by driver</span>
                                    </a>
                                </li>   
                            </ul>
                      </div>
                      <div class="inlain-black-btn2" v-else-if="User.state.auth.type=='client' && [3,2].includes(booking.status)">
                            <ul>
                                <li v-if="!ammending">
                                    <a class="btn" href="javascript:void(0)" @click="ammending=!ammending">Inspection needs ammending</a>
                                </li>
                                <li v-if="ammending">
                                    <a class="btn" href="javascript:void(0)" @click="sendInspection">Send inspection to owner</a>
                                </li>
                                <li>
                                    <a class="btn btn-span" href="javascript:void(0)" @click="confirm_inspection = ! confirm_inspection">Confirm vehicle inspection
                                    <span>using the 4-digits code provided by driver</span>
                                    </a>
                                </li>   
                            </ul>
                      </div>
                      <div v-if="spot_image || content " class="inspection2">
                            <p>{{content}}</p>
                            <img :src="spot_image" />
                      </div>

                </div>

                </div>
            </div>

            <div id="car_notes" class="tab-pane fade in active" v-if="menuView=='notes'">
                    <div class="chat_contrnt">
                            <div  data-toggle="tooltip" :title="inspection.is_return==1?'Return inspection.':'Handover inspection'" v-if="isShowable(inspection)" v-for="inspection in inspections.data">
                                <div class="bs-callout bs-callout-danger" id="callout-glyphicons-dont-mix">
                                   <div @click="spotAction(inspection)" class="clickable send_box">
                                      <p>{{ inspection.note}}</p>
                                   </div>
                                   <span class="chat_date_time"></span>
                                  </div>
                            </div>
                    </div>

                
                <div class="front_back_size">
                    <div class="add_description_icon" v-if="(User.state.auth.type=='owner' && [3,6,9,10].includes(booking.status)) || ammending">
<div class="input-group login-input">
                        <input type="text" placeholder="add description" v-model="description" class="form-control">
                        <div class="input-group-addon">
                                     <button @click="deleteSpot(inAction)" v-if="inAction && User.state.auth.type=='owner'" class="primary-button dispute-btn">
                                      <i class="glyphicon glyphicon-trash" style="font-size: 20px;"></i>
                                    </button>
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
</div></div>
                    </div>
                     
                     <div class="inlain-black-btn2" v-if="User.state.auth.type=='owner' && booking.status < 4">
                            <ul>
                                <li>
                                    <a class="btn" href="javascript:void(0)" @click="sendInspection">Send inspection to driver</a>
                                </li>
                                <li>
                                    <a class="btn btn-span" href="javascript:void(0)" @click="confirm_inspection = ! confirm_inspection">Confirm vehicle inspection
                                    <span>using the 4-digits code provided by driver</span>
                                    </a>
                                </li>   
                            </ul>
                      </div>
                      <div class="inlain-black-btn2" v-else-if="User.state.auth.type=='client' && [2,3].includes(booking.status)">
                            <ul>
                                <li v-if="!ammending">
                                    <a class="btn" href="javascript:void(0)" @click="ammending=!ammending">Inspection needs ammending</a>
                                </li>
                                <li v-if="ammending">
                                    <a class="btn" href="javascript:void(0)" @click="sendInspection">Send inspection to owner</a>
                                </li>
                                <li>
                                    <a class="btn btn-span" href="javascript:void(0)" @click="confirm_inspection = ! confirm_inspection">Confirm vehicle inspection
                                    <span>using the 4-digits code provided by driver</span>
                                    </a>
                                </li>   
                            </ul>
                      </div>
                      <div v-if="spot_image || content " class="inspection2">
                            <p>{{content}}</p>
                            <img :src="spot_image" />
                      </div>

                </div>
            </div>

            
        </div>

    </div>
</template>

<script>
    import User from '../user';
    import CONSTANTS from '../constants';

    export default {
        props: ['profileHeight','booking'],

        data() {
            return {
                CONSTANTS,
                User: User,
                menuView: 'front',
                is_return: false,
                dispute_status: false,
                sportPending: false,
                confirm_inspection: false,
                ammending: false,
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
                spot_id: '',
                is_disputed: false,
                inAction: false,
            };
        },

        mounted() {
            let $scope = this;
            if(this.booking.status>=6){
                this.is_return=true;
            }
            axios.get('/api/booking/'+this.booking.id+'/inspection').then(function (r) {
                $scope.inspections.data = r.data.success;
                setTimeout(function() { $('[data-toggle="tooltip"]').tooltip(); }, 500);
            })

            $(".digit").keyup(function () {
                  $(this).parents('li').next().find('.digit').focus();
            });
        },

        methods: {
            logit(obj){ console.log(obj) },
            changeMenu(view) {
                let $this = this;
                if(this.sportPending){
                    let result;
                    var n = new Noty({
                  text: '<b>Inspection is pending, do you want to continue ??</b>',
                  timeout: false,
                  buttons: [
                    Noty.button('YES', 'btn btn-success', function () {
                      n.close();
                      $this.clearSpot();
                        $this.sportPending = false;
                        if ($this.menuView && $this.menuView === view)
                            $this.menuView = '';
                        else
                            $this.menuView = view;
                    }, {id: 'button1', 'data-status': 'ok'}),

                    Noty.button('NO', 'btn btn-error', function () {
                            n.close();
                            result=false;
                        })
                     ]
                }).show();
                    if(result==false)
                    return false;
                } else { this.clearSpot(); 
                
                if (this.menuView && this.menuView === view)
                    this.menuView = '';
                else
                    this.menuView = view;
                }
                setTimeout(function() { $('[data-toggle="tooltip"]').tooltip(); }, 100);
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

                $scope.X_Axis = 50;
                $scope.Y_Axis = 50;

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
            procesDelete(spot){
                let $this = this;
                axios.delete('/api/booking/'+this.booking.id+'/inspection/'+spot.id).then(function () {
                            let index = $this.inspections.data.indexOf(spot);
                            $this.inspections.data.splice(index,1);
                            new Noty({
                                type: 'success',
                                text: 'Spot delted successfully',
                            }).show();
                        });
            },
            deleteSpot(spot){
                let $this = this;
                var n = new Noty({
                  text: '<b> Are you sure to delete this spot ??</b>',
                  timeout: false,
                  buttons: [
                    Noty.button('YES', 'btn btn-success', function () {
                      n.close();
                      $this.procesDelete(spot);
                    }, {id: 'button1', 'data-status': 'ok'}),

                    Noty.button('NO', 'btn btn-error', function () {
                            n.close();
                        })
                     ]
                }).show();
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

                if(User.state.auth.type=='client')
                    param.status = CONSTANTS.BOOKING_AMENDED;

                $("#centerLoader").show();
                if(User.state.auth.type=='owner')
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
                else 

                     axios.post('/api/booking/'+this.booking.id+'/amended-inspection',{data: [param]}).then(function(r){
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
                    this.content='';
                    $("#remove").click();
            },

            spotAction(inspection){
                this.spot_image = inspection.path;
                this.content = inspection.note;
                this.dispute_status = inspection.status===1?true:false;
                this.is_disputed = inspection.status===1?true:false;
                this.inAction = inspection;
            },
            hideLoader(time){
                setTimeout(function () {
                    $('#centerLoader').hide();
                }, time);
            },
            isShowable(inspection){
                return inspection.type==this.menuView;

            },
            confirmInspection(){

                var code = new Array();

                $(".digit").each(function(val){
                    code.push($(this).val());
                });
                code = code.join('');
                $('#centerLoader').show();
                 axios.post('/api/booking/'+this.booking.id+'/confirm-inspection',{inspection_code: code})
                 .then(r=>{
                    this.hideLoader(500);
                    this.$parent.$emit("changeView","");
                    new Noty({
                                    type: 'success',
                                    text: r.data.success,
                                }).show();
                 }).catch(r=>{
                    this.hideLoader(500);
                    new Noty({
                                    type: 'error',
                                    text: r.response.data.error,
                                }).show();
                 });

            },
            sendInspection(){

                let url;
                let title;
                if(User.state.auth.type=='client'){
                    url = '/api/booking/'+this.booking.id+'/notify-amendedInspection';
                    title = "Inspection amendment notification sent to owner";
                }

                else if(User.state.auth.type=='owner'){
                    url = '/api/booking/'+this.booking.id+'/notify-driver';
                    title = "Inspection amendment notification sent to driver";
                }

                $('#centerLoader').show();
                axios.post(url).then(()=>{
                    this.hideLoader(500);
                    new Noty({
                        type: 'success',
                        text: title,
                    }).show();

                 });


            },
            soptColor(inspection){
                if(inspection.status==CONSTANTS.BOOKING_AMENDED)                
                    return 'inspection_ammended mydraggable';
                else if(inspection.is_return==0)
                    return 'handover_point mydraggable';
                else if(inspection.is_return==1 && inspection.status==1)
                    return 'disputed_point mydraggable';
                else if(inspection.is_return==1)
                    return 'return_point mydraggable'
            },

            spotTitle(inspection){
                if(inspection.status==CONSTANTS.BOOKING_AMENDED)                
                    return 'Inspection ammended';
                else if(inspection.is_return==0)
                    return 'Handover inspection';
                else if(inspection.is_return==1 && inspection.status==1)
                    return 'Disputed inspection';
                else if(inspection.is_return==1)
                    return 'Return inspection';
            },

            spotControls(){

                
            },
            approveSpot(inspection){
                 let index = this.inspections.data.indexOf(inspection);
                            $('#centerLoader').show();
                axios.patch('/api/booking/'+this.booking.id+'/approve-inspection/'+ inspection.id)
                 .then(r=>{
                    new Noty({
                            type: 'success',
                            text: 'Ammended spot approved',
                        }).show();
                        this.inspections.data.splice(index,1);
                        this.inspections.data.push(r.data.success);
                        this.hideLoader(500);
                 });
            },
            resolveSpot(){
                $('#centerLoader').show();
                axios.patch('/api/booking/'+this.booking.id+'/resolve-inspection/'+ this.inAction.id)
                 .then(r=>{
                    new Noty({
                            type: 'success',
                            text: 'Spot is marked as resolve',
                        }).show();


                        let index = this.inspections.data.indexOf(this.inAction);
                                    this.inspections.data.splice(index,1);
                                    this.inspections.data.push(r.data.success);

                        this.hideLoader(500);
                 });
            },
        }
    }
</script>
