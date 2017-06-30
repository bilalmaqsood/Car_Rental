window.SearchMap = null;
function initMap() {
    SearchMap = new google.maps.Map(document.getElementById('search_map'), {
        zoom: 4,
        center: {lat:  51.509865, lng: -0.118092}
    });
}
