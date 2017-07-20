<?php
include("{$_SERVER["DOCUMENT_ROOT"]}/webassets/defaultHeader.php");
if($_SESSION["rank"] < 2) {
  header("Location: /error/403.html");
  exit();
}
include("{$_SERVER['DOCUMENT_ROOT']}/webassets/defaultBody.php");
include("{$_SERVER['DOCUMENT_ROOT']}/webassets/defaultNavbar.php");
include("{$_SERVER["DOCUMENT_ROOT"]}/access/sql.php");
$sql = mysqli_query($link, "SELECT username, email FROM login WHERE approved = '0'");
$count = mysqli_num_rows($sql);
?>
  <div class="card" style="top:5rem;width:25rem;">
    <div class="card-block">
      <h4>Approve user accounts</h4>
      <form method="post" action="confirmUsers.php">
<?php
  for($x=0;$x<$count;$x++) {
    $unapproved = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    echo("          <div class=\"form-check\"><label class=\"form-check-label\"><input type=\"checkbox\" class=\"form-check-input\" value=\"{$unapproved["username"]}\" name=\"{$unapproved["username"]}\"> {$unapproved["username"]} ({$unapproved["email"]})</label></div>\n");
  }
  mysqli_close($link);
?>
        <button type="submit" class="btn btn-info">Submit</button>
      </form>
    </div>
  </div>
</body>
</html>
