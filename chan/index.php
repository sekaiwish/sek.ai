<?php
include("{$_SERVER['DOCUMENT_ROOT']}/webassets/defaultHeader.php");
include("{$_SERVER['DOCUMENT_ROOT']}/webassets/defaultBody.php");
include("{$_SERVER['DOCUMENT_ROOT']}/webassets/defaultNavbar.php");
error_reporting(0);
?>
<link href="/css/chan.css" rel="stylesheet">
<?php
if(reset(explode("=",end(explode("?",$_SERVER["REQUEST_URI"])))) == "thread") {
  include("thread.php");
} elseif(reset(explode("=",end(explode("?",$_SERVER["REQUEST_URI"])))) == "post") {
  include("post.php");
} else {
	include("catalog.php");
}
?>
</body>
</html>
