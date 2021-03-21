<?php
header("Content-Type: application/json");
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
if ($_GET['p']) {
  $period = $_GET['p'];
} else {
  $period = 180;
}
$query = $dbi->prepare('SELECT * FROM stars WHERE maxTime > ? - ? ORDER BY minTime');
$query->bind_param('ii', time(), $period);
$query->execute();
$results = $query->get_result()->fetch_all(MYSQLI_ASSOC);
echo(json_encode($results));
