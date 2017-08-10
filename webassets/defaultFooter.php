  <div class="beta mobile-hidden">
    <a target="_blank" href="https://github.com/Sek-ai/Sek.ai/tree/dev">
      <button class="btn btn-secondary"><i class="fa fa-github"></i> <b>D0.6</b></button>
    </a>
  </div>
	<script src="/js/jquery-3.2.1.min.js"></script>
	<script src="/js/tether.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/moment.min.js"></script>
	<script src="/js/livestamp.min.js"></script>
	<script src="/js/chan.js"></script>
	<script src="https://www.google.com/recaptcha/api.js?render=explicit"></script>
</body>
<footer class="footer mobile-hidden">
  <div class="container">
    <span class="text-muted float-left">Copyright &copy; 2016-2017 Wish</span>
<?php
  if(isset($_SESSION["username"])) {
    echo("    <span class=\"text-muted float-right\">Logged in as {$_SESSION["username"]}");
    if($_SESSION["rank"] == 2) {
      echo(" (Administrator)");
    } elseif($_SESSION["rank"] == 1) {
      echo(" (Moderator)");
    }
    echo("</span>\n");
  }
?>
  </div>
</footer>
</html>
