<?php
include("{$_SERVER["DOCUMENT_ROOT"]}/access/sql.php");
$thread = $_GET["thread"];
$getOP = mysqli_query($link,"SELECT id, name, time, body, filename, filetype, filesize, resolution FROM posts WHERE thread = $thread AND op = 1");
$OP = mysqli_fetch_array($getOP,MYSQLI_ASSOC);
$getThread = mysqli_query($link,"SELECT id, name, time, body, filename, filetype, filesize, resolution FROM posts WHERE thread = $thread AND op = 0");
$x = 0;
while($getReplies = mysqli_fetch_array($getThread,MYSQLI_ASSOC)) {
  $reply[$x] = $getReplies;
  $x++;
}
include("{$_SERVER["DOCUMENT_ROOT"]}/webassets/defaultHeader.php");
echo("    <link href=\"/css/chan.css\" rel=\"stylesheet\">\n</head>\n");
include("{$_SERVER["DOCUMENT_ROOT"]}/webassets/defaultNavbar.php");
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
  echo("<div class=\"alert alert-danger fade show\" role=\"alert\"><strong>Error:</strong> Thread does not exist.</div>");
  exit();
}
?>
<form class="commentBox" enctype="multipart/form-data" id="upload" action="submit.php" method="post">
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
<a class="btn btn-outline-info" href="/chan/"><i class="fa fa-arrow-circle-left"></i> Return</a>
<?php
echo("<div class=\"post\"><p class=\"chan\"><img src=\"/chan/thumbs/{$OP["id"]}.jpg\" id=\"i{$OP["id"]}\" onclick=\"enlargeImage(\"{$OP["id"]}\",\"{$OP["filetype"]}\")\"><b>{$OP["name"]}</b> {$OP["time"]} <a href=\"?thread={$OP["id"]}\" class=\"notHighlight\">No.</a><a onclick=\"insertReply(event)\" class=\"notHighlight\">{$OP["id"]}</a> (OP)<br><a class=\"notHighlight\" target=\"_blank\" href=\"/chan/files/{$OP["id"]}.{$OP["filetype"]}\">{$OP["filename"]}</a> {$OP["filesize"]}B ({$OP["resolution"]})</p><p id=\"test\" class=\"comment\">{$OP["body"]}</p></div>");
for($y=0;$y<count($reply);$y++) {
  echo("<div class=\"reply\" id=\"{$reply[$y]["id"]}\"><p class=\"chan\">");
  if($reply[$y]["filename"] != "") {
    echo("<img class=\"chan\" src=\"/chan/thumbs/{$reply[$y]["id"]}.jpg\" id=\"i{$reply[$y]["id"]}\" onclick=\"enlargeImage(\"{$reply[$y]["id"]}\",\"{$reply[$y]["filetype"]}\")\">");
  }
  echo("<b>{$reply[$y]["name"]}</b> {$reply[$y]["time"]} <a href=\"?post={$reply[$y]["id"]}\" class=\"notHighlight\">No.</a><a onclick=\"insertReply(event)\" class=\"notHighlight\">{$reply[$y]["id"]}</a>");
  if($reply[$y]["filename"] != "") {
    echo("<br><a href=\"/chan/files/{$reply[$y]["id"]}.{$reply[$y]["filetype"]}\" class=\"notHighlight\" target=\"_blank\">{$reply[$y]["filename"]}</a> {$reply[$y]["filesize"]}B ({$reply[$y]["resolution"]})");
  }
  echo("</p><p class=\"comment\">{$reply[$y]["body"]}</p></div>\n");
  }
echo("</div>");
?>
