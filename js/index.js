var cursorState = false;
var modalState = false;
var killModal;
const data = [
  [
    {label:'/home/ - login to sekai', fun:function() {modalToggle()}},
    {label:'/stars/ - osrs shooting star tracker', url:'/stars/'},
    {label:'/iku/ - pomf-powered file hosting', url:'/iku/'},
    {label:'contact information', fun:function() {
      document.getElementById('data').style = 'opacity:0';
      setTimeout(function(){loadData(1)}, 1000);
    }}
  ],[
    {label:'discord', url:'discord://open/users/119094696487288833'},
    {label:'gpg', url:'/k.asc'},
    {label:'email', url:'mailto:wish@sek.ai'},
    {label:'steam', url:'//steamcommunity.com/id/wishdere'},
    {label:'gitlab', url:'//gitlab.com/wishu'},
    {label:'github', url:'//github.com/sekaiwish'},
    {label:'twitter', url:'//twitter.com/wishdere'},
    {label:'return', fun:function() {
      document.getElementById('data').style = 'opacity:0';
      setTimeout(function(){loadData(0)}, 1000);
    }}
  ]
];
function loadData(i) {
  var div = document.getElementById("data");
  div.style = "opacity:1";
  div.innerHTML = "";
  for (var j = 0; j < data[i].length; j++) {
    let br = document.createElement("BR");
    let a = document.createElement("A");
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
function redraw() {
  draw(1, '#00a0a0');
}
function init() {
  document.getElementById("body").hidden = false;
  document.getElementById("modal").hidden = false;
  document.getElementById("loader").hidden = true;
  setTimeout(function() {document.getElementById("wish").innerHTML = "w_"}, 180);
  setTimeout(function() {document.getElementById("wish").innerHTML = "wi_"}, 360);
  setTimeout(function() {document.getElementById("wish").innerHTML = "wis_"}, 540);
  setTimeout(function() {
    document.getElementById("wish").innerHTML = "wish<span id='cursor'>_</span>";
    setInterval(blink, 530);
  }, 720);
  loadData(0);
  window.requestAnimationFrame(redraw);
  play();
}
function blink() {
  let elem = document.getElementById('cursor').style;
  cursorState
    ? (() => {elem.visibility = 'hidden'; cursorState = false})()
    : (() => {elem.visibility = 'visible'; cursorState = true})();
}
async function login(form) {
  const data = await postData('/php/login.php', {
    username: form.username.value,
    password: form.password.value
  });
  switch (data) {
    case 0:
      document.getElementById("title").innerHTML = "ユーザーが見つからない";
      break;
    case 1:
      document.getElementById("title").innerHTML = "ログインに成功";
      window.location.href = "/home";
      break;
    case 2:
      document.getElementById("title").innerHTML = "パスワードが間違";
      break;
    default:
      document.getElementById("title").innerHTML = "ログインエラー";
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
