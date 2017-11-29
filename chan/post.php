<?php
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$post = $_GET["g"];
$getThread = mysqli_query($link,"SELECT thread FROM posts WHERE id = $post");
$goThread = implode(mysqli_fetch_array($getThread,MYSQLI_ASSOC));
mysqli_close($link);
header("Location: /chan/?t=$goThread#$post");
exit();
?>
