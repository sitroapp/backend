<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/todo_filters.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$todo_filters = new Todo_filters($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
	!empty($data->todo_filters_handle) &&
    !empty($data->todo_filters_icon) &&
    !empty($data->todo_filters_id) &&
    !empty($data->todo_filters_title) &&

){
 
    // set product property values
    $todo_filters->todo_filters_handle = $data->todo_filters_handle;
    $todo_filters->todo_filters_icon = $data->todo_filters_icon;
    $todo_filters->todo_filters_id = $data->todo_filters_id;
    $todo_filters->todo_filters_title = $data->todo_filters_title;
    
    // create the product
    if($todo_filters->create()){
 
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
