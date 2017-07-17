<!DOCTYPE html>
<html>
  <head>
    <link type="image/png" href="/webassets/favicon/256.png" sizes="256x256" rel="icon">
  	<link type="image/png" href="/webassets/favicon/32.png" sizes="32x32" rel="icon">
    <link type="image/png" href="/webassets/favicon/16.png" sizes="16x16" rel="icon">
  	<link href="/webassets/favicon/180.png" sizes="180x180" rel="apple-touch-icon">
    <link href="/webassets/favicon/manifest.json" rel="manifest">
    <link rel="stylesheet" href="/webassets/style.css" type="text/css">
    <title>Confirmation</title>
  </head>
  <body>
    <p class="header">Sekai</p>
    <?php
    if(isset($_GET["key"])) {
      echo("GOT KEY");
    } else {
      echo("NO KEY");
    }
    ?>
    <p class="errorPage">Account Confirmation</p>
    <p style="text-align:center;">
      The page you tried to access is restricted.<br>
      <a href="/">Click here</a> to return to the homepage.
    </p>
  </body>
</html>
