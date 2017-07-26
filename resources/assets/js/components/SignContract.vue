<template>
    <div class="signature-container">
        <pdf-document v-if="contract" :d="contract"></pdf-document>

        <div class="add-signature" style="display: none;">
            <h1 class="h2">Signature for Contract</h1>
            <canvas></canvas>
        </div>

        <div class="row m-0">
            <a href="javascript:" class="primary-button m-0 pull-left" @click="showSignContainer">{{sign}}</a>
            <a href="javascript:" class="primary-button m-0 pull-right danger-button">Cancel Contract</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['booking'],

        data() {
            return {
                sign: 'Sign Contract'
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
            prepareComponent() {},

            showSignContainer() {
                let container = $('.add-signature');
                if (container.is(':visible'))
                    this.sign = 'Sign Contract';
                else
                    this.sign = 'Save Signature';
                container.slideToggle();
            },
        }
    }
</script>
