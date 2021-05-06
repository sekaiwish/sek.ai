<?php

session_start();
if (!isset($_SESSION["username"])) { http_response_code(401); exit(); }
require __DIR__ . '/../vendor/autoload.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);

$logoutButton = "<button class='jp' id='button' onclick='logout()'>ログアウト&nbsp;&nbsp;&#10148;</button>";

$modal = <<< EOF
<h2 class='en' id='mtitle'>change password</h2>
<form action='/php/password.php' method='post'>
  <input class='en' type='password' name='old' maxlength='16' placeholder='current password' required>
  <br>
  <input class='en' type='password' name='new' maxlength='16' placeholder='new password' required>
  <br>
  <input class='en' type='password' name='confirm' maxlength='16' placeholder='confirm new password' required>
  <br>
  <input class='en' type='button' value='change!' onclick='password(this.form)'>
</form>
EOF;

echo $twig->render('base.html.twig', [
  'title' => 'home',
  'header' => '世界へようこそ！',
  'page' => 'home',
  'body' => $logoutButton,
  'modal' => $modal
]);

?>
