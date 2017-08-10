<?php
error_reporting(0);
session_start();
if($_SESSION["logged_in"] != TRUE) {
  include("webassets/login.php");
} else {
  include("webassets/home.php");
}
?>
