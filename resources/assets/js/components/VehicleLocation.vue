<template>
        <ul>
                    <li><span>Pickup from:</span> <span class="pickup_location">{{pickupLoc}}</span></li>
                    <li><span>Return to:</span> <span class="return_location">{{ returnLoc }}</span></li>
                </ul>

</template>

<script>
    export default {
        props: ["return_location","pickup_location"],
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

        
        prepareComponent(){
            let $this = this;
            FetchLocationName(this.pickup_location,null,function(value){
                $this.pickupLoc = value;
            });

            FetchLocationName(this.return_location,null,function(value){
                $this.returnLoc = value;
            });
        }
    }

}
</script>
