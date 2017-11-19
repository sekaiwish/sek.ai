<?php
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
if(isset($_GET["key"])) {
  $sql = mysqli_query($link, "SELECT approved FROM login WHERE confirm = '{$_GET["key"]}'");
  $result = mysqli_fetch_array($sql, MYSQLI_ASSOC);
  if(isset($result["approved"])) {
    if($result["approved"] == 0) {
      if(mysqli_query($link, "UPDATE login SET approved = '1' WHERE confirm = '{$_GET["key"]}'")) {
        mysqli_close();
        session_start();
        $_SESSION["activated"] = 1;
        header("Location: /");
        exit();
      }
    }
  }
} else {
  header("Location: /error/401.html");
}
?>
