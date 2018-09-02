<?php $time = explode(' ', microtime()); $start = $time[1] + $time[0]; session_start(); if (!isset($_SESSION["username"])) { header("Location: /error/401.html"); exit(); } ?>
<!doctype html>
<html>
  <head>
    <title>&#x4E16;&#x754C; &raquo; Anime</title>
    <meta name="author" content="Wish">
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/mplus1p.css" type="text/css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.13/css/solid.css" integrity="sha384-Rw5qeepMFvJVEZdSo1nDQD5B6wX0m7c5Z/pLNvjkB14W6Yki1hKbSEQaX9ffUbWe" crossorigin="anonymous">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.13/css/brands.css" integrity="sha384-VGCZwiSnlHXYDojsRqeMn3IVvdzTx5JEuHgqZ3bYLCLUBV8rvihHApoA1Aso2TZA" crossorigin="anonymous">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.13/css/fontawesome.css" integrity="sha384-GVa9GOgVQgOk+TNYXu7S/InPTfSDTtBalSgkgqQ7sCik56N9ztlkoTr2f/T44oKV" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="/assets/favicon/sekai/196.png" type="image/png" sizes="196x196">
    <link rel="icon" href="/assets/favicon/sekai/128.png" type="image/png" sizes="128x128">
    <link rel="icon" href="/assets/favicon/sekai/96.png" type="image/png" sizes="96x96">
    <link rel="icon" href="/assets/favicon/sekai/32.png" type="image/png" sizes="32x32">
    <link rel="icon" href="/assets/favicon/sekai/16.png" type="image/png" sizes="16x16">
  </head>
  <body>
    <div id="animeList" class="accordion">
    <?php
      $files = array_slice(scandir("./"), 2);
      $anime = [];
      $i = 1;
      foreach ($files as $key) {
        if (is_dir($key)) {

          array_push($anime, $key);
        }
      }
      foreach ($anime as $key): ?>
      <div class="card bg-dark">
        <button class="card-header mb-0 btn d-flex collapsed text-white" data-toggle="collapse" data-target="#a<?php echo $i; ?>"><?php echo $key; ?></button>
        <div id="a<?php echo $i; ?>" class="collapse" data-parent="#animeList">
          <p class="card-text bg-light">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
      </div>
    <?php $i++; endforeach; ?>
    </div>
    <div class="account btn-group">
      <a class="btn btn-danger" href="/php/logout.php">Logout</a>
      <a class="btn btn-secondary" href="/home/">Home</a>
    </div>
    <?php include("../php/commit.php"); ?>
    <div class="copyright">
      <button class="btn btn-dark"><i class="fas fa-copyright"></i> Wish 2016-2018</button>
    </div>
    <div class="ms">
      <button class="btn btn-dark"><?php $time = explode(' ', microtime()); $finish = $time[1] + $time[0]; echo round(($finish-$start),5) * 1000 . "ms"; ?></button>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>$(document).ready(function(){$("[data-toggle='collapse']").collapse();});</script>
  </body>
</html>
