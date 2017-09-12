<template>
    <div class="booking-request-actions notification-shadow">
        <div class="btn-inlane-content btn-inlane-content-btn3 noty_successfull">
            <div class="driver-profile-text">
            <h3>Booking approved</h3>
            <p>Mike Myers approved your request to book <b> {{notification.data.vehicle}} </b>
            <p><b>Contract start:</b> {{notification.data.contract_start.date | date('format', 'DD.MM.YYYY') }} </p>
            <p><b>Contract end:</b> {{notification.data.contract_end.date | date('format', 'DD.MM.YYYY') }}</p>
            You can now check and sign the contract and set your Direct Debit. A
            deposit of <b>{{notification.data.amount | currency}}</b> have been taken from your card ending in <b>{{notification.data.card_ending}}</b></p>
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
