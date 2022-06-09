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
 
$order_products->IdOrder = $data->id_order;
 
if($order_products->delete()){
    http_response_code(200);
    echo json_encode(array("risposta" => "The Single Order has been eliminated"));
}else{
    //503 service unavailable
    http_response_code(503);
    echo json_encode(array("risposta" => "Unable to delete the Single Order."));
}
?>