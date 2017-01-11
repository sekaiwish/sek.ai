<?php include('C:/xampp/htdocs/webassets/default.php');?>
<title>Sekai > Preferences</title>
<p class="subTitle" style="color:white;font-size:150%">
  Sekai > Preferences
</p>
<p>[<a href="/">Return</a>]<br>
<form method="post" action="/access/updateprefs.php" style="font-family:Arial,Verdana,Tahoma;color:white;">
  <input type="radio" name="linkstyle" value="0" required<?php if($_SESSION["linkstyle"]==0){echo(" checked");}?>>4chan Style Hyperlinks
  <br>
  <input type="radio" name="linkstyle" value="1" required<?php if($_SESSION["linkstyle"]==1){echo(" checked");}?>>YouTube Style Hyperlinks
  <br>
  <br>
  <input type="radio" name="tilestyle" value="0" required<?php if($_SESSION["tilestyle"]==0){echo(" checked");}?>>GIF Menu Tiles (Color)
  <br>
  <input type="radio" name="tilestyle" value="1" required<?php if($_SESSION["tilestyle"]==1){echo(" checked");}?>>GIF Menu Tiles (Black and White)
  <br>
  <input type="radio" name="tilestyle" value="2" required<?php if($_SESSION["tilestyle"]==2){echo(" checked");}?>>PNG Menu Tiles
  <br>
  <br>
  <input type="number" name="postsshown" value="<?php echo($_SESSION["postsshown"]);?>" required min="5" max="50" style="max-width:3em;"> Posts shown per imageboard page
  <br>
  <br>
  <input type="submit" name="confirm" value="Update Preferences">
</form>
