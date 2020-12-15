<?php session_start(); if (!isset($_SESSION["username"])) { header("Location: /error/401.html"); exit(); } ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>wip</title>
  </head>
  <body style="background:#000">
    <canvas id="canvas"></canvas>
    <div id="body">
      <h1>β(test);</h1>
      <?php
      $list = scandir(".");
      foreach (array_slice($list, 2) as $value) {
        if (is_dir($value)) {
          echo("<a href='$value'>$value</a><br>");
        }
      }
      ?>
      <h4>&copy; wish 2020</h4>
    </div>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=M+PLUS+1p:300,500&amp;display=swap&amp;subset=japanese">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/index.css">
  </body>
</html>
