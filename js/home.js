var modalState = false;
var killModal;
function redraw() {
  draw(0, "#c06000");
}
function init() {
  window.requestAnimationFrame(redraw);
}
function hide() {
  document.getElementById("body").style.opacity = 1;
  killModal = setTimeout(function(){document.getElementById("modal").style.visibility = "hidden"},3000);
  document.getElementById("catch").style.visibility = "hidden";
  document.getElementById("modal").style.opacity = 0;
  modalState = false;
}
function show() {
  clearTimeout(killModal);
  document.getElementById("body").style.opacity = 0.2;
  document.getElementById("modal").style.visibility = "visible";
  document.getElementById("catch").style.visibility = "visible";
  document.getElementById("modal").style.opacity = 1;
  modalState = true;
}
function modalToggle() {
  modalState ? hide() : show();
}
document.onkeydown = function(evt) {
  evt = evt || window.event;
  var isEscape = false;
  if ("key" in evt) {
    isEscape = (evt.key == "Escape" || evt.key == "Esc");
  }
  if (isEscape) {
    hide();
  }
}
if (window.location.search.substring(1) === "s=1")
  document.getElementById("s").innerHTML = "- updated successfully!";
if (window.location.search.substring(1) === "e=1")
  document.getElementById("s").innerHTML = "- update failed.";
function play() {
  audio = document.getElementById("player");
  audio.volume = 0.1;
  audio.loop = true;
  var isChromium = window.chrome;
  if (isChromium !== null && typeof isChromium !== "undefined") {
    document.body.addEventListener("mousemove", function() {
      audio.play()
    });
  } else {
    audio.play();
  }
}
setTimeout(play, 0);
init();
