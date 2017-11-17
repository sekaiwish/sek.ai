<?php
session_start();
//include("{$_SERVER["DOCUMENT_ROOT"]}/access/sql.php");
$username = $_POST["username"];
$password = $_POST["password"];
echo("`$username`,`$password`");
?>
