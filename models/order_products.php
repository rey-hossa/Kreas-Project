<?php

class OrderProducts{
	private $conn;
	private $table_name = "order_products";

	public $IdOrder;
	public $IdProduct;
	public $Quantity;

	public function __construct($db){
		$this->conn = $db;
	}

	// READ order_products
	function read(){
		// select all
		$query = "SELECT
                        id_order, id_product, quantity
                    FROM
                     $this->table_name" ;
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
	}

	// CREATE order_products

	function create(){
 
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
				id_order=:id_order, id_product=:id_product, quantity=:quantity; " ;
	 
		$stmt = $this->conn->prepare($query);
	 
	   
		$this->IdOrder = htmlspecialchars(strip_tags($this->IdOrder));
		$this->IdProduct = htmlspecialchars(strip_tags($this->IdProduct));
		$this->Quantity = htmlspecialchars(strip_tags($this->Quantity));
	 
		// binding
		$stmt->bindParam(":id_order", $this->IdOrder);
		$stmt->bindParam(":id_product", $this->IdProduct);
		$stmt->bindParam(":quantity", $this->Quantity);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}

	// UPDATE order_products

	function update(){
 
		$query = "UPDATE
					" . $this->table_name . "
				SET
					id_product = :id_product,
                    quantity = :quantity
				WHERE
					id_order = :id_order";
	 
		$stmt = $this->conn->prepare($query);
	 
		$this->IdOrder = htmlspecialchars(strip_tags($this->IdOrder));
		$this->IdProduct = htmlspecialchars(strip_tags($this->IdProduct));
		$this->Quantity = htmlspecialchars(strip_tags($this->Quantity));
	 
		// binding
		$stmt->bindParam(":id_order", $this->IdOrder);
		$stmt->bindParam(":id_product", $this->IdProduct);
		$stmt->bindParam(":quantity", $this->Quantity);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}

	// DELETE order_products

	function delete(){
 
		$query = "DELETE FROM " . $this->table_name . " WHERE id_order = ?";
	 
	 
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