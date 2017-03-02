<?php
include("C:/xampp/htdocs/access/sql.php");
$x = $_SESSION["postsshown"];
$page = end(explode('?',$_SERVER['REQUEST_URI']));
$offset = 0;
if(is_numeric($page)) {
	$pageNext = $page + 1;
	$pagePrev = $page - 1;
	if($page != 1) {
		$offset = $x * $page - $x;
	}
} else {
	$pageNext = 2;
}
$threads = "SELECT thread FROM posts WHERE op = 1 ORDER BY thread DESC LIMIT $x OFFSET $offset";
# Change to order by last updated, based on time or ID??
$threads = mysqli_query($link,$threads);
$y = 0;
while($thread = mysqli_fetch_array($threads,MYSQLI_ASSOC)) {
  $y += 1;
  $displayThreads[$y] = $thread;
}
$threadCount = count($displayThreads) + 1;
echo('		<div class="commentBox">
            <select form="upload" name="threadUpload" id="threadUpload">
								<option value="new">New thread</option>');
for($x = 1; $x < $threadCount; $x++) {
	echo('<option value="'.$displayThreads[$x]['thread'].'">Thread #'.$displayThreads[$x]['thread'].'</option>');
}
echo('
						</select>
            <textarea placeholder="Comment" form="upload" name="textUpload" id="textUpload"></textarea>
            <form class="commentBox" action="submit.php" method="post" enctype="multipart/form-data" id="upload">
                <input type="file" name="fileUpload" id="fileUpload">
                <br>
                <input style="margin-top:7px;" type="submit" value="Submit file" name="submit">
            </form>
        </div>');
for($x = 1; $x < $threadCount; $x++) {
	echo('<div class="thread">');
  $postData[$x] = "SELECT id, thread, name, time, body, filename, filetype, filesize FROM posts WHERE op = 1 AND thread = ".$displayThreads[$x]['thread'];
  $postData[$x] = mysqli_query($link,$postData[$x]);
  $postData[$x] = mysqli_fetch_array($postData[$x],MYSQLI_ASSOC);
  echo('        <div class="post">
');
  if(isset($postData[$x]['filename'])) {
    echo('            <a href="/chan/files/'.
    $postData[$x]['id'].
    '.'.
    $postData[$x]['filetype'].
    '" target="_blank"><img class="chan" src="/chan/thumbs/'.
    $postData[$x]['id'].
    '.jpg"></a>
');
  }
  echo('            <p>'.
  $postData[$x]['filename'].
  ' '.
  $postData[$x]['filesize'].
  'B'.
  '<br><b>'.
  $postData[$x]['name'].
  '</b> '.
  $postData[$x]['time'].
  ' <a href="?thread='.
	$postData[$x]['id'].
	'" class="notHighlight">No.</a><a onclick="insertReply(event)" class="notHighlight">'.
  $postData[$x]['id'].
  '</a><br><br>'.
  $postData[$x]['body']);
  echo('</p>
      </div>
');
	/*
  $replyData[$x] = "SELECT id, name, time, body FROM posts WHERE thread = ".$displayThreads[$x]['thread']." AND op = 0 ORDER by id DESC LIMIT 3";
  $replyData[$x] = mysqli_query($link,$replyData[$x]);
  $replyData[$x] = mysqli_fetch_array($replyData[$x],MYSQLI_ASSOC);
  $replies = count($replyData);
  if(!isset($replyData[$x]['id'])) {
    $replies = 0;
  }
  for($y = 1; $y <= $replies; $y++) {
    echo('		<div class="reply">
    <p><b>'.$replyData[$y]['name'].'</b> '.$replyData[$y]['time'].' No.'.$replyData[$y]['id'].' &gt;&gt;'.$postData[$x]['id'].'<br><br>'.$replyData[$y]['body'].'</p>
  </div>
');
  }
*/
	# EXAMPLE NESTED MATRIX: $postData[$x]['replies'][$y]
	$z = 1;
	for($y = 2; $y >= 0; $y--) {
		$postData[$x]['replies'][$z] = "SELECT id, name, time, body FROM posts WHERE thread = ".$displayThreads[$x]['thread']." AND op = 0 ORDER by id DESC LIMIT 3 OFFSET $y";# OFFSET needs to go 2 => 1 => 0
		$postData[$x]['replies'][$z] = mysqli_query($link,$postData[$x]['replies'][$z]);
		$postData[$x]['replies'][$z] = mysqli_fetch_array($postData[$x]['replies'][$z],MYSQLI_ASSOC);
		if($postData[$x]['replies'][$z]['name'] != "") {
			echo('		<div class="reply">
			<p><b>'.
			$postData[$x]['replies'][$z]['name'].
			'</b> '.
			$postData[$x]['replies'][$z]['time'].
			' <a href="?post='.
			$postData[$x]['replies'][$z]['id'].
			'" class="notHighlight">No.</a><a onclick="insertReply(event)" class="notHighlight">'.
			$postData[$x]['replies'][$z]['id'].
			'</a> &gt;&gt;'.$postData[$x]['id'].
			'<br><br>'.
			$postData[$x]['replies'][$z]['body'].
			'</p>
		</div>
');
		}
	$z += 1;
	}
	echo('</div>');
}
mysqli_close($link);
$pages = ' [<a href="?1">1</a>]'.
' [<a href="?2">2</a>]'.
' [<a href="?3">3</a>]'.
' [<a href="?4">4</a>]'.
' [<a href="?5">5</a>]'.
' [<a href="?6">6</a>]'.
' [<a href="?7">7</a>]'.
' [<a href="?8">8</a>]'.
' [<a href="?9">9</a>]'.
' [<a href="?10">10</a>]';
$pages = explode('[<a href="?'.$page.'">'.$page.'</a>]', "$pages");
$pages = $pages[0].'[<a href="?'.$page.'"><b>'.$page.'</b></a>]'.$pages[1];
echo('        <div class="pageBox">
          <div>
      <a href="?'.$pagePrev.'">
        <button');
if($page == 1) {
  echo(' disabled');
}
echo('>Previous</button>
      </a>
          </div>
          <div>
              <p class="pages">'.$pages.'</p>
          </div>
          <div>
      <a href="?'.$pageNext.'">
        <button');
if($page == 10) {
  echo(' disabled');
}
echo('>Next</button>
      </a>
          </div>
      </div>
');
?>
