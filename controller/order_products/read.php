<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include database.php and book.php in order to use them
include_once '../config/database.php';
include_once '../models/order_products.php';

// Create a new Database object and connect to our database
$database = new Database();
$db = $database->getConnection();

// Create a new Single Order object
$order_products = new OrderProducts($db);

// query order_productss
$stmt = $order_products->read();
$num = $stmt->rowCount();

// if any order_products are found in the database
if($num>0){
    // Single Order array
    $order_products_arr = array();
    $order_products_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $order_products_item = array(
            "id_order" => $id_order,
            "id_product" => $id_product,
            "quantity" => $quantity
        );
        array_push($order_products_arr["records"], $order_products_item);
    }
    http_response_code(200); 
    echo json_encode($order_products_arr);
}else{
    http_response_code(404); 
    echo json_encode(
        array("message" => "No Single Order Found.")
    );
}
?>

