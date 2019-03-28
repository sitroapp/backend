<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once 'config/database.php';
include_once './objects/mail.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$mail = new Mail($db);
 
// set ID property of record to read
$mail->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$mail->readOne();

if($mail->title!=null){
    // create array
    $product_arr = array(
        "mail_id" =>  $mail->id,
        "mail_from_name" => $mail->name,
        "mail_from_avatar" => $mail->avatar,
        "mail_from_email" => $mail->email,
        "mail_to_name" => $mail->name,
        "mail_to_email" => $mail->email,
        "mail_subject" =>  $mail->subject,
        "mail_message" => $mail->message,
        "mail_time" => $mail->time,
        "mail_read" => $mail->read,
        "mail_starred" => $mail->starred,
        "mail_important" => $mail->important,
        "mail_hasAttachments" => $mail->hasattachments
 
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

