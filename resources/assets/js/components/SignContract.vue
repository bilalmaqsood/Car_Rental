<template>
    <div class="signature-container">
        <pdf-document v-if="contract" :d="contract"></pdf-document>

        <div class="add-signature" style="display: none;">
            <h1 class="h2">Signature for Contract</h1>
            <div class="js-signature" data-width="540" data-height="320" data-line-color="#000" data-line-width="3"></div>
        </div>

        <div class="row m-0">
            <img :src="signature" alt="">
            <button data-loading-text="Signing Contract" class="primary-button m-0 pull-left" @click="showSignContainer" v-html="sign"></button>
            <button data-loading-text="Canceling Contract" v-if="storage.state.auth.type=='owner'" class="primary-button m-0 pull-right danger-button" @click="cancelContract">Cancel Contract</button>
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
                signature: ''
            };
        },

        mounted() {
            this.prepareComponent();
        },

        computed: {
            contract() {
                return this.booking ? this.booking.documents[0] : null;
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
                                type: 'information',
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
                    $('.js-signature').jqSignature();
                    $('body').addClass('body-signature');
                    setTimeout(() => {
                        this.sign = 'Save Signature';
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
