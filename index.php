<?php

session_start();
require __DIR__ . '/vendor/autoload.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

if (isset($_SESSION['username'])) {
  $loginButton = "<button class='jp' type='button' name='button' onclick=\"window.location.href='/home/'\">世界に続ける&nbsp;&nbsp;&#10148;</button>";
} else {
  $loginButton = "<button class='jp' type='button' name='button' onclick='modalToggle()'>世界にログイン&nbsp;&nbsp;&#10148;</button>";
}

$modal = <<< EOF
<h2 class='jp' id='mtitle'><b>世界にログイン</b></h2>
<form>
  <input class='jp' type='text' name='username' maxlength='16' placeholder='ユーザー名' required>
  <br>
  <input class='jp' type='password' name='password' maxlength='16' placeholder='パスワード' required>
  <br>
  <input class='jp' type='button' value='ログイン' onclick='login(this.form)'>
</form>
EOF;

echo $twig->render('base.html.twig', [
  'title' => 'wish',
  'page' => 'index',
  'body' => $loginButton,
  'modal' => $modal
]);

?>
