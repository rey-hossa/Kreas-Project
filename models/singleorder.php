<?php
class SingleOrder
	{
	private $conn;
	private $table_name = "singleorder";

	public $IdOrder;
	public $IdProduct;
	public $Quantity;

	public function __construct($db){
		$this->conn = $db;
	}

	// READ SINGLEORDER
	function read(){
		// select all
		$query = "SELECT
                        idorder, idproduct, quantity
                    FROM
                     $this->table_name" ;
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
	}

	// CREATE SINGLEORDER

	function create(){
 
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
                    idorder=:idorder, idproduct=:idproduct, quantity=:quantity; " ;
	 
		$stmt = $this->conn->prepare($query);
	 
	   
		$this->IdOrder = htmlspecialchars(strip_tags($this->IdOrder));
		$this->IdProduct = htmlspecialchars(strip_tags($this->IdProduct));
		$this->Quantity = htmlspecialchars(strip_tags($this->Quantity));
	 
		// binding
		$stmt->bindParam(":idorder", $this->IdOrder);
		$stmt->bindParam(":idproduct", $this->IdProduct);
		$stmt->bindParam(":quantity", $this->Quantity);
	 
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
                    idproduct = :idproduct,
                    quantity = :quantity
				WHERE
                    idorder = :idorder";
	 
		$stmt = $this->conn->prepare($query);
	 
		$this->IdOrder = htmlspecialchars(strip_tags($this->IdOrder));
		$this->IdProduct = htmlspecialchars(strip_tags($this->IdProduct));
		$this->Quantity = htmlspecialchars(strip_tags($this->Quantity));
	 
		// binding
		$stmt->bindParam(":idorder", $this->IdOrder);
		$stmt->bindParam(":idproduct", $this->IdProduct);
		$stmt->bindParam(":quantity", $this->Quantity);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}

	// DELETE ORDER

	function delete(){
 
		$query = "DELETE FROM " . $this->table_name . " WHERE idorder = ?";
	 
	 
		$stmt = $this->conn->prepare($query);
	 
		$this->IdOrder = htmlspecialchars(strip_tags($this->IdOrder));
	 
	 
		$stmt->bindParam(1, $this->IdOrder);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}
	 

	}
?>