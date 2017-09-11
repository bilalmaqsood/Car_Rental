<template>
    <div class="pofile_content_wrapper notification-shadow">
        <div class="img_box booking-request-img-box" style="background: url(images/car_img_1.png)">
            <img src="images/car_img_1.png" alt="">
        </div>
        <div class="profile_content">
            <h3>Booking approved</h3>
            <p><span>Mike Myers</span> approved your request to book</p>
            <p>Toyota Prius 1.8 Hybrid</p>
            <p>Contract start: 06.05.2017 </p>
            <p>Contract end: 20.05.2017</p>
            <p>You can now check and sign the contract and set your
                <span>Direct Debit.</span> A deposit of <span>£250.00</span> have been taken from your card ending in <span>1234</span></p>
        </div>
    </div>
</template>

<script>
    import User from '../../user';

    export default {
        data() {
            return {

            };
        },

        computed: {

        },

        mounted() {

            this.prepareComponent();
        },

        methods: {

        }
    }
</script>
