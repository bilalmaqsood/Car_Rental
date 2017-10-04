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
                <input type="text" placeholder="Driving license expiration date" class="form-control dates" v-model="form.driving_expire_date">
            </div>
        </li>
        <li class="vehicle-details-row2">
            <div class="form-group">
                <input type="text" placeholder="PCO license number" class="form-control" v-model="form.pco_number">
            </div>
        </li>
        <li class="vehicle-details-row2">
            <div class="form-group">
                <input type="text" placeholder="PCO license expiration date" class="form-control dates" v-model="form.pco_expiry_date">
            </div>
        </li>
        <li class="vehicle-details-row2">
            <div class="form-group">
                <input type="text" placeholder="Refundable deposit value" class="form-control" v-model="form.deposit">
            </div>
        </li>
        <li class="vehicle-details-row2">
            <div class="form-group">
                <input type="text" placeholder="Deposit paid date" class="form-control dates" v-model="form.deposit_paid_date">
            </div>
        </li>
        <li class="vehicle-details-row2">
            <div class="form-group">
                <input type="text" placeholder="Agreement start date" class="form-control dates" v-model="form.start_date">
            </div>
        </li>
        <li class="vehicle-details-row2">
            <div class="form-group">
                <input type="text" placeholder="Agreement end date / time" class="form-control dates" v-model="form.end_date">
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
                <input type="text" placeholder="Insurance expiry date" class="form-control dates" v-model="form.insurance_expiry_date">
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
            <li><a href="javascript:void(0)" class="btn">Preview contract</a></li> 
            <li><a href="javascript:void(0)" class="btn" @click="processContract">Confirm contract</a></li>
        </ul>
    </div>
</div>
 <process-contract-signatures v-else :booking="booking"></process-contract-signatures>    
</div>
</template>

<script>
    import User from '../user';

    export default {
        props: ['booking'],

        data() {
            return {
                signContract: false,
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

        computed: {

        },

        methods: {
            prepareComponent(){
                $('#sideLoader').show();
                axios.get('/api/booking/'+this.booking.id+'/contract-data')
                     .then(r=>{
                        setTimeout(function() { $('#sideLoader').hide(); }, 500);
                        this.form = r.data.success;
                     });

            $(".dates").datetimepicker({
                    format: 'YYYY-MM-DD',
                    }).on('dp.change',(e)=> {
                    // $(e.target).val();
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
            }
        }
    }
</script>
