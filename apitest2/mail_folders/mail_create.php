<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/database.php';
 
// instantiate product object
include_once './objects/mail_folders.php';

$database = new Database();
$db = $database->getConnection();
 
$mail_folders = new Mail($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->folders_id) &&
    !empty($data->folders_handle) &&
    !empty($data->folders_title) &&
    !empty($data->folders_icon)
    
){
 
    // set product property values
    $mail_folders->folders_id = $data->mail_id;
    $mail_folders->folders_handle = $data->mail_from_name;
    $mail_folders->folders_title = $data->mail_from_avatar;
    $mail_folders->folders_icon = $data->mail_from_email;
  
    
    
    // create the product
    if($mail_folders->create()){
 
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
