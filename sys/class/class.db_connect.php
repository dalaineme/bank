<?php
/**
* Database actions (DB access, validation, etc.)
*
* PHP version 5
*
* LICENSE: This source file is subject to the MIT License, available
* at http://www.opensource.org/licenses/mit-license.html
*
* @author Neullo <neullo09@gmail.com>
* @copyright 2013 Neullo Design
* @license http://www.opensource.org/licenses/mit-license.html
*/
class DB_Connect {

	protected $db;
	/**
	* Checks for a DB object or creates one if one isn't found
	*
	* @param object $dbo A database object
	*/
	protected function __construct($dbo=NULL)
	{
		if ( is_object($dbo) )
			{
				$this->db = $dbo;
			}
		else
			{
				// Constants are defined in /sys/config/db-cred.inc.php and will be included
				$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
				try
					{
						//Connect to the Database
						$this->db = new PDO($dsn, DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true));
					}
				catch ( Exception $e )
					{
						// If the DB connection fails, output the error
						die ( $e->getMessage() );
					}
			}
	}
}
?>