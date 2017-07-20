<?php
# Handle users that are already signed in
error_reporting(0);
session_start();
if($_SESSION["logged_in"] == TRUE) {
	header("Location: /");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="robots" content="noindex">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="image/png" href="/webassets/favicon/256.png" sizes="256x256" rel="icon">
	<link type="image/png" href="/webassets/favicon/32.png" sizes="32x32" rel="icon">
  <link type="image/png" href="/webassets/favicon/16.png" sizes="16x16" rel="icon">
	<link href="/webassets/favicon/180.png" sizes="180x180" rel="apple-touch-icon">
  <link href="/webassets/manifest.json" rel="manifest">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/font-awesome.min.css" rel="stylesheet">
  <link href="/css/login.css" rel="stylesheet">
  <script src="/js/validate.js"></script>
	<script>
		function onSubmit(token) {
			document.getElementById("registration").submit();
		}
	</script>
  <script src="https://www.google.com/recaptcha/api.js?render=explicit"></script>
  <title>
    Sekai: Register
  </title>
</head>
<body>
<?php
if(!isset($_SESSION["registerStatus"])) {
  if(isset($_SESSION["registerError"])) {
    echo("  <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
    <strong>Login Error:</strong> ");
    if($_SESSION["registerError"] == 1) {
      echo("The reCAPTCHA was not completed successfully.\n");
      session_destroy();
    } elseif ($_SESSION["registerError"] == 2) {
      echo("That username is invalid.\n");
      session_destroy();
    } elseif ($_SESSION["registerError"] == 3) {
      echo("That username is already in use.\n");
      session_destroy();
    } elseif ($_SESSION["registerError"] == 4) {
    	echo("An error occurred with the mailer.\n");
			session_destroy();
    }
    echo("  </div>\n");
  }
  echo("  <div class=\"card\">
    <div class=\"card-header\">
      Register
    </div>
    <div class=\"card-block\">
      <form onsubmit=\"return validateLogin(1)\" id=\"registration\" action=\"/access/register.php\" method=\"POST\">
        <div class=\"input-group\">
          <span class=\"input-group-addon\"><i class=\"fa fa-envelope fa-fw\"></i></span>
          <input class=\"form-control\" type=\"email\" placeholder=\"電子メールアドレス\" name=\"email\" maxlength=\"48\" required>
        </div>
        <br>
        <div class=\"input-group\">
          <span class=\"input-group-addon\"><i class=\"fa fa-user-circle fa-fw\"></i></span>
          <input class=\"form-control\" type=\"text\" placeholder=\"ユーザー名\" name=\"username\" maxlength=\"16\" required>
        </div>
        <br>
        <div class=\"input-group\">
          <span class=\"input-group-addon\"><i class=\"fa fa-question-circle fa-fw\"></i></span>
          <input class=\"form-control\" type=\"password\" placeholder=\"パスワード\" name=\"password\" maxlength=\"16\" required>
        </div>
        <br>
				<button class=\"btn btn-success g-recaptcha\" data-sitekey=\"6LcykxoUAAAAAMEKIJkUZ7do2Q2DohJ2L7TKbgK6\" data-callback=\"onSubmit\">
					<i class=\"fa fa-pencil-square-o\"></i> Register
				</button>
        <a class=\"btn btn-secondary\" href=\"/\">
          <i class=\"fa fa-arrow-circle-left\"></i> Return
        </a>
      </form>
    </div>
  </div>\n");
} else {
  echo("  <div class=\"card\" style=\"width:20rem;\">
    <div class=\"card-header\">
      Register for Sekai
    </div>
    <div class=\"card-block\">
      <h4 class=\"card-title\">Registration successful!</h4>
      <p class=\"card-text success\">You will be notified if your application was successful via email.</p>
      <br>
      <a href=\"/\" class=\"btn btn-primary\">
        <i class=\"fa fa-arrow-circle-left\"></i> Return
      </a>
    </div>
  </div>\n");
}
?>
  <p class="header">
    Sekai
  </p>
	<div class="beta mobile-hidden">
		<a target="_blank" href="https://github.com/Sek-ai/Sek.ai/tree/dev-0.6">
			<button class="btn btn-secondary"><i class="fa fa-github"></i> <b>DEV 0.6</b></button>
		</a>
	</div>
</body>
</html>
