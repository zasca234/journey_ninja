<?php
$sessid = $_COOKIE['sess_id'];
$json = file_get_contents("sessions.json");
$json_decoded = json_decode($json, true);
$old_lat = $json_decoded[$sessid][0];
$old_long = $json_decoded[$sessid][1];
echo'
<
<li class="active"><a href="#">Home</a></li>
<li><a href="#">About</a></li>
</ul>
<h3 class="text-muted">Journey Ninja</h3>
</div>
<div class="jumbotron">
<h1>Where do you want to go?</h1>
<form role="form" method="post" action="compare.php">
<h6>search a location.</h6>
<input type="hidden" name="coords_geo1" id="coordslat" value="223" />
<input type="hidden" name="coords_geo2" id="coordslng" value="223" />
<input type="hidden" name="coords_geo3" id="coordslatold" value="'.$old_lat.'" />
<input type="hidden" name="coords_geo4" id="coordslngold" value="'.$old_long.'" />
<input type="hidden" name="totalCarTime" id="cartime" value="381" />
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

