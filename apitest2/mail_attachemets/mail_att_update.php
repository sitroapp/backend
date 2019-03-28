<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'config/database.php';
include_once './objects/mail_att.php';
 
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

$mail->mail_id = $data->mail_id;
$mail->mail_from_name = $data->mail_from_name;
$mail->mail_from_avatar = $data->mail_from_avatar;
$mail->mail_from_email = $data->mail_from_email;
$mail->mail_to_name = $data->mail_to_name;
$mail->mail_to_email = $data->mail_to_email;
$mail->mail_subject = $data->mail_subject;
$mail->mail_message = $data->mail_message;
$mail->mail_time = $data->mail_time;
$mail->mail_read = $data->mail_read;
$mail->mail_starred = $data->mail_starred;
$mail->mail_important = $data->mail_important;
$mail->mail_hasAttachments = $data->mail_hasAttachments;

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

