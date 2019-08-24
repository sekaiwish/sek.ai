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
      if (trails[i].direction > 0) {
        if (trails[i].age > window.innerHeight + trailLength) {
          dead.push(i);
        }
      } else {
        if (trails[i].age < 0) {
          dead.push(i);
        }
      }
    }
    for (var i = dead.length - 1; i >= 0; i--)
      trails.splice(dead[i], 1);
    dead = [];
  }
  var newPixel = {};
  newPixel.position = Math.floor((Math.random() * window.innerWidth) + 1);
  newPixel.velocity = Math.floor((Math.random() * 3) + 2);
  newPixel.direction = Math.floor(Math.random() * 2);
  if (newPixel.direction > 0) {
    newPixel.age = 0;
  } else {
    newPixel.age = window.innerHeight + trailLength;
  }
  trails.push(newPixel);
  let leng = trails.length;
  for (var i = 0; i < leng; i++) {
    ctx.fillStyle = "#FFF";
    if (trails[i].direction > 0) {
      ctx.fillRect(trails[i].position, window.innerHeight - trails[i].age - 1, 1, 1);
    } else {
      ctx.fillRect(trails[i].position, window.innerHeight - trails[i].age + trailLength, 1, 1);
    }
    var gradient = ctx.createLinearGradient(trails[i].position, window.innerHeight - trails[i].age + trailLength, trails[i].position, window.innerHeight - trails[i].age);
    if (trails[i].direction > 0) {
      gradient.addColorStop(0, "#000");
      gradient.addColorStop(1, "#70000f");
    } else {
      gradient.addColorStop(0, "#70000f");
      gradient.addColorStop(1, "#000");
    }
    ctx.fillStyle = gradient;
    ctx.fillRect(trails[i].position, window.innerHeight - trails[i].age, 1, trailLength);
    if (trails[i].direction > 0) {
      trails[i].age += trails[i].velocity;
    } else {
      trails[i].age -= trails[i].velocity;
    }
  }
  window.requestAnimationFrame(draw);
}
init();
