<?php
echo '<meta name="author" content="wish">
<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/mplus1p.css" type="text/css">
<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.13/css/solid.css" integrity="sha384-Rw5qeepMFvJVEZdSo1nDQD5B6wX0m7c5Z/pLNvjkB14W6Yki1hKbSEQaX9ffUbWe" crossorigin="anonymous">
<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.13/css/brands.css" integrity="sha384-VGCZwiSnlHXYDojsRqeMn3IVvdzTx5JEuHgqZ3bYLCLUBV8rvihHApoA1Aso2TZA" crossorigin="anonymous">
<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.13/css/fontawesome.css" integrity="sha384-GVa9GOgVQgOk+TNYXu7S/InPTfSDTtBalSgkgqQ7sCik56N9ztlkoTr2f/T44oKV" crossorigin="anonymous">
<link rel="stylesheet" href="/css/style.css">';
if ($_SERVER["REQUEST_URI"] === "/") {
  echo '<link rel="icon" href="/assets/favicon/wish/196.png" type="image/png" sizes="196x196">
  <link rel="icon" href="/assets/favicon/wish/128.png" type="image/png" sizes="128x128">
  <link rel="icon" href="/assets/favicon/wish/96.png" type="image/png" sizes="96x96">
  <link rel="icon" href="/assets/favicon/wish/32.png" type="image/png" sizes="32x32">
  <link rel="icon" href="/assets/favicon/wish/16.png" type="image/png" sizes="16x16">';
} else {
  echo '<link rel="icon" href="/assets/favicon/sekai/196.png" type="image/png" sizes="196x196">
  <link rel="icon" href="/assets/favicon/sekai/128.png" type="image/png" sizes="128x128">
  <link rel="icon" href="/assets/favicon/sekai/96.png" type="image/png" sizes="96x96">
  <link rel="icon" href="/assets/favicon/sekai/32.png" type="image/png" sizes="32x32">
  <link rel="icon" href="/assets/favicon/sekai/16.png" type="image/png" sizes="16x16">';
}
