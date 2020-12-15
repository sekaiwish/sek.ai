<?php session_start(); if (!isset($_SESSION["username"])) { header("Location: /error/401.html"); exit(); } ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>世界</title>
    <style>
      #left {
        width: 50vw
      }
      #right {
        width: 50vw
      }
    </style>
  </head>
  <body>
    <canvas id="canvas"></canvas>
    <div id="body">
      <div id="left"><h1 style="background:#fff">世</h1></div>
      <div id="right"><h1 style="background:#000">界</h1></div>
      <h4>&copy; wish 2020</h4>
    </div>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=M+PLUS+1p:300,500&amp;display=swap&amp;subset=japanese">
    <link rel="stylesheet" href="style.css">
    <script>
      document.getElementById("left").firstChild.classList = "load";
      document.getElementById("right").firstChild.classList = "load";
    </script>
  </body>
</html>
