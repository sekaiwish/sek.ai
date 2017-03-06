<?php
session_start();
echo('<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/webassets/loginStyle.css" type="text/css">
  <title>Sekai: Register</title>
  <style>
    body {
      background-image: url(/webassets/gradients/dark.png);
      animation-duration: 5s;
      animation-name: gradient;
      animation-iteration-count: infinite;
      animation-timing-function: linear;
    }
    </style>
</head>
<body>
  <p class="pageTitle">Sekai</p>');
if(!isset($_SESSION['registerStatus'])) {
  echo('
      <div class="login">
        <p class="loginHeader">
          <b>Register for Sekai</b>
        </p>');
  if(isset($_SESSION['registerError'])) {
    echo('
        <p class="errorText">That username is already in use.</p>');
    session_destroy();
  }
  echo('
        <form style="text-align:center;color:white;" action="/access/register.php" method="post" accept-charset="UTF-8">
          <label>Email Address</label><br>
          <input type="text" placeholder="Enter Email Address" name="email" id="email" size="30" maxlength="48" required autofocus><br>
          <label>Username</label><br>
          <input type="text" placeholder="Enter Username" name="username" id="username" maxlength="16" required><br>
          <label>Password</label><br>
          <input type="password" placeholder="Enter Password" name="password" id="password" maxlength="16" required><br>
          <a href="/"><button>Return</button></a>
          <button type="submit">Register</button>
        </form>
      </div>
  </body>
  </html>');
} else {
  echo('
      <h2 style="text-align:center;color:gray">Registration successful</h2>
      <p style="text-align:center;color:gray">
          You will be notified if your application was successful via email.
          <br><a href="/">Click here</a> to return to the homepage.
      </p>
  </body>
  </html>');
}
?>
