function redraw() {
  draw(0, "#690099");
}
function store(name, value) {
  sessionStorage.setItem(name, value);
}
function retrieve(name) {
  return sessionStorage.getItem(name);
}
function createSession() {
  store("played", 0.0);
  store("volume", 0.1);
  store("track", JSON.stringify([]));
  store("playlist", JSON.stringify([]));
  store("index", 0);
  store("state", false);
}
const audio = document.getElementById("player");
function addFolder() {
  var tracks = document.querySelectorAll("#song");
  for (var i = 0; i < tracks.length; i++) {
    document.querySelectorAll("#song")[i].onclick();
  }
}
function exportPlaylist() {
  let playlist = retrieve("playlist");
  prompt("Copy the text below", playlist);
}
function importPlaylist() {
  let imported = prompt("Paste a playlist below");
  store("playlist", imported);
  populateModal();
  play(0);
}
function updatePlaylist(url, title) {
  let playlist = JSON.parse(retrieve("playlist"));
  let art = "";
  if (document.getElementById("data")) {
    art = document.getElementById("data").value;
  }
  let item = [url, art];
  if (title) {
    item.push(title);
  }
  playlist.push(item);
  store("playlist", JSON.stringify(playlist));
  if (playlist.length == 1) {
    play(0);
    document.getElementById("reset").hidden = false;
  }
}
function removeIndex(index) {
  let playlist = JSON.parse(retrieve("playlist"));
  playlist.splice(index, 1);
  store("playlist", JSON.stringify(playlist));
  populateModal();
}
function updateArt() {
  let art = JSON.parse(retrieve("track"))[1];
  if (art != "") {
    document.getElementById("cover").src = art;
    document.getElementById("cover").hidden = false;
  } else {
    document.getElementById("cover").src = "data:null";
    document.getElementById("cover").hidden = true;
  }
}
function play(index) {
  let data = JSON.parse(retrieve("playlist"))[index];
  audio.src = decodeURI(data[0]);
  audio.play();
  let track = [data[0], data[1]];
  if (data[2]) {
    document.getElementById("track").innerHTML = data[2];
    track.push(data[2]);
  } else {
    document.getElementById("track").innerHTML = decodeURI(data[0].split("/").pop().split(".").slice(0,-1).join("."));
  }
  store("track", JSON.stringify(track));
  store("index", index);
  updateArt(index);
}
function reset() {
  createSession();
  location.reload(true);
}
function populateModal() {
  let playlist = JSON.parse(retrieve("playlist"));
  let modal = document.getElementById("contents");
  while (modal.firstChild) {
    modal.removeChild(modal.firstChild);
  }
  for (var i = 0; i < playlist.length; i++) {
    let deleter = document.createElement("a");
    deleter.classList = "ul delete";
    deleter.innerHTML = "&nbsp;X&nbsp;";
    deleter.setAttribute("onclick", "removeIndex(" + i + ")");
    modal.appendChild(deleter);
    let item = document.createElement("a");
    item.classList = "ul";
    if (playlist[i][2]) {
      item.innerHTML = playlist[i][2];
    } else {
      item.innerHTML = decodeURI(playlist[i][0].split("/").pop().split(".").slice(0,-1).join("."));
    }
    item.setAttribute("onclick", "play(" + i + ")");
    modal.appendChild(item);
    modal.appendChild(document.createElement("br"));
  }
}
window.addEventListener("unload", function() {
  store("progress", audio.currentTime);
  store("trails", JSON.stringify(trails));
});
audio.onvolumechange = function() {
  store("volume", audio.volume);
};
audio.onplay = function() {
  store("state", true);
};
audio.onpause = function() {
  store("state", false);
}
audio.addEventListener("ended", function() {
  let playlist = JSON.parse(retrieve("playlist"));
  let index = JSON.parse(retrieve("index"));
  if (!playlist.length < 1) {
    if (!playlist[index + 1]) {
      play(0);
    } else {
      play(index + 1);
    }
  } else {
    document.getElementById("track").innerHTML = "N/A";
    document.getElementById("cover").src = "data:null";
    document.getElementById("cover").hidden = true;
  }
});
function init() {
  var trailsExist = retrieve("trails");
  if (!trailsExist) {
    createSession();
  } else {
    trails = JSON.parse(trailsExist);
    audio.volume = retrieve("volume");
    let track = JSON.parse(retrieve("track"));
    if (!track.length < 1) {
      audio.src = decodeURI(track[0]);
      audio.currentTime = retrieve("progress");
      if (JSON.parse(retrieve("state"))) {
        audio.play();
      }
      // Sometimes the element just will not update.
      audio.volume += 0.000001;
      if (track[2]) {
        document.getElementById("track").innerHTML = track[2];
      } else {
        document.getElementById("track").innerHTML = decodeURI(track[0].split("/").pop().split(".").slice(0,-1).join("."));
      }
      document.getElementById("reset").hidden = false;
      document.getElementById("playlist").hidden = false;
      updateArt();
    }
  }
  document.getElementById('body').hidden = false;
  document.getElementById('modal').hidden = false;
  document.getElementById('loader').hidden = true;
  window.requestAnimationFrame(redraw);
}
function modalToggle() {
  populateModal();
  modalState ? hide() : show();
}
init();
