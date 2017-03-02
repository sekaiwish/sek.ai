<?php
error_reporting(0);
include('C:/xampp/htdocs/webassets/default.php');
?>
        <title>
            Sekai > 世界chan
        </title>
        <p class="subTitle">
            Sekai > 世界chan
        </p>
        <p>[<a href="/" class="highlight">Return</a>]</p>
        <style>
          body {
            background: linear-gradient(to left, #EC7EDD, #3494E6);
          }
        </style>
        <script>
            function insertReply(event) {
                var targ = event.target || event.srcElement;
                document.getElementById("textUpload").value += ">>" + targ.textContent + "\n";
            }
        </script>
        <div class="container">
<?php
  if(reset(explode('=',end(explode('?',$_SERVER['REQUEST_URI'])))) == 'thread') {
    include('C:/xampp/htdocs/chan/thread.php');
	} elseif(reset(explode('=',end(explode('?',$_SERVER['REQUEST_URI'])))) == 'post') {
    include('C:/xampp/htdocs/chan/post.php');
	} else {
		include('C:/xampp/htdocs/chan/catalog.php');
	}
?>
        </div>
    </body>
</html>
