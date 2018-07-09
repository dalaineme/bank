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

  // check url to get id and code
  if(empty($_GET['id']) && empty($_GET['code'])){
    $common->redirect('index');
  }

  if(isset($_GET['id']) && isset($_GET['code'])) {
    $id = base64_decode($_GET['id']);
    $code = $_GET['code'];
    
    $statusY = "1";
    $statusN = "0";
    
    $stmt = $common->runQuery("SELECT userId, isActive FROM tbl_users WHERE userId = :uID AND tokenCode = :code LIMIT 1");
    $stmt->execute(array(":uID"=>$id,":code"=>$code));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0)
    {
      if($row['isActive']==$statusN)
      {
        $stmt = $common->runQuery("UPDATE tbl_users SET isActive = :status WHERE userId = :uID");
        $stmt->bindparam(":status",$statusY);
        $stmt->bindparam(":uID",$id);
        $stmt->execute();	
        
        $msg = "
          <div class='alert alert-success'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>Success!</strong> Your Account is Now Activated: <a href='index'>Login here</a>
          </div>
        ";	
      }
      else
      {
        $msg = "
          <div class='alert alert-error'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>Sorry!</strong> Your account is already activated: <a href='index'>Login Here</a>
          </div>
        ";
      }
    }
    else
    {
      $msg = "
        <div class='alert alert-error'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Sorry!</strong> No account found: <a href='index'>Create Account Here</a>
        </div>
      ";
    }	
  }

  // Set up script root.
  // Used for fetching CSS and JS
  $scriptRoot = '../';
  define('SCRIPT_ROOT', $scriptRoot);
?>

<?php
  $page_title = "Verify - Bookstore";
  include SCHOOL_ROOT .'includes/inc-header.php';
  include SCHOOL_ROOT .'includes/inc-plain-nav.php';
?>
<body>
  <div class="container">
    <div style="margin: 5%;">
		  <?php if(isset($msg)) { echo $msg; } ?>
    </div>
  </div> <!-- /container -->
</body>
</html>