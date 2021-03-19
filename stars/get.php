<?php
header("Content-Type: application/json");
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$query = $dbi->prepare('SELECT * FROM stars WHERE maxTime > ? - 180 ORDER BY minTime');
$query->bind_param('i', time());
$query->execute();
$results = $query->get_result()->fetch_all(MYSQLI_ASSOC);
echo(json_encode($results));
