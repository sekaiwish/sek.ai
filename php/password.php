<?php
session_start();
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$get = mysqli_query($link,"SELECT password FROM login WHERE username = '{$_SESSION["username"]}'");
$oldPassword = mysqli_fetch_array($get,MYSQLI_ASSOC);
if(password_verify($_POST["oldpassword"],$oldPassword["password"])) {
  if($_POST["newpassword"] == $_POST["confirmpassword"]) {
    $newPassword = password_hash($_POST["newpassword"],PASSWORD_DEFAULT);
    if(mysqli_query($link,"UPDATE login SET password = '$newPassword' WHERE username = '{$_SESSION["username"]}'")) {
      mysqli_close($link);
      header("Location: /account/?passwordsuccess=1");
      exit();
    } else {
      echo("MYSQL ERROR: ".mysqli_error($link));
      mysqli_close($link);
      exit();
    }
  } else {
    mysqli_close($link);
    header("Location: /account/password/?passworderror=2");
    exit();
  }
} else {
  mysqli_close($link);
  header("Location: /account/password/?passworderror=1");
  exit();
}
?>
