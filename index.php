<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="&#x4E16;&#x754C;">
    <meta name="author" content="wish">
    <meta name="description" content="This ugly son of a bitch is coding super lame websites and basically, you are fucking stupid. How?..Just click here ^">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:image" content="https://sek.ai/embed.png">
    <meta property="og:url" content="https://sek.ai">
    <meta property="og:title" content="&#x4E16;&#x754C;">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#00a0a0">
    <title>wish</title>
    <link rel="icon" href="sekai.ico">
  </head>
  <body style="background:#000">
    <p id="loader" style="position:absolute;color:#333;top:48%;text-align:center;width:100vw">Loading...</p>
    <canvas id="canvas"></canvas>
    <div id="body" hidden>
      <h1 id="wish">_</h1>
      <div id="data"></div>
      <h4>&copy; wish 2020</h4>
      <?php if (isset($_SESSION["username"])): ?>
        <button class="jp" type="button" name="button" onclick="window.location.href='/home/'">世界に続ける&nbsp;&nbsp;&#10148;</button>
      <?php else: ?>
        <button class="jp" type="button" name="button" onclick="modalToggle()">世界にログイン&nbsp;&nbsp;&#10148;</button>
      <?php endif; ?>
    </div>
    <div id="catch" onclick="hide()"></div>
    <div id="modal" hidden>
      <h2 class="jp" id="title"><b>世界にログイン</b></h2>
      <form>
        <input class="jp" type="text" name="username" maxlength="16" placeholder="ユーザー名" required>
        <br>
        <input class="jp" type="password" name="password" maxlength="16" placeholder="パスワード" required>
        <br>
        <input class="jp" type="button" value="ログイン" onclick="login(this.form)">
      </form>
    </div>
    <audio id="player">
      <source src="theme.flac" type="audio/flac">
    </audio>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=M+PLUS+1p:300,500&display=swap&subset=japanese">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/index.css">
    <script src="/js/main.js" charset="utf-8"></script>
    <script src="/js/index.js" charset="utf-8"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152844430-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag("js", new Date());
      gtag("config", "UA-152844430-1");
    </script>
  </body>
</html>
