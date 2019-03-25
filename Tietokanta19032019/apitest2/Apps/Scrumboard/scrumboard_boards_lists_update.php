<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/scrumboard_boards_lists.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$scrumboard_boards_lists = new Scrumboard_boards_lists($db);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));

$postdata = $_POST['array']; 
$data = json_decode($postdata);  
// set ID property of product to be edited
$scrumboard_boards_lists->id = $data->id;
 
// set product property values

$scrumboard_boards_lists->id = $data->id;
$scrumboard_boards_lists->lists_id = $data->lists_id;
$scrumboard_boards_lists->lists_name = $data->lists_name;
$scrumboard_boards_lists->lists_id_cards = $data->lists_id_cards;

// update the product
if($scrumboard_boards_lists->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Product was updated."));
}
 
// if unable to update the product, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update product."));
}
?>

