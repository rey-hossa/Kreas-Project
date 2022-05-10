<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include database.php and book.php in order to use them
include_once '../config/database.php';
include_once '../models/product.php';

// Create a new Database object and connect to our database
$database = new Database();
$db = $database->getConnection();

// Create a new Product object
$product = new Product($db);

// query products
$stmt = $product->read();
$num = $stmt->rowCount();

// if any products are found in the database
if($num>0){
    // product array
    $product_arr = array();
    $product_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $product_item = array(
            "id" => $id,
            "name" => $name,
            "co2" => $co2
        );
        array_push($product_arr["records"], $product_item);
    }
    http_response_code(200); 
    echo json_encode($product_arr);
}else{
    http_response_code(404); 
    echo json_encode(
        array("message" => "No Product Found.")
    );
}
?>

