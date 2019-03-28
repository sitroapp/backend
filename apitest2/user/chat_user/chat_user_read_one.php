<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once 'config/database.php';
include_once 'objects/chat_user.php';

// prepare product object
$chat_user = new Chat_user($db);
 
// set ID property of record to read
$chat_user->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$chat_user->readOne();

if($chat_user->title!=null){
    // create array
    $product_arr = array(
        "id" =>  $chat_user->id,
        "title" => $chat_user->title,
        "description" => $chat_user->description,
        "start" => $chat_user->start,
        "end" => $chat_user->end,
        "user" => $chat_user->user,
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($product_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}

?>