<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/todo_labels.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$todo_labels = new Todo_labels($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->todo_folders_handle) &&
    !empty($data->todo_folders_icon) &&
    !empty($data->todo_folders_id) &&
    !empty($data->todo_folders_title) &&


){
 
    // set product property values
    $todo_labels_color->todo_labels_color = $data->todo_labels_color;
    $todo_labels_handle->todo_labels_handle = $data->todo_labels_handle;
    $todo_labels_id->todo_labels_id = $data->todo_labels_id;
    $todo_labels_title->todo_labels_title = $data->todo_labels_title;

    
    // create the product
    if($todo_labels->create()){
 
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
