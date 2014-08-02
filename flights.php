<?php
date_default_timezone_set("GMT");
$timestamp = time();
$end_timestamp = mktime(24,date('i') , 0, date('m'), date('d') + 1, date('Y'));
//echo $timestamp;
//echo $end_timestamp;
$username = "ENTERUSERNAMEHERE";
$password = "ENTERPASSWORDHERE";
$remote_url = 'http://flightxml.flightaware.com/json/FlightXML2/AirlineFlightSchedules?startDate=$timestamp&endDate=$timestamp_end&origin=LTN&destination=EDI&howMany=15';
// Create a stream
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header' => "Authorization: Basic " . base64_encode("$username:$password")                 
  )
);
$context = stream_context_create($opts);
// Open the file using the HTTP headers set above
$request = file_get_contents($remote_url, false, $context);
$json_decoded = json_decode($request, true);
$parsing_this = $json_decoded['AirlineFlightSchedulesResult']['data'];
echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>JourneyNinja Flights</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
    <!-- Bootstrap core CSS -->
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/theme/theme.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">
	<div class="row">
        <div class="col-md-8">
          <table class="table">
            <thead>
              <tr>
                <th>Ident:</th>
                <th>Actual Ident:</th>
                <th>Departing:</th>
                <th>Arriving:</th>
				<th>Airport of origin:</th>
				<th>Destination Airport:</th>
				<th>Aircraft type:</th>
				<th>Meal service availability:</th>
				<th>Number of first class seats</th>
				<th>Number of business class seats</th>
				<th>Number of economy class seats</th>
              </tr>
            </thead>
			<tbody>
';
foreach($parsing_this as $Key => $Val){
	echo '<tr>';
	echo '<td>'.$parsing_this[$Key]['ident'].'</td>';
	echo '<td>'.$parsing_this[$Key]['actual_ident'].'</td>';
	$timestamp = $parsing_this[$Key]['departuretime'];
	echo '<td>'.gmdate("d-m-Y", $timestamp).'  '.gmdate("H:i:s:T", $timestamp).'</td>';
	$timestamp = $parsing_this[$Key]['arrivaltime'];
	echo '<td>'.gmdate("d-m-Y", $timestamp).'  '.gmdate("H:i:s:T", $timestamp).'</td>';
	echo '<td>'.$parsing_this[$Key]['origin'].'</td>';
	echo '<td>'.$parsing_this[$Key]['destination'].'</td>';
	echo '<td>'.$parsing_this[$Key]['aircrafttype'].'</td>';
	echo '<td>'.$parsing_this[$Key]['meal_service'].'</td>';
	echo '<td>'.$parsing_this[$Key]['seats_cabin_first'].'</td>';
	echo '<td>'.$parsing_this[$Key]['seats_cabin_business'].'</td>';
	echo '<td>'.$parsing_this[$Key]['seats_cabin_coach'].'</td>';
	echo "</tr>";
}
echo '</tbody></table></div></div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>';
?>