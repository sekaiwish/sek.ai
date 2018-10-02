<?php
echo '<div class="gitlab">';
$proc = proc_open(
  "git rev-parse --short HEAD",
  array(
    array(
      "pipe",
      "r"
    ),
    array(
      "pipe",
      "w"
    ),
    array(
      "pipe",
      "w"
    )
  ),
  $pipes
);
$commit = trim(
  stream_get_contents(
    $pipes[1]
  )
);
echo "<a target=\"_blank\" href=\"//gitlab.com/wishu/sek.ai/commit/$commit\"><button class=\"btn btn-dark\"><i class=\"fab fa-gitlab\"></i>&nbsp;&nbsp;$commit</button></a></div>";
echo '<div class="copyright"><button class="btn btn-dark"><i class="fas fa-copyright"></i> wish 2016-2018</button></div>';
echo '<div class="ms"><button class="btn btn-dark">';
$time = explode(' ', microtime());
$finish = $time[1] + $time[0];
echo round(($finish - $start), 5) * 1000 . "ms";
echo '</button></div>';
if (isset($_SESSION["username"])) {
  echo '<div class="account btn-group"><a class="btn btn-danger" href="/php/logout.php">Logout</a>';
  if ($_SERVER["REQUEST_URI"] === "/account.php" || $_SERVER["REQUEST_URI"] === "/anime/") {
    echo '<a class="btn btn-secondary" href="/home/">Home</a>';
  } else {
    echo '<a class="btn btn-secondary" href="/account.php">Account</a>';
  }

  echo '</div>';
}
