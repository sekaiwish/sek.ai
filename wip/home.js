var cursorState = false;
var modalState = false;
var killModal;
var linkObject;
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
};
setTimeout(function(){document.getElementById("wish").innerHTML="<span class='halfStyle' data-content='w'>w</span>_"},180);
setTimeout(function(){document.getElementById("wish").innerHTML="<span class='halfStyle' data-content='w'>w</span><span class='halfStyle' data-content='i'>i</span>_"},360);
setTimeout(function(){document.getElementById("wish").innerHTML="<span class='halfStyle' data-content='w'>w</span><span class='halfStyle' data-content='i'>i</span><span class='halfStyle' data-content='s'>s</span>_"},540);
setTimeout(function(){document.getElementById("wish").innerHTML="<span class='halfStyle' data-content='w'>w</span><span class='halfStyle' data-content='i'>i</span><span class='halfStyle' data-content='s'>s</span><span class='halfStyle' data-content='h'>h</span><span id='cursor'>_</span>";setInterval(blink,500);},720);
var audio = document.getElementById("player");
player.volume = 0.1;
player.loop = true;
player.play();
