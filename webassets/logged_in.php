<?php
  echo('<!DOCTYPE html>
  <html>
    <head>

      <link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="/webassets/font.css" type="text/css">
      <title>
        WishDrive
      </title>
      <style>
        .tile {
          float: left;
          width: 32%;
          display: flex;
          justify-content: left;
        }
        .hSeparator {
          float: left;
          width: 2%;
          height: 1%;
        }
        .vSeparator {
          float: left;
          height: 100%;
          width: 100%;
        }
        .tileText {
          font-family: "NeoNoire";
          color: white;
          font-size: 350%;
          z-index: 2;
          filter: blur(2px);
          opacity: 0;
          transition: 1s linear;
          position: relative;
          left: 27%;
        }
        .imgTile {
          width: 424;
          height: 181;
          z-index: 1;
          position: absolute;
          transition: 1s linear;
        }
        .tile:hover > .tileText {
          filter: blur(0px);
          opacity: 1;
        }
        .tile:hover > .imgTile {
          filter: blur(10px);
        }
        div > img {
          max-height: 100%;
          max-width: 100%;
          position: static;
        }
      </style>

    </head>
    <body bgcolor="#1D1F21">

      <p class="beta">DEV 0.4</p>
      <p style="position: fixed; right: 10px; top: 0px;">
        Logged in as '.$_SESSION["username"].'.
      </p>
      <form method="POST" style="position: fixed; right: 10px; top: 40px;">
        <input type="submit" name="preferences" value="Preferences">
      </form>
      <form method="POST" style="position: fixed; right: 10px; top: 68px;">
        <input type="submit" name="logout" value="Log Out">
      </form>
      <p class="neonoireTitle">
        WishDrive
      </p>
      <p style="text-align: center;">
        <div style="height: 100%; width: 70%; margin: auto;">
          <a href="/flac">
            <div class="tile">
              <div class="imgTile">
                <img src=');if($_SESSION["tilestyle"]==2){echo("/webassets/tiles/flac.png");}else{echo("/webassets/tiles/flac.gif");}echo('>
              </div>
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
              <div class="imgTile">
                <img src=');if($_SESSION["tilestyle"]==0){echo("/webassets/tiles/anime.gif");}elseif($_SESSION["tilestyle"]==1){echo("/webassets/tiles/Ganime.gif");}else{echo("/webassets/tiles/anime.png");}echo('>
              </div>
              <p class="tileText">
                ANIME
              </p>
            </div>
          </a>
          <div class="hSeparator">
            <br>
          </div>
          <a href="/board">
            <div class="tile">
              <div class="imgTile">
                <img src=');if($_SESSION["tilestyle"]==0){echo("/webassets/tiles/board.gif");}elseif($_SESSION["tilestyle"]==1){echo("/webassets/tiles/Gboard.gif");}else{echo("/webassets/tiles/board.png");}echo('>
              </div>
              <p class="tileText">
                BOARD
              </p>
            </div>
          </a>
          <br>
          <div class="vSeparator">
            <br>
          </div>
          <br>
          <a href="/DLF ARCHIVE">
            <div class="tile">
              <div class="imgTile">
                <img src=');if($_SESSION["tilestyle"]==0){echo("/webassets/tiles/dlf.gif");}elseif($_SESSION["tilestyle"]==1){echo("/webassets/tiles/Gdlf.gif");}else{echo("/webassets/tiles/dlf.png");}echo('>
              </div>
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
              <div class="imgTile">
                <img src=');if($_SESSION["tilestyle"]==0){echo("/webassets/tiles/hentai.gif");}elseif($_SESSION["tilestyle"]==1){echo("/webassets/tiles/Ghentai.gif");}else{echo("/webassets/tiles/hentai.png");}echo('>
              </div>
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
              <div class="imgTile">
                <img src=');if($_SESSION["tilestyle"]==0){echo("/webassets/tiles/iso.gif");}elseif($_SESSION["tilestyle"]==1){echo("/webassets/tiles/Giso.gif");}else{echo("/webassets/tiles/iso.png");}echo('>
              </div>
              <p class="tileText">
                ISO
              </p>
            </div>
          </a>
        </div>

    </body>
  </html>');
?>
