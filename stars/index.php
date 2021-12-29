<!doctype html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='keywords' content='osrs, shooting stars, tracker, runescape, cc, star miners, discord'>
    <style>
      @font-face {
        font-family:'RuneScape UF';
        src: url('font.woff2') format('woff2');
        font-weight: normal;
        font-style: normal;
      }
      body {
        height:93vh;
        background-color:black;
        background-image:url('bg.png');
        background-repeat:no-repeat;
        background-position:center;
        color:white;
        font-family:'RuneScape UF';
      }
      h1 {
        text-align:center;
        font-size:4em;
      }
      p {
        text-align:center;
        font-size:1.1em;
        margin:0;
      }
      .fallen {
        color:orange;
      }
      .depleted {
        color:red;
      }
      .help {
        position:fixed;
        bottom:1em;
        right:1em;
        color:white;
        text-decoration:none;
        outline:0;
      }
      .discord {
        position:fixed;
        bottom:1em;
        left:1em;
        color:white;
        text-decoration:none;
        outline:0;
      }
    </style>
    <title>Shooting Stars</title>
  </head>
  <body>
    <h1>OSRS Shooting Stars</h1>
    <p id='data'></p>
    <a class='help' href='#' onclick=help()>How to use?</a>
    <a class='discord' href='https://discord.gg/kePnzpNXXK'>Star Miners Discord</a>
    <script>
      const locations = {
        0:'Asgarnia',
        1:'Karamja/Crandor',
        2:'Feldip Hills/Isle of Souls',
        3:'Fossil Island/Mos Le\'Harmless',
        4:'Fremennik Lands/Lunar Isle',
        5:'Great Kourend',
        6:'Kandarin',
        7:'Kebos Lowlands',
        8:'Kharidian Desert',
        9:'Misthalin',
        10:'Morytania',
        11:'Piscatoris/Gnome Stronghold',
        12:'Tirannwn',
        13:'Wilderness'
      };
      function init() {
        const parent = document.getElementById('data');
        stars = false;
        fetch('/stars/get.php').then((resp)=>resp.json()).then(function(data) {
          // clear existing data
          if (parent.lastChild) {
            while (parent.firstChild) {
              parent.removeChild(parent.lastChild);
            }
          }
          stars = data;
          stars.reverse();
          for (var i = 0; i < stars.length; i++) {
            if (stars[i].maxTime < Math.floor(Date.now() / 1000) + 180) {
              continue;
            }
            star = document.createElement('p');
            if (stars[i].minTime < Math.floor(Date.now() / 1000)) {
              star.classList.add('fallen');
            }
            if (stars[i].maxTime <= Math.floor(Date.now() / 1000) + 180) {
              star.classList.replace('fallen', 'depleted');
            }
            minTime = new Date(stars[i].minTime*1000).toLocaleTimeString();
            maxTime = new Date(stars[i].maxTime*1000).toLocaleTimeString();
            star.innerHTML = 'W' + stars[i].world + ' - ' + locations[stars[i].location] + ' - ' + minTime + ' ~ ' + maxTime;
            parent.appendChild(star);
          }
        });
        setTimeout(function(){init();},30000);
      }
      function help() {
        alert("Stars don't last forever. You can contribute data through a RuneLite plugin called 'Shooting Stars' (cred. Andrew McAdams). Once installed, go to settings and change the 'POST endpoint' to   https://sek.ai/stars/post.php   This will automatically submit what you see in the telescope! You can also set the 'GET endpoint' to   https://sek.ai/stars/get.php   to have an in-game widget with the next star. ");
      }
      init();
    </script>
  </body>
</html>
