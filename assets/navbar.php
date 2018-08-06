<body>
<?php $page=explode("/",$_SERVER["REQUEST_URI"]);?>
<?php $page=$page[count($page)-2]; ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <b class="navbar-brand jp">
      <img src="/assets/favicon/sekai/32.png" width="32" height="32">
      &#x4E16;&#x754C;&#x3061;&#x3083;&#x3093;
    </b>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php if ($page == "account"): ?><a class="ml-auto nav-item" href="/chan/">
      <button class="btn btn-outline-info"><i class="fa fa-arrow-circle-left"></i> Return</button>
    </a>
    <?php else: ?><a class="ml-auto nav-item" href="/chan/submit/">
      <button class="btn btn-alert"><i class="fa fa-pencil-square-o"></i> Submit Thread</button>
    </a>
    <?php if ($_SESSION["username"] !== "Anonymous"): ?>
    &nbsp;&nbsp;<a class="nav-item" href="/account.php">
      <button class="btn btn-info"><i class="fa fa-user"></i> Account</button>
    </a>
    <?php endif; endif; ?>&nbsp;&nbsp;<form class="nav-item form-inline" method="post">
      <button class="btn btn-danger" type="submit" name="logout"><i class="fa fa-sign-out"></i> Log out</button>
    </form>
    </div>
  </nav>
