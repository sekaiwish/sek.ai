<?php
include("{$_SERVER['DOCUMENT_ROOT']}/webassets/defaultHeader.php");
include("{$_SERVER['DOCUMENT_ROOT']}/webassets/defaultBody.php");
include("{$_SERVER['DOCUMENT_ROOT']}/webassets/defaultNavbar.php");
?>
  <div style="width:100%;margin-top:8rem;">
    <div class="card-group">
      <a href="/flac/">
        <div class="card card-inverse card-outline-success">
          <img class="card-img" src="/webassets/tiles/flac.<?php if($_SESSION["tilestyle"]!=2){echo("gif");}else{echo("png");}?>" alt="FLAC graphic">
          <div class="card-img-overlay">
            <h1 class="card-title">
              <strong>
                /flac/
              </strong>
            </h1>
          </div>
        </div>
      </a>
      <a href="/anime/">
        <div class="card card-inverse card-outline-success">
          <img class="card-img" src="/webassets/tiles/<?php if($_SESSION["tilestyle"]==1){echo("G");}?>anime.<?php if($_SESSION["tilestyle"]!=2){echo("gif");}else{echo("png");}?>" alt="Anime graphic">
          <div class="card-img-overlay">
            <h1 class="card-title">
              <strong>
                /anime/
              </strong>
            </h1>
          </div>
        </div>
      </a>
      <a href="/chan/">
        <div class="card card-inverse card-outline-danger">
          <img class="card-img" src="/webassets/tiles/<?php if($_SESSION["tilestyle"]==1){echo("G");}?>chan.<?php if($_SESSION["tilestyle"]!=2){echo("gif");}else{echo("png");}?>" alt="世界chan graphic">
          <div class="card-img-overlay">
            <h1 class="card-title">
              <strong>
                /chan/
              </strong>
            </h1>
          </div>
        </div>
      </a>
    </div>
    <div class="card-group">
      <a href="/dlf/">
        <div class="card card-inverse card-outline-danger">
          <img class="card-img" src="/webassets/tiles/<?php if($_SESSION["tilestyle"]==1){echo("G");}?>dlf.<?php if($_SESSION["tilestyle"]!=2){echo("gif");}else{echo("png");}?>" alt="DLF graphic">
          <div class="card-img-overlay">
            <h1 class="card-title">
              <strong>
                /dlf/
              </strong>
            </h1>
          </div>
        </div>
      </a>
      <a href="/hentai/">
        <div class="card card-inverse card-outline-danger">
          <img class="card-img" src="/webassets/tiles/<?php if($_SESSION["tilestyle"]==1){echo("G");}?>anime.<?php if($_SESSION["tilestyle"]!=2){echo("gif");}else{echo("png");}?>" alt="Hentai graphic">
          <div class="card-img-overlay">
            <h1 class="card-title">
              <strong>
                /hentai/
              </strong>
            </h1>
          </div>
        </div>
      </a>
      <a href="/iso/">
        <div class="card card-inverse card-outline-success">
          <img class="card-img" src="/webassets/tiles/<?php if($_SESSION["tilestyle"]==1){echo("G");}?>iso.<?php if($_SESSION["tilestyle"]!=2){echo("gif");}else{echo("png");}?>" alt="ISO graphic">
          <div class="card-img-overlay">
            <h1 class="card-title">
              <strong>
                /iso/
              </strong>
            </h1>
          </div>
        </div>
      </a>
    </div>
  </div>
</body>
</html>
