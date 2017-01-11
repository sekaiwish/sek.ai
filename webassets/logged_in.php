<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/webassets/style.css" type="text/css">
    <title>
      Sekai
    </title>
    <style>
      body {
        background: linear-gradient(to left,#EECDA3,#EF629F);
      }
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
        transition: 0.7s linear;
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
  <body>
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
      Sekai
    </p>
    <div style="width:70%;margin:auto;">
      <a href="/flac">
        <div class="tile" style='background:url("/webassets/tiles/<?php
          if($_SESSION["tilestyle"]==2) {
            echo("flac.png");
          } else {
            echo("flac.gif");
          }
        ?>");'>
          <p class="tileText">
            FLAC
          </p>
        </div>
      </a>
      <div class="hSeparator">
        <br>
      </div>
      <a href="/anime">
        <div class="tile" style='background:url("/webassets/tiles/<?php
          if($_SESSION["tilestyle"]==0) {
            echo("anime.gif");
          } elseif($_SESSION["tilestyle"]==1) {
            echo("Ganime.gif");
          } else {
            echo("anime.gif");
          }
        ?>");'>
          <p class="tileText">
            ANIME
          </p>
        </div>
      </a>
      <div class="hSeparator">
        <br>
      </div>
      <a href="/sekaichan">
        <div class="tile" style='background:url("/webassets/nsfw.png"),url("/webassets/tiles/<?php
          if($_SESSION["tilestyle"]==0) {
            echo("board.gif");
          } elseif($_SESSION["tilestyle"]==1) {
            echo("Gboard.gif");
          } else {
            echo("board.gif");
          }
        ?>");background-position:bottom right,left top;background-repeat:no-repeat;'>
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
        <div class="tile" style='background:url("/webassets/nsfw.png"),url("/webassets/tiles/<?php
          if($_SESSION["tilestyle"]==0) {
            echo("dlf.gif");
          } elseif($_SESSION["tilestyle"]==1) {
            echo("Gdlf.gif");
          } else {
            echo("dlf.gif");
          }
        ?>");background-position:bottom right,left top;background-repeat:no-repeat;'>
          <p class="tileText">
            DLF
          </p>
        </div>
      </a>
      <div class="hSeparator">
        <br>
      </div>
      <a href="/hentai">
        <div class="tile" style='background:url("/webassets/nsfw.png"),url("/webassets/tiles/<?php
          if($_SESSION["tilestyle"]==0) {
            echo("hentai.gif");
          } elseif($_SESSION["tilestyle"]==1) {
            echo("Ghentai.gif");
          } else {
            echo("hentai.gif");
          }
        ?>");background-position:bottom right,left top;background-repeat:no-repeat;'>
          <p class="tileText">
            HENTAI
          </p>
        </div>
      </a>
      <div class="hSeparator">
        <br>
      </div>
      <a href="/iso">
        <div class="tile" style='background:url("/webassets/tiles/<?php
          if($_SESSION["tilestyle"]==0) {
            echo("iso.gif");
          } elseif($_SESSION["tilestyle"]==1) {
            echo("Giso.gif");
          } else {
            echo("iso.gif");
          }
        ?>");'>
          <p class="tileText">
            ISO
          </p>
        </div>
      </a>
    </div>
  </body>
</html>
