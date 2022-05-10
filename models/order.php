<?php
class Order
	{
	private $conn;
	private $table_name = "orders";

	public $Id;
	public $Date;
	public $DestCountry;

	public function __construct($db){
		$this->conn = $db;
	}

	// READ ORDER
	function read(){
		// select all
		$query = "SELECT
                        id, date, destcountry
                    FROM
                     $this->table_name" ;
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
	}

	// CREATE ORDER

	function create(){
 
   
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					id=:id, date=:date, destcountry=:destcountry; " ;
	 
	   
		$stmt = $this->conn->prepare($query);
	 
	   
		$this->Id = htmlspecialchars(strip_tags($this->Id));
		$this->Date = htmlspecialchars(strip_tags($this->Date));
		$this->DestCountry = htmlspecialchars(strip_tags($this->DestCountry));
	 
		// binding
		$stmt->bindParam(":id", $this->Id);
		$stmt->bindParam(":date", $this->Date);
		$stmt->bindParam(":destcountry", $this->DestCountry);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}

	// UPDATE ORDER

	function update(){
 
		$query = "UPDATE
					" . $this->table_name . "
				SET
					date = :date,
					destcountry = :destcountry
				WHERE
					id = :id";
	 
		$stmt = $this->conn->prepare($query);
	 
		$this->Id = htmlspecialchars(strip_tags($this->Id));
		$this->Date = htmlspecialchars(strip_tags($this->Date));
		$this->DestCountry = htmlspecialchars(strip_tags($this->DestCountry));
	 
		// binding
		$stmt->bindParam(":id", $this->Id);
		$stmt->bindParam(":date", $this->Date);
		$stmt->bindParam(":destcountry", $this->DestCountry);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}

	// DELETE ORDER

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