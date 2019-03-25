<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/scrumboard_boards_cards.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$scrumboard_boards_cards = new Scrumboard_boards_cards($db);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));

$postdata = $_POST['array']; 
$data = json_decode($postdata);  
// set ID property of product to be edited
$scrumboard_boards_cards->id = $data->id;
 
// set product property values

$scrumboard_boards_cards->id = $data->id;
$scrumboard_boards_cards->list_id = $data->list_id;
$scrumboard_boards_cards->due = $data->due;
$scrumboard_boards_cards->name = $data->name;
$scrumboard_boards_cards->description = $data->description;
$scrumboard_boards_cards->activities_id = $data->activities_id;
$scrumboard_boards_cards->attachments_type = $data->attachments_type;
$scrumboard_boards_cards->id_members = $data->id_members;
$scrumboard_boards_cards->id_labels = $data->id_labels;

// update the product
if($scrumboard_boards_cards->update()){
 
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

