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
      $firstName = ucfirst(strtolower(trim($_POST['firstName'])));
      $lastName = ucfirst(strtolower(trim($_POST['lastName'])));
      $email = strtolower(trim($_POST['email']));
      $phoneNumber = trim($_POST['phoneNumber']);
      $password = trim($_POST['password']);
      $pass = md5($password);
      $code = md5(uniqid(rand()));

      // Create a response array
      $response = array();

      // Insert to DB
      $query = $common -> Insert ("
        INSERT INTO `tbl_users` (`firstName`, `lastName`, `email`, `phoneNumber`, `password`, `tokenCode`)
        VALUES ('".$firstName."', '".$lastName."', '".$email."', '".$phoneNumber."', '".$pass."', '".$code."')
      ");
       
      // If query could not execute
      if(!$query){
          $response['status'] = 'error'; // could not create user
          $response['message'] = 'Sorry, Could not create your account. Try again later.';
      // Query executed successfully 
      }else if($query){	
        $response['status'] = 'success';
        $response['message'] = 'New account successfuly created. Check your email inbox to activate it.';

        $id = $common->lasdID();		
        $key = base64_encode($id);
        $id = $key;
        
        $message = "					
          Hello $firstName $lastName,
          <br /><br />
          Welcome to Amba Business!
          <br />
          To complete your registration, please click the link below.
          <br />
          <a href='$siteURL/auth/verify?id=$id&code=$code'>Click here to activate your account</a>
          <br /><br />
          Thanks
        ";
              
        $subject = "Amba Business Registration Confirmation";
              
        $common->send_mail('mcdalinoluoch@gmail.com', $message, $subject);	
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