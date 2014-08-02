<?php
$sessid = $_COOKIE['sess_id'];
$json = file_get_contents("sessions.json");
$json_decoded = json_decode($json, true);
$old_lat = $json_decoded[$sessid][0];
$old_long = $json_decoded[$sessid][1];
echo'
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>JourneyNinja</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<!-- Bootstrap core CSS -->
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=INSERTAPIKEY">
    </script>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="container">
<div class="header">
<ul class="nav nav-pills pull-right">
<li class="active"><a href="#">Home</a></li>
<li><a href="#">About</a></li>
</ul>
<h3 class="text-muted">Journey Ninja</h3>
</div>
<div class="jumbotron">
<h1>Plan your journey</h1>
<form role="form" method="post" action="compare.php">
<h6>search a location.</h6>
<input type="hidden" name="coords_geo1" id="coordslat" value="223" />
<input type="hidden" name="coords_geo2" id="coordslng" value="223" />
<input type="hidden" name="coords_geo3" id="coordslatold" value="'.$old_lat.'" />
<input type="hidden" name="coords_geo4" id="coordslngold" value="'.$old_long.'" />
<br>
<button type="submit" class="btn btn-lg btn-success">Next</button>
</form>
<div id="map">
</div>
<div class="footer">
<p>&copy; Journey Ninja 2014</p>
</div>

</div> <!-- /container -->

<script type="text/javascript" src="main.js"></script>

<!-- Bootstrap core JavaScript
================================================== -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
';
?>

