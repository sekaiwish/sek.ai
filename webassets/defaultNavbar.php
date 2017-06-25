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
echo("  <nav class=\"navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse\">
    <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
      <span class=\"navbar-toggler-icon\"></span>
    </button>
    <a class=\"navbar-brand\" href=\"/\">
      <img src=\"/webassets/favicon/32.png\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\">
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
      if($_SESSION['rank'] > 1) {
        echo("      </ul>\n      <span class=\"navbar-text\">\n        Logged in as {$_SESSION['username']} (Admin)\n      </span>\n");
      } elseif ($_SESSION["rank"] > 0) {
        echo("      </ul>\n      <span class=\"navbar-text\">\n        Logged in as {$_SESSION['username']} (Mod)\n      </span>\n");
      } else {
        echo("      </ul>\n      <span class=\"navbar-text\">\n        Logged in as {$_SESSION['username']}\n      </span>\n");
      }
      if($page == "account") {
        echo("      <a class=\"btn btn-outline-info\" href=\"/\">\n        <i class=\"fa fa-arrow-circle-left\"></i> Return\n      </a>");
      } else {
        echo("      <form class=\"form-inline\" method=\"POST\">\n        <button class=\"btn btn-info\" type=\"submit\" name=\"account\"><i class=\"fa fa-user\"></i> Account</button>\n      </form>");
      }
      echo("\n      <form class=\"form-inline\" method=\"POST\">\n        <button class=\"btn btn-danger\" type=\"submit\" name=\"logout\"><i class=\"fa fa-sign-out\"></i> Log out</button>\n      </form>\n      </div>\n    </nav>\n");
?>
