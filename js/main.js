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
// dir 0 is up, 1 is down
function draw(dir, color) {
  canvas.height = window.innerHeight;
  canvas.width = window.innerWidth;
  if (canvasWidth !== window.innerWidth) {
    scale();
  }
  let trailLength = 60;
  if (trails[0]) {
    let len = trails.length;
    for (var i = 0; i < len; i++) {
      if (dir) {
        if (trails[i].age < 0) {
          dead.push(i);
        }
      } else {
        if (trails[i].age > window.innerHeight + trailLength) {
          dead.push(i);
        }
      }
    }
    for (var i = dead.length - 1; i >= 0; i--)
      trails.splice(dead[i], 1);
    dead = [];
  }
  var newPixel = {};
  if (dir) {
    newPixel.age = window.innerHeight + trailLength;
  } else {
    newPixel.age = 0;
  }
  newPixel.position = Math.floor((Math.random() * window.innerWidth) + 1);
  newPixel.velocity = Math.floor((Math.random() * 5) + 2);
  trails.push(newPixel);
  let leng = trails.length;
  for (var i = 0; i < leng; i++) {
    ctx.fillStyle = "#FFF";
    if (dir) {
      ctx.fillRect(
        trails[i].position,
        window.innerHeight - trails[i].age + trailLength,
        1,
        1
      );
    } else {
      ctx.fillRect(
        trails[i].position,
        window.innerHeight - trails[i].age - 1,
        1,
        1
      );
    }
    var gradient = ctx.createLinearGradient(
      trails[i].position,
      window.innerHeight - trails[i].age + trailLength,
      trails[i].position,
      window.innerHeight - trails[i].age
    );
    if (dir) {
      gradient.addColorStop(0, color);
      gradient.addColorStop(1, "#000");
    } else {
      gradient.addColorStop(0, "#000");
      gradient.addColorStop(1, color);
    }
    ctx.fillStyle = gradient;
    ctx.fillRect(
      trails[i].position,
      window.innerHeight - trails[i].age,
      1,
      trailLength
    );
    if (dir) {
      trails[i].age -= trails[i].velocity;
    } else {
      trails[i].age += trails[i].velocity;
    }
  }
  window.requestAnimationFrame(redraw);
}
