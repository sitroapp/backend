<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/scrumboard_attachments.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$scrumboard_attachments = new Scrumboard_attachments($db);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));

$postdata = $_POST['array']; 
$data = json_decode($postdata);  
// set ID property of product to be edited
$scrumboard_attachments->id = $data->id;
 
// set product property values

$scrumboard_attachments->id = $data->id;
$scrumboard_attachments->card_id = $data->card_id;
$scrumboard_attachments->cards_attachments_id = $data->cards_attachments_id;
$scrumboard_attachments->cards_id_attachment_cover = $data->cards_id_attachment_cover;
$scrumboard_attachments->cards_attachments_ = $data->cards_attachments_;
$scrumboard_attachments->cards_attachments_name = $data->cards_attachments_name;
$scrumboard_attachments->cards_attachments_url = $data->cards_attachments_url;
$scrumboard_attachments->cards_attachments_time = $data->cards_attachments_time;

// update the product
if(scrumboard_attachments->update()){
 
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

