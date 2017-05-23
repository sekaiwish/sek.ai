<?php
if(isset($_FILES['fileUpload'])) {
  /*
  $data = array('secret' => "$recaptcha",
  'response' => "{$_POST['g-recaptcha-response']}",
  'remoteip' => "{$_SERVER['REMOTE_ADDR']}");
  $options = array(
      'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data)
      )
  );
  $context = stream_context_create($options);
  $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
  $success = json_decode($result,true);
  if($success['success'] != 1) {
    session_start();
    $_SESSION['submitError'] = 1;
    header('Location: /chan/');
    exit();
  }
  */
  session_start();
  function make_thumb($source,$destination,$sourceType) {
    $sourceType = strtolower($sourceType);
    if($sourceType == 'jpg' || $sourceType == 'jpeg') {
      $sourceImage = imagecreatefromjpeg($source);
    }
    if($sourceType == 'png') {
      $sourceImage = imagecreatefrompng($source);
    }
    if($sourceType == 'gif') {
      $sourceImage = imagecreatefromgif($source);
    }
    $width = imagesx($sourceImage);
    $height = imagesy($sourceImage);
    if($width < $height) {
      $thumbWidth = floor($width*(125/$height));
      $thumbHeight = 125;
    } else {
      $thumbHeight = floor($height*(125/$width));
      $thumbWidth = 125;
    }
    $thumbnail = imagecreatetruecolor($thumbWidth,$thumbHeight);
    imagecopyresampled($thumbnail,$sourceImage,0,0,0,0,$thumbWidth,$thumbHeight,$width,$height);
    imagejpeg($thumbnail,$destination);
  }
  include("{$_SERVER['DOCUMENT_ROOT']}/access/sql.php");
  $username = $_SESSION['username'];
  $ip = $_SERVER['REMOTE_ADDR'];
  $thread = $_POST['threadUpload'];
  $textBody = $_POST['textUpload'];
  $fileName = $_FILES['fileUpload']['name'];
  $lastID = mysqli_query($link,'SELECT id FROM posts ORDER BY id DESC LIMIT 1');
  $lastID = mysqli_fetch_array($lastID,MYSQLI_ASSOC);
  $nextID = $lastID["id"] + 1;
  # Stop users from submitting empty posts.
  if($fileName == "" && $textBody == "") {
    echo('ERROR: No message was attached.');
    exit();
  }
  # File content formatting
  if($fileName != "") {
    $allowed = array('image/jpeg','image/png','image/gif');
    if(!in_array($_FILES['fileUpload']['type'],$allowed)) {
      echo('ERROR: File submitted was not an image.');
      exit();
    }
    $fileSize = $_FILES['fileUpload']['size'];
    if($fileSize > 1048576) {
      $fileSize = round($fileSize/1048576,2);
      $fileSize = $fileSize.'M';
    } elseif($fileSize > 0) {
      $fileSize = round($fileSize/1024);
      $fileSize = $fileSize.'K';
    } else {
      echo('ERROR: Submitted image was empty.');
      exit();
    }
    $fileType = end(explode('.',$fileName));
    $fileError = $_FILES['fileUpload']['error'];
    $fileTemp = $_FILES['fileUpload']['tmp_name'];
    $fileResolution = getimagesize($fileTemp);
    $fileResolution = $fileResolution[0].'x'.$fileResolution[1];

  } else {
    if($thread == "new") {
      echo('ERROR: No image was attached to new thread.');
      exit();
    }
  }
  # Text content formatting.
  if($textBody != "") {
    preg_match('/(?<=[>]{2})\d+/',$textBody,$replies);
    $textBody = preg_replace('/([>]{2})(\d+)/','⁆a href="?post=$2"⁗&gt;&gt;$2⁆/a⁗',$textBody);
    $textBody = preg_replace('/([>]{1})(.+)(\B|\b)/','⁆span class="greentext"⁗&gt;$2⁆/span⁗$3',$textBody);
    $textBody = str_replace("<","&lt;",$textBody);
    $textBody = str_replace(">","&gt;",$textBody);
    $textBody = str_replace("⁆","<",$textBody);
    $textBody = str_replace("⁗",">",$textBody);
    $textBody = preg_replace('/(.*)(\n)/','$1<br>',$textBody);
  } else {
    if($thread == "new") {
      echo('ERROR: No text was attached to new thread.');
      exit();
    }
  }
  # Update replies array.
  # ! NOT IMPLEMENTED YET !
  if($replies != []) {
    for($x=0;$x<count($replies);$x++) {
      $oldReplies = mysqli_query($link,"SELECT replies FROM posts WHERE id = {$replies[$x]}");
      $oldReplies = mysqli_fetch_array($oldReplies,MYSQLI_ASSOC);
      $oldReplies = $oldReplies['replies'];
      var_dump($oldReplies);
      if($oldReplies == NULL) {
        mysqli_query($link,"UPDATE posts SET replies = $nextID WHERE id = {$replies[$x]}");
      } else {
        $newReplies = "$oldReplies,$nextID";
        mysqli_query($link,"UPDATE posts SET replies = $newReplies WHERE id = {$replies[$x]}");
      }
    }
  }
  # Select SQL template to use for post.
  if($thread == "new") {
    $submit = "INSERT INTO posts (thread, op, ip, name, body, filename, filetype, filesize, resolution) VALUES ('$nextID', '1', '$ip', '$username', '$textBody', '$fileName', '$fileType', '$fileSize', '$fileResolution')";
  } elseif($fileName != "" && $textBody == "") {
    $submit = "INSERT INTO posts (thread, ip, name, filename, filetype, filesize, resolution) VALUES ('$thread', '$ip', '$username', '$fileName', '$fileType', '$fileSize', '$fileResolution')";
  } elseif($fileName == "" && $textBody != "") {
    $submit = "INSERT INTO posts (thread, ip, name, body) VALUES ('$thread', '$ip', '$username', '$textBody')";
  } else {
    $submit = "INSERT INTO posts (thread, ip, name, body, filename, filetype, filesize, resolution) VALUES ('$thread', '$ip', '$username', '$textBody', '$fileName', '$fileType', '$fileSize', '$fileResolution')";
  }
  # Submission for posts with file
  if($fileName != "") {
    if(move_uploaded_file($fileTemp,"files/$nextID.$fileType")) {
      make_thumb("files/$nextID.$fileType","thumbs/$nextID.jpg",$fileType);
      if(mysqli_query($link,$submit)) {
        header("Location: /chan?post=$nextID");
        exit();
      } else {
        echo("ERROR: MySQL encountered an error whilst updating the database.<br>ERROR INFORMATION: {${mysqli_error($link)}}");
        exit();
      }
    } else {
      echo("ERROR: An error occured while uploading your image.<br>ERROR CODE: $fileError");
      exit();
    }
  # Submission for posts without file
  } else {
    if(mysqli_query($link,$submit)) {
      header("Location: /chan?post=$nextID");
      exit();
    } else {
      echo("ERROR: MySQL encountered an error whilst updating the database.<br>ERROR INFORMATION: {${mysqli_error($link)}}");
      exit();
    }
  }
}
?>
