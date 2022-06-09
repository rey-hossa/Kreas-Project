<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'core/database.php';

// Create a new Database object and connect to our database
$database = new Database();
$db = $database->getConnection();


function queryExecute($conn){
		// select all
		$query = "SELECT
                        sum(round((products.co2 * order_products.quantity))) as co2tot
                    FROM
                    products join order_products on products.id = order_products.id_product" ;
		$stmt = $conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
}


$stmt = queryExecute($db);
$num = $stmt->rowCount();


if($num>0){
    
    $query_arr = array();
    $query_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $query_item = array(
            "co2tot" => $co2tot
        );
        array_push($query_arr["records"], $query_item);
    }
    http_response_code(200); 
    echo json_encode($query_arr);
}else{
    http_response_code(404); 
    echo json_encode(
        array("message" => "No items found.")
    );
}
?>
