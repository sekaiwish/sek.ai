<?php
echo '<meta name="author" content="wish">
<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=M+PLUS+1p:300&amp;subset=japanese"> 
<script defer src="//use.fontawesome.com/releases/v5.5.0/js/solid.js" integrity="sha384-Xgf/DMe1667bioB9X1UM5QX+EG6FolMT4K7G+6rqNZBSONbmPh/qZ62nBPfTx+xG" crossorigin="anonymous"></script>
<script defer src="//use.fontawesome.com/releases/v5.5.0/js/brands.js" integrity="sha384-S2C955KPLo8/zc2J7kJTG38hvFV+SnzXM6hwfEUhGHw5wPo6uXbnbjSJgw3clO4G" crossorigin="anonymous"></script>
<script defer src="//use.fontawesome.com/releases/v5.5.0/js/fontawesome.js" integrity="sha384-bNOdVeWbABef8Lh4uZ8c3lJXVlHdf8W5hh1OpJ4dGyqIEhMmcnJrosjQ36Kniaqm" crossorigin="anonymous"></script>
<link rel="stylesheet" href="/css/style.css">';
if ($_SERVER["REQUEST_URI"] === "/") {
  echo '<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/assets/favicon/wish/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/favicon/wish/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/favicon/wish/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/favicon/wish/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/assets/favicon/wish/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/assets/favicon/wish/apple-touch-icon-152x152.png">
  <link rel="icon" type="image/png" href="/assets/favicon/wish/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/assets/favicon/wish/favicon-16x16.png" sizes="16x16">';
} else {
  echo '<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/assets/favicon/sekai/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/favicon/sekai/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/favicon/sekai/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/favicon/sekai/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/assets/favicon/sekai/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/assets/favicon/sekai/apple-touch-icon-152x152.png">
  <link rel="icon" type="image/png" href="/assets/favicon/sekai/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/assets/favicon/sekai/favicon-16x16.png" sizes="16x16">';
}
