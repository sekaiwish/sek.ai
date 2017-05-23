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
echo("  <nav class=\"navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse\">
    <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
      <span class=\"navbar-toggler-icon\"></span>
    </button>
    <a class=\"navbar-brand\" href=\"/\">
      <img src=\"/webassets/favicon.ico\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\">
      Sekai
    </a>
    <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
      <ul class=\"navbar-nav mr-auto\">\n");
      for($x=0;$x<count($pageTitles);$x++) {
        if($pageLinks[$x] == $page) {
          echo("        <li class=\"nav-item\">
          <a class=\"nav-link active\" href=\"/{$pageLinks[$x]}/\">{$pageTitles[$x]}</a>
        </li>\n");
        } else {
          echo("        <li class=\"nav-item\">
          <a class=\"nav-link\" href=\"/{$pageLinks[$x]}/\">{$pageTitles[$x]}</a>
        </li>\n");
        }
      }
      echo("      </ul>
      <span class=\"navbar-text\">
        Logged in as {$_SESSION['username']}
      </span>\n");
    if($page == "account") {
      echo("      <a class=\"btn btn-outline-info\" href=\"/\">
        <i class=\"fa fa-arrow-circle-left\"></i> Return
      </a>");
    } else {
      echo("      <form class=\"form-inline\" method=\"POST\">
        <button class=\"btn btn-info\" type=\"submit\" name=\"account\"><i class=\"fa fa-user\"></i> Account</button>
      </form>");
    }
    echo("
      <form class=\"form-inline\" method=\"POST\">
        <button class=\"btn btn-danger\" type=\"submit\" name=\"logout\"><i class=\"fa fa-sign-out\"></i> Log out</button>
      </form>
    </div>
  </nav>\n");
?>
