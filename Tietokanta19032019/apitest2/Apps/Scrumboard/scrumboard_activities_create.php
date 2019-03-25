<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/scrumboard_activities.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$scrumboard_activities = new Scrumboard_activities($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->id) &&
    !empty($data->card_id) &&
    !empty($data->cards_activities_time) &&
    !empty($data->cards_activities_id_member) &&
    !empty($data->cards_activities_type) &&    
    !empty($data->cards_activities_message) &&

){
 
    // set product property values
    $scrumboard_activities->id = $data->id;
    $scrumboard_activities->card_id = $data->card_id;
    $scrumboard_activities->cards_activities_time = $data->cards_activities_time;
    $scrumboard_activities->cards_activities_id_member = $data->cards_activities_id_member;
    $scrumboard_activities->cards_activities_type = $data->cards_activities_type;
    $scrumboard_activities->cards_activities_message = $data->cards_activities_message;
    
    // create the product
    if($scrumboard_activities->create()){
 
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
