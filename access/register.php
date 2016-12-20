<?PHP
$usernames = array("WiSh","minty","niggerlove");

$username = strtolower($_POST["username"]);
$usernamecount = count($usernames);
for($x = 0; $x < $usernamecount; $x++) {
	$usernamesLower[$x] = strtolower($usernames[$x]);
}
if(in_array($username,$usernamesLower)) {
	header("Location: /registererror");
	exit();
}

$username = $_POST["username"];
$password = $_POST["password"];
$email = strtolower($_POST["email"]);
$append = array($username,$password,$email);

//openssl_encrypt($append, aes-256-ofb, fUcKiNgNiGgEr);

$fp = fopen('register.csv','a');
fwrite($fp,"\r\n");
fputcsv($fp,$append);
fclose($fp);

header("Location: /registered")
?>
