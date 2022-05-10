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
if(
    !empty($data->id) &&
    !empty($data->name) &&
    !empty($data->co2)
){
    $product->Id = $data->id;
    $product->Name = $data->name;
    $product->Co2 = $data->co2;
 
    if($product->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Product created successfully."));
    }
    else{
        //503 servizio non disponibile
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create product."));
    }
}
else{
    //400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create the product because the data is incomplete."));
}
?>