<?php
if(isset($_FILES["fileUpload"])) {
  session_start();
  function make_thumb($src,$dest,$desired_width,$mime) {
    $mime = strtolower($mime);
    if($mime == "jpg") {
      $source_image = imagecreatefromjpeg($src);
    }
    if($mime == "jpeg") {
      $source_image = imagecreatefromjpeg($src);
    }
    if($mime == "png") {
      $source_image = imagecreatefrompng($src);
    }
    if($mime == "gif") {
      $source_image = imagecreatefromgif($src);
    }
    $width = imagesx($source_image);
    $height = imagesy($source_image);
    #if($width < $height) {
    #  $desired_width = floor($width*($resolution/$height));
    #} else {
    #  $desired_height = floor($height*($resolution/$width));
    #}
    $desired_height = floor($height*($desired_width/$width));
    $virtual_image = imagecreatetruecolor($desired_width,$desired_height);
    imagecopyresampled($virtual_image,$source_image,0,0,0,0,$desired_width,$desired_height,$width,$height);
    imagejpeg($virtual_image,$dest);
  }
  include("C:/xampp/htdocs/access/sql.php");
  $allowed = array("jpg","jpeg","png","gif","JPG","JPEG","PNG","GIF","");
  $err = $_FILES["fileUpload"]["error"];
  $temp = $_FILES["fileUpload"]["tmp_name"];
  $ip = $_SERVER["REMOTE_ADDR"];
  $name = $_FILES["fileUpload"]["name"];
  $user = $_SESSION["username"];
  $body = $_POST["textUpload"];
  $size = $_FILES["fileUpload"]["size"];
  $thread = $_POST["threadUpload"];
  if($size > 1048576) {
    $size = round($size/1048576,2);
    $size = $size."M";
  } else {
    $size = round($size/1024);
    $size = $size."K";
  }
  $type = explode(".",$name);
  $type = end($type);
  $body = preg_replace('/([>]{2})(\d+)/','⁆a href="?post=$2"⁗&gt;&gt;$2⁆/a⁗',$body);
  $body = preg_replace('/([>]{1})(.+)(\b)/','⁆span class="greentext"⁗&gt;$2⁆/span⁗$3',$body);
  $body = str_replace("<","&lt;",$body);
  $body = str_replace(">","&gt;",$body);
  $body = str_replace("⁆","<",$body);
  $body = str_replace("⁗",">",$body);
  $body = str_replace("
","<br>",$body);
  if($size > 1000000000) {
    echo("ERROR: File cannot be larger than one gibibyte.");
    exit();
  }
  if(!in_array($type,$allowed)) {
    echo("ERROR: File submitted was not an image.");
    exit();
  }
  if($thread == "new") {
    $lastpostnumber = "SELECT id FROM posts ORDER BY id DESC LIMIT 1";
    $lastpostnumber = mysqli_query($link,$lastpostnumber);
    $lastpostnumber = mysqli_fetch_array($lastpostnumber,MYSQLI_ASSOC);
    $postId = $lastpostnumber["id"] + 1;
    if(!isset($name)) {
      echo('ERROR: Submitting a thread requires an image to be attached.');
      exit();
    }
  } else {
    $postId = $thread;
    $lastpostnumber = "SELECT id FROM posts ORDER BY id DESC LIMIT 1";
    $lastpostnumber = mysqli_query($link,$lastpostnumber);
    $lastpostnumber = mysqli_fetch_array($lastpostnumber,MYSQLI_ASSOC);
    $nextPostId = $lastpostnumber["id"] + 1;
  }
  $submit = "INSERT INTO posts (thread, op, ip, name, body, filename, filetype, filesize)
  VALUES ('$postId', '1', '$ip', '$user', '$body', '$name', '$type', '$size')";
  if($thread != "new") {
    $submit = str_replace("'1'","'0'",$submit);
  }
  if(mysqli_query($link,$submit)) {
    if($thread == "new") {
      if(move_uploaded_file($temp,"files/$postId.$type")) {
        mysqli_close($link);
        if(make_thumb("files/$postId.$type","thumbs/$postId.jpg","125",$type)) {
          header("Location: /chan?thread=$postId");
          exit();
        } else {
          header("Location: /chan");
          exit();
        }
      } else {
        echo("ERROR: Your upload was interrupted.<br>ERROR CODE: $err");
        exit();
      }
    } else {
      header("Location: /chan?post=$postId#$nextPostId");
    }
  } else {
    echo("ERROR: MySQL encountered an error while submitting your file.<br>ERROR INFORMATION: ".mysqli_error($link));
    exit();
  }
}
?>
