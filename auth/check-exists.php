<?php
	// Get core config
	include_once('../sys/core/init.inc.php');
	// Instantiate common
	$common = new common();

	// if email is requested
	if ( isset($_REQUEST['email']) && !empty($_REQUEST['email']) ) {
		$email = trim($_REQUEST['email']);
      $results = $common -> GetRows("SELECT email FROM tbl_users WHERE email='".$email."'");
		if ($results) {
			echo 'false'; // email already taken
		} else {
			echo 'true';
		}
	}

	if ( isset($_REQUEST['phoneNumber']) && !empty($_REQUEST['phoneNumber']) ) {

		$phoneNumber = trim($_REQUEST['phoneNumber']);

        $phone = $common -> GetRows("SELECT phoneNumber FROM tbl_users WHERE phoneNumber='".$phoneNumber."'");

		if ($phone) {
			echo 'false'; // already taken
		} else {
			echo 'true';
		}
	}
?>