<?php
$email = $_POST["email"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];
$number = $_POST["mob_number"];
if($password1 == $password2){
$key = "INSERTKEYHERE";
$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $password, MCRYPT_MODE_CBC, md5(md5($key))));
$json = file_get_contents("users.json");
$json_decoded = json_decode($json, true);
$privilege_json = file_get_contents("privileges.json");
$json_decoded2 = json_decode($privilege_json, true);
if (array_key_exists($usrname,$json_decoded)){
echo "Sorry that email has already been registered, please try another one";
}
else {
$json_decoded[$usrname] = $encrypted;
$new_json = json_encode($json_decoded);
$Handle = fopen("users.json", 'w');
fwrite($Handle, $new_json); 
fclose($Handle);
$json_decoded2[$usrname] = "Normal";
$newjson2 = json_encode($json_decoded2);
$Handle = fopen("privileges.json", 'w');
fwrite($Handle, $newjson2); 
fclose($Handle);
echo "Sign up successful";
}
}
else{
echo "Passwords do not match, please try again.";
}
?>