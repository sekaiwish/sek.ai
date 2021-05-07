var modalState = false;
var killModal;
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
  localStorage.setItem('trailsEnabled', false);
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
    dir
      ? trails[i].age -= trails[i].velocity
      : trails[i].age += trails[i].velocity;
  }
  window.requestAnimationFrame(redraw);
}
async function postData(url = '', data = {}) {
  const response = await fetch(url, {
    method: 'POST',
    cache: 'no-cache',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  });
  return await response.json();
}
function loadData(i) {
  var div = document.getElementById('data');
  div.style = 'opacity:1';
  div.innerHTML = '';
  for (var j = 0; j < data[i].length; j++) {
    let br = document.createElement('BR');
    let a = document.createElement('A');
    a.textContent = data[i][j].label;
    if (data[i][j].url) {
      a.href = data[i][j].url;
    } else {
      a.onclick = data[i][j].fun;
    }
    div.appendChild(br);
    div.appendChild(a);
  }
}
function hide() {
  document.getElementById('body').style.opacity = 1;
  killModal = setTimeout(function(){document.getElementById('modal').style.visibility = 'hidden'}, 3000);
  document.getElementById('catch').style.visibility = 'hidden';
  document.getElementById('modal').style.opacity = 0;
  modalState = false;
}
function show() {
  clearTimeout(killModal);
  document.getElementById('body').style.opacity = 0.2;
  document.getElementById('modal').style.visibility = 'visible';
  document.getElementById('catch').style.visibility = 'visible';
  document.getElementById('modal').style.opacity = 1;
  modalState = true;
}
function modalToggle() {
  modalState ? hide() : show();
}
document.onkeydown = function(evt) {
  evt = evt || window.event;
  var isEscape = false;
  if ('key' in evt) { isEscape = (evt.key == 'Escape' || evt.key == 'Esc') };
  if (isEscape) { hide() };
}
function play() {
  audio = document.getElementById('player');
  audio.volume = 0.1;
  audio.loop = true;
  var isChromium = window.chrome;
  if (isChromium !== null && typeof isChromium !== 'undefined') {
    document.body.addEventListener('mousemove', function() {
      audio.play()
    });
  } else { audio.play() };
}
function init() {
  document.getElementById('body').hidden = false;
  document.getElementById('modal').hidden = false;
  document.getElementById('loader').hidden = true;
  loadData(0);
  window.requestAnimationFrame(redraw);
  play();
}
