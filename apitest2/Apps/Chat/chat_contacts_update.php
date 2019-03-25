<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/chat_contacts.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$chat_contacts = new Chat_contacts($db);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));

$postdata = $_POST['array']; 
$data = json_decode($postdata);  
// set ID property of product to be edited
$chat_contacts->id = $data->id;
 
// set product property values

$chat_contacts->id = $data->id;
$chat_contacts->contacts_avatar = $data->contacts_avatar;
$chat_contacts->contacts_id = $data->contacts_id;
$chat_contacts->contacts_mood = $data->contacts_mood;
$chat_contacts->contacts_name = $data->contacts_name;
$chat_contacts->contacts_status = $data->contacts_status;
$chat_contacts->contacts_unread = $data->contacts_unread;


// update the product
if($chat_contacts->update()){
 
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

