var cursorState = false;
var modalState = false;
var killModal;
function redraw() {
  draw(1, "#00a0a0");
}
function init() {
  window.requestAnimationFrame(redraw);
  play();
}
function blink() {
  if (cursorState === true) {
    document.getElementById("cursor").style.visibility = "hidden";
    cursorState = false;
    var link = document.querySelector("link[rel*='icon']") || document.createElement("link");
    link.rel = "icon";
    link.href = "favicoff.ico";
    document.getElementsByTagName("head")[0].appendChild(link);
  } else {
    document.getElementById("cursor").style.visibility = "visible";
    cursorState = true;
    var link = document.querySelector("link[rel*='icon']") || document.createElement("link");
    link.rel = "icon";
    link.href = "favicon.ico";
    document.getElementsByTagName("head")[0].appendChild(link);
  }
}
async function login(form) {
  const data = await postData("/php/login.php", {
    username: form.username.value,
    password: form.password.value
  });
  switch (data) {
    case 1:
      document.getElementById("title").innerHTML = "ログインに成功";
      window.location.href = "/home";
      break;
    case 2:
      document.getElementById("title").innerHTML = "パスワードが間違";
      break;
    default:
      document.getElementById("title").innerHTML = "ユーザーが見つからない";
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
setTimeout(function() {document.getElementById("wish").innerHTML = "w_"}, 180);
setTimeout(function() {document.getElementById("wish").innerHTML = "wi_"}, 360);
setTimeout(function() {document.getElementById("wish").innerHTML = "wis_"}, 540);
setTimeout(function() {
  document.getElementById("wish").innerHTML = "wish<span id='cursor'>_</span>";
  setInterval(blink, 530);
}, 720);
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
init();
