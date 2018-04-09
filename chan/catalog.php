<?php
$time = explode(' ', microtime());
$start = $time[1] + $time[0];
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
		<script src="/js/chan.js"></script>
		<script src="//www.google.com/recaptcha/api.js?render=explicit"></script>
	</head>
<?php
include("{$_SERVER["DOCUMENT_ROOT"]}/assets/navbar.php");
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$x = $_SESSION["threads"];
if (isset($_GET["p"])) {
	$page = $_GET["p"];
}
$offset = 0;
if(is_numeric($page)) {
	if($page < 1) {
		header("Location: /chan?p=1");
		exit();
	}
	elseif($page > 10) {
		header("Location: /chan?p=10");
		exit();
	}
	$pageNext = $page + 1;
	$pagePrev = $page - 1;
	if($page != 1) {
		$offset = $x * $page - $x;
	}
} else {
	$page = 1;
	$pageNext = 2;
	$pagePrev = 0;
}
$query = $db->prepare("SELECT DISTINCT thread FROM posts ORDER BY id DESC LIMIT :threads OFFSET :page");
$query->bindValue(":threads", $x, PDO::PARAM_STR);
$query->bindValue(":page", $offset, PDO::PARAM_STR);
var_dump($query);
$query->execute();
$result = $query->fetchColumn();
print_r($result);

$threads = mysqli_query($link,"SELECT DISTINCT thread FROM posts ORDER BY id DESC LIMIT $x OFFSET $offset");

$queryString = "SELECT * FROM posts WHERE thread = (:thread1)";
for ($i = 1; $i < $x; $i++) {
	$queryString = $queryString . " OR thread = (:thread" . ($i + 1) . ")";
}

$query = $db->prepare($queryString);
for ($i = 1; $i <= $x; $i++) {
	$query->bindValue(":thread$i", $result[$i-1], PDO::PARAM_INT);
}
$query->execute();
$result = $query->fetchAll();

var_dump($result);


$y = 1;
while($thread = mysqli_fetch_array($threads,MYSQLI_ASSOC)) {
	$displayThreads[$y] = $thread;
	$y++;
}
?>
	<form class="commentBox" enctype="multipart/form-data" id="upload" action="/php/submit.php" method="post">
		<select class="form-control form-control-sm col-sm-12" form="upload" name="threadUpload" id="threadUpload">
			<option value="new">New thread</option>
			<?php
				for ($x = 1; $x <= count($displayThreads); $x++) {
					echo("			<option value=\"{$displayThreads[$x]["thread"]}\">Thread #{$displayThreads[$x]["thread"]}</option>\n");
				}
			?>
		</select>
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
<?php
for ($x = 1; $x <= count($displayThreads); $x++) {
	echo("<div class=\"thread\">");
	$postData[$x] = mysqli_query($link,"SELECT id, thread, name, time, body, filename, filetype, filesize, resolution FROM posts WHERE op = 1 AND thread = {$displayThreads[$x]["thread"]}");
	$postData[$x] = mysqli_fetch_array($postData[$x], MYSQLI_ASSOC);
	$postData[$x]["replyCount"] = mysqli_query($link, "SELECT COUNT(id) FROM posts WHERE op = 0 AND thread = {$postData[$x]["id"]}");
	$postData[$x]["replyCount"] = mysqli_fetch_array($postData[$x]["replyCount"], MYSQLI_ASSOC);
	if($postData[$x]["replyCount"]["COUNT(id)"] == 1) {
		$postData[$x]["replyCount"] = 1;
		$postData[$x]["replyFormat"] = 0;
	} else {
		$postData[$x]["replyCount"] = $postData[$x]["replyCount"]["COUNT(id)"];
		$postData[$x]["replyFormat"] = 1;
	}
	echo("<div class=\"post\"><a href=\"/chan/files/{$postData[$x]["id"]}.{$postData[$x]["filetype"]}\" class=\"notHighlight\" target=\"_blank\"><img src=\"/chan/thumbs/{$postData[$x]["id"]}.jpg\"></a><div class=\"postinfo\"><p><b>{$postData[$x]["name"]}</b> {$postData[$x]["time"]} <a href=\"?t={$postData[$x]["id"]}\" class=\"notHighlight\">No.</a><a id=\"{$postData[$x]["id"]}\" onclick=\"insertReply(event);insertThread(this.id)\" class=\"notHighlight\">{$postData[$x]["id"]}</a> [<a href=\"?t={$postData[$x]["id"]}\">Reply</a>] {$postData[$x]["replyCount"]} ");
	if($postData[$x]["replyFormat"] == 0) {
		echo("reply");
	} else {
		echo("replies");
	}
	if($postData[$x]["replyCount"] > 3) {
		$omissions = $postData[$x]["replyCount"] - 3;
		echo(" ($omissions omitted)");
	}
	if(strlen($postData[$x]["filename"]) > 37) {
		$postData[$x]["shortname"] = substr($postData[$x]["filename"], 0, 27) . "..." . substr($postData[$x]["filename"], -7);
	}
	echo("<br><a href=\"/chan/files/{$postData[$x]["id"]}.{$postData[$x]["filetype"]}\" class=\"notHighlight\" target=\"_blank\">");
	if(isset($postData[$x]["shortname"])) {
		echo("<span title=\"{$postData[$x]["filename"]}\">{$postData[$x]["shortname"]}</span>");
	} else {
		echo($postData[$x]["filename"]);
	}
	echo("</a> {$postData[$x]["filesize"]}B ({$postData[$x]["resolution"]})</p></div><div class=\"comment\">{$postData[$x]["body"]}</div></div>");
	for($y=2,$z=1;$y>=0;$y--,$z++) {
		$postData[$x]["replies"][$z] = mysqli_query($link,"SELECT id, name, time, body, filename, filetype, filesize, resolution FROM posts WHERE thread = '{$displayThreads[$x]["thread"]}' AND op = 0 ORDER by id DESC LIMIT 1 OFFSET $y");
		$postData[$x]["replies"][$z] = mysqli_fetch_array($postData[$x]["replies"][$z],MYSQLI_ASSOC);
		if($postData[$x]["replies"][$z]["id"] != "") {
			echo("<div class=\"reply\">");
			if($postData[$x]["replies"][$z]["filename"] != "") {
				echo("<a href=\"/chan/files/{$postData[$x]["replies"][$z]["id"]}.{$postData[$x]["replies"][$z]["filetype"]}\" class=\"notHighlight\" target=\"_blank\"><img class=\"chan\" src=\"/chan/thumbs/{$postData[$x]["replies"][$z]["id"]}.jpg\"></a>");
			}
			echo("<div class=\"postinfo\"><p><b>{$postData[$x]["replies"][$z]["name"]}</b> {$postData[$x]["replies"][$z]["time"]} <a href=\"?g={$postData[$x]["replies"][$z]["id"]}\" class=\"notHighlight\">No.</a><a id=\"{$postData[$x]["id"]}\" onclick=\"insertReply(event);insertThread(this.id)\" class=\"notHighlight\">{$postData[$x]["replies"][$z]["id"]}</a> <a href=\"?t={$postData[$x]["id"]}\" class=\"notHighlight\"><span class=\"replyThread\">&gt;&gt;{$postData[$x]["id"]}</span></a>");
			if($postData[$x]["replies"][$z]["filename"] != "") {
				echo("<br><a href=\"/chan/files/{$postData[$x]["replies"][$z]["id"]}.{$postData[$x]["replies"][$z]["filetype"]}\" class=\"notHighlight\" target=\"_blank\">{$postData[$x]["replies"][$z]["filename"]}</a> {$postData[$x]["replies"][$z]["filesize"]}B ({$postData[$x]["replies"][$z]["resolution"]})");
			}
			echo("</p></div><div class=\"comment\">{$postData[$x]["replies"][$z]["body"]}</div></div>");
		}
	}
	echo("</div>");
}
mysqli_close($link);
?>
		<div class="chanFooter">
			<div>
				<div class="btn-group">
					<a class="btn btn-outline-info<?php if ($pagePrev === 0) { echo " disabled"; } ?>" href="?p=<?php echo $pagePrev; ?>">&laquo;</a>
					<?php for ($x = 1; $x <= 10; $x++) { if ($x == $page): ?><a class="btn btn-info"><b><?php echo $x; ?></b></a>
					<?php else: ?><a class="btn btn-outline-info" href="?p=<?php echo $x; ?>"><?php echo $x; ?></a><?php endif; } ?>
					<a class="btn btn-outline-info<?php if ($pageNext === 11) { echo " disabled"; } ?>" href="?p=<?php echo $pageNext; ?>">&raquo;</a>
				</div>
			</div>
		</div>
		<footer class="footer bg-dark">
			<div class="github">
	      <?php $proc=proc_open("git rev-parse --short HEAD",array(array("pipe","r"),array("pipe","w"),array("pipe","w")),$pipes);$commit=trim(stream_get_contents($pipes[1])); ?><a target="_blank" href="//github.com/Wish495/sekai-php/commit/<?php echo $commit; ?>">
	        <button class="btn btn-dark"><i class="fa fa-github"></i>&nbsp;<?php echo $commit; ?></button>
	      </a>
	    </div>
			<div class="container">
				<span class="text-muted float-left">&copy; Wish 2016-2018 (<?php $time = explode(' ', microtime()); $finish = $time[1] + $time[0]; echo round(($finish-$start),5) * 1000 . "ms"; ?>)</span>
				<span class="text-muted float-right">Logged in as <?php echo $_SESSION["username"]; if ($_SESSION["rank"] == 2): ?> (Administrator)<?php elseif ($_SESSION["rank"] == 1): ?> (Moderator)<?php endif; ?></span>
			</div>
		</footer>
	</body>
</html>
