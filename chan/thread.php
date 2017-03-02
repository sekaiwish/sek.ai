<?php
include("C:/xampp/htdocs/access/sql.php");
$thread = end(explode('=',end(explode('?',$_SERVER['REQUEST_URI']))));
$getThread = "SELECT id, name, time, body, filename, filetype, filesize FROM `posts` WHERE thread = $thread";
$getThread = mysqli_query($link,$getThread);
$x = 0;
while($getPost = mysqli_fetch_array($getThread,MYSQLI_ASSOC)) {
  $x += 1;
  $posts[$x] = $getPost;
}
for($x = 1; $x <= count($posts); $x++) {
  echo('<div class="post" id="'.$posts[$x]['id'].'"><p style="width:100%;margin:0px;">');
  if($posts[$x]['filename'] != '') {
    echo('
            <a href="/chan/files/'.
    $posts[$x]['id'].
    '.'.
    $posts[$x]['filetype'].
    '" target="_blank"><img class="chan" src="/chan/thumbs/'.
    $posts[$x]['id'].
    '.jpg"></a>'.
  $posts[$x]['filename'].
  ' '.
  $posts[$x]['filesize'].
  'B<br>');
}
echo('<b>'.
  $posts[$x]['name'].
  '</b> '.
  $posts[$x]['time'].
  ' <a href="?post='.
	$posts[$x]['id'].
	'">No.</a><a onclick="insertReply(event)">'.
  $posts[$x]['id'].
  '</a><br><br>'.
  $posts[$x]['body'].
  '</p>
      </div>
');
}
?>
