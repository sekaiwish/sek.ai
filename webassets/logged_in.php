<?php
echo('<!DOCTYPE html>
<html>
<head>

<link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="/webassets/font.css" type="text/css">
<title>WishDrive</title>
<style>
  .tile {
    float: left;
    width: 32%;
    background-color: #333333;
    transition: background-color 1s;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .tile2 {
    float: left;
    width: 49%;
    background-color: #333333;
    transition: background-color 1s;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .tileText {
    font-family: "NeoNoire";
    color: white;
    font-size: 350%;
  }
  .tile2Text {
    font-family: "NeoNoire";
    color: white;
    text-align: center;
    font-size: 470%;
  }
  .tile:hover {
    background-color: #777777;
  }
  .tile2:hover {
    background-color: #777777;
  }
</style>
</head>
<body bgcolor="#1D1F21">

<p class="beta">DEV 0.4.3</p>
<p style="position:fixed;right:10px;top:0px">Logged in as '.$_SESSION["username"].'.</p>
<form method="POST" style="position:fixed;right:10px;top:40px">
  <input type="submit" name="logout" value="Log Out">
</form>
<p class="neonoireTitle">WishDrive</p>
<p style="text-align:center">
<div style="height:100%;width:70%;margin:auto">
  <a href="/FLAC"><div class="tile"><p class="tileText">FLAC</p></div></a>
  <div style="float:left;width:2%;height:30%"><br></div>
  <a href="/anime"><div class="tile"><p class="tileText">ANIME</p></div></a>
  <div style="float:left;width:2%;height:30%"><br></div>
  <a href="/board"><div class="tile"><p class="tileText">BOARD</p></div></a>
  <br>
  <div style="float:left;height:3%;width:100%"><br></div>
  <br>
  <a href="/DLF ARCHIVE"><div class="tile2"><p class="tile2Text">DLF</p></div></a>
  <div style="float:left;width:2%;height:30%"><br></div>
  <a href="/hentai"><div class="tile2"><p class="tile2Text">HENTAI</p></div></a>
</div>
</p>

</body>
</html>');
?>
