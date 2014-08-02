<?php
echo $_POST["coords_geo"];
$current_loc1 = $_POST["coords_geo1"];
$current_loc2 = $_POST["coords_geo2"];
$json = file_get_contents("sessions.json");
$json_decoded = json_decode($json, true);
$num_visits = count($json_decoded) + 1;
$json_decoded[$num_visits][0] = $current_loc1;
$json_decoded[$num_visits][1] = $current_loc2;
$new_json = json_encode($json_decoded);
$Handle = fopen("sessions.json", 'w');
fwrite($Handle, $new_json); 
fclose($Handle);
setcookie("sess_id",$num_visits);
header("Location: dest.php");
?>