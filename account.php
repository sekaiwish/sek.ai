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
<?php include("{$_SERVER["DOCUMENT_ROOT"]}/assets/navbar.php"); ?>
<br>
<div class="row" style="justify-content:center;margin:0px;">
  <div class="card-group" style="width:40rem;">
    <div class="card">
      <div class="card-header">
        Change website preferences
      </div>
      <div class="card-block">
        <form method="POST" action="/php/preferences.php">
          <fieldset class="form-group">
            <legend>
              Hyperlink style
            </legend>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="linkstyle" value="0"<?php if($_SESSION["linkstyle"]==0){echo(" checked");}?>>
                4chan Style Hyperlinks
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="linkstyle" value="1"<?php if($_SESSION["linkstyle"]==1){echo(" checked");}?>>
                YouTube Style Hyperlinks
              </label>
            </div>
          </fieldset>
          <fieldset class="form-group">
            <legend>
              Homepage tile style
            </legend>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="tilestyle" value="0"<?php if($_SESSION["tilestyle"]==0){echo(" checked");}?>>
                Animated and colored tiles
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="tilestyle" value="1"<?php if($_SESSION["tilestyle"]==1){echo(" checked");}?>>
                Animated and grey tiles
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="tilestyle" value="2"<?php if($_SESSION["tilestyle"]==2){echo(" checked");}?>>
                Static tiles
              </label>
            </div>
          </fieldset>
          <fieldset class="form-group">
            <legend>
              世界chan threads per page
            </legend>
            <div class="form-check">
              <label class="form-check-label">
                <input type="number" class="form-check-input" name="postsshown" min="5" max="15" value="<?php echo("{$_SESSION["postsshown"]}");?>">
                posts
              </label>
            </div>
          </fieldset>
          <input type="submit" class="btn btn-success" value="Update preferences">
        </form>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-header">
        Change password
      </div>
      <div class="card-block">
        <form method="POST" action="/php/password.php">
          <fieldset class="form-group">
            <legend>
              Current password
            </legend>
            <div class="form-check">
              <input type="password" class="form-control" name="oldpassword" id="oldpassword" maxlength="16" required>
            </div>
          </fieldset>
          <fieldset class="form-group">
            <legend>
              New password
            </legend>
            <div class="form-check">
              <input type="password" class="form-control" name="newpassword" id="newpassword" maxlength="16" required>
            </div>
          </fieldset>
          <fieldset class="form-group">
            <legend>
              Confirm password
            </legend>
            <div class="form-check">
              <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" maxlength="16" required>
            </div>
          </fieldset>
          <input type="submit" class="btn btn-success" value="Update password">
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include("{$_SERVER["DOCUMENT_ROOT"]}/assets/defaultFooter.php");
?>
