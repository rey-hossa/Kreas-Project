<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include database.php and book.php in order to use them
include_once '../config/database.php';
include_once '../models/singleorder.php';

// Create a new Database object and connect to our database
$database = new Database();
$db = $database->getConnection();

// Create a new Single Order object
$singleorder = new SingleOrder($db);

// query singleorders
$stmt = $singleorder->read();
$num = $stmt->rowCount();

// if any singleorder are found in the database
if($num>0){
    // Single Order array
    $singleorder_arr = array();
    $singleorder_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $singleorder_item = array(
            "idorder" => $idorder,
            "idproduct" => $idproduct,
            "quantity" => $quantity
        );
        array_push($singleorder_arr["records"], $singleorder_item);
    }
    http_response_code(200); 
    echo json_encode($singleorder_arr);
}else{
    http_response_code(404); 
    echo json_encode(
        array("message" => "No Single Order Found.")
    );
}
?>

