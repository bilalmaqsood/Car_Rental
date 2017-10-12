<template>
    <div>
        
        <div class="booking-request-actions notification-shadow">
            <div class="inlane-btn-wrap inlane-btn-wrap-btn2 inlane-btn-wrap-btn2-oct12">
                <ul class="two-btn-inlane">
                    <li>
                        <a href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg>
                            rate driver
                        </a>
                    </li> 
                    <li>
                        <a href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use></svg>
                            vehicle inspection
                        </a>
                    </li>
                </ul>
            </div>
            <div class="btn-inlane-content btn-inlane-content-btn2 btn-inlane-content-btn12oct noty_successfull">
                <div class="driver-profile-img12">
                    <img class="img-responsive" :src="notification.data.image" />
                </div>
            </div>
        </div>

        <div class="booking-request-actions notification-shadow">
            <div class="inlane-btn-wrap inlane-btn-wrap-btn2 inlane-btn-wrap-btn1-oct12">
                <ul class="two-btn-inlane">
                    <li>
                        <a href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 25" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg>
                            rate driver
                        </a>
                    </li> 
                </ul>
            </div>
            <div class="btn-inlane-content btn-inlane-content-btn2 driver-profile-text-ratting noty_successfull">
                <div class="driver-profile-text">
                    <p>rate driveryour rating</p>
                    <div class="ratting"></div>
                </div>
            </div>
        </div>
        <div class="processrating-input-oct12">
            <div class="form-group">
                <input type="text" :placeholder="user.state.auth.type=='owner'?'Tell us a bit about the driver':'Tell us a bit about the owner'" class="form-control" v-model="note">
            </div>
            <button class="add-new-vehile-btn" @click="processRating">Done</button>
        </div>
    
<!--     <div class="booking-request-actions notification-shadow">
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
    </div> -->


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
