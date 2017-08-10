function insertReply(event) {
  var targ = event.target || event.srcElement;
  document.getElementById("textUpload").value += ">>" + targ.textContent + "\n";
}
function insertThread(id) {
  document.getElementById("threadUpload").value = id;
}
$(".custom-file-input").on("change",function(){
  var fileName = $(this).val().replace("C:\\fakepath\\", "");
  $(this).next(".form-control-file").addClass("selected").html(fileName);
})
