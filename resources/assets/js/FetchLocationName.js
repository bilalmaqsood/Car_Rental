window.FetchLocationName = function (arg1, arg2, _callback) {
    if (typeof arg2 === 'undefined') arg2 = null;
    var location;
    var result;
    if (arguments.length === 3) {
        location = arg1 + "," + arg2;
    } else {
        location = arg1
    }
    if (location.length > 0) {

        var geocoder;
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(location.split(",")[0], location.split(",")[1]);

        geocoder.geocode(
            {'latLng': latlng},
            function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        _callback(results[0].formatted_address);
                    }
                }
            }
        );
    }
};
