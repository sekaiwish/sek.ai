<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/webassets/style.css" type="text/css">
    <title>
      Sekai
    </title>
    <style>
      img {
        position: absolute;
        transition: 1s linear;
      }
      .tileText {
        font-family: "MoonFlower";
        color: white;
        font-size: 500%;
        text-align: center;
        margin-top: 0px;
        margin-bottom: 0px;
        position: relative;
        top: 50%;
        transform: translateY(-50%);
        filter: blur(2px);
        opacity: 0;
        transition: 1s linear;
      }
      .tile:hover > img {
        filter: blur(10px);
      }
      .tile:hover > .tileText {
        filter: blur(0px);
        opacity: 1;
      }
    </style>
  </head>
  <body style="background:linear-gradient(to left,#EECDA3,#EF629F);">
    <p class="beta">DEV 0.5</p>
    <p style="position:fixed;right:10px;top:0px;">
      Logged in as <?php echo($_SESSION["username"]);?>.
    </p>
    <form method="POST" style="position:fixed;right:10px;top:40px;">
      <input type="submit" name="preferences" value="Preferences">
    </form>
    <form method="POST" style="position:fixed;right:10px;top:68px;">
      <input type="submit" name="logout" value="Log Out">
    </form>
    <p class="pageTitle">
      <b>Sekai</b>
    </p>
    <div style="width:70%;margin:auto;">
      <a href="/flac">
        <div class="tile">
          <img src="<?php if($_SESSION["tilestyle"]==2) {
            echo("/webassets/tiles/flac.png");
          } else {
            echo("/webassets/tiles/flac.gif");
          }
          ?>">
          <p class="tileText">
            FLAC
          </p>
        </div>
      </a>
      <div class="hSeparator">
        <br>
      </div>
      <a href="/anime">
        <div class="tile">
          <img src="<?php if($_SESSION["tilestyle"]==0) {
            echo("/webassets/tiles/anime.gif");
          } elseif($_SESSION["tilestyle"]==1) {
            echo("/webassets/tiles/Ganime.gif");
          } else {
            echo("/webassets/tiles/anime.png");
          }
          ?>">
          <p class="tileText">
            ANIME
          </p>
        </div>
      </a>
      <div class="hSeparator">
        <br>
      </div>
      <a href="/wishchan">
        <div class="tile">
          <img src="<?php if($_SESSION["tilestyle"]==0) {
            echo("/webassets/tiles/board.gif");
          } elseif($_SESSION["tilestyle"]==1) {
            echo("/webassets/tiles/Gboard.gif");
          } else {
            echo("/webassets/tiles/board.png");
          }
          ?>">
          <p class="tileText">
            BOARD
          </p>
        </div>
      </a>
      <br>
      <div class="vSeparator">
      </div>
      <br>
      <a href="/DLF ARCHIVE">
        <div class="tile">
          <img src="<?php if($_SESSION["tilestyle"]==0) {
            echo("/webassets/tiles/dlf.gif");
          } elseif($_SESSION["tilestyle"]==1) {
            echo("/webassets/tiles/Gdlf.gif");
          } else {
            echo("/webassets/tiles/dlf.png");
          }
          ?>">
          <p class="tileText">
            DLF
          </p>
        </div>
      </a>
      <div class="hSeparator">
        <br>
      </div>
      <a href="/hentai">
        <div class="tile">
          <img src="<?php if($_SESSION["tilestyle"]==0) {
            echo("/webassets/tiles/hentai.gif");
          } elseif($_SESSION["tilestyle"]==1) {
            echo("/webassets/tiles/Ghentai.gif");
          } else {
            echo("/webassets/tiles/hentai.png");
          }
          ?>">
          <p class="tileText">
            HENTAI
          </p>
        </div>
      </a>
      <div class="hSeparator">
        <br>
      </div>
      <a href="/iso">
        <div class="tile">
          <img src="<?php if($_SESSION["tilestyle"]==0) {
            echo("/webassets/tiles/iso.gif");
          } elseif($_SESSION["tilestyle"]==1) {
            echo("/webassets/tiles/Giso.gif");
          } else {
            echo("/webassets/tiles/iso.png");
          }
          ?>">
          <p class="tileText">
            ISO
          </p>
        </div>
      </a>
    </div>
  </body>
</html>
