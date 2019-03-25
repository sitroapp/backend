<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/mail.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$mail = new Mail($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->id) &&
    !empty($data->mail_id) &&
    !empty($data->from_name) &&
    !empty($data->from_avatar) &&
    !empty($data->from_email) &&    
    !empty($data->to_name) &&
    !empty($data->to_email) &&
    !empty($data->subject) &&
    !empty($data->message) &&
    !empty($data->time)
	!empty($data->read) &&
    !empty($data->starred) &&
    !empty($data->important)
	!empty($data->hasAttachments) &&
	
){
 
    // set product property values
    $mail->id = $data->id;
    $mail->mail_id = $data->mail_id;
    $mail->from_name = $data->from_name;
    $mail->from_avatar = $data->from_avatar;
    $mail->from_email = $data->from_email;
    $mail->to_name = $data->to_name;
    $mail->to_email = $data->to_email;
    $mail->important = $data->important;
	$mail->subject = $data->subject;
    $mail->message = $data->message;
    $mail->time = $data->time;
	$mail->read = $data->read;
    $mail->starred = $data->starred;
    $mail->important = $data->important;
    $mail->hasAttachments = $data->hasAttachments;	
	
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
