<?php
error_reporting(0);
session_start();
if($_SESSION["logged_in"] != TRUE) {
  include("webassets/logged_out.php");
} else {
  include("webassets/logged_in.php");
}
?>
