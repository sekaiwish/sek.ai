<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>世界 &middot; flac</title>
    <link rel="icon" href="/sekai.ico">
  </head>
  <body style='background:#000'>
    <p id='loader' style='position:absolute;color:#333;top:48%;text-align:center;width:100vw;font-family:sans-serif'>Loading...</p>
    <canvas id="canvas"></canvas>
    <div id="body" hidden>
      <h1>/flac/<span><?php echo(urldecode(substr($_SERVER["REQUEST_URI"], 6))); ?></span></h1>
      <p>
        <div class="buttons">
          <a class="ul" id="reset" onclick="reset()" hidden>Reset</a>
          <br>
          <a class="ul" id="playlist" onclick="modalToggle()">Playlist</a>
        </div>
        <?php
        require_once $_SERVER["DOCUMENT_ROOT"].'/getid3/getid3.php';
        $getID3 = new getID3;
        if ($_SERVER["REQUEST_URI"] === "/flac/") {
          echo("<a class='ul' href='/home/'>.. - [Home]</a><br><br>");
        } else {
          echo("<a class='ul' href='../'>.. - [Back]</a><br><br>");
        }
        $dir = urldecode("." . substr($_SERVER["REQUEST_URI"], 5));
        $list = scandir($dir);
        if (count(preg_grep("/\S+\.flac$/", $list)) > 1) {
          echo("<a onclick='addFolder()'>[Play folder]</a><br>");
        }
        foreach ($list as $value) {
          $url = str_replace("'", "%27", $value);
          if (in_array($value, array("..", ".", "index.php"))) {
            continue;
          } elseif (is_dir("$dir$value")) {
            echo("<a href='$url/'>$value/</a><br>");
          } elseif (substr($value, -5) == ".flac") {
            $info = $getID3->analyze(
              $_SERVER['DOCUMENT_ROOT'] .
              urldecode($_SERVER["REQUEST_URI"].$value)
            );
            if ($info["tags"]) {
              $title = $info["tags"]["vorbiscomment"]["title"][0];
              $artist = $info["tags"]["vorbiscomment"]["artist"][0];
              $display = "$artist &mdash; $title";
            } else {
              $display = substr($value, 0, -5);
            }
            echo(
              "<a id='song' onclick='updatePlaylist(\"" .
              $_SERVER["REQUEST_URI"] .
              "$url\",\"$display\")'>$display - [Play]</a><br>"
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
              $_SERVER["REQUEST_URI"] .
              "$cover'></data>"
            );
          }
          ?>
        </div>
        <div class="visual">
          <b class="np">Now playing: </b><span id="track">N/A</span>
        </div>
        <div class="controls">
          <audio id="player" preload="auto" controls></audio>
        </div>
      </div>
    </div>
    <div id="catch" onclick="hide()"></div>
    <div id="modal" hidden>
      <h2>Playlist</h2>
      <div class="playlistSetup">
        <a onclick="exportPlaylist()">Export playlist</a>
        <br>
        <a onclick="importPlaylist()">Import playlist</a>
      </div>
      <div id="contents"></div>
    </div>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=M+PLUS+1p:300&amp;display=swap&amp;subset=japanese">
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/css/flac.css" type="text/css">
    <script src="/js/main.js" charset="utf-8"></script>
    <script src="/js/flac.js" charset="utf-8"></script>
  </body>
</html>
