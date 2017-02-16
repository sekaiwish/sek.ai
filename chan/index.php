<?php include('C:/xampp/htdocs/webassets/default.php');
error_reporting(0);
if(isset($_POST['pageNext'])) {
	header("Location: /chan/?$pageForward");
	exit();
}
if(isset($_POST['pagePrev'])) {
	header("Location: /chan/?$pageBackward");
	exit();
}
?>
        <title>
            Sekai > 世界chan
        </title>
        <p class="subTitle">
            Sekai > 世界chan
        </p>
        <p>[<a href="/">Return</a>]</p>
        <style>
          body {
            background: linear-gradient(to left, #EC7EDD, #3494E6);
          }
        </style>
        <div style="position:fixed;right:11px;background:rgba(0,0,0,0.5);">
            <textarea placeholder="Comment" form="upload" name="textUpload" id="textUpload"></textarea>
            <form class="commentBox" action="submit.php" method="post" enctype="multipart/form-data" id="upload">
                <input type="file" name="fileUpload" id="fileUpload">
                <br>
                <input style="margin-top:7px;" type="submit" value="Upload File" name="submit">
            </form>
        </div>
<?php
  include("C:/xampp/htdocs/access/sql.php");
	$x = $_SESSION["postsshown"];
  $page = end(explode('?',$_SERVER['REQUEST_URI']));
  if(is_numeric($page)) {
    $pageNext = $page + 1;
    $pagePrev = $page - 1;
    if($page < 2) {
      $offset = 0;
    } else {
      $offset = $x * $page - $x;
    }
  } else {
    $offset = 0;
		$page = 1;
		$pageNext = 2;
  }
  $threads = "SELECT thread FROM posts WHERE op = 1 ORDER BY thread DESC LIMIT $x OFFSET $offset";
  $threads = mysqli_query($link,$threads);
  $y = 0;
  while($thread = mysqli_fetch_array($threads,MYSQLI_ASSOC)) {
    $y += 1;
    $displayThreads[$y] = $thread;
  }
  $threadCount = count($displayThreads) + 1;
  for($x = 1; $x < $threadCount; $x++) {
    $postData[$x] = "SELECT id, name, time, body, filename, filetype, filesize FROM posts WHERE op = 1 AND thread = ".$displayThreads[$x]['thread'];
    $postData[$x] = mysqli_query($link,$postData[$x]);
    $postData[$x] = mysqli_fetch_array($postData[$x],MYSQLI_ASSOC);
    if($postData[$x]['filesize'] > 1048576) {
      $size = round($postData[$x]['filesize']/1048576,2);
      $unit = "M";
    } else {
      $size = round($postData[$x]['filesize']/1024);
      $unit = "K";
    }
    echo('        <br>
				<div class="postSeparator">
				</div>
        <div class="post">
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
    echo("            <p>".
    $postData[$x]['filename'].
    " ".
    $size.
    $unit.
    "B".
    "<br><b>".
    $postData[$x]['name'].
    "</b> ".
    $postData[$x]['time'].
    " No.".
    $postData[$x]['id'].
    "<br><br>".
    $postData[$x]['body']);
    echo('</p>
        </div>
');
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
    </body>
</html>
