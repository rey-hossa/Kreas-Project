<?php
class Product
	{
	private $conn;
	private $table_name = "products";
	// proprietà di un libro
	public $Id;
	public $Name;
	public $Co2;

	public function __construct($db){
		$this->conn = $db;
	}

	// READ PRODUCT
	function read(){
		// select all
		$query = "SELECT
                        id, name, co2
                    FROM
                     $this->table_name" ;
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
	}

	// CREATE PRODUCT

	function create(){
 
   
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					id=:id, name=:name, co2=:co2; " ;
	 
	   
		$stmt = $this->conn->prepare($query);
	 
	   
		$this->Id = htmlspecialchars(strip_tags($this->Id));
		$this->Name = htmlspecialchars(strip_tags($this->Name));
		$this->Co2 = htmlspecialchars(strip_tags($this->Co2));
	 
		// binding
		$stmt->bindParam(":id", $this->Id);
		$stmt->bindParam(":name", $this->Name);
		$stmt->bindParam(":co2", $this->Co2);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}

	// UPDATE PRODUCT

	function update(){
 
		$query = "UPDATE
					" . $this->table_name . "
				SET
					name = :name,
					co2 = :co2
				WHERE
					id = :id";
	 
		$stmt = $this->conn->prepare($query);
	 
		$this->Id = htmlspecialchars(strip_tags($this->Id));
		$this->Name = htmlspecialchars(strip_tags($this->Name));
		$this->Co2 = htmlspecialchars(strip_tags($this->Co2));
	 
		// binding
		$stmt->bindParam(":id", $this->Id);
		$stmt->bindParam(":name", $this->Name);
		$stmt->bindParam(":co2", $this->Co2);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}

	// DELETE PRODUCT

	function delete(){
 
		$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
	 
	 
		$stmt = $this->conn->prepare($query);
	 
		$this->Id = htmlspecialchars(strip_tags($this->Id));
	 
	 
		$stmt->bindParam(1, $this->Id);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}
	 

	}
?>