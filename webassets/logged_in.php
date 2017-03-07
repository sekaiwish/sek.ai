<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="/webassets/style.css" type="text/css">
<link rel="stylesheet" href="/webassets/menuStyle.css" type="text/css">
<title>Sekai: Home</title>
</head>
<body>
<p class="beta">DEV 0.6</p>
<p class="user">Logged in as <?php echo($_SESSION["username"]);?>.</p>
<form method="POST" style="position:fixed;right:10px;top:40px;"><input type="submit" name="preferences" value="Preferences"></form>
<form method="POST" style="position:fixed;right:10px;top:68px;"><input type="submit" name="logout" value="Log Out"></form>
<p class="pageTitle">Sekai</p>
<div style="width:70%;margin:auto;">
<a href="/flac"><div class="tile" style='background-image:url("/webassets/tiles/<?php
if($_SESSION["tilestyle"]==2) {
  echo("flac.png");
} else {
  echo("flac.gif");
}?>");'><p class="tileText">FLAC</p></div></a>
<div class="hSeparator"><br></div>
<a href="/anime"><div class="tile" style='background-image:url("/webassets/tiles/<?php
if($_SESSION["tilestyle"]==0) {
  echo("anime.gif");
} elseif($_SESSION["tilestyle"]==1) {
  echo("Ganime.gif");
} else {
  echo("anime.png");
}?>");'><p class="tileText">ANIME</p></div></a>
<div class="hSeparator"><br></div>
<a href="/chan"><div class="nsfwTile" style='background-image:url("/webassets/nsfw.png"),url("/webassets/tiles/<?php
if($_SESSION["tilestyle"]==0) {
  echo("board.gif");
} elseif($_SESSION["tilestyle"]==1) {
  echo("Gboard.gif");
} else {
  echo("board.png");
}?>");'><p class="tileText">CHAN</p></div></a>
<div class="vSeparator"><br></div>
<a href="/dlf"><div class="nsfwTile" style='background-image:url("/webassets/nsfw.png"),url("/webassets/tiles/<?php
if($_SESSION["tilestyle"]==0) {
  echo("dlf.gif");
} elseif($_SESSION["tilestyle"]==1) {
  echo("Gdlf.gif");
} else {
  echo("dlf.png");
}?>");'><p class="tileText">DLF</p></div></a>
<div class="hSeparator"><br></div>
<a href="/hentai"><div class="nsfwTile" style='background-image:url("/webassets/nsfw.png"),url("/webassets/tiles/<?php
if($_SESSION["tilestyle"]==0) {
  echo("hentai.gif");
} elseif($_SESSION["tilestyle"]==1) {
  echo("Ghentai.gif");
} else {
  echo("hentai.png");
}?>");'><p class="tileText">HENTAI</p></div></a>
<div class="hSeparator"><br></div>
<a href="/iso"><div class="tile" style='background-image:url("/webassets/tiles/<?php
if($_SESSION["tilestyle"]==0) {
  echo("iso.gif");
} elseif($_SESSION["tilestyle"]==1) {
  echo("Giso.gif");
} else {
  echo("iso.png");
}?>");'><p class="tileText">ISO</p></div></a>
</div>
</body>
</html>
