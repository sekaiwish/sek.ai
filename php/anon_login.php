<?php
session_start();
$_SESSION["rank"] = "0";
$_SESSION["username"] = "Anonymous";
$_SESSION["threads"] = "10";
header("Location: /chan/");
?>
