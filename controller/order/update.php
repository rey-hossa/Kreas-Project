<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once 'core/database.php';
include_once 'models/order.php';
 
$database = new Database();
$db = $database->getConnection();
 
$order = new Order($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$order->Id = $data->id;
$order->Date = $data->date;
$order->DestCountry = $data->dest_country;
 
if($order->update()){
    http_response_code(200);
    echo json_encode(array("risposta" => "Order updated"));
}else{
    //503 service unavailable
    http_response_code(503);
    echo json_encode(array("risposta" => "Unable to update the order"));
}
?>