<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../models/singleorder.php';
 
$database = new Database();
$db = $database->getConnection();
$singleorder = new SingleOrder($db);
$data = json_decode(file_get_contents("php://input"));
if(
    !empty($data->idorder) &&
    !empty($data->idproduct) &&
    !empty($data->quantity)
){
    $singleorder->IdOrder = $data->idorder;
    $singleorder->IdProduct = $data->idproduct;
    $singleorder->Quantity = $data->quantity;
 
    if($singleorder->create()){
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