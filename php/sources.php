<?php
echo '<meta name="author" content="wish">
<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<style>@font-face{font-family:"M PLUS 1p";font-style:normal;font-weight:300;src:local("M PLUS 1p Light"),local("MPLUS1p-Light"),url(//fonts.gstatic.com/s/mplus1p/v15/e3tmeuShHdiFyPFzBRrQVBYgfiv2oNYmg_dUa_BuiDUpAHTpxnQDdX4knG-DKHYZBnWPEAnmhh62.22.woff2) format("woff2");unicode-range:U+7f68-7f69,U+7f6b,U+7f6d,U+7f71,U+7f77-7f79,U+7f7d-7f80,U+7f82-7f83,U+7f86-7f88,U+7f8b-7f8d,U+7f8f-7f91,U+7f94,U+7f96-7f97,U+7f9a,U+7f9c-7f9d,U+7fa1-7fa3,U+7fa6,U+7faa,U+7fad-7faf,U+7fb2,U+7fb4,U+7fb6,U+7fb8-7fb9,U+7fbc,U+7fbf-7fc0,U+7fc3,U+7fc5-7fc6,U+7fc8,U+7fca,U+7fce-7fcf,U+7fd5,U+7fdb,U+7fdf,U+7fe1,U+7fe3,U+7fe5-7fe6,U+7fe8-7fe9,U+7feb-7fec,U+7fee-7ff0,U+7ff2-7ff3,U+7ff9-7ffa,U+7ffd-7fff,U+8002,U+8004,U+8006-8008,U+800a-800f,U+8011-8014,U+8016,U+8018-8019,U+801c-8021,U+8024,U+8026,U+8028,U+802c,U+802e,U+8030,U+8034-8035,U+8037,U+8039-8040,U+8043-8044,U+8046,U+804a,U+8052,U+8058,U+805a,U+805f-8060,U+8062,U+8064,U+8066,U+8068,U+806d,U+806f-8073,U+8075-8076,U+8079,U+807b,U+807d-8081,U+8084-8088,U+808b,U+808e,U+8093,U+8099-809a,U+809c,U+809e,U+80a4,U+80a6-80a7,U+80ab-80ad,U+80b1,U+80b8-80b9,U+80c4-80c5,U+80c8,U+80ca,U+80cd,U+80cf,U+80d2,U+80d4-80db,U+80dd,U+80e0,U+80e4-80e6,U+80ed-80f3,U+80f5-80f7,U+80f9-80fc,U+80fe,U+8103,U+8109,U+810b,U+810d,U+8116-8118,U+811b-811c,U+811e,U+8120,U+8123-8124,U+8127,U+8129,U+812b-812c,U+812f-8130,U+8135,U+8139-813a,U+813c-813d;}</style>
<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.3.1/css/solid.css" integrity="sha384-VGP9aw4WtGH/uPAOseYxZ+Vz/vaTb1ehm1bwx92Fm8dTrE+3boLfF1SpAtB1z7HW" crossorigin="anonymous">
<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.3.1/css/brands.css" integrity="sha384-rf1bqOAj3+pw6NqYrtaE1/4Se2NBwkIfeYbsFdtiR6TQz0acWiwJbv1IM/Nt/ite" crossorigin="anonymous">
<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.3.1/css/fontawesome.css" integrity="sha384-1rquJLNOM3ijoueaaeS5m+McXPJCGdr5HcA03/VHXxcp2kX2sUrQDmFc3jR5i/C7" crossorigin="anonymous">
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
