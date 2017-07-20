<?php
error_reporting(0);
session_start();
if($_SESSION["logged_in"] != TRUE) {
	header("Location: /error/401.html");
  exit();
}
if(isset($_POST["logout"])) {
  session_destroy();
  header("Location: /");
  exit();
}
if(isset($_POST["account"])) {
	header("Location: /account/");
	exit();
}
include("{$_SERVER["DOCUMENT_ROOT"]}/access/sql.php");
$get = mysqli_query($link, "SELECT linkstyle, tilestyle, postsshown FROM login WHERE username = '{$_SESSION["username"]}'");
$data = mysqli_fetch_array($get,MYSQLI_ASSOC);
mysqli_close($link);
$_SESSION["linkstyle"] = $data["linkstyle"];
$_SESSION["tilestyle"] = $data["tilestyle"];
$_SESSION["postsshown"] = $data["postsshown"];
$page = explode("/",$_SERVER["REQUEST_URI"]);
$page = $page[1];
$pageTitles = ["Home","FLAC","Anime","世界chan","DLF","Hentai","ISO"];
$pageLinks = ["home","flac","anime","chan","dlf","hentai","iso"];
if($_SESSION["rank"] > 1) {
	array_push($pageTitles, "Admin");
	array_push($pageLinks, "admin");
}
$pageIndex = array_search($page, $pageLinks);
if($page == "account") {
  $pageTitles = ["Account"];
  $pageIndex = 0;
} else {
  if(!in_array($page,$pageLinks)) {
    $page = "home";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="image/png" href="/webassets/favicon/256.png" sizes="256x256" rel="icon">
	<link type="image/png" href="/webassets/favicon/32.png" sizes="32x32" rel="icon">
	<link type="image/png" href="/webassets/favicon/16.png" sizes="16x16" rel="icon">
	<link href="/webassets/favicon/180.png" sizes="180x180" rel="apple-touch-icon">
	<link href="/webassets/manifest.json" rel="manifest">
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/font-awesome.min.css" rel="stylesheet">
	<script src="/js/jquery-3.2.1.min.js"></script>
	<script src="/js/tether.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/moment.min.js"></script>
	<script src="/js/livestamp.min.js"></script>
	<script src="/js/chan.js"></script>
	<script src="https://www.google.com/recaptcha/api.js"></script>
	<style>
		@keyframes gradient{from{background-position:0px 0px;}to{background-position:-3840px 0px;}}body{background-image:url(/webassets/gradients/light.png);animation:gradient 5s linear 0s infinite normal;}.btn{margin-left:8px;}.card-group{justify-content:center;}.card-outline-success{border-width:3px;}.card-outline-danger{border-width:3px;}.card-title{text-shadow:1.25px 1.25px 0 #000,-1.25px -1.25px 0 #000,1.25px -1.25px 0 #000,-1.25px 1.25px 0 #000;}.beta{font-size:120%;position:fixed;right:16px;bottom:0.5em;}
	</style>
	<title>Sekai: <?php echo($pageTitles[$pageIndex]); ?></title>
</head>
