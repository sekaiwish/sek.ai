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
  <link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/font-awesome.min.css" rel="stylesheet">
  <link href="/css/login.css" rel="stylesheet">
  <script src="/js/validate.js"></script>
  <script src="/js/jquery-3.2.1.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js"></script>
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
    }
    echo("  </div>\n");
  }
  echo("  <div class=\"card\" style=\"width:21.5rem;\">
    <div class=\"card-header\">
      Register
    </div>
    <div class=\"card-block\">
      <form onsubmit=\"return validateLogin(1)\" action=\"/access/register.php\" method=\"POST\">
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
        <div class=\"g-recaptcha\" data-sitekey=\"6LdkYRoUAAAAAOPDZh5DE_9DRkvcEg6jXNzcORCM\">
        </div>
        <br>
        <button class=\"btn btn-success\" type=\"submit\">
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
  <div class="beta">
    <a target="_blank" href="https://github.com/Sek-ai/Sek.ai/tree/dev-0.6">
      <button class="btn btn-secondary">DEV 0.6</button>
    </a>
  </div>
</body>
</html>
