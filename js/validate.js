function validateLogin(x) {
  if (x == "1") {
    var email = document.forms["login"]["email"].value;
    var emailCheck = email.match(/^(?![_-])(?!.*[_-]{2})[a-zA-Z0-9_-]+@[a-zA-Z]+\.[a-zA-Z]+$/g);
    if (emailCheck == null) {
      alert("Email address is invalid.");
      return false;
    }
  }
  var username = document.forms["login"]["username"].value;
  var usernameCheck = username.match(/^(?=.{1,16}$)(?![_.-])(?!.*[_.-]{2})[a-zA-Z0-9._-]+$/g);
  if (username.slice(-1) == ("_" || "." || "-")) {
    usernameCheck = null;
  }
  if (usernameCheck == null) {
    alert("Username contains invalid characters.");
    return false;
  }
}
