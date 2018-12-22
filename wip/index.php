<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>wish</title>
    <link rel="stylesheet" href="home.css">
  </head>
  <body>
    <div id="body">
      <h1 class="halfStyle" id="wish">_</h1>
      <br><a href="//discord.gg/vCXWfya">discord</a>
      <br><a href="//steamcommunity.com/id/sadwish">steam</a>
      <br><a href="//gitlab.com/wishu">gitlab</a>
      <br><a href="//youtube.com/wish495">youtube</a>
      <br><a href="//twitter.com/wishdere">twitter</a>
      <br><a href="//last.fm/user/Wish495">last.fm</a>
      <br><a href="//myanimelist.net/profile/Ain">myanimelist</a>
      <br><a href="//osu.ppy.sh/users/Wishu">osu!</a>
      <?php if (isset($_SESSION["username"])): ?>
        <button type="button" name="button" onclick="window.location.href='/home/'">&#x4E16;&#x754C;&#x306B;&#x7D9A;&#x3051;&#x308B;&nbsp;&nbsp;&#10148;</button>
      <?php else: ?>
        <button type="button" name="button" onclick="modalToggle()">&#x4E16;&#x754C;&#x306B;&#x30ED;&#x30B0;&#x30A4;&#x30F3;&nbsp;&nbsp;&#10148;</button>
      <?php endif; ?>
    </div>
    <div id="catch" onclick="catchModal()"></div>
    <div id="modal">
      <h2>&#x4E16;&#x754C;&#x306B;&#x30ED;&#x30B0;&#x30A4;&#x30F3;</h2>
      <form class="login" action="../php/login.php" method="post">
        <input type="text" name="username" maxlength="16" placeholder="&#x30E6;&#x30FC;&#x30B6;&#x30FC;&#x540D;" required>
        <br>
        <input type="password" name="password" maxlength="16" placeholder="&#x30D1;&#x30B9;&#x30EF;&#x30FC;&#x30C9;" required>
        <br>
        <input type="submit" value="&#x30ED;&#x30B0;&#x30A4;&#x30F3;">
      </form>
    </div>
    <audio id="player" src="theme.flac"></audio>
    <script src="home.js" charset="utf-8"></script>
  </body>
</html>
