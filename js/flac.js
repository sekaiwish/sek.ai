var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var trails = [];
var dead = [];
var canvasWidth = window.innerWidth;
function init() {
  var trailsExist = retrieve("trails");
  if (trailsExist !== null && typeof trailsExist !== "undefined") {
    trails = JSON.parse(trailsExist);
  } else {
    trails = [];
  }
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
function store(name, value) {
  sessionStorage.setItem(name, value);
}
function retrieve(name) {
  return sessionStorage.getItem(name);
}
var audio = document.getElementById("player");
var played = false;
var timePlayed = retrieve("played");
function update() {
  if (!played) {
    if (timePlayed) {
      var track = retrieve("track");
      var title = track.split("/").pop();
      document.getElementById("track").innerHTML = decodeURI(title.substring(0, title.length - 5));
      audio.volume = 0.1;
      audio.loop = true;
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
      played = true;
    } else {
      played = true;
      play("/home/theme.flac");
    }
  } else {
    var percentage = audio.currentTime / audio.duration * 100;
    document.getElementById("progress").innerHTML = ".visual{background:linear-gradient(to right,rgba(100,0,0,0.3) " + percentage + "%,rgba(0,0,0,0.5) " + (percentage + 1) + "%)!important}";
    store("played", audio.currentTime);
    store("track", audio.src);
  }
}
function play(track) {
  document.getElementById("track").innerHTML = decodeURI(track.substring(2, track.length - 5));
  audio.loop = true;
  audio.src = track;
  audio.volume = 0.1;
  audio.currentTime = 0;
  audio.play();
  update();
}
window.addEventListener("unload", function(event) {
  store("played", audio.currentTime);
  store("track", audio.src);
  store("trails", JSON.stringify(trails));
});
update();
setInterval(update, 100);
init();
