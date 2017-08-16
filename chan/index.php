<?php
error_reporting(0);
if(isset($_GET["thread"])) {
  include("thread.php");
} elseif (isset($_GET["post"])) {
  include("post.php");
} else {
  include("catalog.php");
}
include("{$_SERVER["DOCUMENT_ROOT"]}/webassets/defaultFooter.php");
?>
