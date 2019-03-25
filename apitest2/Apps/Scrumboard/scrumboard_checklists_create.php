<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/scrumboard_checklists.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$scrumboard_checklists = new Scrumboard_checklists($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->id) &&
    !empty($data->card_id) &&
    !empty($data->name) &&
    !empty($data->check_items_name) &&
    !empty($data->check_items_id) &&    

){
 
    // set product property values
    $scrumboard_checklists->id = $data->id;
    $scrumboard_checklists->card_id = $data->card_id;
    $scrumboard_checklists->name = $data->name;
    $scrumboard_checklists->check_items_name = $data->check_items_name;
    $scrumboard_checklists->check_items_id = $data->check_items_id;

    
    // create the product
    if($scrumboard_checklists->create()){
 
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
