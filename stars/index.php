<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <style>
      body {
        background-color:black;
        color:white;
        font-family:sans-serif;
      }
      h1 {
        text-align:center;
        font-size:3em;
      }
      p {
        text-align:center;
      }
    </style>
    <title>Shooting Stars</title>
  </head>
  <body>
    <h1>Meet hot stars in YOUR area just waiting to be mined!</h1>
    <p id='data'></p>
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
        13:'Wilderness',
        14:'Unknown'
      };
      stars = false;
      fetch("/stars/get.php").then((resp)=>resp.json()).then(function(data){
        stars = data;
        for (var i = 0; i < stars.length; i++) {
          star = document.createElement('p');
          minTime = new Date(stars[i].minTime*1000).toLocaleTimeString();
          maxTime = new Date(stars[i].maxTime*1000).toLocaleTimeString();
          star.innerHTML = 'W'+stars[i].world+' - '+locations[stars[i].location]+' - '+minTime+' ~ '+maxTime
          document.getElementById('data').appendChild(star);
        }
      });
    </script>
  </body>
</html>
