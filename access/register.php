<?PHP
$usernames = array("WiSh","minty","niggerlove");

$username = strtolower($_POST["username"]);
if (in_array($username,$usernames)) {
	header("Location: /registererror");
	exit();
}
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