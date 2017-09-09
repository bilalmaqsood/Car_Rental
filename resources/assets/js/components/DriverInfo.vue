<template>
<div>
 
    <div class="driver-profile-wrap">
        <div class="driver-profile-content-wrap">
            <div class="driver-profile-img">
                <img src="/images/hero-img.jpg" alt="" style="width: auto;">
            </div>
            <div class="driver-status">
                <h3>Andrei Stanescu</h3>
                <p><span>Age: <i>29</i></span><span> Uber rating: <i>4.6</i></span><span>07402046843</span></p>
            </div>
        </div>
        <div class="driver-detail-wrap">
            <ul>
                <li>
                    <div class="driver-detail-text">
                        <p>Date of birth</p>
                        <h5>March 10 1988</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                        </svg>
                    </span>
                </li>

                <li>
                    <div class="driver-detail-text">
                        <p>NINo</p>
                        <h5>SS 01234567 D</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use></svg>
                    </span>
                </li>

                <li>
                    <div class="driver-detail-text">
                        <p>PCO cert. no.</p>
                        <h5>ABC2313432BC22</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20" class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#contract_view_icon"></use></svg> 
                    </span>
                </li>

                <li>
                    <div class="driver-detail-text">
                        <p>PCO cert. release</p>
                        <h5>May 5 2015</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                        </svg>
                    </span>
                </li>

                <li>
                    <div class="driver-detail-text">
                        <p>PCO cert. exp.</p>
                        <h5>May 4 2020</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 15" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#availability_results"></use>
                        </svg>
                    </span>
                </li>

                <li>
                    <div class="driver-detail-text">
                        <p>Driver license</p>
                        <h5>DOEJ12312446776R</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 21" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#card_form"></use>
                        </svg>
                    </span>
                </li>

                <li>
                    <div class="driver-detail-text">
                        <p>Postcode on license</p>
                        <h5>EC4r 9AN</h5>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lcotion_icon"></use>
                        </svg>
                    </span>
                </li>

            </ul>
        </div>
    </div>

</div>
</template>

<script>
    import Form from '../vehicle-fields';
    import User from '../user';

    var $scope;
    export default {
        data() {
            return {
                menuView: '',
                isEdit: false,
                vehicles: '',
                avg_rating: User.state.auth.avg_rating,
                vehicle: false,
            };
        },
        created: function() {
            let $this = this;
            this.$on('vehicleAdded', function(value){
               this.menuView='';
                new Noty({
                    type: 'success',
                    text: value.make+" "+value.model+" "+value.make + " Added!",
                }).show();
                this.vehicle=value;
            });

            this.$on('vehicleUpdate', function(value){
               this.menuView='';
               this.isEdit=false;
                new Noty({
                    type: 'success',
                    text: value.make+" "+value.model+" "+value.make + " Updated!",
                }).show();
                this.vehicle=value;
            });
        },
        mounted() {
            $scope = this;
            $('#sideLoader').show();
            this.prepareComponent();
            setTimeout(function() { $('#sideLoader').hide(); }, 1000);
            
        },

        methods: {
            prepareComponent() {
                axios.get('/api/vehicle')
                    .then(this.vehiclesCallback);
            },
            vehiclesCallback(r) {
                    this.vehicles = r.data.success;
                    if(r.data.success[0]){
                        this.vehicle = r.data.success[0];
                    }
                let rating = this.avg_rating;
                $('.ratting').starrr({
                    rating: rating
                });
            },
            fetchAddress(arg){
                console.log(arg);
                let $t = this;
                let location;
                    $.ajax({
                        url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + arg + '&key=AIzaSyDp8Pjc5ZmcmTb-ci-Fj-xNh2KLTUlguk0',
                        type: 'GET',
                        dataType: 'json',
                        async: false,
                    }).done(function (r) {
                        location = r.results[0].formatted_address;
                    });

            return location;
            },
            date_format(date){
                return moment.utc(date.date).format("D.M.Y");
            },
            vechicleDetails(arg){
                this.vehicle = arg;
                 $(".menu-component-container").animate({scrollTop: 0});
            },

            editVehicle(){
                this.isEdit=! this.isEdit;
                this.changeMenuView('edit');

            },
            deleteVehicle(){
            if(this.vehicle.is_booked){
                new Noty({
                    type: 'error',
                    text: "You cannot delete vehicle unless booking complete.",
                }).show();
                return false;
            }
             let $this=this;
              var n = new Noty({
                  text: "<b>Are you sure you want to delte "+ this.vehicle.make+" "+this.vehicle.model+" "+this.vehicle.make+" </b>",
                  timeout: false,
                  buttons: [
                    Noty.button('YES', 'btn btn-success', function () {
                      n.close();
                      setTimeout(function() { $this.processDestroy(); }, 100);
                    
                    }, {id: 'button1', 'data-status': 'ok'}),

                    Noty.button('NO', 'btn btn-error', function () {
                        console.log('button 2 clicked');
                        n.close();
                    })
                  ]
                }).show();
            },
            changeMenuView(view) {
                if(view=='edit')
                    this.isEdit=! this.isEdit;
                else 
                    this.isEdit= false;

                let oldView = this.menuView;
                this.menuView = null;
                setTimeout(()=>{

                if (oldView === view)
                    this.menuView = '';
                else
                    this.menuView = view;
            }, 550);
            },

            processDestroy(){
                axios.delete('/api/vehicle/'+this.vehicle.id).then(()=>{
                           let index = this.vehicles.indexOf(this.vehicle);
                            this.vehicles.splice(index, 1);
                            if(this.vehicles.length>0)
                                this.vehicle = this.vehicles[0];
                        });
            }
        }
    }
</script>
