<?php
error_reporting(0);
session_start();
if($_SESSION["logged_in"] != TRUE) {
  include("assets/login.php");
} else {
  include("assets/home.php");
}
?>
