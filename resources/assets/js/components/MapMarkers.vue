<template>
    <div>
        <div id="search_map" style="width: 100%; height: 100%;"></div>
    </div>

</template>

<script>
    import Local from '../local';
    import User from '../user';

    export default {
        props: ['hover'],
        data() {
            return {
                user: User,
                markers: [],
            };
        },

        watch: {    

        hover: function(vehicle) {
                let marker = this.markers[vehicle.id];
                google.maps.event.trigger(marker,'mouseover'); 
            }
        },       

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent(){
                let $t = this;
                setTimeout(function () {
                    $t.SearchMap = new google.maps.Map(document.getElementById('search_map'), {
                        zoom: 10,
                        center: {
                            lat: 51.528308,
                            lng: -0.3817765
                        }
                    });
                    google.maps.event.addListenerOnce($t.SearchMap, 'idle', function () {
                        setTimeout(function () {
                            $t.drawMarker();
                        }, 500);
                    });
                    let vehicleData = Local.get('vehicleData');
                    if (vehicleData) {
                        setTimeout(function () {
                            User.commit('details', true);
                        }, 500);
                        User.commit('vehicle', vehicleData);
                    }
                }, 500);
            },


            bindInfoWindow(marker, map, infowindow, content,item) {
                let $t = this;  
                google.maps.event.addListener(marker, 'mouseover', function() {
                    infowindow.setContent(content);
                    infowindow.open($t.SearchMap, this);
                    User.commit('highlight',item.id);
                });

                google.maps.event.addListener(marker, 'mouseout', function() {
                    User.commit('highlight',null);
                    infowindow.close();
                });
            },
            drawMarker() {
                let $t = this;
                var infowindow = new google.maps.InfoWindow();

                _.map(User.state.searchResults.data, function (v) {

                    let marker_content = v.make + " " + v.model + " " + v.variant + " " + v.year;
                    let lat = parseFloat(v.location.split(",")[0]);
                    let lng = parseFloat(v.location.split(",")[1]);
                    
                    let marker = new google.maps.Marker({
                        position: {lat: lat, lng: lng},
                        map: $t.SearchMap,
                        title: v.make + " " + v.model + " " + v.variant + " " + v.year,
                    });
                    $t.markers[v.id]=marker;
                    $t.bindInfoWindow(marker,$t.SearchMap,infowindow,marker_content,v);


                });
            },

        initMap() {
        var myLatLng = {lat: -25.363, lng: 131.044};

        var map = new google.maps.Map(document.getElementById('search_map'), {
          zoom: 4,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
      },
        }
    }
</script>
