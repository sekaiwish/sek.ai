var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var trails = [];
var dead = [];
var canvasWidth = window.innerWidth;
function init() {
  window.requestAnimationFrame(draw);
}
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
    gradient.addColorStop(1, "#c06000");
    ctx.fillStyle = gradient;
    ctx.fillRect(trails[i].position, window.innerHeight - trails[i].age, 1, trailLength);
    trails[i].age += trails[i].velocity;
  }
  window.requestAnimationFrame(draw);
}
function setCookie(name, value) {
  var cookieValue = escape(value);
  document.cookie = name + "=" + cookieValue;
}
function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}
var audio = document.getElementById("player");
var played = false;
var timePlayed = getCookie("timePlayed");
function update() {
  if (!played) {
    if (timePlayed) {
      audio.volume = 0.1;
      audio.loop = true;
      audio.currentTime = timePlayed;
      var isChromium = window.chrome;
      if (isChromium !== null && typeof isChromium !== "undefined") {
        document.body.addEventListener("mousemove", function() {
          audio.play()
        });
      } else {
        audio.play();
      }
      played = true;
    }
  } else {
    setCookie("timePlayed", audio.currentTime);
  }
}
function play(track) {
  audio.src = track;
  audio.currentTime = 0;
  audio.play();
}
update();
setInterval(update, 100);
init();
