<?php
include("C:/xampp/htdocs/access/sql.php");
$post = end(explode('=',end(explode('?',$_SERVER['REQUEST_URI']))));
$sql = 'SELECT thread FROM posts WHERE id = '.$post;
$thread = mysqli_query($link,$sql);
$thread = implode(mysqli_fetch_array($thread,MYSQLI_ASSOC));
header("Location: /chan/?thread=$thread#$post");
?>
