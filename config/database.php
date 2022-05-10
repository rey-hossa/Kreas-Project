<?php
class Database
	{
	// credentials
	private $host = "localhost";
	private $db_name = "kreas";
	private $username = "root";
	private $password = "";
	public $conn;
	// database connection
	public function getConnection()
		{
		$this->conn = null;
		try
			{
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->exec("set names utf8");
			}
		catch(PDOException $exception)
			{
			echo "Errore di connessione: " . $exception->getMessage();
			}
		return $this->conn;
		}
	}
?>