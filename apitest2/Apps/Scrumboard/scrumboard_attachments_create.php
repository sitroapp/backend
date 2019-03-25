<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/scrumboard_attachments.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$scrumboard_attachments = new Scrumboard_attachments($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->id) &&
    !empty($data->card_id) &&
    !empty($data->cards_attachments_id) &&
    !empty($data->cards_id_attachment_cover) &&
    !empty($data->cards_attachments_src) &&    
    !empty($data->cards_attachments_name) &&
    !empty($data->cards_attachments_url) &&
    !empty($data->cards_attachments_time) &&

){
 
    // set product property values
    $scrumboard_attachments->id = $data->id;
    $scrumboard_attachments->card_id = $data->card_id;
    $scrumboard_attachments->cards_attachments_id = $data->cards_attachments_id;
    $scrumboard_attachments->cards_id_attachment_cover = $data->cards_id_attachment_cover;
    $scrumboard_attachments->cards_attachments_src = $data->cards_attachments_src;
    $scrumboard_attachments->cards_attachments_name = $data->cards_attachments_name;
    $scrumboard_attachments->cards_attachments_url = $data->cards_attachments_url;
    $scrumboard_attachments->cards_attachments_time = $data->cards_attachments_time;
    
    // create the product
    if($scrumboard_attachments->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Product was created."));

}

// if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>
