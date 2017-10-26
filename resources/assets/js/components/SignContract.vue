<template>
 <div>
    <contract-form @closeContract="closeContract" :booking="booking" v-if="storage.state.auth.type=='owner' && [1,2].includes(booking.status)"></contract-form>

<!--     <div class="signature-container">
            <svg @click="closeContract" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close_icon"></use></svg>
        <pdf-document v-if="contract" :d="contract"></pdf-document>

        <div class="add-signature" style="display: none;">
            <h1 class="h2">Signature for Contract</h1>
            <div class="js-signature" data-width="540" data-height="320" data-line-color="#000" data-line-width="3"></div>
        </div>

        <div class="row m-0" v-if="canView">
            <img :src="signature" alt="">
            <button :disabled="status == false" data-loading-text="Signing Contract" class="primary-button m-0 pull-left" @click="showSignContainer" v-html="sign"></button>
            <button data-loading-text="Canceling Contract" v-if="storage.state.auth.type=='owner'" class="primary-button m-0 pull-right danger-button" @click="cancelContract">Cancel Request</button>
        </div>
    </div> -->
    <pdf-document v-else-if="canView && contract" :d="contract"></pdf-document>
    <process-contract-signatures v-else-if="storage.state.auth.type=='client' && doSign "  :booking="booking" @signature="saveSignateues"></process-contract-signatures>  

<!--         <div class="sign-contract-wrap" v-else>
            <div class="contract-top-content">
                <p>Contract
                    <span>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 20" class="pull-right svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download_icon"></use>
                            </svg>
                        </a>
                    </span>
                </p>
            </div>
            <div class="signature-bottom">
                <span>sign here</span>
            </div>
            <div class="signature-date">
                <p>John Doe | 05.05.2017</p>
            </div>
            <div class="signature-delete">
                <button class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 20" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#delete_icon"></use>
                    </svg>
                    <span>retry signature</span>
                </button>
            </div>
            <div class="signature-submit">
                <button class="btn">Submit signature</button>
            </div>
        </div>
 -->
        <div class="sign-contract-wrap" v-show="storage.state.auth.type=='client' && !doSign ">
            <div class="contract-top-content">
                <p>Contract
                    <span>
                        <a :download="typeof booking.documents[0].title!== 'undefined'?booking.documents[0].title:booking.documents[0].name" :href="booking.documents[0].path">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 20" class="pull-right svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#download_icon"></use>
                            </svg>
                        </a>
                    </span>
                </p>
            </div>
        
            <div class="time-picker-signature">
                <b>I will pick up the vehicle at</b>
                <div>
                    <div class="row">
                        <div class='col-sm-12'>
                            <div class="form-group clockpicker-box-2">
                               
                                <div class="form-group clockpicker-box-2">
                                    <div class="input-group clockpicker clockpicker-box">
                                        <input type="text" class="form-control timepicker" value="04:30">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="submitting-your-signature">
                <p>By submitting your signature and selecting the pick-up time, you agree to allow Qwikkar to manage the weekly rent payments from your c ard ending in <b>{{CardLastDigits}}</b> every week between <b>{{booking.start_date | date('format', 'DD.MM.YYYY') }}</b> until <b>{{booking.end_date | date('format', 'DD.MM.YYYY')}}</b></p>
            </div>
            <div class="signature-submit">
                <button class="btn" @click="postSignatures">Submit signature</button>
            </div>
        </div>
    </div>
    
</template>

<script>
    import User from '../user';

    export default {
        props: ['booking'],

        data() {
            return {
                storage: User,
                doSign: true,
                formData: false,
                pickup_time: '',
         
            };
        },
        created: function(){
                 this.$on("closeContract",()=>{
                        this.closeContract(); 
                 });
             },
        watch: {
            booking: function(booking) {
                this.booking = booking;      
            }
        },

        mounted() {
            console.log(this.booking);
            // this.prepareComponent();
             $('.clockpicker').clockpicker({
                            placement: 'bottom',
                            align: 'left',
                            donetext: 'Done',
                        });
        },

        computed: {
            contract() {
                return this.booking ? this.booking.documents[0] : null;
            },
            CardLastDigits(){
                let digit;
                User.state.auth.credit_cards.filter(function(item) {
                    if(item.default==1)
                        digit = item.number.slice(-4);
                });
                return digit;
            },
            canView(){

                if(!this.booking.signatures)
                    return false;

                if(User.state.auth.type === "owner" && typeof this.booking.signatures.client !== 'undefined')
                    return true;

                if(User.state.auth.type === "client" && typeof this.booking.signatures.client !== 'undefined')
                return true;
            return false;
            }
        },

        methods: {
            postSignatures(e) {
                    $('#sideLoader').show();
                    axios.post('/api/booking/' + this.booking.id + '/signature', this.formData)
                        .then((r) => {
                            $('#sideLoader').hide();
                            new Noty({
                                type: 'success',
                                text: r.data.success
                            }).show();
                            this.$emit('closeContract', 'sign');
                            
                            setTimeout(() => {
                                this.sign = 'Sign Contract';
                                this.submitTime();
                            }, 200);
                        });
                
            },

            saveSignateues(data){
                this.formData = data
                this.doSign = false;
            },
            closeContract(){
                this.$emit('closeContract');
            },

            submitTime(){
                
                let pickup_time = $(".timepicker").val();
                axios.post('/api/booking/'+ this.booking.id +'/pickup-timeslot',{
                    pickup_time: pickup_time
                }).then((r)=>{
                     new Noty({
                                type: 'success',
                                text: r.data.success
                            }).show();
                });
            }

        }
    }
</script>
