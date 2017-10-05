<template>
    <div class="booking-request-actions notification-shadow">
        <div class="btn-inlane-content noty_successfull">
            <div class="driver-profile-text">
                <h3>Rate to user</h3>
                <p><b>{{notification.data.user}}</b> requested to book <b>{{ notification.data.vehicle }}</b></p>
                <p><b>Contract start:</b> {{notification.data.contract_start.date | date('format', 'DD.MM.YYYY') }} </p>
                <p><b>Contract end:</b> {{notification.data.contract_end.date | date('format', 'DD.MM.YYYY') }}</p>
                
                <div class="form-group">
                    <input type="text" placeholder="Business e-mail" class="form-control" >
                </div>
            <button class="add-new-vehile-btn">Done</button>
            </div>
        </div>
    </div>
</template>

<script>
    import User from '../../user';

    export default {
        props: ['notification'],
        data() {
            return {

            };
        },

        computed: {
            sender(){

            },
        },

        mounted() {
            let $this = this;

          $('.ratting').starrr({
                  change: function(e, value){
                    $this.rating = value;
                        }
                });  
        },

        methods: {
            viewProfileEvent(){
                this.$parent.$emit("viewPofile",{booking_id: this.notification.data.id});
            },
            approveEvent(){
                this.$parent.$emit("approve",this.notification);

            },
            declineEvent(){
                this.$parent.$emit("decline",this.notification);

            },
            contractEvent(){
                this.$parent.$emit("contract",this.notification);

            },

        }
    }
</script>
