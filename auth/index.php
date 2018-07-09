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
  $page_title = "Login | Signup - Amba Business";
  include SCHOOL_ROOT .'includes/inc-header.php';
  include SCHOOL_ROOT .'includes/inc-header.php';
  include SCHOOL_ROOT .'includes/inc-nav.php';
?>
<section id="form" style="margin-top: 0;" ><!--form-->
		<div class="container" id="auth" >
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="#" method="post" id="login-form">
              <div id="logErrorDiv">
                <!-- error will be shown here ! -->
              </div>
              <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="logEmail" name="logEmail" placeholder="Email..." />
                <span class="help-block" id="error"></span>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" id="logPassword" name="logPassword" placeholder="********" />
                <span class="help-block" id="error"></span>
              </div>
              <div class="form-group">
                <span style="float:right;">
                  <a href="forgot-password">Forgot password | Activate account?</a>
                </span>
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-login" id="btn-login" >Login</button>
              </div>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Create a new account</h2>
            <form action="#" method="post" id="the-signup-form">
              <div id="errorDiv">
                <!-- error will be shown here ! -->
              </div>
              <div class="form-group">
                <label>First Name</label>
                <input type="text" id="firstName" name="firstName" placeholder="First Name" required />
                <span class="help-block" id="error"></span>
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" id="lastName" name="lastName" placeholder="Last Name" required />
                <span class="help-block" id="error"></span>
              </div>
              <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="email" name="email" placeholder="Email Address" required/>
                <span class="help-block" id="error"></span>
              </div>
              <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="07__ ___ ___" required />
                <span class="help-block" id="error"></span>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required />
                <span class="help-block" id="error"></span>
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required />
                <span class="help-block" id="error"></span>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-signup" id="btn-signup"> 
                  Signup
                </button>
              </div>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
<?php
  include SCHOOL_ROOT .'includes/inc-footer.php';
?>
  <script src="signup.js"></script>
  <script src="login.js"></script>
</body>
</html>