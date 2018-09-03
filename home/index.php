<?php $time = explode(' ', microtime()); $start = $time[1] + $time[0]; session_start(); if (!isset($_SESSION["username"])) { header("Location: /error/401.html"); exit(); } ?>
<!doctype html>
<html>
  <head>
    <title>&#x4E16;&#x754C; &raquo; Home</title>
    <?php include("../php/sources.php"); ?>
  </head>
  <body>
    <div class="jumbotron bg-dark text-white">
      <h6 class="display-4 jp"><img src="/assets/favicon/sekai/128.png" height="80">&#x4E16;&#x754C;&#x3078;&#x3088;&#x3046;&#x3053;&#x305D;, <?php echo $_SESSION["username"]; ?>!</h6>
      <p class="lead">Welcome to Sekai! You are now logged into the domain.<br>Feel free to access the content available to you.</p>
      <hr class="my-4">
      <div class="row">
        <div class="col-sm-6">
          <div class="card bg-outline-dark text-dark">
            <div class="card-body">
              <h5 class="card-title">Anime Collection</h5>
              <p class="card-text">Collection of Crunchyroll and Blu-ray Disc copies of various anime.</p>
              <a href="/anime/" class="btn btn-outline-primary jp"><b>/anime/</b></a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card bg-outline-dark text-dark">
            <div class="card-body">
              <h5 class="card-title">FLAC Collection</h5>
              <p class="card-text">Collection of lossless audio files, mostly in FLAC format.</p>
              <a href="/flac/" class="btn btn-outline-danger jp"><b>/flac/</b></a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card bg-outline-dark text-dark">
            <div class="card-body">
              <h5 class="card-title">Sekai Channel</h5>
              <p class="card-text">Exclusive invite-only imagebooru for Sekai users.</p>
              <a href="/chan/" class="btn btn-outline-success jp disabled"><b>/chan/ - Unavailable</b></a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card bg-outline-dark text-dark">
            <div class="card-body">
              <h5 class="card-title">Sekaiiki</h5>
              <p class="card-text">Pomf-based file hosting with shortened URL links.</p>
              <a href="/iki/" class="btn btn-outline-info jp"><b>/iki/</b></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include("../php/buttons.php"); ?>
  </body>
</html>
