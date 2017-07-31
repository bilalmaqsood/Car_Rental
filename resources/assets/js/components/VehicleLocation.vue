<template>
    <ul>
        <li><span><strong>Pickup from:</strong></span> <span class="pickup_location">{{pickupLoc}}</span></li>
        <li><span><strong>Return to: </strong></span> <span class="return_location">{{returnLoc}}</span></li>
    </ul>
</template>

<script>
    export default {
        props: ['return_location', 'pickup_location'],

        data() {
            return {
                pickupLoc: '',
                returnLoc: ''
            }
        },

        mounted() {
            this.prepareComponent();
        },
        watch: {
            return_location: function(location) {
                this.prepareComponent();
            },
            pickup_location: function(location) {
                this.prepareComponent();

            }
        },
        methods: {
            prepareComponent() {
                let $t = this;

                if ($t.pickup_location)
                    $.ajax({
                        beforeSend: function(request) {
                            request.setRequestHeader('Access-Control-Request-Headers', '');
                        },
                        url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + $t.pickup_location + '&key=AIzaSyDp8Pjc5ZmcmTb-ci-Fj-xNh2KLTUlguk0',
                        type: 'GET',
                        dataType: 'json',
                        async: false
                    }).done(function (r) {
                        $t.pickupLoc = r.results[0].formatted_address;
                    });

                if ($t.return_location)
                    $.ajax({
                        beforeSend: function(request) {
                            request.setRequestHeader('Access-Control-Request-Headers', '');
                        },
                        url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + $t.return_location + '&key=AIzaSyDp8Pjc5ZmcmTb-ci-Fj-xNh2KLTUlguk0',
                        type: 'GET',
                        dataType: 'json',
                        async: false,
                    }).done(function (r) {
                        $t.returnLoc = r.results[0].formatted_address;
                    });
            }
        }
    }
</script>
