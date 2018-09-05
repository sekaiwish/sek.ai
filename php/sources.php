<?php
echo '<meta name="author" content="wish">
<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/mplus1p.css" type="text/css">
<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.3.1/css/solid.css" integrity="sha384-VGP9aw4WtGH/uPAOseYxZ+Vz/vaTb1ehm1bwx92Fm8dTrE+3boLfF1SpAtB1z7HW" crossorigin="anonymous">
<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.3.1/css/brands.css" integrity="sha384-rf1bqOAj3+pw6NqYrtaE1/4Se2NBwkIfeYbsFdtiR6TQz0acWiwJbv1IM/Nt/ite" crossorigin="anonymous">
<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.3.1/css/fontawesome.css" integrity="sha384-1rquJLNOM3ijoueaaeS5m+McXPJCGdr5HcA03/VHXxcp2kX2sUrQDmFc3jR5i/C7" crossorigin="anonymous">
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
