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
    var gradient = ctx.createLinearGradient(trails[i].position,
      window.innerHeight - trails[i].age + trailLength,
      trails[i].position,
      window.innerHeight - trails[i].age
    );
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
function createSession() {
  store("played", 0.0);
  store("volume", 0.1);
  store("track", JSON.stringify([]));
  store("playlist", JSON.stringify([]));
  store("index", 0);
  store("state", false);
}
const audio = document.getElementById("player");
function addFolder() {
  var tracks = document.querySelectorAll("[onclick]");
  for (var i = 1; i < tracks.length; i++) {
    document.querySelectorAll("[onclick]")[i].onclick();
  }
}
function updatePlaylist(url) {
  let playlist = JSON.parse(retrieve("playlist"));
  let art = "";
  if (document.getElementById("data")) {
    art = document.getElementById("data").value;
  }
  let item = [url, art];
  playlist.push(item);
  store("playlist", JSON.stringify(playlist));
  if (playlist.length == 1) {
    play(0);
  }
}
function updateArt() {
  let art = JSON.parse(retrieve("track"))[1];
  if (art != "") {
    document.getElementById("cover").src = art;
    document.getElementById("cover").hidden = false;
  } else {
    document.getElementById("cover").src = "data:null";
    document.getElementById("cover").hidden = true;
  }
}
function play(index) {
  let data = JSON.parse(retrieve("playlist"))[index];
  let file = data[0].split("/").pop();
  document.getElementById("track").innerHTML = decodeURI(file.substring(0, file.length - 5));
  audio.src = decodeURI(data[0]);
  audio.play();
  let track = [data[0], data[1]];
  store("track", JSON.stringify(track));
  store("index", index);
  updateArt(index);
}
window.addEventListener("unload", function() {
  store("progress", audio.currentTime);
  store("trails", JSON.stringify(trails));
});
document.getElementsByClassName("visual")[0].addEventListener("mouseover", function() {
  document.getElementsByClassName("next")[0].hidden = false;
});
document.getElementsByClassName("visual")[0].addEventListener("mouseout", function() {
  document.getElementsByClassName("next")[0].hidden = true;
});
audio.onvolumechange = function() {
  store("volume", audio.volume);
};
audio.onplay = function() {
  store("state", true);
};
audio.onpause = function() {
  store("state", false);
}
audio.addEventListener("ended", function() {
  let playlist = JSON.parse(retrieve("playlist"));
  let index = JSON.parse(retrieve("index"));
  if (!playlist[index + 1]) {
    play(0);
  } else {
    play(index + 1);
  }
});
function init() {
  var trailsExist = retrieve("trails");
  if (!trailsExist) {
    trails = [];
    createSession();
  } else {
    trails = JSON.parse(trailsExist);
    let track = JSON.parse(retrieve("track"));
    if (!track.length < 1) {
      audio.src = decodeURI(track[0]);
      audio.currentTime = retrieve("progress");
      audio.volume = retrieve("volume");
      if (JSON.parse(retrieve("state"))) {
        audio.play();
      }
      document.getElementById("track").innerHTML = track[0].split("/").pop().split(".").shift();
      updateArt();
    }
  }
  window.requestAnimationFrame(draw);
}
init();
