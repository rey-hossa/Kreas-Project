<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();


function queryExecute($conn){
		// select all
		$query = "SELECT
                        orders.DestCountry, sum(round((products.co2 * singleorder.quantity))) as co2tot
                    FROM
                        products 
                        join singleorder on products.id = singleorder.idProduct
                        join orders on singleorder.idOrder = orders.Id
                    group by orders.DestCountry" 
                        
        ;
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
            "destcountry" => $destcountry,
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