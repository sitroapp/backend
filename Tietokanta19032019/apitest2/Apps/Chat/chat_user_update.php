<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/chat_user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$chat_user = new Chat_user($db);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));

$postdata = $_POST['array']; 
$data = json_decode($postdata);  
// set ID property of product to be edited
$chat_user->id = $data->id;
 
// set product property values

$chat_user->id = $data->id;
$chat_user->user_avatar = $data->user_avatar;
$chat_user->user_id = $data->user_id;
$chat_user->user_mood = $data->user_mood;
$chat_user->user_name = $data->user_name;
$chat_user->user_status = $data->user_status;

// update the product
if($chat_user->update()){
 
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

