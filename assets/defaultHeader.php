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
if(isset($_POST["return"])) {
	header("Location: /");
	exit();
}
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
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
	<meta name="author" content="Wish">
	<link type="image/png" href="/assets/favicon/256.png" sizes="256x256" rel="icon">
	<link type="image/png" href="/assets/favicon/32.png" sizes="32x32" rel="icon">
	<link type="image/png" href="/assets/favicon/16.png" sizes="16x16" rel="icon">
	<link type="image/png" href="/assets/favicon/180.png" sizes="180x180" rel="apple-touch-icon">
	<link type="application/json" href="/assets/manifest.json" rel="manifest">
	<link type="text/css" href="/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="/css/font-awesome.min.css" rel="stylesheet">
	<link type="text/css" href="/css/style.css" rel="stylesheet">
	<style media="all">
		body{background-image:url(/assets/gradients/light.png);animation:gradient 5s linear 0s infinite normal;}nav>div>form>.btn{margin-left:8px;}.card-group{justify-content:center;}.card-outline-success{border-width:3px;}.card-outline-danger{border-width:3px;}.card-title{text-shadow:1.25px 1.25px 0 #000,-1.25px -1.25px 0 #000,1.25px -1.25px 0 #000,-1.25px 1.25px 0 #000;}
	</style>
	<title>Sekai: <?php echo($pageTitles[$pageIndex]); ?></title>
