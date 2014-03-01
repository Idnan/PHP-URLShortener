<?php 

/**
* Database class to handle the database connection and stuff
*/
class Database
{
	public $db = null;

	public function __construct()
	{
		$this->openConnection();
	}	

	public function openConnection()
	{
		$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
	}
}