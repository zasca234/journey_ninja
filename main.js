var startPoint;
var endPoint;
var mapOptions;
var markers = new Array();
var marker_locations = new Array();

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
	clearMarkers();
    var marker = new google.maps.Marker({
        position: event.latLng,
        map: map,
        draggable: true
    });
marker_locations.push(event.latLng);
console.log(marker_locations);
markers.push(marker);
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
<<<<<<< HEAD
	document.getElementById("coords").value = startPoint[0] + "," + startPoint[1];
=======
	document.getElementById("coords").innerHTML = startPoint[0] + "," + startPoint[1];
>>>>>>> origin/master
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

<<<<<<< HEAD
=======



>>>>>>> origin/master
