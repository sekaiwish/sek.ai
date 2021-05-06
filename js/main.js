// Temporarily disable trails globally until patched
localStorage.setItem("trailsEnabled", false);

var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');
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
if (!localStorage.getItem('trailsEnabled')) {
  localStorage.setItem('trailsEnabled', true);
}
function trailsToggle() {
  let state = JSON.parse(localStorage.getItem('trailsEnabled'));
  state
    ? localStorage.setItem('trailsEnabled', false)
    : localStorage.setItem('trailsEnabled', true);
  location.reload(true);
}
// dir: 0 = up, 1 = down
function draw(dir, color) {
  if (!JSON.parse(localStorage.getItem('trailsEnabled'))) {
    return;
  }
  canvas.height = window.innerHeight;
  canvas.width = window.innerWidth;
  if (canvasWidth !== window.innerWidth) {
    scale();
  }
  let trailLength = 60;
  if (trails[0]) {
    let len = trails.length;
    for (var i = 0; i < len; i++) {
      dir
        ? (() => { if (trails[i].age < 0) { dead.push(i) } })()
        : (() => { if (trails[i].age > window.innerHeight + trailLength) { dead.push(i) } })();
    }
    for (var i = dead.length - 1; i >= 0; i--)
      trails.splice(dead[i], 1);
    dead = [];
  }
  var newPixel = {};
  dir
    ? newPixel.age = window.innerHeight + trailLength
    : newPixel.age = 0;
  newPixel.position = Math.floor((Math.random() * window.innerWidth) + 1);
  newPixel.velocity = Math.floor((Math.random() * 5) + 2);
  trails.push(newPixel);
  let leng = trails.length;
  for (var i = 0; i < leng; i++) {
    ctx.fillStyle = '#FFF';
    dir
      ? ctx.fillRect(trails[i].position, window.innerHeight - trails[i].age + trailLength, 1, 1)
      : ctx.fillRect(trails[i].position, window.innerHeight - trails[i].age - 1, 1, 1);
    var gradient = ctx.createLinearGradient(
      trails[i].position,
      window.innerHeight - trails[i].age + trailLength,
      trails[i].position,
      window.innerHeight - trails[i].age
    );
    dir
      ? (() => {gradient.addColorStop(0, color); gradient.addColorStop(1, '#000')})()
      : (() => {gradient.addColorStop(0, '#000'); gradient.addColorStop(1, color)})();
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
