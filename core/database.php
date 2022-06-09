<?php

class Database{

	// credentials
	// private $host = "localhost";
	// private $db_name = "kreas";
	// private $username = "root";
	// private $password = "";
	public $conn;
	// database connection
	public function getConnection(){

		$host = getenv('DB_HOST');
		$db_name = getenv('DB_NAME');
		$username = getenv('DB_USERNAME');
		$password = getenv('DB_PASSWORD');

		$this->conn = null;
		
		try{
			$this->conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
			$this->conn->exec("set names utf8");
		}
		catch(PDOException $exception){
			echo "Errore di connessione: " . $exception->getMessage();
		}
		return $this->conn;
	}
}
?>