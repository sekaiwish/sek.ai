<?php

require __DIR__ . '/../vendor/autoload.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);

$code = $_GET["code"];

$codeInfo = [
  401 => ['Unauthorised', 'You have not been authorised to access this page'],
  403 => ['Forbidden', 'The page you tried to access is restricted'],
  404 => ['Not Found', 'The page you were looking for does not exist or is disconnected'],
  451 => ['Unavailable by Legal Request', 'This resource has been made unavailable due to legal request'],
  500 => ['Internal Server Error', 'The server encountered an error'],
  503 => ['Service Unavailable', 'The server is currently under heavy load or under maintenance'],
  504 => ['Gateway Timeout', 'Your request timed out']
];

echo $twig->render('error.html.twig', [
  'title' => $code,
  'shorthand' => $codeInfo[$code][0],
  'description' => $codeInfo[$code][1]
]);

?>
