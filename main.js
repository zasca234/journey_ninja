var startPoint = new Array();
var endPoint;
var mapOptions;
var markers = new Array();
var marker;
var counter = -1;
var unSplit;

var map;

function initialize() {
var centrepoint = new google.maps.LatLng(0.0000000, 0.0000000);
var mapOptions = {
zoom : 1,
center : centrepoint
}
map = new google.maps.Map(document.getElementById('map'), mapOptions);
google.maps.event.addListener(map, 'click', addPoint);
}
google.maps.event.addDomListener(window, 'load', initialize);

function addPoint(event) {
	counter++;
clearMarkers();
    var marker = new google.maps.Marker({
        position: event.latLng,
        map: map,
        draggable: true
    });
markers.push(marker);
unSplit = markers[counter].getPosition().toString();
var split = unSplit.split(",");
startPoint[0] = split[0];
startPoint[1] = split[1];
document.getElementById("coordslat").value = startPoint[0].slice(1);
document.getElementById("coordslng").value = startPoint[1].slice(")", -1);
google.maps.event.addListener(marker, 'click', function() {
        marker.setMap(null);
        for (var i = 0, I = markers.length; i < I && markers[i] != marker; ++i);
        markers.splice(i, 1);
    });
google.maps.event.addListener(marker, 'dragend', function() {
 
});
}

//hides the last placed marker
function clearMarkers() {
for (i in markers) {
markers[i].setMap(null);
}
}



function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition,showError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    var startPoint = [position.coords.latitude, position.coords.longitude];
    console.log("returned " + startPoint[0] + " " + startPoint[1]);
document.getElementById("coordslat").value = startPoint[0];
document.getElementById("coordslng").value = startPoint[1];

}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
             alert("An unknown error occurred.");
            break;
    }
}

