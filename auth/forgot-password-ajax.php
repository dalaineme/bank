<?php
	// JSON content
	header('Content-type: application/json');

  // Include core config 
	include_once('../sys/core/init.inc.php');
  // Instanciate class common
  $common = new common();
	
	// Set response to an array
	$response = array();

  // If post from signup.js
	if ($_POST) {
    try { 
      // POST data
      $user_email = strtolower(trim($_POST['fEmail']));
      
      // Create a response array
      $response = array();

      // Select email
      $query = $common -> GetRows("
        SELECT * FROM tbl_users WHERE email='".$user_email."'
      ");
      if(!$query){
        $response['status'] = 'error'; // Could not log in
        $response['message'] = 'Sorry, Email does not exist.'; 
      // Query executed successfully 
      }else if($query){	
        $response['status'] = 'success';
        $response['message'] = 'Check your email inbox for password reset link.';

        foreach($query as $row){
          $userId = $row['userId'];
          $firstName = $row['firstName'];
          $lastName = $row['lastName'];
        }

        $id = base64_encode($userId);
        $code = md5(uniqid(rand()));
        

        $stmt = $common->runQuery("UPDATE tbl_users SET tokenCode = :token WHERE email=:email");
        $stmt->execute(array(":token"=>$code,"email"=>$user_email));
        
        $message= "
          Hello, $firstName $lastName,
          <br /><br />
          We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore                   this email,
          <br /><br />
          Click Following Link To Reset Your Password 
          <br /><br />
          <a href=$siteURL/auth/reset-password?id=$id&code=$code'>click here to reset your password</a>
          <br /><br />
          thank you :)
        ";
        $subject = "Password Reset | Amba Business";
      
        $common->send_mail($user_email, $message, $subject);	
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