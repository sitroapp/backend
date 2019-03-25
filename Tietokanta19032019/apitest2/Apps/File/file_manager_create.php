<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/file_manager.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$file_manager = new File_manager($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->files_created) &&
    !empty($data->files_extention) &&
    !empty($data->files_id) &&
    !empty($data->files_location) &&
    !empty($data->files_modified)
    !empty($data->files_name) &&
    !empty($data->files_opened) &&
    !empty($data->files_owner) &&
    !empty($data->files_preview) &&
    !empty($data->files_size)
	!empty($data->files_type) &&

){
 
    // set product property values
    $file_manager->files_created = $data->files_created;
    $file_manager->files_extention = $data->files_extention;
    $file_manager->files_id = $data->files_id;
    $file_manager->files_location = $data->files_location;
    $file_manager->files_modified = $data->files_modified;
    $file_manager->files_name = $data->files_name;
    $file_manager->files_opened = $data->files_opened;
    $file_manager->files_owner = $data->files_owner;
    $file_manager->files_preview = $data->files_preview;
    $file_manager->files_size = $data->files_size;
	$file_manager->files_type = $data->files_type;
    
    // create the product
    if($file_manager->create()){
 
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
