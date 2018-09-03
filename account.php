<?php $time = explode(' ', microtime()); $start = $time[1] + $time[0]; session_start(); if (!isset($_SESSION["username"])) { header("Location: /error/401.html"); exit(); } ?>
<!doctype html>
<html>
  <head>
		<title>&#x4E16;&#x754C; &raquo; Account</title>
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
		<div class="row" style="justify-content:center;margin:auto;">
      <div class="card-group">
        <div class="card bg-dark text-white">
          <div class="card-header">Website Settings</div>
          <div class="card-body">
            <form method="post" action="/php/preferences.php">
              <div class="form-group">
                <label>Threads per Sekai Channel page</label>
                <select class="form-control" name="threads">
                  <?php
									$a = ["3", "5", "10", "15"];
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
							<input type="submit" class="btn btn-outline-success" value="Change Settings">
            </form>
          </div>
        </div>
        <div class="card bg-dark text-white">
          <div class="card-header">Change Password</div>
          <div class="card-body">
            <form method="post" action="/php/password.php">
              <div class="form-group">
                <label>Current Password</label>
                <input type="password" class="form-control" name="old" maxlength="16" required>
              </div>
              <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control" name="new" maxlength="16" required>
              </div>
              <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" class="form-control" name="confirm" maxlength="16" required>
              </div>
              <input type="submit" class="btn btn-outline-success" value="Change Password">
            </form>
          </div>
        </div>
      </div>
    </div>
		<div class="status">
			<?php
			if (isset($_GET["s"])) {
				if ($_GET["s"] == "1") {
					echo '<div class="btn alert-success"><strong>Success</strong> &mdash; Your preferences were successfully updated.</div>';
				} elseif ($_GET["s"] == "2") {
					echo '<div class="btn alert-success"><strong>Success</strong> &mdash; Your password was successfully updated.</div>';
				}
			}
			if (isset($_GET["e"])) {
				if ($_GET["e"] == "1") {
					echo '<div class="btn alert-warning"><strong>Error</strong> &mdash; Passwords did not match.</div>';
				}
			}
			?>
		</div>
    <?php include("php/buttons.php"); ?>
	</body>
</html>
