<template>
    <div class="tab-content booking_tab_content">
        <div id="car_inspection" class="tab-pane fade active in">
            <div class="spinner-container center-loader" id="centerLoader">
                <div class="spinner-frame">
                    <div class="spinner-cover"></div>
                    <div class="spinner-bar"></div>
                </div>
            </div>
            <div class="vehicle_registration vehicle_registration_3">
                <div class="vehicle-registration-slider">
                    <div class="owl-carousel owl-slider">
                        <div class="item"><img src="/images/hero-img.jpg" alt=""></div>
                        <div class="item"><img src="/images/hero-img.jpg" alt=""></div>
                        <div class="item"><img src="/images/hero-img.jpg" alt=""></div>
                        <div class="item"><img src="/images/hero-img.jpg" alt=""></div>
                        <div class="item"><img src="/images/hero-img.jpg" alt=""></div>
                    </div><!--owl-slider-->
                    <button class="registration-slider-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#delete_icon"></use></svg>
                    </button>
                </div>
                <div class="card_recured">
                    <ul>
                        <li class="vehicle-details-row1">

                            <div class="form-group" :class="{'has-error': $v.form.registration_number.$error}">
                                <div class="input-group login-input">
                                <input type="text" class="form-control" placeholder="add more pictures"
                                       v-model="form.registration_number" @blur="$v.form.registration_number.$touch()">
                                       <div class="input-group-addon">
                                        <span @click="verifyByAVLA" class="clickable">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use></svg>
                                        </span>
                                    </div>
                                </div>
                                <p class=" help-block text-sm" v-if="$v.form.registration_number.$error">
                                    add more pictures</p>
                            </div>

                        </li>
                        <li class="vehicle-details-row1">
                            <div class="form-group" :class="{'has-error': $v.form.make.$error}">
                                <input type="text" class="form-control" placeholder="current mileage" v-model="form.make"
                                       @blur="$v.form.make.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.make.$error">
                                    current mileage</p>
                            </div>
                        </li>
                        <li class="vehicle-details-row1">
                            <div class="form-group" :class="{'has-error': $v.form.model.$error}">
                                <input type="text" class="form-control" placeholder="next service mileage" v-model="form.model"
                                       @blur="$v.form.model.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.model.$error">
                                    next service mileage</p>
                            </div>
                        </li>                        
                        <li class="vehicle-details-row1 vehicle-details-row3">
                            <div class="form-group">
                                <div class="input-group login-input">
                                <input type="text" class="form-control" placeholder="fuel type">
                                       <div class="input-group-addon">
                                        <span class="clickable">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29" class="svg-icon">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#add_icon"></use>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <p class=" help-block text-sm" v-if="$v.form.registration_number.$error">
                                    fuel type</p>
                            </div>
                        </li>
                        <li class="vehicle-details-row1 vehicle-details-row3">
                            <div class="form-group" :class="{'has-error': $v.form.mpg.$error}">
                                <input type="text" class="form-control" placeholder="mpg" v-model="form.mpg"
                                       @blur="$v.form.mpg.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.mpg.$error">Enter mpg </p>
                            </div>
                        </li>
                        <li class="vehicle-details-row1 vehicle-details-row3">
                            <div class="form-group" :class="{'has-error': $v.form.mpg_eco.$error}">
                                <input type="text" class="form-control" placeholder="mpg (economy)"
                                       v-model="form.mpg_eco" @blur="$v.form.mpg_eco.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.mpg_eco.$error">Enter mpg(economy) </p>

                            </div>
                        </li>
                        <li class="vehicle-details-row1 vehicle-details-row2 half-group">
                            <div class="form-group" :class="{'has-error': $v.form.seats.$error}">
                                <button @click="selectSeats('5')" class="btn btn-block seats-button"
                                        :class="{'btn-selected': form.seats=='5' }">5 seats
                                </button>
                                <p class=" help-block text-sm" v-if="$v.form.seats.$error">Enter vehicle seats </p>

                            </div>
                        </li>
                        <li class="vehicle-details-row1 vehicle-details-row2 half-group">
                            <div class="form-group" :class="{'has-error': $v.form.seats.$error}">
                                <button @click="selectSeats('7')" class="btn btn-block seats-button"
                                        :class="{'btn-selected': form.seats=='7' }">7 seats
                                </button>
                                <p class=" help-block text-sm" v-if="$v.form.seats.$error">Enter vehicle seats </p>

                            </div>
                        </li>
                        <li class="vehicle-details-row1">
                            <div class="form-group" :class="{'has-error': $v.form.pickup_location.$error}">

                                <div class="input-group login-input">
                                    <input type="text" class="form-control" placeholder="availability"
                                           id="pickup_location" @blur="$v.form.pickup_location.$touch()">
                                    <div class="input-group-addon">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <p class=" help-block text-sm" v-if="$v.form.pickup_location.$error">
                                    Enter availability</p>
                            </div>
                        </li>
                        <li class="vehicle-details-row1">
                            <div class="form-group" :class="{'has-error': $v.form.return_location.$error}">


                                <div class="input-group login-input">
                                    <input type="text" class="form-control" placeholder="pickup location"
                                           id="return_location" @blur="$v.form.return_location.$touch()">
                                    <div class="input-group-addon">
                                        <span>
                                            <svg @click="showLocationPicker('return_location')"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20"
                                                 class="svg-icon">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     xlink:href="#lcotion_icon"></use>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <p class=" help-block text-sm" v-if="$v.form.return_location.$error">
                                    Enter rpickup location</p>
                            </div>
                        </li>
                        <li class="vehicle-details-row1">
                            <div class="form-group" :class="{'has-error': $v.form.location.$error}">

                                <div class="input-group login-input">
                                    <input type="text" class="form-control"
                                           placeholder="return location" id="location"
                                           @blur="$v.form.location.$touch()">
                                    <div class="input-group-addon">
                                        <span>
                                            <svg @click="showLocationPicker('location')"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20"
                                                 class="svg-icon">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     xlink:href="#lcotion_icon"></use>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <p class=" help-block text-sm" v-if="$v.form.location.$error">
                                    Enter return location </p>
                            </div>
                        </li>
                        <li class="vehicle-details-row1">
                            <div class="form-group" :class="{'has-error': $v.form.rent.$error}">
                                <input type="text" class="form-control" placeholder="rental cost/week"
                                       v-model="form.rent" @blur="$v.form.rent.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.rent.$error">Rent per week</p>
                            </div>
                        </li>
                        <li class="vehicle-details-row1">
                            <div class="form-group" :class="{'has-error': $v.form.insurance.$error}">
                                <input type="text" class="form-control" placeholder="insurance cost/week"
                                       v-model="form.insurance" @blur="$v.form.insurance.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.insurance.$error">
                                    Enter vehicle insurance </p>

                            </div>
                        </li>
                        <li class="vehicle-details-row1">
                            <div class="form-group" :class="{'has-error': $v.form.mile_cap.$error}">
                                <input type="text" class="form-control" placeholder="deposit"
                                       v-model="form.mile_cap" @blur="$v.form.mile_cap.$touch()">
                                <p class=" help-block text-sm" v-if="$v.form.mile_cap.$error">
                                    Enter deposit</p>

                            </div>
                        </li>
                        <li class="vehicle-details-row1">

                            <div class="form-group">
                                <div class="input-group login-input">
                                    <input type="text" class="form-control" placeholder="discounts">
                                    <div class="input-group-addon">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#add_icon"></use></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </li>
                        <li class="vehicle-details-row1">
                            <div class="form-group">
                                <div class="input-group login-input">
                                    <input type="text" class="form-control" placeholder="booking restrictions">
                                    <div class="input-group-addon">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#add_icon"></use></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="vehicle-details-row1">
                            <div class="form-group">
                                <div class="input-group login-input">
                                    <input type="text" class="form-control" placeholder="Vehicle registration document">
                                    <div class="input-group-addon">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cloud-computing"></use></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="vehicle-details-row1">
                            <div class="form-group">
                                <div class="input-group login-input">
                                    <input type="text" class="form-control" placeholder="Latest service certificate">
                                    <div class="input-group-addon">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cloud-computing"></use></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="vehicle-details-row1">
                            <div class="form-group">
                                <div class="input-group login-input">
                                    <input type="text" class="form-control" placeholder="MOT certificate">
                                    <div class="input-group-addon">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cloud-computing"></use></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="vehicle-details-row1">
                            <div class="form-group">
                                <div class="input-group login-input">
                                    <input type="text" class="form-control" placeholder="othet document name">
                                    <div class="input-group-addon">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cloud-computing"></use></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="vehicle-details-row1">
                            <button class="add-new-vehile-btn">Done</button>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <update-documents :doc="doc" :title="'Update vehicle documents'" @modelHiding="hideModal" @docUpdate="docUpdated"></update-documents> 
        <location-coordinates-picker :location="location"
                                     @locationEvent="saveLocationCoordinates" ></location-coordinates-picker>
    </div>
</template>
<script>

    import Local from '../local';
    import {Boolean} from '../validators';
    import {required, minLength, maxLength, between} from 'vuelidate/lib/validators';
    import User from '../user';
    import Form from '../vehicle-fields';

    var $scope;
    export default {
        props: ['profileHeight', 'vehicle', 'isEdit'],

        data() {
            return {
                User: User,
                location: '',
                selectedLocation: '',
                week: '',
                percent: '',
                doc: false,
                form: JSON.parse(JSON.stringify(Form)),
            };
        },

        validations: {
            form: {
                make: {
                    required,
                    minLength: minLength(1)
                },
                model: {
                    required,
                    minLength: minLength(1),
                    
                },
                variant: {
                    required,
                    minLength: minLength(1)
                },
                year: {
                    required,
                    minLength: minLength(1)
                },
                mileage: {
                    required,
                    minLength: minLength(1)
                },
                fuel: {
                    required,
                    minLength: minLength(1)
                },
                mpg: {
                    required,
                    minLength: minLength(1)
                },
                mpg_eco: {
                    required,
                    minLength: minLength(1)
                },
                transmission: {
                    required,
                    minLength: minLength(1)
                },
                seats: {
                    required,
                    minLength: minLength(1)
                },
                available_from: {
                    minLength: minLength(1)
                },
                available_to: {
                    required,
                    minLength: minLength(1)
                },
                pickup: {
                    required,
                    minLength: minLength(1)
                }, delivery: {
                    required,
                    minLength: minLength(1)
                },

                pickup_location: {
                    required,
                    minLength: minLength(1)
                },
                return_location: {
                    required,
                    minLength: minLength(1)
                },
                location: {
                    required,
                    minLength: minLength(1)
                },
                delivery_charges: {
                    required,
                    minLength: minLength(1)
                },
                rent: {
                    required,
                    minLength: minLength(1)
                },
                insurance: {
                    required,
                    minLength: minLength(1)
                },
                mile_cap: {
                    required,
                    minLength: minLength(1)
                },
                after_mile: {
                    required,
                    minLength: minLength(1)
                },
                deposit: {
                    required,
                    minLength: minLength(1)
                },

                extension: {
                    required,
                    minLength: minLength(1)
                },
                license_years: {
                    required,
                    minLength: minLength(1)
                },
                pco_years: {
                    required,
                    minLength: minLength(1)
                },
                driver_year: {
                    required,
                    minLength: minLength(1)
                },
                license_points: {
                    required,
                    minLength: minLength(1)
                },
                no_fault_accident: {
                    required,
                    minLength: minLength(1)
                },
                fault_accident: {
                    required,
                    minLength: minLength(1)
                },
                notes: {
                    required,
                    minLength: minLength(1)
                },
                registration_number: {
                    required,
                    minLength: minLength(1)
                },
                images: {
                    required,
                    minLength: minLength(1)
                },
            }
        },
        created: function() {
            this.$on("modelHiding",this.hideModal);
        },
        watch: {
            vehicle: function (val, oldVal) {
                if (this.isEdit) {
                    this.form = JSON.parse(JSON.stringify(Form));
                    this.form = val;
                    this.updateLocationNames();
                }
            },
            isEdit: function(val, oldVal){
                if (val) {
                    this.form = JSON.parse(JSON.stringify(Form));
                    this.form = this.vehicle;
                    this.updateLocationNames();
                } else {
                   this.form = JSON.parse(JSON.stringify(Form)); 
                }
                this.prepareComponent();
            }

        },
        mounted() {
            $scope = this;
            if (this.isEdit) {
                this.form = JSON.parse(JSON.stringify(Form));
                this.form = this.vehicle;
                this.updateLocationNames();
            }
            $(".owl-slider").owlCarousel({
                items: 1,
                margin: 0,
                navigation: false,
                autoplay:true,
            });
            this.prepareComponent();
        },

        methods: {
            processForm() {
                $scope.postForm();
            },
            postForm() {
                if (this.isEdit) {
                    axios.patch('/api/vehicle/' + this.form.id, this.prepareForm())
                        .then(this.responseHandler);
                } else {
                    axios.post('/api/vehicle', this.prepareForm())
                        .then(this.responseHandler);
                }
            },
            responseHandler(response) {
                this.form = JSON.parse(JSON.stringify(Form));
                if (this.isEdit)
                    this.$parent.$emit('vehicleUpdate', response.data.success);
                else
                    this.$parent.$emit('vehicleAdded', response.data.success);
            },
            prepareForm() {
                let input = this.form;
                if (this.isEdit) {
                        delete input.id;
                        delete input.uber_discount;

                }
                return input;
            },
            push() {
                let count = $scope.form.discounts.length + 1;
                $scope.form.discounts.push({week: count, percent: $scope.percent});
                $scope.percent = '';
                $scope.week = '';
                count = '';
            },
            pop(discount) {
                $scope.form.discounts.splice($scope.form.discounts.indexOf(discount), 1);
                $scope.reCalculate();
            },
            reCalculate() {
                var discounts = [];
                $scope.form.discounts.map(function (value, key) {
                    discounts.push({week: key + 1, percent: value.percent});
                });
                $scope.form.discounts = discounts;
            },
            imagesResponse(r) {
                this.form.images.push(r.data.success);
            },

            prepareComponent() {
                let $this = this;

                $('.registration_year').datetimepicker({
                    format: 'YYYY',
                    viewMode: 'years',
                    maxDate: moment(new Date())
                }).on('dp.change', function (e) {
                    $scope.form.year = $(".registration_year").val();
                    $scope.checkSeriveDoc(e);
                });


                $("#documents").click(function () {
                    $(".documentsUpload").click();
                    $(".documentsUpload").change(function () {
                        $('#sideLoader').show();
                        $.map(this.files, function (val) {

                            var reader = new FileReader();
                            let name = val.name.substring(0, val.name.lastIndexOf('.'));
                            let type = val.name.split('.').pop();
                            reader.readAsDataURL(val);
                            var fd = new window.FormData();
                            fd.append('upload', val);
                            reader.onload = function (e) {
                                axios.post('/api/upload/document', fd).then((r) => {
                                    $this.form.documents.push({
                                         name: name,
                                         title: name,
                                         path: r.data.success,
                                         type: type
                                     });
                                });
                            };
                        });
                        setTimeout(function() { $('#sideLoader').hide(); }, 500);
                    });
                    
                });

                $("#uploadImages").click(function () {
                    $(".hiddenUpload").click();
                    $(".hiddenUpload").change(function () {
                        $('#sideLoader').show();
                        $.map(this.files, function (val) {
                            var reader = new FileReader();
                            reader.readAsDataURL(val);
                            var fd = new window.FormData();
                            fd.append('upload', val);
                            reader.onload = function (e) {
                                axios.post('/api/upload/image', fd).then($scope.imagesResponse);
                            };
                        });
                    setTimeout(function() { $('#sideLoader').hide(); }, 500);
                    });
                });

            },
            showLocationPicker(obj) {
                this.selectedLocation = obj;
                this.location = this.form[obj];
                $('#myModal').appendTo("body").modal('show');
            },
            saveLocationCoordinates(response) {
                var $this = this;
                FetchLocationName(response, null, function (result) {
                    $("#" + $this.selectedLocation).val(result);
                });
                this.form[this.selectedLocation] = response;
            },
            verifyByAVLA() {
                let param = {registration_number: this.form.registration_number}
                $('#sideLoader').show();
                axios.post('/api/driver-and-vehicle-licensing-agency', param)
                    .then((r) => {
                        setTimeout(function() { $('#sideLoader').hide(); }, 500);
                        if (r.data.success.Response.DataItems.VehicleRegistration) {
                            this.form.year = r.data.success.Response.DataItems.VehicleRegistration.YearOfManufacture;
                            this.form.make = r.data.success.Response.DataItems.VehicleRegistration.Make;
                            this.form.model = r.data.success.Response.DataItems.VehicleRegistration.Model;
                        } else {
                            new Noty({
                                type: 'warning',
                                text: 'Vehicle registration number not found.'
                            }).show();
                        }
                    });
            },
            selectSeats(value) {
                this.form.seats = value;
            },
            updateLocationNames(){
                    FetchLocationName(this.form.pickup_location, null, function (result) {
                        $("#pickup_location").val(result);
                    });

                     FetchLocationName(this.form.return_location, null, function (result) {
                        $("#return_location").val(result);
                    });

                     FetchLocationName(this.form.location, null, function (result) {
                        $("#location").val(result);
                    });
            },
           upload(obj){
                let $this = this;
                $(".docUploader").click();
                    $(".docUploader").change(function () {
                        $('#sideLoader').show();
                        $.map(this.files, function (val) {
                           
                            obj.name = val.name.substring(0, val.name.lastIndexOf('.'));
                            obj.type = val.name.split('.').pop();
                            var reader = new FileReader();
                            reader.readAsDataURL(val);
                            var fd = new window.FormData();
                            fd.append('upload', val);
                            reader.onload = function (e) {
                                axios.post('/api/upload/document', fd).then(function(r){
                                    obj.path = r.data.success;
                                    $(".docUploader").val("");
                                });
                            }
                        });
                         setTimeout(function() { $('#sideLoader').hide(); }, 500);

                    });

                   
            },
            edit(doc){
                this.doc = doc;
                $('#updateModel').modal('show');
                
            },
            deleteDocument(doc){
            
                if(doc.doc){
                    doc.path = null;
                    doc.name = null;
                    doc.type = null;
                } else{
                this.form.documents.splice(this.form.documents.indexOf(doc), 1);
                }
            },
            docUpdated(newDoc){

            },
            hideModal(){
               this.doc = false;
               console.log("calling thisss");
               $('#updateModel').modal('hide');
               
            },

            checkSeriveDoc(e){
                   let $this = this;
                    let doc = {title: 'Last service certificate', name:'',path: '',type: '', doc: 'Last_service_certificate', status: '' };
                    let input = $(e.target).val();
                if(input.length==4){
                    let currentYear = new Date().getFullYear();
                        if(currentYear - input >= 2 ){
                                this.form.documents.push(doc);
                        } else {
                            $this.form.documents.filter(function (val) {
                                if(JSON.stringify(val) == JSON.stringify(doc))
                                    $this.form.documents.splice($this.form.documents.indexOf(val), 1); 
                                   
                                });
                        }
                }

            }
        }

    }
</script>
