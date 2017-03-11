<?php
include($_SERVER["DOCUMENT_ROOT"].'/webassets/default.php');
echo('<link rel="stylesheet" href="/webassets/chanStyle.css" type="text/css">
<title>Sekai: 世界chan</title>
<p class="subTitle">Sekai > 世界chan</p>
<script>
  function insertReply(event) {
    var targ = event.target || event.srcElement;
    document.getElementById("textUpload").value += ">>" + targ.textContent + "\n";
  }
  function insertThread(id) {
    document.getElementById("threadUpload").value = id;
  }
</script>
');
if(reset(explode('=',end(explode('?',$_SERVER['REQUEST_URI'])))) == 'thread') {
  include('thread.php');
} elseif(reset(explode('=',end(explode('?',$_SERVER['REQUEST_URI'])))) == 'post') {
  include('post.php');
} else {
	include('catalog.php');
}
echo('</body>
</html>');
?>
