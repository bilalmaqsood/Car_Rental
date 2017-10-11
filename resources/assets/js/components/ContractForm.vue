<template>
    <div>
    <div class="agreement-form-wrap" v-if="!signContract">
        <p>Contract</p>
        <p>Please check the information below for accuracy and make the necessary amendments.</p>
        <div class="uploader-box">
            <ul>
                <li class="vehicle-details-row1">
                    <div class="form-group">
                        <input type="text" placeholder="Business name" class="form-control" v-model="form.business_name">
                    </div>
                </li>
                <li>
                    <div class="form-group">
                        <input type="text" placeholder="Business registration number" class="form-control" v-model="form.business_registration_number">
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
                    <input type="text" placeholder="Business address" class="form-control" v-model="form.business_address">
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <input type="text" placeholder="Business e-mail" class="form-control" v-model="form.business_email">
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <input type="text" placeholder="Business phone number" class="form-control" v-model="form.business_phone">
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <input type="text" placeholder="Vehicle registration number" class="form-control" v-model="form.vehicle_registration_number">
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <input type="text" placeholder="Vehicle colour" class="form-control" v-model="form.vehicle_color">
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <input type="text" placeholder="Vehicle make" class="form-control" v-model="form.vehicle_make">
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <input type="text" placeholder="Vehicle model" class="form-control" v-model="form.vehicle_model">
                </div>
            </li>
            <li class="vehicle-details-row1">
                <div class="form-group">
                    <input type="text" placeholder="Client name" class="form-control" v-model="form.client_name">
                </div>
            </li>
            <li class="vehicle-details-row1">
                <div class="form-group">
                    <input type="text" placeholder="Client address" class="form-control" v-model="form.client_address">
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <input type="text" placeholder="Driving license number" class="form-control" v-model="form.driving">
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <flat-pickr
                            v-model="form.driving_expire_date"
                            placeholder="Driving license expiration date"
                            :config="config"
                            :required="true"
                            input-class="form-control"
                            name="driving_expire_date">
                    </flat-pickr>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <input type="text" placeholder="PCO license number" class="form-control" v-model="form.pco_number">
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <flat-pickr
                            v-model="form.pco_expiry_date"
                            placeholder="PCO license expiration date"
                            :config="config"
                            :required="true"
                            input-class="form-control"
                            name="pco_expiry_date">
                    </flat-pickr>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <input type="text" placeholder="Refundable deposit value" class="form-control" v-model="form.deposit">
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <flat-pickr
                            v-model="form.deposit_paid_date"
                            placeholder="Deposit paid date"
                            :config="config"
                            :required="true"
                            input-class="form-control"
                            name="deposit_paid_date">
                    </flat-pickr>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <flat-pickr
                            v-model="form.start_date"
                            placeholder="Agreement start date"
                            :config="config"
                            :required="true"
                            input-class="form-control"
                            name="start_date">
                    </flat-pickr>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <flat-pickr
                            v-model="form.end_date"
                            placeholder="Agreement end date"
                            :config="config"
                            :required="true"
                            input-class="form-control"
                            name="end_date">
                    </flat-pickr>
                </div>
            </li>
            <li class="vehicle-details-row1">
                <div class="form-group">
                    <input type="text" placeholder="Insurance company name" class="form-control" v-model="form.insurance_company_name">
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <input type="text" placeholder="Insurance policy number" class="form-control" v-model="form.insurance_policy_number">
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <flat-pickr
                            v-model="form.insurance_expiry_date"
                            placeholder="Insurance expiry date"
                            :config="config"
                            :required="true"
                            input-class="form-control"
                            name="insurance_expiry_date">
                    </flat-pickr>
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <input type="text" placeholder="Weekly rent cost" class="form-control" v-model="form.weekly_rent_cost">
                </div>
            </li>
            <li class="vehicle-details-row2">
                <div class="form-group">
                    <input type="text" placeholder="Insurance excess cost" class="form-control" v-model="form.Insurance_excess_cost">
                </div>
            </li>
        </ul>
        <div class="inlain-black-btn2">
            <ul>
                <li><a href="javascript:void(0)" class="btn" @click="PreviewContract">Preview contract</a></li> 
                <li><a href="javascript:void(0)" class="btn" @click="processContract">Confirm contract</a></li>
            </ul>
        </div>
    </div>
 <process-contract-signatures @closeContract="closeContract" v-else-if="!contractPreview && signContract"  :booking="booking"></process-contract-signatures>    
 <preview-contract v-if="contractPreview" :doc="doc" @modelHiding="closeModel" :booking="booking"></preview-contract>
</div>
</template>

<script>
    import User from '../user';

    import flatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';

    export default {
        props: ['booking'],

        data() {
            return {
                date: new Date(),
                // Get more form https://chmln.github.io/flatpickr/options/
                config: {
                    wrap: true, // set wrap to true when using 'input-group'
                    altFormat: 'M	j, Y',
                    altInput: true,
                    dateFormat: "Y-m-d",
                },
                signContract: false,
                contractPreview: false,
                doc: '',
                form:{
                     // business_logo  : false,
                     // business_name  : false,
                     // business_registration_number  : false,
                     // business_address  : false,
                     // business_email  : false,
                     // business_phone  : false,
                     // vehicle_registration_number  : false,
                     // vehicle_color  : false,
                     // vehicle_make  : false,
                     // vehicle_model  : false,
                     // client_name  : false,
                     // client_address  : false,
                     // driving  : false,
                     // driving_expire_date  : false,
                     // pco_number  : false,
                     // pco_expiry_date  : false,
                     // deposit  : false,
                     // deposit_paid_date  : false,
                     // start_date  : false,
                     // end_date  : false,
                     // insurance_company_name  : false,
                     // insurance_policy_number  : false,
                     // insurance_expiry_date  : false,
                     // weekly_rent_cost  : false,
                     // Insurance_excess_cost  : false,
                }
            };
        },

        watch: {
            booking: function(booking) {
                this.booking = booking;      
            }
        },

        mounted() {
            this.prepareComponent();
        },
        components: {
            flatPickr
        },
        computed: {

        },

        methods: {
            prepareComponent(){
                let $this = this;
                $('#sideLoader').show();
                axios.get('/api/booking/'+this.booking.id+'/contract-data')
                     .then(r=>{
                        setTimeout(function() { $('#sideLoader').hide(); }, 500);
                        this.form = r.data.success;
                     });

            $(".upload").on('change', function(event) {
                event.preventDefault();
                console.log(event);
                 $('#sideLoader').show();
                        $.map(this.files, function (val) {
                            if($this.isUploadAble(val)){
                            var reader = new FileReader();
                            let name = val.name.substring(0, val.name.lastIndexOf('.'));
                            let type = val.name.split('.').pop();
                            reader.readAsDataURL(val);
                            var fd = new window.FormData();
                            fd.append('upload', val);
                            reader.onload = function (e) {
                                axios.post('/api/upload/document', fd).then((r) => {
                                        $this.form.business_logo = r.data.success;
                                });
                            };
                           }
                        });
                        setTimeout(function() { $('#sideLoader').hide(); }, 500);
            });

            },
            processContract(){
             $('#sideLoader').show();
                axios.patch('/api/booking/'+this.booking.id+'/contract-data',this.form)
                     .then(r=>{
                        setTimeout(()=>{ $('#sideLoader').hide(); 
                            new Noty({
                                type: 'success',
                                text:  r.data.success
                            }).show();
                            this.signContract=true;
                        }, 500);
                        
                     });   
            },
            PreviewContract(){
                             $('#sideLoader').show();
                axios.post('/api/booking/'+this.booking.id+'/preview-contract',this.form)
                     .then(r=>{
                        this.doc=r.data.success;
                        setTimeout(()=>{ $('#sideLoader').hide(); 
                            this.contractPreview=true;
                        }, 1000);
                        
                     }); 
            },
            hideModal(){
                this.contractPreview = false;
            },
            isUploadAble(file){
                if(parseInt(file.size)/1024/1024 >5.00){
                    new Noty({
                                type: 'error',
                                text: file.name+" Exceeds the Max Size! 5MB",
                            }).show();
                    return false;
                }
                return true;
            },

            closeModel(){
                this.contractPreview=false;
                
            },
             closeContract(){
                this.$emit('closeContract');
            },
        }
    }
</script>
