<?php
//Variables to store the login details
$email = $_POST["email"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];
//An if statement to compare password to see if they match
if($password1 == $password2){
	//Stores the encryption key
$key = "INSERTKEYHERE";
//Encrypts the verified password
$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $password, MCRYPT_MODE_CBC, md5(md5($key))));
$json = file_get_contents("users.json");
$json_decoded = json_decode($json, true);
if (array_key_exists($email,$json_decoded)){
echo "Sorry that email has already been registered, please try another one";
}
else {
$json_decoded[$email] = $encrypted;
$new_json = json_encode($json_decoded);
$Handle = fopen("users.json", 'w');
fwrite($Handle, $new_json);
fclose($Handle);
echo "Sign up successful";
}
}
else{
echo "Passwords do not match, please try again.";
}
?>
