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
  <?php
  include("{$_SERVER["DOCUMENT_ROOT"]}/assets/navbar.php");
  include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
  ?>
    <div class="github">
      <?php $proc=proc_open("git rev-parse --short HEAD",array(array("pipe","r"),array("pipe","w"),array("pipe","w")),$pipes);$commit=trim(stream_get_contents($pipes[1])); ?><a target="_blank" href="//github.com/Wish495/Sek.ai/commit/<?php echo $commit; ?>">
        <button class="btn btn-dark"><i class="fa fa-github"></i>&nbsp;<?php echo $commit; ?></button>
      </a>
    </div>
		<script src="/js/chan.js"></script>
		<script src="//www.google.com/recaptcha/api.js?render=explicit"></script>
		<footer class="footer bg-dark">
			<div class="container">
				<span class="text-muted float-left">&copy; 2016-2017 Wish</span>
				<span class="text-muted float-right">Logged in as <?php echo $_SESSION["username"]; if ($_SESSION["rank"] == 2): ?> (Administrator)<?php elseif ($_SESSION["rank"] == 1): ?> (Moderator)<?php endif; ?></span>
			</div>
		</footer>
	</body>
</html>
