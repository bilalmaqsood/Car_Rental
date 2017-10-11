<template>

    <!-- <contract-form :booking="booking"></contract-form> -->

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

    <div>
        <div class="sign-contract-wrap">
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
            <div class="signature-bottom">
                        <div class="js-signature" data-width="540" data-height="320" data-line-color="#000" data-line-width="3"></div>

                <span>sign here</span>
            </div>
            <div class="signature-date">
                <p>{{storage.state.auth.name}} | {{ date | date('format', 'DD.MM.YYYY') }}</p>
            </div>
            <div class="signature-delete">
                <button class="btn" id="retry">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 20" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#delete_icon"></use>
                    </svg>
                    <span>retry signature</span>
                </button>
            </div>
            <div class="signature-submit">
                <button class="btn" :disabled="status" @click="postSignatures">Submit signature</button>
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
                date: moment(new Date()),
                storage: User,
                sign: 'Sign Contract',
                lastX: -1,
                lastY: -1,
                mousePressed: false,
                status: true,
                signature: ''
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
            prepareComponent() {
                $('body').addClass('body-signature');
                 let e = $('.js-signature').jqSignature();
                    $(e).on("touchstart mousedown",e=> {
                        this.status = false;
                        
                    });
                    $("#retry").on('click', function(event) {
                       $('.js-signature').jqSignature('clearCanvas');
                        /* Act on the event */
                    });
                    
            },

            postSignatures(e) {
                let $btn = $(e.target).button('loading');
                
                
                    this.signature = $('.js-signature').jqSignature('getDataURL');

                    $('body').removeClass('body-signature');

                    let fd = new FormData();
                    fd.append('signature', this.dataURItoBlob(this.signature));

                    if(this.storage.state.auth.type=='client'){
                        this.$emit('signature',fd);
                        return false;
                    }


                    $('#sideLoader').show();
                    axios.post('/api/booking/' + this.booking.id + '/signature', fd)
                        .then((r) => {
                            $('#sideLoader').hide();
                            new Noty({
                                type: 'success',
                                text: r.data.success
                            }).show();
                            this.$emit('closeContract');
                            
                            $btn.button('reset');
                            setTimeout(() => {
                                this.sign = 'Sign Contract';
                            }, 200);
                        });
                
            },

            dataURItoBlob(dataURI) {
                let byteString;

                if (dataURI.split(',')[0].indexOf('base64') >= 0)
                    byteString = atob(dataURI.split(',')[1]);
                else
                    byteString = unescape(dataURI.split(',')[1]);

                let mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

                let ia = new Uint8Array(byteString.length);
                for (let i = 0; i < byteString.length; i++) {
                    ia[i] = byteString.charCodeAt(i);
                }

                return new Blob([ia], {type: mimeString});
            },
            closeContract(){
                this.$emit('closeContract');
            },
            cancelContract(e) {
                let $btn = $(e.target).button('loading');
                $('#sideLoader').show();
                axios.patch('/api/booking/' + this.booking.id + '/status', {
                    status: 6,
                    note: 'contract canceled by owner before signature.'
                }).then((r) => {
                    $('#sideLoader').hide();
                    new Noty({
                        type: 'warning',
                        text: r.data.success
                    }).show();
                    this.$emit('closeContract');
                    $btn.button('reset');
                });
            }
        }
    }
</script>
