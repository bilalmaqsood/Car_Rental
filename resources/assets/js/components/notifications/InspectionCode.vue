<template>
    <div class="booking-request-actions notification-shadow">
        <div class="btn-inlane-content noty_successfull">
            <div class="driver-profile-text">
            <h3>Your vehicle pickup number</h3>
            <p>Hello <b>{{ notification.data.user }}</b> Please provide the code below to the vehicle owner when you pick-up your vehicle as confirmation of your approval to the vehicle inspection.</p>
            <div class="confirmation-code-no">
                <p>
                    Your confirmation code is:
                <span class="inspection-code">
                        {{  notification.data.inspection_code }}
                    </span>
                </p>
            </div>
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
