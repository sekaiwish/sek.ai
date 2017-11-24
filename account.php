<?php
session_start();
if(!isset($_SESSION["username"])) {
	header("Location: /error/401.html");
  exit();
}
if(isset($_POST["logout"])) {
  session_destroy();
	header("Location: /");
}
?>
<!doctype html>
<html>
  <head>
  	<meta name="author" content="Wish">
  	<link type="image/png" href="/assets/favicon/256.png" sizes="256x256" rel="icon">
  	<link type="image/png" href="/assets/favicon/32.png" sizes="32x32" rel="icon">
  	<link type="image/png" href="/assets/favicon/16.png" sizes="16x16" rel="icon">
  	<link type="image/png" href="/assets/favicon/180.png" sizes="180x180" rel="apple-touch-icon">
  	<link type="application/json" href="/assets/manifest.json" rel="manifest">
  	<link type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet">
  	<link type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  	<script src="//code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  	<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  	<link type="text/css" href="/css/chan.css" rel="stylesheet">
  	<title>&#x4E16;&#x754C;&#x3061;&#x3083;&#x3093;</title>
  </head>
  <?php include("{$_SERVER["DOCUMENT_ROOT"]}/assets/navbar.php");
  if (isset($_GET["s"])) {
    if ($_GET["s"] == "1"): ?><div class="alert alert-success alert-dismissable fade show">
      <strong>Success</strong> &mdash; Your preferences were successfully updated.
      <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div><?php elseif ($_GET["s"] == "2"): ?><div class="alert alert-success alert-dismissable fade show">
      <strong>Success</strong> &mdash; Your password was successfully updated.
      <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div><?php endif;
  } elseif (isset($_GET["e"])) {
    if ($_GET["e"] == "1"): ?><div class="alert alert-warning alert-dismissable fade show">
      <strong>Error</strong> &mdash; Passwords did not match.
      <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div><?php endif; } ?>
    <div class="row" style="justify-content:center;margin:0px;transform:translate(0,20%);">
      <div class="card-group" style="width:40rem;">
        <div class="card">
          <div class="card-header">&#x4E16;&#x754C;&#x3061;&#x3083;&#x3093;&#x306E;&#x8A2D;&#x5B9A;</div>
          <div class="card-body">
            <form method="post" action="/php/preferences.php">
              <div class="form-group">
                <label>&#x4E16;&#x754C;&#x3061;&#x3083;&#x3093;&#x9801;&#x5F53;&#x305F;&#x308A;&#x306E;&#x30B9;&#x30EC;&#x30C3;&#x30C9;</label>
                <select class="form-control" name="threads">
                  <?php $a = ["3", "5", "10", "15"];
                  $t = $_SESSION["threads"];
                  for ($i=0; $i < 4; $i++) {
                    if ($a[$i] == $t) {
                      echo "<option value=\"{$a[$i]}\" selected>{$a[$i]}</option>";
                    } else {
                      echo "<option value=\"{$a[$i]}\">{$a[$i]}</option>";
                    }
                  } ?>
                </select>
              </div>
              <input type="submit" class="btn btn-success" value="&#x66F4;&#x65B0;&#x8A2D;&#x5B9A;">
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-header">&#x30D1;&#x30B9;&#x30EF;&#x30FC;&#x30C9;&#x306E;&#x5909;&#x66F4;</div>
          <div class="card-body">
            <form method="post" action="/php/password.php">
              <div class="form-group">
                <label>&#x73FE;&#x5728;&#x306E;&#x30D1;&#x30B9;&#x30EF;&#x30FC;&#x30C9;</label>
                <input type="password" class="form-control" name="old" maxlength="16" required>
              </div>
              <div class="form-group">
                <label>&#x65B0;&#x3057;&#x3044;&#x30D1;&#x30B9;&#x30EF;&#x30FC;&#x30C9;</label>
                <input type="password" class="form-control" name="new" maxlength="16" required>
              </div>
              <div class="form-group">
                <label>&#x78BA;&#x8A8D;&#x30D1;&#x30B9;&#x30EF;&#x30FC;&#x30C9;</label>
                <input type="password" class="form-control" name="confirm" maxlength="16" required>
              </div>
              <input type="submit" class="btn btn-success" value="&#x66F4;&#x65B0;&#x30D1;&#x30B9;&#x30EF;&#x30FC;&#x30C9;">
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="github">
      <a target="_blank" href="//github.com/Sek-ai/Sek.ai/tree/dev">
        <button class="btn btn-dark"><i class="fa fa-github"></i> <b>D0.7</b></button>
      </a>
    </div>
    <footer class="footer bg-dark">
      <div class="container">
        <span class="text-muted float-left">&copy; 2016-2017 Wish</span>
        <span class="text-muted float-right">Logged in as <?php echo $_SESSION["username"]; if ($_SESSION["rank"] == 2): ?> (Administrator)<?php elseif ($_SESSION["rank"] == 1): ?> (Moderator)<?php endif; ?></span>
      </div>
    </footer>
  </body>
</html>
