function insertReply(event) {
  var targ = event.target || event.srcElement;
  document.getElementById("textUpload").value += ">>" + targ.textContent + "\n";
}
function insertThread(id) {
  document.getElementById("threadUpload").value = id;
}
