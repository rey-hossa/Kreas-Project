<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../models/order_products.php';
 
$database = new Database();
$db = $database->getConnection();
$order_products = new OrderProducts($db);
$data = json_decode(file_get_contents("php://input"));
if(
    !empty($data->id_order) &&
    !empty($data->id_product) &&
    !empty($data->quantity)
){
    $order_products->IdOrder = $data->id_order;
    $order_products->IdProduct = $data->id_product;
    $order_products->Quantity = $data->quantity;
 
    if($order_products->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Single Order created successfully."));
    }
    else{
        //503 servizio non disponibile
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create Single Order."));
    }
}
else{
    //400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create Single Order because the data is incomplete."));
}
?>