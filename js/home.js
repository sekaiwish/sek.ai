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
async function password(form) {
  const data = await postData("/php/password.php", {
    old: form.old.value,
    new: form.new.value,
    confirm: form.confirm.value
  });
  switch (data) {
    case 0:
      document.getElementById("title").innerHTML = "passwords don't match";
      break;
    case 1:
      document.getElementById("title").innerHTML = "user error";
      break;
    case 2:
      document.getElementById("title").innerHTML = "old password doesn't match";
      break;
    case 3:
      document.getElementById("title").innerHTML = "password changed";
      break;
    default:
      document.getElementById("title").innerHTML = "script error";
  }
}
async function postData(url = '', data = {}) {
  const response = await fetch(url, {
    method: "POST",
    cache: "no-cache",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
  });
  return await response.json();
}
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
