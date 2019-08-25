var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var trails = [];
var dead = [];
var canvasWidth = window.innerWidth;
function scale() {
  var scale = window.innerWidth / canvasWidth;
  var len = trails.length;
  for (var i = 0; i < len; i++) {
    trails[i].position = Math.round(trails[i].position * scale);
  }
  canvasWidth = window.innerWidth;
}
function draw() {
  canvas.height = window.innerHeight;
  canvas.width = window.innerWidth;
  if (canvasWidth !== window.innerWidth) {
    scale();
  }
  let trailLength = 80;
  if (trails[0]) {
    let len = trails.length;
    for (var i = 0; i < len; i++) {
      if (trails[i].age > window.innerHeight + trailLength) {
        dead.push(i);
      }
    }
    for (var i = dead.length - 1; i >= 0; i--)
      trails.splice(dead[i], 1);
    dead = [];
  }
  var newPixel = {};
  newPixel.age = 0;
  newPixel.position = Math.floor((Math.random() * window.innerWidth) + 1);
  newPixel.velocity = Math.floor((Math.random() * 3) + 2);
  trails.push(newPixel);
  let leng = trails.length;
  for (var i = 0; i < leng; i++) {
    ctx.fillStyle = "#FFF";
    ctx.fillRect(trails[i].position, window.innerHeight - trails[i].age - 1, 1, 1);
    var gradient = ctx.createLinearGradient(trails[i].position, window.innerHeight - trails[i].age + trailLength, trails[i].position, window.innerHeight - trails[i].age);
    gradient.addColorStop(0, "#000");
    gradient.addColorStop(1, "#690099");
    ctx.fillStyle = gradient;
    ctx.fillRect(trails[i].position, window.innerHeight - trails[i].age, 1, trailLength);
    trails[i].age += trails[i].velocity;
  }
  window.requestAnimationFrame(draw);
}
function store(name, value) {
  sessionStorage.setItem(name, value);
}
function retrieve(name) {
  return sessionStorage.getItem(name);
}
var audio = document.getElementById("player");
var timePlayed = retrieve("played");
var playlist = [];
function createSession() {
  store("played", 0.0);
  store("volume", 0.1);
  store("track", "");
  store("playlist", "");
  store("playIndex", 0);
}
function play(track, all) {
  if (!all) {
    store("playlist", "");
    playlist = [];
  }
  let file = track.split("/").pop();
  document.getElementById("track").innerHTML = decodeURI(file.substring(0, file.length - 5));
  if (document.getElementById("data")) {
    try {
      document.getElementsByClassName("cover")[0].removeChild(document.getElementsByClassName("cover")[0].childNodes[3]);
    } catch {}
    let node = document.createElement("IMG");
    document.getElementsByClassName("cover")[0].appendChild(node);
    node.src = document.getElementById("data").value;
    store("art", node.src);
  } else {
    try {
      document.getElementsByClassName("cover")[0].removeChild(document.getElementsByClassName("cover")[0].childNodes[1]);
    } catch {}
    store("art");
  }
  audio.src = decodeURI(track);
  audio.play();
  audio.volume = retrieve("volume");
}
function playAll() {
  var tracks = document.querySelectorAll("[onclick]");
  for (var i = 1; i < tracks.length; i++) {
    let string = document.querySelectorAll("[onclick]")[i].text;
    playlist.push(encodeURI(window.location + string.substring(0, string.length - 9)));
  }
  store("playlist", JSON.stringify(playlist));
  play(playlist[0], 1);
}
function init() {
  var trailsExist = retrieve("trails");
  if (!trailsExist) {
    trails = [];
    createSession();
  } else {
    trails = JSON.parse(trailsExist);
  }
  if (timePlayed && timePlayed !== "0.0") {
    var track = retrieve("track");
    var volume = retrieve("volume");
    var playlistExist = retrieve("playlist");
    var artExist = retrieve("art");
    if (artExist && artExist !== "undefined") {
      let node = document.createElement("IMG");
      document.getElementsByClassName("cover")[0].appendChild(node);
      node.src = artExist;
    }
    var title = track.split("/").pop();
    document.getElementById("track").innerHTML = decodeURI(title.substring(0, title.length - 5));
    audio.volume = volume;
    audio.currentTime = timePlayed;
    try {
      if (JSON.parse(playlistExist).length > 1) {
        playlist = JSON.parse(playlistExist);
        audio.src = playlist[retrieve("playIndex")];
        console.log("loaded playlist");
      }
    } catch {} finally {
      audio.src = track;
    }
    var isChromium = window.chrome;
    if (isChromium !== null && typeof isChromium !== "undefined") {
      document.body.addEventListener("mousemove", function() {
        audio.play()
      });
    } else {
      audio.play();
    }
  }
  window.requestAnimationFrame(draw);
}
window.addEventListener("unload", function(event) {
  store("played", audio.currentTime);
  store("volume", audio.volume);
  store("track", audio.src);
  store("playlist", JSON.stringify(playlist));
  store("trails", JSON.stringify(trails));
});
audio.onvolumechange = function() {
  store("volume", audio.volume);
};
audio.addEventListener("ended", function() {
  if (playlist.length > 1) {
    for (var i = 0; i < playlist.length; i++) {
      if (playlist[i] == audio.src) {
        if (!playlist[i + 1]) {
          play(playlist[0], 1);
        } else {
          play(playlist[i + 1], 1);
        }
        break;
      }
    }
  } else {
    audio.currentTime = 0;
    audio.play();
  }
});
init();
