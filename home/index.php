<?php $time = explode(' ', microtime()); $start = $time[1] + $time[0]; session_start(); if (!isset($_SESSION["username"])) { header("Location: /error/401.html"); exit(); } ?>
<!doctype html>
<html>
  <head>
    <title>&#x4E16;&#x754C; &raquo; Home</title>
    <meta name="author" content="Wish">
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/mplus1p.css" type="text/css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.13/css/solid.css" integrity="sha384-Rw5qeepMFvJVEZdSo1nDQD5B6wX0m7c5Z/pLNvjkB14W6Yki1hKbSEQaX9ffUbWe" crossorigin="anonymous">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.13/css/brands.css" integrity="sha384-VGCZwiSnlHXYDojsRqeMn3IVvdzTx5JEuHgqZ3bYLCLUBV8rvihHApoA1Aso2TZA" crossorigin="anonymous">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.13/css/fontawesome.css" integrity="sha384-GVa9GOgVQgOk+TNYXu7S/InPTfSDTtBalSgkgqQ7sCik56N9ztlkoTr2f/T44oKV" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="/assets/favicon/wish/196.png" type="image/png" sizes="196x196">
    <link rel="icon" href="/assets/favicon/wish/128.png" type="image/png" sizes="128x128">
    <link rel="icon" href="/assets/favicon/wish/96.png" type="image/png" sizes="96x96">
    <link rel="icon" href="/assets/favicon/wish/32.png" type="image/png" sizes="32x32">
    <link rel="icon" href="/assets/favicon/wish/16.png" type="image/png" sizes="16x16">
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
              <a href="/anime/" class="btn btn-outline-primary"><b>/anime/</b></a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card bg-outline-dark text-dark">
            <div class="card-body">
              <h5 class="card-title">Sekai Channel</h5>
              <p class="card-text">Exclusive invite-only imagebooru for Sekai users.</p>
              <a href="/chan/" class="btn btn-outline-success"><b>/chan/</b></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="logout">
      <a class="btn btn-danger" href="/php/logout.php">Logout</a>
    </div>
    <div class="github">
      <?php $proc=proc_open("git rev-parse --short HEAD",array(array("pipe","r"),array("pipe","w"),array("pipe","w")),$pipes);$commit=trim(stream_get_contents($pipes[1])); ?><a target="_blank" href="//github.com/Wish495/sekai-php/commit/<?php echo $commit; ?>">
        <button class="btn btn-dark"><i class="fab fa-github"></i>&nbsp;<?php echo $commit; ?></button>
      </a>
    </div>
    <div class="copyright">
      <button class="btn btn-dark"><i class="fas fa-copyright"></i> Wish 2016-2018</button>
    </div>
    <div class="ms">
      <button class="btn btn-dark"><?php $time = explode(' ', microtime()); $finish = $time[1] + $time[0]; echo round(($finish-$start),5) * 1000 . "ms"; ?></button>
    </div>
  </body>
</html>
