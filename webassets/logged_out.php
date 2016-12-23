<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/webassets/font.css" type="text/css">
    <title>
      Log in to WishDrive
    </title>
    <style type="text/css">
      form {
        border: 0px solid: #f1f1f1;
      }
      input[type=text], input[type=password] {
        margin: 8px 0;
        display: inline-block;
        border: 1px solid: #ccc;
        box-sizing: border-box;
      }
    </style>
  </head>
  <body bgcolor="#1D1F21">
    <p class="beta">
      DEV 0.5
    </p>
    <p class="neonoireTitle">
      WishDrive
    </p>
    <h2>
      Log in to WishDrive
    </h2>
    <form style="text-align: center; color: gray;" action="/access/login.php" method="post" accept-charset = "UTF-8">
      <div class="container">
        <label>
          <b>
            Username
          </b>
        </label>
        <br>
        <input type="text" placeholder="Enter Username" name="username" id="username" maxlength="16" required>
        <br>
        <label>
          <b>
            Password
          </b>
        </label>
        <br>
        <input type="password" placeholder="Enter Password" name="password" id="password" maxlength="16" required>
        <br>
        <button type="submit">
          Login
        </button>
        <a href="/register">
          <button type="button">
            Register
          </button>
        </a>
      </div>
    </form>
  </body>
</html>
