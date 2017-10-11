<template>
    <div class="booking-request-actions notification-shadow">
        <div class="btn-inlane-content noty_successfull">
            <div class="driver-profile-text">
                <h3>{{notification.data.title}}</h3>

                <p>Your rating</p>
                
                <div class="ratting"></div>
                <div class="form-group">
                    <input type="text" :placeholder="user.state.auth.type=='owner'?'Tell us a bit about the driver':'Tell us a bit about the owner'" class="form-control" v-model="note">
                </div>
            <button class="add-new-vehile-btn" @click="processRating">Done</button>
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
                user: User,
                note: '',
                rating: '',
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

            processRating(){
                let $this = this;
                let param ={rating: $this.rating, note: $this.note};
                $('#sideLoader').show();
                 axios.post('/api/booking/'+this.notification.data.booking_id+'/feedback', param)
                        .then((r) => {
                            $this.note=null;

                            setTimeout(function() {
                                $('#sideLoader').hide();
                                new Noty({
                                    type: 'success',
                                    text: 'Rating saved successfully.',

                                }).show();
                                 $this.$parent.$emit("markread",$this.notification);
                             }, 1000);
                        });
            },


        }
    }
</script>
