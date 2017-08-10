<?php
if (!isset($_GET["q"])) {
  if (!isset($_GET["d"])) {
    exit();
  }
  exit();
}
$query = $_GET["q"];
$directory = $_GET["d"];
$directoryLength = strlen($directory);
$dir_iterator = new RecursiveDirectoryIterator("$directory/", RecursiveDirectoryIterator::SKIP_DOTS);
$iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
$count = 0;
$list = [];
/* Use for folder-only search
foreach($iterator as $file) {
  if ($file->isDir()) {
    $file = substr($file, 1+$directoryLength);
    if (stripos($file, $query) !== false) {
      $count++;
      array_push($list, $file);
    }
  }
}
*/
foreach($iterator as $file) {
  $file = substr($file, 1+$directoryLength);
  if (preg_match("/\.php/", $file)) {
    continue;
  } else {
    if (stripos($file, $query) !== false) {
      $count++;
      array_push($list, $file);
    }
  }
}
$results = "";
foreach ($list as $file) {
  $fileUrl = rawurlencode(str_replace("\\", "/", $file));
  $file = implode("<b>$query</b>", explode($query, $file));
  if ($results == "") {
    $results = "In: $directory<br><a target=\"_blank\" href=\"../$directory/$fileUrl\">$file</a>";
  } else {
    $results = "$results<br>\n<a target=\"_blank\" href=\"../$directory/$fileUrl\">$file</a>";
  }
}
if ($results == "") {
  echo "No results";
} else {
  echo "$results";
}
exit();
?>
