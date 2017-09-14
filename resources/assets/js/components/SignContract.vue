<template>
    <div class="signature-container">
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
    </div>
</template>

<script>
    import User from '../user';

    export default {
        props: ['booking'],

        data() {
            return {
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
            contract() {
                return this.booking ? this.booking.documents[0] : null;
            },
            canView(){

                if(!this.booking.signatures)
                    return true;

                if(User.state.auth.type === "owner" && typeof this.booking.signatures.owner === 'undefined')
                    return true;

                if(User.state.auth.type === "client" && typeof this.booking.signatures.client === 'undefined')
                return true;
            return false;
            }
        },

        methods: {
            prepareComponent() {
            },

            showSignContainer(e) {
                let $btn = $(e.target).button('loading');
                let container = $('.add-signature');
                if (container.is(':visible')) {
                    this.signature = $('.js-signature').jqSignature('getDataURL');

                    $('body').removeClass('body-signature');

                    let fd = new FormData();
                    fd.append('signature', this.dataURItoBlob(this.signature));

                    $('#sideLoader').show();
                    axios.post('/api/booking/' + this.booking.id + '/signature', fd)
                        .then((r) => {
                            $('#sideLoader').hide();
                            new Noty({
                                type: 'success',
                                text: r.data.success
                            }).show();
                            this.$emit('closeContract', 'sign');
                            $btn.button('reset');
                            setTimeout(() => {
                                this.sign = 'Sign Contract';
                            }, 200);
                        });
                }
                else {
                    $btn.button('reset');
                    let e = $('.js-signature').jqSignature();
                    $(e).on("touchstart mousedown",e=> {
                        this.status = true;
                        
                    });
                    $('body').addClass('body-signature');
                    setTimeout(() => {
                        this.sign = 'Save Signature';
                        this.status = false;
                    }, 200);
                }
                container.slideToggle();
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
