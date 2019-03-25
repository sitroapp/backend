<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/chat_user_chat_list.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$chat_user_chat_list = new Chat_user_chat_list($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->id) &&
	!empty($data->user_id) &&
	!empty($data->chat_id) &&
    !empty($data->contact_id) &&
	!empty($data->chat_user_chat_list_chat_id) &&
	!empty($data->chat_user_chat_list_contact_id) &&
    !empty($data->chat_user_chat_list_last_message_time) &&
	!empty($data->contacts_unread) &&		
	
){
 
    // set product property values
    $chat_user_chat_list->id = $data->id;	
    $chat_user_chat_list->user_id = $data->user_id;
    $chat_user_chat_list->chat_id = $data->chat_id;
    $chat_user_chat_list->contact_id = $data->contact_id;
    $chat_user_chat_list->chat_user_chat_list_chat_id = $data->chat_user_chat_list_chat_id;
    $chat_user_chat_list->contacts_name = $data->contacts_name;
    $chat_user_chat_list->chat_user_chat_list_contact_id = $data->chat_user_chat_list_contact_id;
    $chat_user_chat_list->chat_user_chat_list_last_message_time = $data->chat_user_chat_list_last_message_time;
	
    // create the product
    if($chat_user_chat_list->create()){
 
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
