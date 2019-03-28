<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/database.php';
 
// instantiate product object
include_once './objects/mail_attachements.php';

$database = new Database();
$db = $database->getConnection();
 
$calendar = new Mail($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->mail_id) &&
    !empty($data->mail_from_name) &&
    !empty($data->mail_from_avatar) &&
    !empty($data->mail_from_email) &&
    !empty($data->mail_to_name) &&
    !empty($data->mail_to_email) &&
    !empty($data->mail_subject) &&
    !empty($data->mail_message) &&
    !empty($data->mail_time) &&
    !empty($data->mail_read) &&
    !empty($data->mail_starred) &&
    !empty($data->mail_important) &&
    !empty($data->mail_hasAttachments) 
    
){
 
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
    
    
    // create the product
    if($mail->create()){
 
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
