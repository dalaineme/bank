<?php
	error_reporting(1);

	session_start();

	/* Getting root directory of the site */
	$siteDirectory = 'http://bank';
	define('SCHOOL_ROOT', $_SERVER["DOCUMENT_ROOT"]."/");

	/*
	* Include the necessary configuration info
	*/
	include SCHOOL_ROOT .'sys/config/db-cred.inc.php';
	include SCHOOL_ROOT .'sys/mailer/class.phpmailer.php';

	/*
	* Define constants for configuration info
	*/
	foreach ($C as $name => $val) {
		define($name, $val);
	}

	/*
	* Define the auto-load function for classes 
	*/
	function __autoload($class) {
		$class = strtolower($class);
		$filename = SCHOOL_ROOT ."sys/class/class." . $class . ".php";

		if(file_exists($filename)) {
			include_once $filename;
		}
	}

	// Jeremy Scripts Start 
	$sql=new common();
	//Initialize All Common Files
	$SysConfig = $sql->GetRows("SELECT * FROM tbl_sys_config");
	foreach($SysConfig AS $SysConf) {
		$SystemURI = $SysConf['main_url'];
		$SystemName = $SysConf['system_name'];
		$SystemRegisteredTo = $SysConf['system_registered_to'];
		$SystemIP = $SysConf['sys_default_ip'];	
		$SystemEnabled = $SysConf['sys_status_enabled'];	
		$SystemEmailSupport = $SysConf['support_email'];	
		$SuportPhone = $SysConf['support_phone'];
		$SuportWebsite = $SysConf['support_website'];
		$DeploymentDate = $SysConf['deployment_date'];	
		$sys_version = $SysConf['sys_version'];
		$isssl = $SysConf['isssl'];

		//Co-operative Details
		$coop_phone = $SysConf['coop_phone'];
		$coop_website = $SysConf['coop_website'];
		$coop_address = $SysConf['coop_address'];
		$coop_countyid = $SysConf['coop_countyid'];
		$coop_email = $SysConf['coop_email'];
		$coop_logo = $SysConf['coop_logo'];
		$coop_status = $SysConf['coop_status']; 

		if(empty($coop_logo)){
			$coop_logo = "logo.png";
		}
	}

	define("SITE_ROOT", "/$siteDirectory/");

	define("ASSETS_URL", "../assets/");
	/*Date Diff*/
	function format_interval(DateInterval $interval) {
		$result = "";
		if ($interval->y) { $result .= $interval->format("%y years "); }
		if ($interval->m) { $result .= $interval->format("%m months "); }
		if ($interval->d) { $result .= $interval->format("%d days "); }
		if ($interval->h) { $result .= $interval->format("%h hrs "); }
		if ($interval->i) { $result .= $interval->format("%i mins "); }
		if ($interval->s) { $result .= $interval->format("%s secs "); }
		return $result;
	}
	function get_image_type ( $filename ) {
		$img = getimagesize( $filename );
		if(!empty($img[2])){
			return image_type_to_mime_type( $img[2] );
		}
		return false;
	}


	//End Initialize All Common Files
	function array_filter_by_value($my_array, $index, $value) { 
	    if(is_array($my_array) && count($my_array)>0) { 
	        foreach(array_keys($my_array) as $key){ 
	            $temp[$key] = $my_array[$key][$index]; 
	                 
	       	    if ($temp[$key] == $value){ 
	                $new_array[$key] = $my_array[$key]; 
	            } 
	        } 
	    } 
	    return $new_array; 
	}
?>