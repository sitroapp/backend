<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once 'config/database.php';
include_once 'objects/chat_user_chat_list.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$chat_user_chat_list = new Chat_user_chat_list($db);
 
// get product id
//$data = json_decode(file_get_contents("php://input"));
$chat_user_chat_list->id = isset($_GET['id']) ? $_GET['id'] : die();

// set product id to be deleted
#$chat_user_chat_list->id = $data->id;
 
// delete the product

if($chat_user_chat_list->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Product was deleted."));
}
 
// if unable to delete the product
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to delete product."));
}

?>

