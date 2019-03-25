<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/scrumboard_boards_cards.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$scrumboard_boards_cards = new Scrumboard_boards_cards($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->id) &&
    !empty($data->list_id) &&
    !empty($data->due) &&
    !empty($data->name) &&
    !empty($data->description) &&    
    !empty($data->activities_id) &&
    !empty($data->attachments_type) &&
    !empty($data->id_members) &&
    !empty($data->id_labels) &&

){
 
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
    
    // create the product
    if($scrumboard_boards_cards->create()){
 
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
