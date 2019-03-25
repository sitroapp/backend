<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/notes_checklist.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$todo = new Todo($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->checklist_id) &&
    !empty($data->id) &&
    !empty($data->checklist_text) &&

){
 
    // set product property values
    $notes_checklist->checklist_id = $data->checklist_id;
    $notes_checklist->id = $data->id;
    $notes_checklist->checklist_text = $data->checklist_text;
   
    
    // create the product
    if($notes_checklist->create()){
 
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
