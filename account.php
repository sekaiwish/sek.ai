<?php
include("{$_SERVER['DOCUMENT_ROOT']}/webassets/defaultHeader.php");
include("{$_SERVER['DOCUMENT_ROOT']}/webassets/defaultBody.php");
include("{$_SERVER['DOCUMENT_ROOT']}/webassets/defaultNavbar.php");
?>
<br>
<div class="row" style="justify-content:center;margin:0px;">
  <div class="card-group" style="width:40rem;">
    <div class="card">
      <div class="card-header">
        Change website preferences
      </div>
      <div class="card-block">
        <form method="POST" action="/access/preferences.php">
          <fieldset class="form-group">
            <legend>
              Hyperlink style
            </legend>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="linkstyle" value="0"<?php if($_SESSION["linkstyle"]==0){echo(" checked");}?>>
                4chan Style Hyperlinks
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="linkstyle" value="1"<?php if($_SESSION["linkstyle"]==1){echo(" checked");}?>>
                YouTube Style Hyperlinks
              </label>
            </div>
          </fieldset>
          <fieldset class="form-group">
            <legend>
              Homepage tile style
            </legend>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="tilestyle" value="0"<?php if($_SESSION["tilestyle"]==0){echo(" checked");}?>>
                Animated and colored tiles
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="tilestyle" value="1"<?php if($_SESSION["tilestyle"]==1){echo(" checked");}?>>
                Animated and grey tiles
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="tilestyle" value="2"<?php if($_SESSION["tilestyle"]==2){echo(" checked");}?>>
                Static tiles
              </label>
            </div>
          </fieldset>
          <fieldset class="form-group">
            <legend>
              世界chan threads per page
            </legend>
            <div class="form-check">
              <label class="form-check-label">
                <input type="number" class="form-check-input" name="postsshown" value="<?php echo("{$_SESSION["postsshown"]}");?>">
                posts
              </label>
            </div>
          </fieldset>
          <input type="submit" class="btn btn-success" value="Update preferences">
        </form>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-header">
        Change password
      </div>
      <div class="card-block">
        <form method="POST" action="/access/password.php">
          <fieldset class="form-group">
            <legend>
              Current password
            </legend>
            <div class="form-check">
              <input type="password" class="form-control" name="oldpassword" id="oldpassword" maxlength="16" required>
            </div>
          </fieldset>
          <fieldset class="form-group">
            <legend>
              New password
            </legend>
            <div class="form-check">
              <input type="password" class="form-control" name="newpassword" id="newpassword" maxlength="16" required>
            </div>
          </fieldset>
          <fieldset class="form-group">
            <legend>
              Confirm password
            </legend>
            <div class="form-check">
              <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" maxlength="16" required>
            </div>
          </fieldset>
          <input type="submit" class="btn btn-success" value="Update password">
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
