<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>wish</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=M+PLUS+1p:300&amp;subset=japanese">
    <link rel="stylesheet" href="home.css">
  </head>
  <body>
    <div id="body">
      <h1 class="halfStyle" id="wish">_</h1>
      <br><a target="_blank" href="//discord.gg/vCXWfya">discord</a>
      <br><a target="_blank" href="//steamcommunity.com/id/sadwish">steam</a>
      <br><a target="_blank" href="//gitlab.com/wishu">gitlab</a>
      <br><a target="_blank" href="//youtube.com/wish495">youtube</a>
      <br><a target="_blank" href="//twitter.com/wishdere">twitter</a>
      <br><a target="_blank" href="//last.fm/user/Wish495">last.fm</a>
      <br><a target="_blank" href="//myanimelist.net/profile/Ain">myanimelist</a>
      <br><a target="_blank" href="//osu.ppy.sh/users/Wishu">osu!</a>
      <?php if (isset($_SESSION["username"])): ?>
        <button class="jp" type="button" name="button" onclick="window.location.href='/home/'">&#x4E16;&#x754C;&#x306B;&#x7D9A;&#x3051;&#x308B;&nbsp;&nbsp;&#10148;</button>
      <?php else: ?>
        <button class="jp" type="button" name="button" onclick="modalToggle()">&#x4E16;&#x754C;&#x306B;&#x30ED;&#x30B0;&#x30A4;&#x30F3;&nbsp;&nbsp;&#10148;</button>
      <?php endif; ?>
    </div>
    <div id="catch" onclick="catchModal()"></div>
    <div id="modal">
      <h2 class="jp">&#x4E16;&#x754C;&#x306B;&#x30ED;&#x30B0;&#x30A4;&#x30F3;</h2>
      <form class="login" action="../php/login.php" method="post">
        <input class="jp" type="text" name="username" maxlength="16" placeholder="&#x30E6;&#x30FC;&#x30B6;&#x30FC;&#x540D;" required>
        <br>
        <input class="jp" type="password" name="password" maxlength="16" placeholder="&#x30D1;&#x30B9;&#x30EF;&#x30FC;&#x30C9;" required>
        <br>
        <input class="jp" type="submit" value="&#x30ED;&#x30B0;&#x30A4;&#x30F3;">
      </form>
    </div>
    <audio id="player" src="theme.flac"></audio>
    <script src="home.js" charset="utf-8"></script>
  </body>
</html>
