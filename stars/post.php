<?php
header("Content-Type: application/json");
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$data = json_decode(file_get_contents("php://input"), true);
$new = $data[0];

// basic antispam
if (time() + 10800 < $new['minTime']) {
  exit();
} elseif (time() + 10800 < $new['maxTime']) {
  exit();
}

if ($new['loc'] > 13) {
  exit();
}

$query = $dbi->prepare('SELECT * FROM stars WHERE world = ?');
$query->bind_param('i', $new['world']);
$query->execute();
$result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
$old = $result[0];

if (empty($result)) {
  // create new star
  $query = $dbi->prepare('INSERT INTO stars VALUES (?, ?, ?, ?)');
  $query->bind_param('iiii', $new['loc'], $new['world'], $new['minTime'], $new['maxTime']);
  $query->execute();
} elseif ($new['minTime'] > $old['maxTime']) {
  // replace outdated star
  // just don't put any fake data in haha -_-
  $query = $dbi->prepare('UPDATE stars SET min_time = ?, max_time = ?, location = ? WHERE location = ? AND world = ?');
  $query->bind_param('iiiii', $new['minTime'], $new['maxTime'], $new['loc'], $old['location'], $new['world']);
  $query->execute();
} else {
  // refine timing for old star
  if ($old['min_time'] < $new['minTime']) {
    $query = $dbi->prepare('UPDATE stars SET min_time = ? WHERE location = ? AND world = ?');
    $query->bind_param('iii', $new['minTime'], $new['loc'], $new['world']);
    $query->execute();
  }
  if ($old['max_time'] > $new['maxTime']) {
    $query = $dbi->prepare('UPDATE stars SET max_time = ? WHERE location = ? AND world = ?');
    $query->bind_param('iii', $new['maxTime'], $new['loc'], $new['world']);
    $query->execute();
  }
}
