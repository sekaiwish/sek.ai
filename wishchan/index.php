<?php include('C:/xampp/htdocs/webassets/default.php');
error_reporting(0);?>
        <title>
            Sekai > 世界chan
        </title>
        <p class="subTitle" style="color:white;font-size:150%;">
            Sekai > 世界chan
        </p>
        <p>[<a href="/">Return</a>]</p>
        <div style="position:fixed;right:11px;background:#3787cc;">
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
  $threads = "SELECT thread FROM posts WHERE op = 1 ORDER BY thread DESC LIMIT $x";
  $threads = mysqli_query($link,$threads);
  $y = 0;
  while($thread = mysqli_fetch_array($threads,MYSQLI_ASSOC)) {
    $y += 1;
    $displayThreads[$y] = $thread;
  }
  $threadCount = count($displayThreads) + 1;
  for($x=1;$x<$threadCount;$x++) {
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
        <div class="post">
');
    if(isset($postData[$x]['filename'])) {
      echo('            <a href="/wishchan/files/'.$postData[$x]['id'].'.'.$postData[$x]['filetype'].'" target="_blank"><img style="float:left;padding-right:15px;padding-bottom:15px;" src="/wishchan/thumbs/'.$postData[$x]['id'].'.jpg"></a>
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
  }
  mysqli_close($link);
?>
    </body>
</html>
