<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/mail_attachments.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$mail_attachments = new Mail_attachments($db);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));

$postdata = $_POST['array']; 
$data = json_decode($postdata);  
// set ID property of product to be edited
$mail_attachments->id = $data->id;
 
// set product property values

$mail_attachments->id = $data->id;
$mail_attachments->type = $data->type;
$mail_attachments->fileName = $data->fileName;
$mail_attachments->preview = $data->preview;
$mail_attachments->url = $data->url;
$mail_attachments->size = $data->size;
$mail_attachments->mail_labels = $data->mail_labels;
$mail_attachments->mail_folder = $data->mail_folder;

// update the product
if($mail_attachments->update()){
 
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

