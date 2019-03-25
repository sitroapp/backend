<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/chat_user.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$chat_user = new Chat_user($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->id) &&
	!empty($data->user_avatar) &&
    !empty($data->user_id) &&
	!empty($data->user_mood) &&
	!empty($data->user_name) &&
    !empty($data->user_status) &&
	
){
 
    // set product property values
    $chat_user->id = $data->id;
    $chat_user->user_avatar = $data->user_avatar;
    $chat_user->user_id = $data->user_id;
    $chat_user->user_mood = $data->user_mood;
    $chat_user->user_name = $data->user_name;
    $chat_user->user_status = $data->user_status;
	
    // create the product
    if($chat_user->create()){
 
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
