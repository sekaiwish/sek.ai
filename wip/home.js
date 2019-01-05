var cursorState = false;
var modalState = false;
var killModal;
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var trails = [];
var canvasWidth = window.innerWidth;
function init() {
  window.requestAnimationFrame(draw);
}
function draw() {
  canvas.height = window.innerHeight;
  canvas.width = window.innerWidth;
  if (canvasWidth !== window.innerWidth) {
    scale();
  }
  if (trails[0]) {
    while (trails[0].age < 1) {
      trails.shift();
    }
  }
  var newPixel = {};
  let trailLength = 60;
  newPixel.age = window.innerHeight + trailLength;
  newPixel.position = (Math.floor((Math.random() * window.innerWidth) + 1));
  trails.push(newPixel);
  for (var i = 0; i < trails.length; i++) {
    ctx.fillStyle = "#FFF";
    ctx.fillRect(trails[i].position, window.innerHeight - trails[i].age + trailLength, 1, 1);
    var gradient = ctx.createLinearGradient(trails[i].position, window.innerHeight - trails[i].age + trailLength, trails[i].position, window.innerHeight - trails[i].age);
    gradient.addColorStop(0, "#00a0a0");
    gradient.addColorStop(1, "#000");
    ctx.fillStyle = gradient;
    ctx.fillRect(trails[i].position, window.innerHeight - trails[i].age, 1, trailLength);
    trails[i].age -= 2;
  }
  window.requestAnimationFrame(draw);
}
function blink() {
  if (cursorState === false) {
    document.getElementById("cursor").style.visibility = "hidden";
    cursorState = true;
  } else {
    document.getElementById("cursor").style.visibility = "visible";
    cursorState = false;
  }
}
function modalToggle() {
  if (modalState === false) {
    clearTimeout(killModal);
    document.getElementById("body").style.opacity = 0.2;
    document.getElementById("modal").style.visibility = "visible";
    document.getElementById("catch").style.visibility = "visible";
    document.getElementById("modal").style.opacity = 1;
    modalState = true;
  } else {
    document.getElementById("body").style.opacity = 1;
    killModal = setTimeout(function(){document.getElementById("modal").style.visibility = "hidden"},3000);
    document.getElementById("catch").style.visibility = "hidden";
    document.getElementById("modal").style.opacity = 0;
    modalState = false;
  }
}
function catchModal() {
  document.getElementById("body").style.opacity = 1;
  killModal = setTimeout(function(){document.getElementById("modal").style.visibility = "hidden"},3000);
  document.getElementById("catch").style.visibility = "hidden";
  document.getElementById("modal").style.opacity = 0;
  modalState = false;
}
document.onkeydown = function(evt) {
    evt = evt || window.event;
    var isEscape = false;
    if ("key" in evt) {
        isEscape = (evt.key == "Escape" || evt.key == "Esc");
    }
    if (isEscape) {
        catchModal();
    }
}
setTimeout(function(){document.getElementById("wish").innerHTML="<span class='halfStyle' data-content='w'>w</span>_"},180);
setTimeout(function(){document.getElementById("wish").innerHTML="<span class='halfStyle' data-content='w'>w</span><span class='halfStyle' data-content='i'>i</span>_"},360);
setTimeout(function(){document.getElementById("wish").innerHTML="<span class='halfStyle' data-content='w'>w</span><span class='halfStyle' data-content='i'>i</span><span class='halfStyle' data-content='s'>s</span>_"},540);
setTimeout(function(){document.getElementById("wish").innerHTML="<span class='halfStyle' data-content='w'>w</span><span class='halfStyle' data-content='i'>i</span><span class='halfStyle' data-content='s'>s</span><span class='halfStyle' data-content='h'>h</span><span id='cursor'>_</span>";setInterval(blink,500);},720);
function play() {
  audio = document.getElementById("player");
  audio.volume = 0.1;
  audio.loop = true;
  audio.play();
}
setTimeout(play, 0);
init();
