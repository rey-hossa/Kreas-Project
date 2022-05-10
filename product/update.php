<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../models/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$product->Id = $data->id;
$product->Name = $data->name;
$product->Co2 = $data->co2;
 
if($product->update()){
    http_response_code(200);
    echo json_encode(array("risposta" => "Updated product"));
}else{
    //503 service unavailable
    http_response_code(503);
    echo json_encode(array("risposta" => "Unable to update the product"));
}
?>