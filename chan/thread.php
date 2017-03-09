<?php
include($_SERVER["DOCUMENT_ROOT"].'/access/sql.php');
$thread = end(explode('=',end(explode('?',$_SERVER['REQUEST_URI']))));
$getOP = mysqli_query($link,"SELECT id, name, time, body, filename, filetype, filesize FROM posts WHERE thread = $thread AND op = 1");
$OP = mysqli_fetch_array($getOP,MYSQLI_ASSOC);
$getThread = mysqli_query($link,"SELECT id, name, time, body, filename, filetype, filesize FROM posts WHERE thread = $thread AND op = 0");
$x = 0;
while($getReplies = mysqli_fetch_array($getThread,MYSQLI_ASSOC)) {
  $x += 1;
  $reply[$x] = $getReplies;
}
echo('<p>[<a href="/chan" class="highlight">Return</a>]</p>
<div class="commentBox">
<textarea placeholder="Comment" form="upload" name="textUpload" id="textUpload"></textarea>
<form class="commentBox" action="submit.php" method="post" enctype="multipart/form-data" id="upload"><input type="hidden" name="threadUpload" id="threadUpload" value="'.$OP['id'].'"><input type="file" name="fileUpload" id="fileUpload"><br><input style="margin-top:7px;" type="submit" value="Submit file" name="submit"></form>
</div>
<div class="thread">
<div class="post"><p class="chan"><a href="/chan/files/'.
  $OP['id'].
  '.'.
  $OP['filetype'].
  '" class="notHighlight" target="_blank"><img class="chan" src="/chan/thumbs/'.
  $OP['id'].
  '.jpg">'.
  $OP['filename'].
  '</a> '.
  $OP['filesize'].
  'B ('.
  $postData[$x]['resolution'].
  ')<br><b>'.
  $OP['name'].
  '</b> '.
  $OP['time'].
  ' <a href="?thread='.
  $OP['id'].
  '" class="notHighlight">No.</a><a onclick="insertReply(event)" class="notHighlight">'.
  $OP['id'].
  '</a> (OP)</p><p class="comment">'.
  $OP['body'].
  '</p></div>');
for($y=1;$y<=count($reply);$y++) {
  echo('<div class="reply" id="'.
  $reply[$y]['id'].
  '"><p class="chan">');
  if($reply[$y]['filename'] != '') {
    echo('<a href="/chan/files/'.
    $reply[$y]['id'].
    '.'.
    $reply[$y]['filetype'].
    '" class="notHighlight" target="_blank"><img class="chan" src="/chan/thumbs/'.
    $reply[$y]['id'].
    '.jpg">'.
    $reply[$y]['filename'].
    '</a> '.
    $reply[$y]['filesize'].
    'B ('.
		$postData[$x]['resolution'].
  	')<br>');
  }
  echo('<b>'.
    $reply[$y]['name'].
    '</b> '.
    $reply[$y]['time'].
    ' <a href="?post='.
    $reply[$y]['id'].
    '" class="notHighlight">No.</a><a onclick="insertReply(event)" class="notHighlight">'.
    $reply[$y]['id'].
    '</a></p><p class="comment">'.
    $reply[$y]['body'].
    '</p></div>');
}
echo('</div>');
?>
