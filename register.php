<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="/webassets/loginStyle.css" type="text/css">
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript" src="/access/validate.js"></script>
<title>Sekai: Register</title>
</head>
<body>
<p class="pageTitle">Sekai</p>
<?php
if(!isset($_SESSION['registerStatus'])) {
  echo('<div class="login">
<p class="loginHeader"><b>Register for Sekai</b></p>
');
  if(isset($_SESSION['registerError'])) {
    if($_SESSION['registerError'] == 1) {
      echo('<p class="errorText">The reCAPTCHA was not completed successfully.</p>
');
      session_destroy();
    } elseif ($_SESSION['registerError'] == 2) {
      echo('<p class="errorText">That username is invalid.</p>
');
      session_destroy();
    } elseif ($_SESSION['registerError'] == 3) {
      echo('<p class="errorText">That username is already in use.</p>
');
      session_destroy();
    }
  }
  echo <<<END
<form name="login" style="color:white;" action="/access/register.php" method="POST" onsubmit="return validateLogin(1)">
<label>Email Address</label><br><input type="email" placeholder="電子メールアドレス" name="email" size="30" maxlength="48" required autofocus><br>
<label>Username</label><span class="inputInfo" title="- Cannot include characters besides alphanumeric, periods, underscores and dashes.
- Cannot begin or end with a period, underscore or dash.
- Cannot contain two consecutive periods, underscores or dashes.">?</span><br><input type="text" placeholder="ユーザー名" name="username" maxlength="16" required><br>
<label>Password</label><br><input type="password" placeholder="パスワード" name="password" maxlength="16" required><br><br>
<div style="display:flex;justify-content:center;"><div class="g-recaptcha" data-sitekey="6LdkYRoUAAAAAOPDZh5DE_9DRkvcEg6jXNzcORCM"></div></div><br>
<a href="/"><button type="button">Return</button></a>
<button type="submit">Register</button>
</form>
</div>
</body>
</html>
END;
} else {
  echo('
<p style="text-align:center;">Your registration was successful.<br>You will be notified if your application was successful via email.<br><br><a href="/">Click here</a> to return to the homepage.</p>
</body>
</html>');
}
?>
