<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>世界 &middot; /flac/</title>
    <link rel="stylesheet" href="/css/flac.css" type="text/css">
    <link rel="shortcut icon" href="/test.png">
  </head>
  <body>
    <canvas id="canvas"></canvas>
    <div id="body">
      <h1>/flac/<span><?php echo(urldecode(substr($_SERVER["REQUEST_URI"], 6))); ?></span></h1>
      <p>
        <div class="buttons">
          <a id="reset" onclick="reset()" hidden>Reset</a>
          <br>
          <a id="playlist" onclick="modalToggle()">View Playlist</a>
        </div>
        <?php
        if ($_SERVER["REQUEST_URI"] === "/flac/") {
          echo("<a href='/home/'>.. - [Home]</a><br><br>");
        } else {
          echo("<a href='../'>.. - [Back]</a><br><br>");
        }
        $dir = urldecode("." . substr($_SERVER["REQUEST_URI"], 5));
        $list = scandir($dir);
        if (count(preg_grep("/\S+\.flac$/", $list)) > 1) {
          echo("<a onclick='addFolder()'>[Play folder]</a><br>");
        }
        foreach ($list as $key => $value) {
          $url = str_replace("'", "%27", $value);
          if (in_array($value, array("..", ".", "index.php"))) {
            continue;
          } elseif (is_dir("$dir$value")) {
            echo("<a href='$url/'>$value/</a><br>");
          } elseif (substr($value, -5) == ".flac") {
            echo(
              "<a id='song' onclick='updatePlaylist(\"" .
              urldecode($_SERVER["REQUEST_URI"]) .
              "$url\")'>$value - [Play]</a><br>"
            );
          } else {
            $size = round(filesize($dir . $value) / 1000);
            if ($size > 1000) {
              $size = round($size / 1000);
              echo("<a href='$url'>$value - {$size}MB</a><br>");
            } else {
              echo("<a href='$url'>$value - {$size}KB</a><br>");
            }
          }
        }
        ?>
      </p>
      <div class="music">
        <div class="cover">
          <img id="cover" src="data:null" hidden>
          <?php
          $cover = array_values(preg_grep("/^.*(c|C|f|F)((o(v|ld)er)|(ront))\.(jpg|jpeg|png)$/", $list))[0];
          if (!empty($cover)) {
            echo(
              "<data id='data' value='" .
              urldecode($_SERVER["REQUEST_URI"]) .
              "$cover'></data>"
            );
          }
          ?>
        </div>
        <div class="next" hidden></div>
        <div class="visual">
          <b>Now playing: </b><span id="track">N/A</span>
        </div>
        <div class="controls">
          <audio id="player" preload="auto" controls></audio>
        </div>
      </div>
    </div>
    <div id="catch" onclick="catchModal()"></div>
    <div id="modal">
      <h2>Playlist</h2>
      <div id="contents"></div>
    </div>
    <script src="/js/main.js" charset="utf-8"></script>
    <script src="/js/flac.js" charset="utf-8"></script>
  </body>
</html>
