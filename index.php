<?php $time = explode(' ', microtime()); $start = $time[1] + $time[0]; session_start(); ?>
<!doctype html>
<html>
  <head>
    <title>wish</title>
    <?php include("php/sources.php"); ?>
    <script>
      var discord = 0;
      function Discord(){if(discord==0){showDiscord();discord=1}else{hideDiscord();discord=0}}
      function showDiscord(){document.getElementById("discord").classList.add("visible")}
      function hideDiscord(){document.getElementById("discord").classList.remove("visible")}
      function showLogin(){document.getElementById("links").classList.add("trigger");document.getElementById("login").classList.add("trigger")}
      function showLinks(){document.getElementById("links").classList.remove("trigger");document.getElementById("login").classList.remove("trigger")}
    </script>
  </head>
  <body>
    <audio src="theme.mp3"></audio>
    <?php if (isset($_GET["e"])) { if ($_GET["e"] == "1"): ?><div class="alert alert-warning">
      <strong>Error</strong> &mdash; The user entered does not exist.
    </div><?php echo "\n    "; elseif ($_GET["e"] == "2"): ?><div class="alert alert-warning">
      <strong>Error</strong> &mdash; The incorrect password was entered.
    </div><?php echo "\n    "; endif; } ?>
    <div class="links" id="links">
      <img class="wish" src="wish.svg">
      <br>
      <a class="link" href="//twitter.com/Wish495" target="_blank">
        <img src="assets/svg/twitter.svg">
      </a>
      <a class="link" href="//youtube.com/wish495" target="_blank">
        <img src="assets/svg/youtube.svg">
      </a>
      <a class="link" href="//twitch.tv/TheRealWish" target="_blank">
        <img src="assets/svg/twitch.svg">
      </a>
      <a class="link" href="//gitlab.com/wishu" target="_blank">
        <img src="assets/svg/gitlab.svg">
      </a>
      <a class="link" onclick="Discord()">
        <img src="assets/svg/discord.svg">
      </a>
      <a class="link" href="//steamcommunity.com/id/sadwish" target="_blank">
        <img src="assets/svg/steam.svg">
      </a>
      <a class="link" href="//osu.ppy.sh/users/Wishu" target="_blank">
        <img src="assets/svg/osu.svg">
      </a>
      <a class="link" href="//last.fm/user/Wish495" target="_blank">
        <img src="assets/svg/lastfm.svg">
      </a>
      <a class="link" href="//myanimelist.net/profile/Ain" target="_blank">
        <img src="assets/svg/myanimelist.svg">
      </a>
      <br>
      <?php if (isset($_SESSION["username"])): ?><a href="/home/" class="btn btn-dark jp">
        &#x304A;&#x3063;&#x3059;&#x3001;<b><?php echo $_SESSION["username"]; ?></b>!&nbsp;&nbsp;<i class="fas fa-chevron-circle-right"></i>
      </a>
      <?php else: ?><button class="btn btn-dark jp" onclick="showLogin()">
        &#x4E16;&#x754C;&#x306B;&#x30ED;&#x30B0;&#x30A4;&#x30F3;&nbsp;&nbsp;<i class="fas fa-chevron-circle-right"></i>
      </button><?php endif; echo "\n"; ?>
    </div>
    <div class="card bg-dark text-white" id="login">
      <h5 class="card-header jp">&#x4E16;&#x754C;&#x306B;&#x30ED;&#x30B0;&#x30A4;&#x30F3;</h5>
      <form class="card-body" action="php/login.php" method="post">
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend"><i class="input-group-text fas fa-user-circle"></i></div>
            <input class="form-control jp" type="text" placeholder="&#x30E6;&#x30FC;&#x30B6;&#x30FC;&#x540D;" name="username" maxlength="16" required>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend"><i class="input-group-text fas fa-lock"></i></div>
            <input class="form-control jp" type="password" placeholder="&#x30D1;&#x30B9;&#x30EF;&#x30FC;&#x30C9;" name="password" maxlength="16" required>
          </div>
        </div>
        <div class="btn-group">
          <a class="btn btn-secondary jp" onclick="showLinks()">&#x7D42;&#x4E86;</a>
          <input class="btn btn-primary jp" type="submit" value="&#x30ED;&#x30B0;&#x30A4;&#x30F3;">
        </div>
      </form>
    </div>
    <div class="views">
      <?php
        if (include("php/sql.php")) {
          $stmt = $dbi->prepare("SELECT num FROM views ORDER BY num DESC LIMIT 1");
          $stmt->execute();
          $res = $stmt->get_result();
          $row = $res->fetch_assoc();
          $result = str_split($row["num"] + 1);
          foreach ($result as $key => $value) {
            echo "<img src=\"assets/views/$value.gif\">";
          }
          echo "\n";
          $stmt = $dbi->prepare("INSERT INTO views (ip) VALUES (?)");
          $ip = $_SERVER["REMOTE_ADDR"];
          $stmt->bind_param("s", $ip);
          $stmt->execute();
        }
      ?>
    </div>
    <div id="discord">
      <iframe src="https://discordapp.com/widget?id=212908561771134977&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0"></iframe>
    </div>
    <?php include("php/buttons.php"); ?>
  </body>
</html>
