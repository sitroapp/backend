<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/file_manager.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$file_manager = new File_manager($db);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));

$postdata = $_POST['array']; 
$data = json_decode($postdata);  
// set ID property of product to be edited
$file_manager->id = $data->id;
 
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

// update the product
if($file_manager->update()){
 
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

