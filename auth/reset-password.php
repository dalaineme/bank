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

  if(empty($_GET['id']) && empty($_GET['code'])){
    $common->redirect('token-error');
  }

  if(isset($_GET['id']) && isset($_GET['code'])) {
    $id = base64_decode($_GET['id']);
    $code = $_GET['code'];
    
    $stmt = $common->runQuery("SELECT * FROM tbl_users WHERE userId=:uid AND tokenCode=:token");
    $stmt->execute(array(":uid"=>$id,":token"=>$code));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($stmt->rowCount() != 1) {
      $common->redirect('token-error');
    }
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
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form"><!--login form-->
						<h2>Reset your password | Activate your Account</h2>
						<form action="#" method="post" id="forgot-password-form">
              <div id="fpassErrorDiv">
                <!-- error will be shown here ! -->
              </div>
              <!-- Hidden inputs -->
              <input type="hidden" name="userId" id="userId" value="<?php echo $id; ?>" />
              <input type="hidden" name="code" id="code" value="<?php echo $code; ?>" />
              <!-- Hidden inputs -->

              
              <div class="form-group">
                <label>Password</label>
                <input type="password" id="rPassword" name="rPassword" required placeholder="******" />
                <span class="help-block" id="error"></span>
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" id="cPassword" name="cPassword" required placeholder="******" />
                <span class="help-block" id="error"></span>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-forgot-password" id="btn-forgot-password" >Reset Password</button>
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
  <script src="reset-password.js"></script>

</body>
</html>