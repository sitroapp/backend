<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/chat_user_chat_list.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$chat_user_chat_list = new Chat_user_chat_list($db);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));

$postdata = $_POST['array']; 
$data = json_decode($postdata);  
// set ID property of product to be edited
$chat_user_chat_list->id = $data->id;
 
// set product property values

$chat_user_chat_list->id = $data->id;
$chat_user_chat_list->user_id = $data->user_id;
$chat_user_chat_list->chat_id = $data->chat_id;
$chat_user_chat_list->contact_id = $data->contact_id;
$chat_user_chat_list->chat_user_chat_list_chat_id = $data->chat_user_chat_list_chat_id;
$chat_user_chat_list->chat_user_chat_list_contact_id = $data->chat_user_chat_list_contact_id;
$chat_user_chat_list->chat_user_chat_list_last_message_time = $data->chat_user_chat_list_last_message_time;


// update the product
if(chat_user_chat_list->update()){
 
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

