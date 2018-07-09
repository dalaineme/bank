<?php
/**
* Common tasks
* @author Go Sheng Services
* @copyright 
*/
	class Common extends DB_Connect {
		public function __construct($dbo=NULL) {
			parent::__construct($dbo);
		}
		public function CCStrip($value) {
			if(get_magic_quotes_gpc() != 0) {
				if(is_array($value)) {  
				  	foreach($value as $key=>$val)
						$value[$key] = stripslashes($val);
				}else{
				  	$value = stripslashes($value);
				}
			}
			return $value;
		}
		public function GetParam($parameter_name, $default_value = "") {
			$parameter_value = "";

			if(isset($_POST[$parameter_name])) { 
				$parameter_value = stripslashes($_POST[$parameter_name]);

			}else if(isset($_GET[$parameter_name])) { 
				$parameter_value = stripslashes($_GET[$parameter_name]);

			}else { 
				$parameter_value = $default_value;
			}
			return $parameter_value;
		}
		public function CCGetDBValue($sql) {
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			if($stmt) { 
				if($stmt->rowCount() > 0 ) { 
						   $result = $stmt->fetchColumn(); 
				}else {
					$result="";
				}
			}
			return $result;  
		}
		public function JsonGetRows($sql) {
			try	{
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return json_encode($results);
			}catch(Exception $e) {
				die($e->getMessage());
			}
		}
		public function JsonInsert($sql) {
			try {
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$stmt->closeCursor();
				return json_encode($this->db->lastInsertId());
			}catch ( Exception $e )	{
				return $e->getMessage();
			}
		}	
		public function GetRows($sql) {
			try {
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $results;
			}catch(Exception $e) {
				die ( $e->getMessage() );
			}
		}
		public function Insert($sql) {
			try {
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$stmt->closeCursor();
				return $this->db->lastInsertId();
			}catch(Exception $e) {
				return $e->getMessage();
			}
		}
		public function Delete($sql) {
			try	{
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$stmt->closeCursor();
				return $stmt;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		public function runQuery($sql)
		{
			$stmt = $this->db->prepare($sql);
			return $stmt;
		}
		public function lasdID()
		{
			$stmt = $this->db->lastInsertId();
			return $stmt;
		}

		public function redirect($url)
		{
			header("Location: $url");
		}
		
		function send_mail($email,$message,$subject)
		{								
			require_once(SCHOOL_ROOT .'sys/mailer/class.phpmailer.php');
			$mail = new PHPMailer();
			$mail->IsSMTP(); 
			$mail->SMTPDebug  = 0;                     
			$mail->SMTPAuth   = true;                  
			$mail->SMTPSecure = "ssl";                 
			$mail->Host       = "smtp.gmail.com";      
			$mail->Port       = 465;             
			$mail->AddAddress($email);
			$mail->Username="mcdalinoluoch@gmail.com";  
			$mail->Password="dalomallo401h8*";            
			$mail->SetFrom('mcdalinoluoch@gmail.com','Amba Business');
			$mail->AddReplyTo("mcdalinoluoch@gmail.com","Amba Business");
			$mail->Subject    = $subject;
			$mail->MsgHTML($message);
			$mail->Send();
		}
		//removing quotes
		function mysql_escape_mimic($inp) { 
		    if(is_array($inp)) {  
		        return array_map(__METHOD__, $inp); 
		    }
		    if(!empty($inp) && is_string($inp)) { 
		        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
		    } 
			return $inp; 
		} 
		
	}
?>