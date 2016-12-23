<?php include('C:/xampp/htdocs/webassets/default.php');?>
<title>WishDrive > Preferences</title>
<p class="neonoire" style="color:white;font-size:150%">
  WishDrive > Preferences
</p>
<p>[<a href="/">Return</a>]<br>
<form method="post" action="/access/updateprefs.php" style="font-family: Arial,Verdana,Tahoma; color: grey;">
  <input type="radio" name="linkstyle" value="0" required <?php if($_SESSION["linkstyle"]==0){echo("checked");}?>>4chan Style Hyperlinks
  <br>
  <input type="radio" name="linkstyle" value="1" required <?php if($_SESSION["linkstyle"]==1){echo("checked");}?>>YouTube Style Hyperlinks
  <br>
  <br>
  <input type="radio" name="tilestyle" value="0" required <?php if($_SESSION["tilestyle"]==0){echo("checked");}?>>GIF Menu Tiles (Color)
  <br>
  <input type="radio" name="tilestyle" value="1" required <?php if($_SESSION["tilestyle"]==1){echo("checked");}?>>GIF Menu Tiles (Black and White)
  <br>
  <input type="radio" name="tilestyle" value="2" required <?php if($_SESSION["tilestyle"]==2){echo("checked");}?>>PNG Menu Tiles
  <br>
  <br>
  <input type="text" name="postsshown" value="<?php echo($_SESSION['postsshown']);?>" required>
  <!-- Doesn't return value... yet... -->
  <br>
  <br>
  <input type="submit" name="confirm" value="Update Preferences">
</form>
