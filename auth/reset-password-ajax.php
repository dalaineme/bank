<?php
	// JSON content
	header('Content-type: application/json');

  // Include core config 
	include_once('../sys/core/init.inc.php');
  // Instanciate class common
  $common = new common();
	
	

  // If post from signup.js 
	if ($_POST) {
    try { 
      // get the inputs
      $pass = $_POST['rPassword'];
      $cpass = $_POST['cPassword'];
      $id = $_POST['userId'];
      $code = $_POST['code'];
      $tcode = '';
      $isActive = '1';

      // Set response to an array
	    $response = array();
        
      if($cpass!==$pass) {
        $response['status'] = 'error'; // Passwords don't match
        $response['message'] = 'Sorry, Passwords do not match.'; 
      } else {
        $password = md5($cpass);
        
        $stmt = $common->runQuery("
          UPDATE tbl_users SET password=:upass, tokenCode=:tcode, isActive=:isActive WHERE userId=:uid
        ");
        $stmt->bindParam(":upass",$password);
        $stmt->bindParam(":tcode",$tcode);
        $stmt->bindParam(":uid",$id);
        $stmt->bindParam(":isActive",$isActive);
        
        if($stmt->execute()){
          $response['status'] = 'success'; // Passwords don't match
          $response['message'] = 'Success, Password changed. Account is active. Redirecting...'; 
          // page redirects from js script

        }else if(!$stmt->execute()){
          $response['status'] = 'error'; // wrong token
          $response['message'] = 'Sorry, Could not update password. Please try again later.';        
        }
      }
      // Encode response as JSON
      echo json_encode($response);
      exit;
    }catch(Exception $e){
      echo $e;
    }
  }
  echo json_encode($response);
?>