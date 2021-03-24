<?php
header("Content-Type: application/json");
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$period = 180;
if ($_GET['p']) {
  $period = $_GET['p'];
}
if ($period == 'all') {
  $query = $dbi->prepare('SELECT * FROM stars ORDER BY minTime');
} else {
  $query = $dbi->prepare('SELECT * FROM stars WHERE maxTime > ? - ? ORDER BY minTime');
  $query->bind_param('ii', time(), $period);
}
$query->execute();
$results = $query->get_result()->fetch_all(MYSQLI_ASSOC);

/*
$cr = curl_init('https://z9smj03u77.execute-api.us-east-1.amazonaws.com/stars');
$header[] = 'Authorization: global';
curl_setopt($cr, CURLOPT_HTTPHEADER, $header);
curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($cr);
curl_close($cr);

$data = json_decode($data, true);
foreach ($data as &$star) {
  unset($star['sharedKey']);
  if (!in_array($star['world'], array_column($results, 'world'))) {
    array_push($results);
  }
}
*/

// merging is an issue and currently prefers local data
// check is needed to see if remote data is newer than local data
#$stars = array_merge($results, $data);

/*
$stars = $results;
usort($stars, function($a, $b) {
  return $a['minTime'] <=> $b['minTime'];
});

echo(json_encode($stars));
*/

echo(json_encode($results));
