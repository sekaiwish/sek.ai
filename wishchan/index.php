<?php include('C:/xampp/htdocs/webassets/default.php');?>
<title>WishDrive > WishChan</title>
<p class="neonoire" style="color:white;font-size:150%">WishDrive > WishChan</p>
<p>[<a href="/">Return</a>]</p>

<form action="submit.php" method="post" enctype="multipart/form-data" style="color:grey;position:fixed;right:50px">
  <input type="file" name="fileToUpload" id="fileToUpload">
  <br>
  <input type="submit" value="Upload File" name="submit">
</form>

<p>
  <?php
    $link = mysqli_connect("127.0.0.1","root","nig");
    $sql = 'SELECT id, name, time, body, files, sticky FROM posts';
    mysqli_select_db($link, 'wishchan');
    $get = mysqli_query($link, $sql);
    $x = 0;
    #$y = 1; $y < $logincount; $y++
    #while($row = mysqli_fetch_array(mysqli_result, MYSQLI_ASSOC)) {
    #  $x += 1;
    #  $logins[$x] = $row;
    #}
    mysqli_close($link);
  ?>
</p>

</body>
</html>
