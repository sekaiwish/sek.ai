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
<html lang="en">
	<head>
		<title>&#x4E16;&#x754C;&#x3061;&#x3083;&#x3093;</title>
		<meta name="author" content="Wish">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
		<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/mplus1p.css" type="text/css">
		<link rel="stylesheet" href="/css/chan.css">
		<link rel="icon" href="/assets/favicon/sekai/196.png" type="image/png" sizes="196x196">
		<link rel="icon" href="/assets/favicon/sekai/128.png" type="image/png" sizes="128x128">
		<link rel="icon" href="/assets/favicon/sekai/96.png" type="image/png" sizes="96x96">
		<link rel="icon" href="/assets/favicon/sekai/32.png" type="image/png" sizes="32x32">
		<link rel="icon" href="/assets/favicon/sekai/16.png" type="image/png" sizes="16x16">
		<script src="//code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	</head>
<?php
include("{$_SERVER["DOCUMENT_ROOT"]}/assets/navbar.php");
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$thread = $_GET["t"];
$getOP = mysqli_query($link,"SELECT id, name, time, body, filename, filetype, filesize, resolution FROM posts WHERE thread = $thread AND op = 1");
$OP = mysqli_fetch_array($getOP,MYSQLI_ASSOC);
$getThread = mysqli_query($link,"SELECT id, name, time, body, filename, filetype, filesize, resolution FROM posts WHERE thread = $thread AND op = 0");
$x = 0;
while($getReplies = mysqli_fetch_array($getThread,MYSQLI_ASSOC)) {
  $reply[$x] = $getReplies;
  $x++;
}
?>
<script>
  function enlargeImage(id, filetype) {
    var imageid = "i" + id;
    const result = document.getElementById(imageid).src.replace(/(.*)(/.*/.*/.*)/g, "$2");
    if (result == "/chan/thumbs/" + id + ".jpg") {
      document.getElementById(imageid).src = "/chan/files/" + id + "." + filetype;
    } else {
      document.getElementById(imageid).src = "/chan/thumbs/" + id + ".jpg";
    }
  }
</script>
<?php
if($OP["filename"] == "") {
  echo("<div class=\"alert alert-danger fade show\" role=\"alert\"><b>Error:</b> Thread does not exist.</div>");
  exit();
}
?>
<form class="commentBox" enctype="multipart/form-data" id="upload" action="/php/submit.php" method="post">
  <input type="hidden" name="threadUpload" value="<?php echo($OP["id"]); ?>">
  <textarea class="form-control col-sm-12" placeholder="Comment" form="upload" name="textUpload" id="textUpload"></textarea>
  <label class="custom-file col-sm-12">
    <input class="custom-file-input" type="file" name="fileUpload" id="fileUpload">
    <span class="custom-file-control form-control-file"></span>
  </label>
  <br>
  <button class="btn btn-sm g-recaptcha form-control col-sm-12" data-sitekey="6LcykxoUAAAAAMEKIJkUZ7do2Q2DohJ2L7TKbgK6" data-callback="onSubmit">
    Submit Post
  </button>
</form>
<div class="thread">
<a class="btn btn-outline-info" href="."><i class="fa fa-arrow-circle-left"></i> Return</a>
<?php
echo("<div class=\"post\"><p class=\"chan\"><img src=\"/chan/thumbs/{$OP["id"]}.jpg\" id=\"i{$OP["id"]}\" onclick=\"enlargeImage('{$OP["id"]}','{$OP["filetype"]}')\"><b>{$OP["name"]}</b> {$OP["time"]} <a href=\"?t={$OP["id"]}\" class=\"notHighlight\">No.</a><a onclick=\"insertReply(event)\" class=\"notHighlight\">{$OP["id"]}</a> (OP)<br><a class=\"notHighlight\" target=\"_blank\" href=\"/chan/files/{$OP["id"]}.{$OP["filetype"]}\">{$OP["filename"]}</a> {$OP["filesize"]}B ({$OP["resolution"]})</p><p id=\"test\" class=\"comment\">{$OP["body"]}</p></div>");
if (isset($reply)) {
	for($y=0;$y<count($reply);$y++) {
	  echo("<div class=\"reply\" id=\"{$reply[$y]["id"]}\"><p class=\"chan\">");
	  if($reply[$y]["filename"] != "") {
	    echo("<img class=\"chan\" src=\"/chan/thumbs/{$reply[$y]["id"]}.jpg\" id=\"i{$reply[$y]["id"]}\" onclick=\"enlargeImage('{$reply[$y]["id"]}','{$reply[$y]["filetype"]}')\">");
	  }
	  echo("<b>{$reply[$y]["name"]}</b> {$reply[$y]["time"]} <a href=\"?g={$reply[$y]["id"]}\" class=\"notHighlight\">No.</a><a onclick=\"insertReply(event)\" class=\"notHighlight\">{$reply[$y]["id"]}</a>");
	  if($reply[$y]["filename"] != "") {
	    echo("<br><a href=\"/chan/files/{$reply[$y]["id"]}.{$reply[$y]["filetype"]}\" class=\"notHighlight\" target=\"_blank\">{$reply[$y]["filename"]}</a> {$reply[$y]["filesize"]}B ({$reply[$y]["resolution"]})");
	  }
	  echo("</p><p class=\"comment\">{$reply[$y]["body"]}</p></div>\n");
	}
}
echo("</div>");
?>
<footer class="footer bg-dark">
	<div class="github">
		<?php $proc=proc_open("git rev-parse --short HEAD",array(array("pipe","r"),array("pipe","w"),array("pipe","w")),$pipes);$commit=trim(stream_get_contents($pipes[1])); ?><a target="_blank" href="//github.com/Wish495/Sek.ai/commit/<?php echo $commit; ?>">
			<button class="btn btn-dark"><i class="fa fa-github"></i>&nbsp;<?php echo $commit; ?></button>
		</a>
	</div>
	<div class="container">
		<span class="text-muted float-left">&copy; 2016-2017 Wish</span>
		<span class="text-muted float-right">Logged in as <?php echo $_SESSION["username"]; if ($_SESSION["rank"] == 2): ?> (Administrator)<?php elseif ($_SESSION["rank"] == 1): ?> (Moderator)<?php endif; ?></span>
	</div>
</footer>
