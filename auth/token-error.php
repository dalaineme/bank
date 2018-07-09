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
  // If session is not empty -> user is logged in, redirect to index
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
  include SCHOOL_ROOT .'includes/inc-plain-nav.php';
?>
<body>
  <div class="container">
    <div style="margin: 5%;">
      <div class="alert alert-danger">
        <strong>Sorry!</strong> No account found: 
        <p>Use your latest email password reset link or <a href='forgot-password'>reset password again.</a> </p>
      </div>
    </div>
  </div> <!-- /container -->
</body>
</html>