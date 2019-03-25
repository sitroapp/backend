<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/mail.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$mail = new Mail($db);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));

$postdata = $_POST['array']; 
$data = json_decode($postdata);  
// set ID property of product to be edited
$mail->id = $data->id;
 
// set product property values

$mail->id = $data->id;
$mail->mail_id = $data->mail_id;
$mail->from_name = $data->from_name;
$mail->from_avatar = $data->from_avatar;
$mail->from_email = $data->from_email;
$mail->to_name = $data->to_name;
$mail->to_email = $data->to_email;
$mail->subject = $data->subject;
$mail->message = $data->message;
$mail->time = $data->time;
$mail->read = $data->read;
$mail->starred = $data->starred;
$mail->important = $data->important;
$mail->hasAttachments = $data->hasAttachments;

// update the product
if($mail->update()){
 
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

