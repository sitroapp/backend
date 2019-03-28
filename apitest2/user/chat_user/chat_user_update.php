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
$chat_user->chat_user_id = $data->chat_user_id;
$chat_user->chat_user_avatar = $data->chat_user_avatar;
$chat_user->chat_user_mood = $data->chat_user_mood;
$chat_user->chat_user_name = $data->chat_user_name;
$chat_user->chat_user_status = $data->chat_user_status;


?>