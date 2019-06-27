<?php session_start(); if (!isset($_SESSION["username"])) { header("Location: /error/401.html"); exit(); } ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>&#x4E16;&#x754C; &#183; Home</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=M+PLUS+1p:300&amp;subset=japanese">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="icon" href="favicon.ico">
  </head>
  <body>
    <canvas id="canvas"></canvas>
    <div id=body>
      <h1>世界へようこそ！</h1>
      <br><a href="/account.php">sek.ai account settings</a><br>
      <br><a href="/iki/">/iki/ - pomf-powered file hosting</a>
      <br><a href="/flac/">/flac/ - lossless music collection</a>
      <br><a href="/anime/">/anime/ - bd and webrip collection</a>
      <br><a>/chan/ - unavailable</a>
      <h4>&copy; wish 2019</h4>
      <button class="jp" id="button" onclick="window.location.href='/php/logout.php';">&#x30ED;&#x30B0;&#x30A2;&#x30A6;&#x30C8;&nbsp;&nbsp;&#10148;</button>
    </div>
    <script src="../js/home.js" charset="utf-8"></script>
    <audio id="player">
      <source src="theme.flac" type="audio/flac">
    </audio>
  </body>
</html>
