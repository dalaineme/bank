<?php
	// JSON content
	header('Content-type: application/json');
  
  // Include core config 
	include_once('../sys/core/init.inc.php');
  // Instanciate class common
  $common = new common();

  $yasavedemail = $_COOKIE['emailyako'];
  $yasavedepassword = $_COOKIE['ingiamsee'];
  /* Start ajax login process */
  if(filter_has_var(INPUT_POST, 'btn-login')){
    try {
      $user_email = strtolower(trim($_POST['logEmail']));
      $user_password = trim($_POST['logPassword']);
      $password = md5($user_password);

      $response = array();

      // Check if email and password are correct 
      $getALevel = $common -> GetRows("
        SELECT * FROM tbl_users WHERE email='".$user_email."' AND password='".$password."'
      ");
      if(!$getALevel){
        $response['status'] = 'error'; // Could not log in
        $response['message'] = 'Sorry, wrong email and or password.'; 
      }else if($getALevel){
        foreach($getALevel as $row){
          $isActive = $row['isActive'];
        }
        if ($isActive == '0'){
          $response['status'] = 'error'; // Could not log in
          $response['message'] = 'Sorry, please check you email for activation link.'; 
        }else if ($isActive == '1'){
          $response['status'] = 'success'; // Log in successful

          foreach($getALevel as $A){
            $_SESSION['UID'] = $A["userId"];
            $_SESSION['userFirstName'] = $A["firstName"];
            $_SESSION['userLastName'] = $A["lastName"];
            $_SESSION['userEmail'] = $A["email"];
            $_SESSION['userPhoneNumber'] = $A["phoneNumber"];
            $_SESSION['userLevel'] = $A["userLevel"];
            $_SESSION['userOnline'] = $A["online"];
          }
          // Change online status to 'Y' i.e. Yes 
          $onlineStatus = $common -> GetRows("
            UPDATE tbl_users SET online = 'Y' WHERE id='".$_SESSION['UID']."'
          ");
          // Set Login Cookies
          if($_POST['autologin'] == 1) {
            $year = time() + 31536000;
            setcookie('emailyako', $Uname_Email, $year);
            setcookie('ingiamsee', $_POST['password'], $year);
          }else{
            if(isset($_COOKIE['emailyako'])){
              $past = time() - 100;
              setcookie('emailyako', gone, $past);
              setcookie('ingiamsee', gone, $past);
            }
          }
        }
      } 
      echo json_encode($response);
      exit;
    }catch(Exception $e){
      echo $e;
    }
  }
?>