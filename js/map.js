function onMapLoad() {
    // Check if document has been loaded
    if ($("#googleMap").length == 0) {
        setTimeout(onMapLoad, 500);
        return;
    }
    var centerLoc = new google.maps.LatLng(58.378991, 26.714598);
    var markerLoc = new google.maps.LatLng(58.378189, 26.714668);

    var mapProp = {center: centerLoc, zoom: 16};
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

    var marker = new google.maps.Marker({
        position: markerLoc,
        animation: google.maps.Animation.BOUNCE,
        icon: "../favicon.ico"
    });
    marker.setMap(map);

    google.maps.event.addListener(marker, 'mouseover', function () {
        var messageWindow = new google.maps.InfoWindow({content: "Example of text to show while hovered."});
        marker.setAnimation(null);
        messageWindow.open(map, marker);
        var outListener = google.maps.event.addListener(marker, 'mouseout', function () {
            messageWindow.close();
            google.maps.event.removeListener(outListener);
        });
    });


}