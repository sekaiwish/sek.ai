<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:image" content="/embed.png">
    <meta property="og:url" content="https://sek.ai">
    <meta property="og:title" content="&#x4E16;&#x754C;">
    <meta name="theme-color" content="#00a0a0">
    <title>wish</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=M+PLUS+1p:300,700&display=swap&subset=japanese">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="icon" href="favicon.ico">
  </head>
  <body>
    <canvas id="canvas"></canvas>
    <div id="body">
      <h1 id="wish">_</h1>
      <br><a href="discord://open/users/119094696487288833">discord</a>
      <br><a target="_blank" href="//steamcommunity.com/id/sadwish">steam</a>
      <br><a target="_blank" href="//gitlab.com/wishu">gitlab</a>
      <br><a target="_blank" href="//youtube.com/wish495">youtube</a>
      <br><a target="_blank" href="//twitch.tv/wishdere">twitch</a>
      <br><a target="_blank" href="//twitter.com/wishdere">twitter</a>
      <br><a target="_blank" href="//last.fm/user/Wish495">last.fm</a>
      <br><a target="_blank" href="//myanimelist.net/profile/Ain">myanimelist</a>
      <br><a target="_blank" href="//osu.ppy.sh/users/Wishu">osu!</a>
      <h4>&copy; wish 2019</h4>
      <?php if (isset($_SESSION["username"])): ?>
        <button class="jp" type="button" name="button" onclick="window.location.href='/home/'">世界に続ける&nbsp;&nbsp;&#10148;</button>
      <?php else: ?>
        <button class="jp" type="button" name="button" onclick="modalToggle()">世界にログイン&nbsp;&nbsp;&#10148;</button>
      <?php endif; ?>
    </div>
    <div id="catch" onclick="catchModal()"></div>
    <div id="modal">
      <h2 class="jp" id="title">世界にログイン</h2>
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
    <script src="/js/main.js" charset="utf-8"></script>
    <script src="/js/index.js" charset="utf-8"></script>
  </body>
</html>
