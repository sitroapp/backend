<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/chat_dialog.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$chat_dialog = new Chat_dialog($db);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));

$postdata = $_POST['array']; 
$data = json_decode($postdata);  
// set ID property of product to be edited
$chat_dialog->id = $data->id;
 
// set product property values

$chat_dialog->id = $data->id;
$chat_dialog->dialog_message = $data->dialog_message;
$chat_dialog->dialog_time = $data->dialog_time;
$chat_dialog->dialog_who = $data->dialog_who;

// update the product
if($chat_dialog->update()){
 
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

