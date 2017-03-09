<?php
include($_SERVER["DOCUMENT_ROOT"].'/access/sql.php');
$x = $_SESSION["postsshown"];
$page = end(explode('?',$_SERVER['REQUEST_URI']));
$offset = 0;
if(is_numeric($page)) {
	if($page < 1) {
		header('Location: /chan?1');
		exit();
	}
	elseif ($page > 10) {
		header('Location: /chan?10');
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
}
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
$threads = mysqli_query($link,"SELECT DISTINCT thread FROM posts ORDER BY id DESC LIMIT $x OFFSET $offset");
$y = 1;
while($thread = mysqli_fetch_array($threads,MYSQLI_ASSOC)) {
  $displayThreads[$y] = $thread;
	$y += 1;
}
echo('<p>[<a href="/" class="highlight">Return</a>]</p>
<div class="commentBox">
<select form="upload" name="threadUpload" id="threadUpload"><option value="new">New thread</option>');
for($x=1;$x<=count($displayThreads);$x++) {
	echo('<option value="'.$displayThreads[$x]['thread'].'">Thread #'.$displayThreads[$x]['thread'].'</option>');
}
echo('</select><br>
<textarea placeholder="Comment" form="upload" name="textUpload" id="textUpload"></textarea>
<form class="commentBox" action="submit.php" method="post" enctype="multipart/form-data" id="upload"><input type="file" name="fileUpload" id="fileUpload"><br><input style="margin-top:7px;" type="submit" value="Submit file" name="submit"></form>
</div>
');
for($x=1;$x<=count($displayThreads);$x++) {
	echo('<div class="thread">
');
  $postData[$x] = mysqli_query($link,"SELECT id, thread, name, time, body, filename, filetype, filesize, resolution FROM posts WHERE op = 1 AND thread = ".$displayThreads[$x]['thread']);
  $postData[$x] = mysqli_fetch_array($postData[$x],MYSQLI_ASSOC);
	$postData[$x]['replyCount'] = mysqli_query($link,"SELECT COUNT(id) FROM posts WHERE op = 0 AND thread = ".$postData[$x]['id']);
	$postData[$x]['replyCount'] = mysqli_fetch_array($postData[$x]['replyCount'],MYSQLI_ASSOC);
	if($postData[$x]['replyCount']['COUNT(id)'] == 1) {
		$postData[$x]['replyCount'] = 1;
		$postData[$x]['replyFormat'] = 0;
	} else {
		$postData[$x]['replyCount'] = $postData[$x]['replyCount']['COUNT(id)'];
		$postData[$x]['replyFormat'] = 1;
	}
  echo('<div class="post"><p class="chan"><a href="/chan/files/'.
    $postData[$x]['id'].
    '.'.
    $postData[$x]['filetype'].
    '" class="notHighlight" target="_blank"><img class="chan" src="/chan/thumbs/'.
    $postData[$x]['id'].
    '.jpg">'.
  	$postData[$x]['filename'].
  	'</a> '.
  	$postData[$x]['filesize'].
  	'B ('.
		$postData[$x]['resolution'].
  	')<br><b>'.
  	$postData[$x]['name'].
  	'</b> '.
  	$postData[$x]['time'].
  	' <a href="?thread='.
		$postData[$x]['id'].
		'" class="notHighlight">No.</a><a id="'.
		$postData[$x]['id'].
		'" onclick="insertReply(event);insertThread(this.id)" class="notHighlight">'.
  	$postData[$x]['id'].
  	'</a> (OP) [<a href="?thread='.
		$postData[$x]['id'].
		'">Reply</a>] '.
		$postData[$x]['replyCount'].
		' ');
		if($postData[$x]['replyFormat'] == 0) {
			echo('reply');
		} else {
			echo('replies');
		}
		if($postData[$x]['replyCount'] > 3) {
			echo(' ('.($postData[$x]['replyCount'] - 3).' omitted)');
		}
		echo('</p><p class="comment">'.
  	$postData[$x]['body']);
  echo('</p></div>');
	$z = 1;
	for($y=2;$y>=0;$y--) {
		$postData[$x]['replies'][$z] = mysqli_query($link,'SELECT id, name, time, body, filename, filetype, filesize, resolution FROM posts WHERE thread = '.$displayThreads[$x]['thread'].' AND op = 0 ORDER by id DESC LIMIT 3 OFFSET '.$y);
		$postData[$x]['replies'][$z] = mysqli_fetch_array($postData[$x]['replies'][$z],MYSQLI_ASSOC);
		if($postData[$x]['replies'][$z]['name'] != "") {
			echo('<div class="reply"><p class="chan">');
			if($postData[$x]['replies'][$z]['filename'] != '') {
				echo('<a href="/chan/files/'.
				$postData[$x]['replies'][$z]['id'].
				'.'.
				$postData[$x]['replies'][$z]['filetype'].
				'" class="notHighlight" target="_blank"><img class="chan" src="/chan/thumbs/'.
				$postData[$x]['replies'][$z]['id'].
				'.jpg">'.
				$postData[$x]['replies'][$z]['filename'].
				'</a> '.
				$postData[$x]['replies'][$z]['filesize'].
				'B ('.
				$postData[$x]['replies'][$z]['resolution'].
		  	')<br>');
			}
			echo('<b>'.
			$postData[$x]['replies'][$z]['name'].
			'</b> '.
			$postData[$x]['replies'][$z]['time'].
			' <a href="?post='.
			$postData[$x]['replies'][$z]['id'].
			'" class="notHighlight">No.</a><a id="'.
			$postData[$x]['id'].
			'" onclick="insertReply(event);insertThread(this.id)" class="notHighlight">'.
			$postData[$x]['replies'][$z]['id'].
			'</a> <a href="?thread='.
			$postData[$x]['id'].
			'" class="notHighlight"><span class="replyThread">&gt;&gt;'.$postData[$x]['id'].
			'</span></a></p><p class="comment">'.
			$postData[$x]['replies'][$z]['body'].
			'</p></div>');
		}
	$z += 1;
	}
	echo('
</div>
');
}
mysqli_close($link);
echo('<div class="pageBox"><div><a href="?'.$pagePrev.'"><button');
if($page <= 1) {
  echo(' disabled');
}
echo('>Previous</button></a></div><div><p class="pages">'.$pages.'</p></div><div><a href="?'.$pageNext.'"><button');
if($page >= 10) {
  echo(' disabled');
}
echo('>Next</button></a></div></div>
');
?>
