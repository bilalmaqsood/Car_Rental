<template>
    <div>



        
        
    </div>
</template>

<script>
    import User from '../user';

    export default {
        data() {
            return {
                
            };
        },

        computed: {
        
        },

        mounted() {

        },

        methods: {
            showActionButtons(noti){
                let allowed = [5, 7];
                return allowed.includes(noti.data.status) &&  User.state.auth.type=='owner'; 
            },
            isActionable(notification) {
                let allowed = [1, 2, 3];

                return (notification.data.old_status && notification.data.type === 'Booking' && allowed.includes(notification.data.status));
            },

            prepareComponent() {
            let $scope = this;

            $("#uploadImages").click(function () {
                
                $(".hiddenUpload").click();
                $(".hiddenUpload").change(function () {
                    
                        let val = this.files[0];
                        console.log(val);
                        var reader = new FileReader();
                        reader.readAsDataURL(val);
                        var fd = new window.FormData();
                        fd.append('upload', val);
                        reader.onload = function (e) {
                            $('#sideLoader').show();
                            axios.post('/api/upload/image', fd).then($scope.processAvatar);
                            setTimeout(function () {
                    $('#sideLoader').hide();
                    
                }, 1000);
                        };
                });

                
            });


                $('#sideLoader').show();
                axios.get('/api/notifications')
                    .then(response => {
                        $('#sideLoader').hide();
                        this.notifications = response.data.success;
                        setTimeout(function() {
                
                
                $('.ratting').starrr({
                  change: function(e, value){
                    $scope.rating = value;
                        }
                });
                
                }, 1500);
                    });


            

            },



            propExist(obj, prop) {
                return obj.hasOwnProperty(prop);
            },

            date_format(date) {
                return moment.utc(date.date).format("D.M.Y");
            },

            approve_action(notification) {
                if (notification.data.id) {
                    $(".side-loader").show();
                    axios.get('/api/booking/' + notification.data.id + '/logs')
                        .then(this.approveRequest);

                    setTimeout(function () {
                        $(".side-loader").hide();
                    },500)
                }
            },

            cancle_action(notification) {
//                TODO: need to do this
                    
                     if (notification.data.id) {
                    $(".side-loader").show();
                    axios.get('/api/booking/' + notification.data.id + '/logs')
                        .then(this.cancelRequest);

                    setTimeout(function () {
                        $(".side-loader").hide();
                    },500)
                }

                // if (notification.data.id) {
                //     axios.patch('/api/booking/' + notification.data.id + '/status', this.cancleParams())
                //         .then(response => {
                //             console.log(response);
                //         });
                // }
            },

            approveRequest(response) {
                if (response.data.success.booking_log[0] !== undefined) {
                    let data = response.data.success.booking_log[0];
                    let booking_id = response.data.success.booking_log[0].booking_id;
                    let status = response.data.success.booking_log[0].requested_data.status;
                    let log_id = response.data.success.booking_log[0].id;
                    let params = {log_id: response.data.success.booking_log[0].id, status: ""};
                    console.log(response.data.success);
                    if (status === 5)
                        params.status = 6;

                    if (status === 3)
                        params.status = 4;

                    if (status === 7)
                        params.status = 8;

                    if(params.status)
                        this.sendRequest(response.data.success.id, params);

                }
            },

            cancelRequest(response) {
                if (response.data.success.booking_log[0] !== undefined) {
                    let params = {log_id: response.data.success.booking_log[0].id, status: 4};
                    console.log(response.data.success);
                        this.sendRequest(response.data.success.id, params);

                }
            },

            sendRequest(booking_id, params) {
                axios.patch('/api/booking/' + booking_id + '/status', params)
                    .then((response) => {
                    console.log(response);

                        if (response.status==200)
                            new Noty({type: 'success', text: response.data.success}).show();
                        if (response.status!==200)
                            new Noty({type: 'error', text: response.data.error}).show();
                    });
            },

            markRead(notification) {

                $('#sideLoader').show();
                if (typeof notification === 'undefined' && this.notify)
                    notification = this.notify;

                let params = {notify_id: [notification.id]};
                axios.post('/api/notifications', params)
                    .then(() => {
                        $('#sideLoader').hide();
                        let index = this.notifications.indexOf(notification);
                        this.notifications.splice(index, 1);
                        notification = null;
                    });
            },

            viewContract(notify) {
                $('#sideLoader').show();
                this.notify = notify;
                this.booking=null;
                axios.get('/api/booking/' + notify.data.id)
                    .then((r) => {
                        $('#sideLoader').hide();
                        this.booking = r.data.success;
                        setTimeout(function() {
                           $(".menu-component-container").animate({scrollTop: 0});
                        }, 500);
                    });
            },

            cleanViewContract() {
                this.booking = null;
            },
            processAvatar(r){
                let param = {avatar: r.data.success};
                if(User.state.auth.type === "owner")
                    axios.patch('/api/profile/owner', param)
                        .then((r) => {
                            console.log(r);
                            User.state.auth.avatar = param.avatar;
                            User.commit('update', User.state.auth);
                        });
                else if(User.state.auth.type === "client")
                    axios.patch('/api/profile/client', param)
                        .then((r) => {
                            console.log(r);
                            User.state.auth.avatar = param.avatar;
                            User.commit('update', User.state.auth);
                        });
            },
            processRating(notification){
                let $this = this;
                let param ={rating: $this.rating, note: $this.note}; 
                $('#sideLoader').show();
                 axios.post('/api/booking/'+notification.data.booking_id+'/feedback', param)
                        .then((r) => {
                            $this.note=null;
                            
                            setTimeout(function() { 
                                $('#sideLoader').hide(); 
                                new Noty({
                                    type: 'success',
                                    text: 'Rating saved successfully.',
                                    
                                }).show();
                                 $this.markRead(notification);
                             }, 1000);
                        });
            },
             NotyClass(notif){
                if([5,9].includes(notif.data.status))
                    return "noty_warning";
                else if([6,10,7].includes(notif.data.status))
                    return "noty_danger";
                else if([12,0].includes(notif.data.status))
                    return "noty_info";

            }
        },
    }
</script>
