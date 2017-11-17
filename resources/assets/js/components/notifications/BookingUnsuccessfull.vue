<template>
    <div class="booking-request-actions notification-shadow">
        <div class="btn-inlane-content btn-inlane-content-btn3 noty_danger">
            <div class="driver-profile-text">
            
            <h3>Booking request was auto declined</h3>

            <p>Unfortunately, your request to book <b> {{notification.data.vehicle}} </b>
             has beenunsuccessful.</p>
             <p>Please check our vehicles database for a similar vehicle that you can book.</p>
        </div>
    </div>
</div>
</template>

<script>
    import User from '../../user';

    export default {
        props: ["notification"],
        data() {
            return {

            };
        },

        computed: {

        },

        mounted() {
            
        },

        methods: {
            
        }
    }
</script>
