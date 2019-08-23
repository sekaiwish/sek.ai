<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>世界 &#183; /flac/</title>
    <link rel="stylesheet" href="/css/home.css" type="text/css">
  </head>
  <body>
    <canvas id="canvas"></canvas>
    <div id="body">
      <h1>/flac/</h1>
      <p>
        <?php
        $dir = scandir("." . substr($_SERVER["REQUEST_URI"], 5));
        foreach ($dir as $key => $value) {
          if (in_array($value, array(".", "index.php"))) {
            continue;
          } else {
            $cdir = ("." . substr($_SERVER["REQUEST_URI"], 5));
            if (is_dir("$cdir$value")) {
              echo("<a href='$value/'>$value</a><br>");
            } else {
              $size = filesize($value) / 1024;
              echo("<a href='$value'>$value - {$size}KB</a><br>");
            }
          }
        }
        ?>
      </p>
    </div>
    <script src="/js/home.js" charset="utf-8"></script>
  </body>
</html>
