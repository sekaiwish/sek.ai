<body>
<?php
$page = explode("/",$_SERVER["REQUEST_URI"]);
$page = $page[1];
if($page != "account") {
  if(!in_array($page,$pageLinks)) {
    $page = "home";
  }
}
$pageTitles = ["Home","FLAC","Anime","世界chan","DLF","Hentai","ISO"];
$pageLinks = ["home","flac","anime","chan","dlf","hentai","iso"];
if($_SESSION["rank"] > 1) {
	array_push($pageTitles, "Admin");
	array_push($pageLinks, "admin");
}

?>
  <script>
    function showResult(str) {
      if (str.length==0) {
        document.getElementById("livesearch").innerHTML = "";
        document.getElementById("livesearch").style.border = "0px";
        document.getElementById("livesearch").style.display = "none";
        return;
      }
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      }
      xmlhttp.onreadystatechange = function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("livesearch").innerHTML = this.responseText;
          document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
          document.getElementById("livesearch").style.display = "block";
        }
      }
      var dir = window.location.href;
      var dir = dir.replace(/http.*:\/\/.*\/(.*)\//, "$1");
      xmlhttp.open("GET","/livesearch.php?q="+str+"&d="+dir, true);
      xmlhttp.send();
    }
  </script>
  <nav class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">
      <img src="/assets/favicon/32.png" width="30" height="30" class="d-inline-block align-top">
      Sekai
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
<?php
  for($x=0;$x<count($pageTitles);$x++) {
    if($pageLinks[$x] == $page) {
      echo("        <li class=\"nav-item\">\n          <a class=\"nav-link active\" href=\"/{$pageLinks[$x]}/\">{$pageTitles[$x]}</a>\n        </li>\n");
    } else {
      echo("        <li class=\"nav-item\">\n          <a class=\"nav-link\" href=\"/{$pageLinks[$x]}/\">{$pageTitles[$x]}</a>\n        </li>\n");
    }
  }
  echo("      </ul>
      <form class=\"form-inline my-2 my-lg-0\">
        <input class=\"form-control mr-sm-2 mobile-hidden\" type=\"text\" id=\"searchInput\" onkeyup=\"showResult(this.value)\" placeholder=\"Search...\">
        <div class=\"livesearch mobile-hidden\" id=\"livesearch\"></div>
      </form>\n");
  if($page == "account") {
    echo("      <form class=\"form-inline\" method=\"POST\">\n        <button class=\"btn btn-outline-info\" type=\"submit\" name=\"return\"><i class=\"fa fa-arrow-circle-left\"></i> Return</button>\n      </form>");
  } else {
    echo("      <form class=\"form-inline\" method=\"POST\">\n        <button class=\"btn btn-info\" type=\"submit\" name=\"account\"><i class=\"fa fa-user\"></i> Account</button>\n      </form>");
  }
  echo("\n      <form class=\"form-inline\" method=\"POST\">\n        <button class=\"btn btn-danger\" type=\"submit\" name=\"logout\"><i class=\"fa fa-sign-out\"></i> Log out</button>\n      </form>\n      </div>\n    </nav>\n");
?>
