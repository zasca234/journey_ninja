var startPoint = new Array();
var oldCoords = new Array();
var mapOptions;
var markers = new Array();
var marker;
var counter = -1;
var unSplit;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var originLocation;
var destination;




var map;

function initialize() {
	getOldCoords();
	directionsDisplay = new google.maps.DirectionsRenderer();
var centrepoint = new google.maps.LatLng(0.0000000, 0.0000000);
var mapOptions = {
zoom : 1,
center : centrepoint
}
map = new google.maps.Map(document.getElementById('map'), mapOptions);
google.maps.event.addListener(map, 'click', addPoint);
  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById("directionsPanel"));

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
calcTime();
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

function getOldCoords() {
	oldCoords[0] = document.getElementById("coordslatold").value;
	oldCoords[1] = document.getElementById("coordslngold").value;
}

function calcTime() {
	originLocation = new google.maps.LatLng(oldCoords[0], oldCoords[1]);
	destination = new google.maps.LatLng(document.getElementById("coordslat").value, document.getElementById("coordslng").value)
	var request = {
    origin:originLocation,
    destination:destination,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
}
