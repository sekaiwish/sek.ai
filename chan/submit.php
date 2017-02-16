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
  $allowed = array("jpg","jpeg","png","gif","JPG","JPEG","PNG","GIF");
  $err = $_FILES["fileUpload"]["error"];
  $temp = $_FILES["fileUpload"]["tmp_name"];
  $ip = $_SERVER["REMOTE_ADDR"];
  $name = $_FILES["fileUpload"]["name"];
  $user = $_SESSION["username"];
  $body = $_POST["textUpload"];
  $body = str_replace("
","<br>",$body);
  $size = $_FILES["fileUpload"]["size"];
  $type = explode(".",$name);
  $type = end($type);
  if($size > 1000000000) {
    echo("ERROR: File cannot be larger than one gibibyte.");
    exit();
  }
  if(!in_array($type,$allowed)) {
    echo("ERROR: File submitted was not an image.");
    exit();
  }
  $lastpostnumber = "SELECT id FROM posts ORDER BY id DESC LIMIT 1";
  $lastpostnumber = mysqli_query($link,$lastpostnumber);
  $lastpostnumber = mysqli_fetch_array($lastpostnumber,MYSQLI_ASSOC);
  $newpostnumber = $lastpostnumber["id"] + 1;
  $submit = "INSERT INTO posts (thread, op, ip, name, body, filename, filetype, filesize)
  VALUES ('$newpostnumber', '1', '$ip', '$user', '$body', '$name', '$type', '$size')";
  if(mysqli_query($link,$submit)) {
    if(move_uploaded_file($temp,"files/$newpostnumber.$type")) {
      mysqli_close($link);
      if(make_thumb("files/$newpostnumber.$type","thumbs/$newpostnumber.jpg","125",$type)) {
        header("Location: /chan");
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
    echo("ERROR: MySQL encountered an error while submitting your file.<br>ERROR INFORMATION: ".mysqli_error($link));
    exit();
  }
}
?>
