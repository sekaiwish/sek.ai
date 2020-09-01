<?php session_start(); if (!isset($_SESSION["username"])) { header("Location: /error/401.html"); exit(); } ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>世界 &middot; Home</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=M+PLUS+1p:300,700&amp;display=swap&amp;subset=japanese">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="icon" href="/sekai.ico">
  </head>
  <body>
    <canvas id="canvas"></canvas>
    <div id=body>
      <h1>世界へようこそ！</h1>
      <br><a onclick="modalToggle()">change account password</a>
      <br><a onclick="trailsToggle()">toggle trails globally</a><br>
      <br><a href="/iku/">/iku/ - pomf-powered file hosting</a>
      <br><a href="/flac/">/flac/ - lossless music collection</a>
      <br><a href="/anime/">/anime/ - bd and webrip collection</a>
      <br><a>/chan/ - unavailable</a>
      <br><a href="/">/index/ - return to index</a>
      <h4>&copy; wish 2020</h4>
      <button class="jp" id="button" onclick="window.location.href='/php/logout.php'">ログアウト&nbsp;&nbsp;&#10148;</button>
    </div>
    <div id="catch" onclick="hide()"></div>
    <div id="modal">
      <h2 class="en" id="title">change password</h2>
      <form action="/php/password.php" method="post">
        <input class="en" type="password" name="old" maxlength="16" placeholder="current password" required>
        <br>
        <input class="en" type="password" name="new" maxlength="16" placeholder="new password" required>
        <br>
        <input class="en" type="password" name="confirm" maxlength="16" placeholder="confirm new password" required>
        <br>
        <input class="en" type="button" value="change!" onclick="password(this.form)">
      </form>
    </div>
    <script src="/js/main.js" charset="utf-8"></script>
    <script src="/js/home.js" charset="utf-8"></script>
    <audio id="player">
      <source src="theme.flac" type="audio/flac">
    </audio>
  </body>
</html>
