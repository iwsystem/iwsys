  <div class="modal hide fade in" id="loginForm" aria-hidden="false">
      <div class="modal-header">
          <i class="icon-remove" data-dismiss="modal" aria-hidden="true"></i>
          <h4>Login Form</h4>
      </div>
      <!--Modal Body-->
      <div class="modal-body">
          <form class="form-inline" action="portal/signon/chk-login.php" method="post" id="form-login" role="form">
              <input type="text" class="input-small" placeholder="Username" id="username" name="username" value="<?php echo $_COOKIE['remember_me']; ?>"  required>
              <input type="password" class="input-small" placeholder="Password" id="password" name="password" required>
              <input type="checkbox" id="remember" name="remember" value="1" checked>
              <label class="checkbox" > Remember me</label>
              <button type="submit" class="btn btn-success">Sign in</button>
          </form>
          <a href="forgot_password.php">Forgot your password?</a>
      </div>
      <!--/Modal Body-->
  </div>
  <!--  /Login form -->