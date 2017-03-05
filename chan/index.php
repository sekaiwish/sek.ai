<?php
#error_reporting(0);
include($_SERVER["DOCUMENT_ROOT"].'/webassets/default.php');
echo('        <title>
            Sekai > 世界chan
        </title>
        <p class="subTitle">
            Sekai > 世界chan
        </p>
        <style>
          body {
            background: #2E3136;
          }
        </style>
        <script>
            function insertReply(event) {
                var targ = event.target || event.srcElement;
                document.getElementById("textUpload").value += ">>" + targ.textContent + "\n";
            }
        </script>');
if(reset(explode('=',end(explode('?',$_SERVER['REQUEST_URI'])))) == 'thread') {
  include('thread.php');
} elseif(reset(explode('=',end(explode('?',$_SERVER['REQUEST_URI'])))) == 'post') {
  include('post.php');
} else {
	include('catalog.php');
}
echo('    </body>
</html>');
?>
