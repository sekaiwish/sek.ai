<?php
if(isset($_GET["t"])) {
  include("thread.php");
} elseif (isset($_GET["g"])) {
  include("post.php");
} else {
  include("catalog.php");
}
?>
