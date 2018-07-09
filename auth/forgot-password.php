<?php
  error_reporting(0);
  //session_start();
  header('Cache-control: private'); // IE 6 FIX
  // always modified 
  header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
  // HTTP/1.1 
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', false);
  // HTTP/1.0 
  header('Pragma: no-cache');

  /* Start Original Scripts */
  include_once('../sys/core/init.inc.php');

  // Instanciate class common
  $common = new common();

  // check if user is logged in
  // If session is not empty -> user is logged in, redirect to dashboard
  if(!$_SESSION['UID'] == ''){
    header("Location: ../index"); /* Redirect browser */
    exit();
  }

  // Set up script root.
  // Used for fetching CSS and JS
  $scriptRoot = '../';
  define('SCRIPT_ROOT', $scriptRoot);
?>
<?php
  $page_title = "Reset Password | Account - Amba Business";
  include SCHOOL_ROOT .'includes/inc-header.php';
  include SCHOOL_ROOT .'includes/inc-header.php';
  include SCHOOL_ROOT .'includes/inc-nav.php';
?>
<section id="form" style="margin-top: 0;" ><!--form-->
		<div class="container" id="auth" >
			<div class="row">
				<div class="col-sm-5 col-sm-offset-3">
					<div class="login-form"><!--login form-->
						<h2>Reset your password | Activate your account</h2>
						<form action="#" method="post" id="forgot-password-form">
              <div id="fpassErrorDiv">
                <!-- error will be shown here ! -->
              </div>
              <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="fEmail" name="fEmail" required placeholder="Email..." />
                <span class="help-block" id="error"></span>
              </div>
              <div class="form-group">
                <span style="float:right;">
                  <a href="index">Login instead?</a>
                </span>
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-forgot-password" id="btn-forgot-password" >Reset Password | Activate Account</button>
              </div>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
<?php
  include SCHOOL_ROOT .'includes/inc-footer.php';
?>
  <script src="forgot-password.js"></script>

</body>
</html>