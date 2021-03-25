<?php
header("Content-Type: application/json");
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");

$query = $dbi->prepare('SELECT * FROM stars ORDER BY minTime');
$query->execute();
$results = $query->get_result()->fetch_all(MYSQLI_ASSOC);

$cr = curl_init('https://z9smj03u77.execute-api.us-east-1.amazonaws.com/stars');
$header[] = 'Authorization: global';
curl_setopt($cr, CURLOPT_HTTPHEADER, $header);
curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($cr);
curl_close($cr);
$data = json_decode($data, true);

foreach ($data as &$star) {
  unset($star['sharedKey']);
  // if remote world already tracked (always, but just in case)
  if (in_array($star['world'], array_column($results, 'world'))) {
    $index = array_search($star['world'], array_column($results, 'world'));
    $remote_delta = $star['maxTime'] - $star['minTime'];
    $local_delta = $results[$index]['maxTime'] - $results[$index]['minTime'];
    // remote star newer
    if ($star['minTime'] > $results[$index]['maxTime']) {
      $results[$index] = $star;
    // remote star not new but more precise
    } elseif ($remote_delta < $local_delta) {
      $results[$index] = $star;
    }
  }
}

usort($results, function($a, $b) {
  return $a['minTime'] <=> $b['minTime'];
});

echo(json_encode($results));
