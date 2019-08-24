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
function createSession() {
  store("played", 0.0);
  store("volume", 0.1);
  store("track", "");
}
function play(track) {
  document.getElementById("track").innerHTML = decodeURI(track.substring(2, track.length - 5));
  audio.src = track;
  audio.play();
  audio.volume = retrieve("volume");
}
function init() {
  var trailsExist = retrieve("trails");
  if (trailsExist !== null && typeof trailsExist !== "undefined") {
    trails = JSON.parse(trailsExist);
  } else {
    trails = [];
    createSession();
  }
  if (timePlayed !== "0.0" && timePlayed !== null) {
    var track = retrieve("track");
    var volume = retrieve("volume");
    var title = track.split("/").pop();
    document.getElementById("track").innerHTML = decodeURI(title.substring(0, title.length - 5));
    audio.volume = volume;
    audio.currentTime = timePlayed;
    audio.src = track;
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
  store("trails", JSON.stringify(trails));
});
audio.onvolumechange = function() {
  store("volume", audio.volume);
};
init();
