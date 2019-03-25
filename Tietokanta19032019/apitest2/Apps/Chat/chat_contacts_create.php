<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/chat_contacts.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$chat_dialog = new Chat_contacts($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->id) &&
	!empty($data->contacts_avatar) &&
    !empty($data->contacts_id) &&
	!empty($data->contacts_mood) &&
	!empty($data->contacts_name) &&
    !empty($data->contacts_status) &&
	!empty($data->contacts_unread) &&		
	
){
 
    // set product property values
    $chat_dialog->id = $data->id;
    $chat_dialog->contacts_avatar = $data->contacts_avatar;
    $chat_dialog->contacts_id = $data->contacts_id;
    $chat_dialog->contacts_mood = $data->contacts_mood;
    $chat_dialog->contacts_name = $data->contacts_name;
    $chat_dialog->contacts_status = $data->contacts_status;
    $chat_dialog->contacts_unread = $data->contacts_unread;
	
    // create the product
    if($chat_dialog->create()){
 
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
