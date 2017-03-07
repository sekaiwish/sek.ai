<?php
include($_SERVER["DOCUMENT_ROOT"].'/access/sql.php');
$post = end(explode('=',end(explode('?',$_SERVER['REQUEST_URI']))));
$getThread = mysqli_query($link,'SELECT thread FROM posts WHERE id = '.$post);
$gotoThread = implode(mysqli_fetch_array($getThread,MYSQLI_ASSOC));
header("Location: /chan/?thread=$gotoThread#$post");
?>
