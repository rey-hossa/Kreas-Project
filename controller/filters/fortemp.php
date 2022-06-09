<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'core/database.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));
 
$start_date = $data->start_date;
$end_date = $data->end_date;


function queryExecute($conn, $start_date, $end_date){

		$query = "SELECT
                        sum(round((products.co2 * order_products.quantity))) as co2tot
                    FROM
                     products 
                        join order_products on products.id = order_products.id_product 
                        join orders on order_products.id_order = orders.Id
                     where orders.date between '{$start_date}' and '{$end_date}' " ;
        

        // $query = "SELECT
        //                 sum(round((products.co2 * order_products.quantity))) as co2tot
        //             FROM
        //              products 
        //                 join order_products on products.id = order_products.id_product 
        //                 join orders on order_products.id_order = orders.Id
        //              where orders.date between '2022-02-01' and '2022-02-28' ;"   
        // ;

		$stmt = $conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
}


$stmt = queryExecute($db, $start_date, $end_date);
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
