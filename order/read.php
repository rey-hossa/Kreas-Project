<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include database.php and book.php in order to use them
include_once '../config/database.php';
include_once '../models/order.php';

// Create a new Database object and connect to our database
$database = new Database();
$db = $database->getConnection();

// Create a new Order object
$order = new Order($db);

// query orders
$stmt = $order->read();
$num = $stmt->rowCount();

// if any orders are found in the database
if($num>0){
    // orders array
    $order_arr = array();
    $order_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $order_item = array(
            "id" => $id,
            "date" => $date,
            "destcountry" => $destcountry
        );
        array_push($order_arr["records"], $order_item);
    }
    http_response_code(200); 
    echo json_encode($order_arr);
}else{
    http_response_code(404); 
    echo json_encode(
        array("message" => "No Order Found.")
    );
}
?>

