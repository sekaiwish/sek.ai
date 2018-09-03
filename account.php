<?php $time = explode(' ', microtime()); $start = $time[1] + $time[0]; session_start(); if (!isset($_SESSION["username"])) { header("Location: /error/401.html"); exit(); } ?>
<!doctype html>
<html>
  <head>
		<title>&#x4E16;&#x754C; &raquo; Account</title>
    <?php include("php/sources.php"); ?>
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
