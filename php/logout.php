<?php
header('Content-Type: application/json');
session_start();
if (!isset($_SESSION['username'])) { echo json_encode(1); exit; }
session_destroy();
echo json_encode(0);
