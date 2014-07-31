<?php
$email = $_POST["email"];
$password = $_POST["password"];
$key = "INSERTKEYHERE";
$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $password, MCRYPT_MODE_CBC, md5(md5($key))));
$json = file_get_contents("users.json");
$json_decoded = json_decode($json, true);
if (array_key_exists($email,$json_decoded)){
if ($json_decoded[$email] == $encrypted){
setcookie("user", $email);
setcookie("pass_hash",$encrypted);
header("Location: index.php");
exit();
}
else {
echo "Incorrect login credentials";
echo "<a href='signup.html'>Click here to sign up</a>";
}
}
else {
echo "Incorrect login credentials";
echo "<a href='signup.html'>Click here to sign up</a>";
}
?>