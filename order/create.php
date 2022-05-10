<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../models/order.php';
 
$database = new Database();
$db = $database->getConnection();
$order = new Order($db);
$data = json_decode(file_get_contents("php://input"));
if(
    !empty($data->id) &&
    !empty($data->date) &&
    !empty($data->destcountry)
){
    $order->Id = $data->id;
    $order->Date = $data->date;
    $order->DestCountry = $data->destcountry;
 
    if($order->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Order created successfully."));
    }
    else{
        //503 Service Unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create order."));
    }
}
else{
    //400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "The order cannot be created because the data is incomplete."));
}
?>