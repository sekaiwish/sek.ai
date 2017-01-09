<?php include('C:/xampp/htdocs/webassets/default.php');
error_reporting(0);?>
        <title>
            WishDrive > WishChan
        </title>
        <p class="neonoire" style="color:white;font-size:150%;">
            WishDrive > WishChan
        </p>
        <p>[<a href="/">Return</a>]</p>
        <div style="position:fixed;right:11px;background:#2a2c2f;">
            <textarea placeholder="Comment" form="upload" name="textUpload" id="textUpload">
            </textarea>
            <form class="commentBox" action="submit.php" method="post" enctype="multipart/form-data" id="upload">
                <input type="file" name="fileUpload" id="fileUpload">
                <br>
                <input style="margin-top:7px;" type="submit" value="Upload File" name="submit">
            </form>
        </div>
<?php
  $link = mysqli_connect("127.0.0.1","root","nig");
  mysqli_select_db($link,'wishchan');
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
    echo('        <br>
        <div class="post">
            <p>
');
    # Display image thumb.
    echo("                ".
    $postData[$x]['filename'].
    " ".
    $postData[$x]['filesize'].
    " bytes".
    "<br><b>".
    $postData[$x]['name'].
    "</b> ".
    $postData[$x]['time'].
    " No.".
    $postData[$x]['id'].
    "<br><br>".
    $postData[$x]['body']);
    echo('
            </p>
        </div>
');
  }
  mysqli_close($link);
?>
    </body>
</html>
