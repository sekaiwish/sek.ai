<?php

session_start();
require __DIR__ . '/../vendor/autoload.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);

$modal = <<< EOF
<h2 class='en' id='mtitle'>select an option</h2>
<div id='mbody'></div>
EOF;

echo $twig->render('base.html.twig', [
  'title' => 'mhf',
  'header' => '/mhf/',
  'page' => 'mhf',
  'modal' => $modal
]);

?>
