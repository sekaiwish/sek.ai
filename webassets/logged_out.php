<?php session_start();?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/webassets/style.css" type="text/css">
    <title>
      Log in to WishDrive
    </title>
  </head>
  <body bgcolor="#1D1F21">
    <p class="beta">
      DEV 0.5
    </p>
    <p class="neonoireTitle">
      WishDrive
    </p>
    <h2>
      Log in to WishDrive
    </h2>
    <?php
      if(isset($_SESSION["loginerror"])) {
        echo('<div class="centerDiv" style="padding-bottom:1em;">
      <div class="errorDiv">
        <p class="errorText">
          ');
        if($_SESSION["loginerror"]==1) {
          echo("User not found.");
        } elseif($_SESSION["loginerror"]==2) {
          echo("Your account has not been approved yet.");
        } elseif($_SESSION["loginerror"]==3) {
          echo("Incorrect password.");
        }
        echo("
        </p>
      </div>
    </div>
");}
    ?>
    <form style="text-align:center;color:gray;" action="/access/login.php" method="post" accept-charset="UTF-8">
      <div class="container">
        <label>
          <b>
            Username
          </b>
        </label>
        <br>
        <input type="text" placeholder="Enter Username" name="username" id="username" maxlength="16" required>
        <br>
        <label>
          <b>
            Password
          </b>
        </label>
        <br>
        <input type="password" placeholder="Enter Password" name="password" id="password" maxlength="16" required>
        <br>
        <button type="submit">
          Login
        </button>
        <a href="/register">
          <button type="button">
            Register
          </button>
        </a>
      </div>
    </form>
  </body>
</html>
<?php session_destroy();?>
