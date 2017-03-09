<?php include($_SERVER["DOCUMENT_ROOT"].'/webassets/default.php');?>
<title>Sekai: Password</title>
<p class="subTitle" style="color:white;font-size:150%">Sekai > Account > Password</p>
<p>[<a href="/account/">Return</a>]<br></p>
<form method="post" action="/access/password.php">
<?php
if(reset(explode('=',end(explode('?',$_SERVER['REQUEST_URI'])))) == 'error') {
  echo('<p style="color:red;">');
  $error = end(explode('=',end(explode('?',$_SERVER['REQUEST_URI']))));
  if($error == 1) {
    echo('Your old password does not match.');
  } elseif($error == 2) {
    echo('Your new passwords did not match.');
  }
  echo('</p>');
}
if(reset(explode('=',end(explode('?',$_SERVER['REQUEST_URI'])))) == 'success') {
  $success = end(explode('=',end(explode('?',$_SERVER['REQUEST_URI']))));
  echo('<p style="color:lime;">');
  if($success == 1) {
    echo('Your password was successfully changed.');
  }
  echo('</p>');
}
?>
<p>Current password:<br><input type="password" name="oldpassword" id="oldpassword" maxlength="16" required><br><br>
New password:<br><input type="password" name="newpassword" id="newpassword" maxlength="16" required><br><br>
Confirm new password:<br><input type="password" name="confirmpassword" id="confirmpassword" maxlength="16" required></p>
<input type="submit" value="Change Password">
</form>
</body>
</html>
