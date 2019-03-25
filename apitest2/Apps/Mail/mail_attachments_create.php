<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/mail_attachments.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$mail_attachments = new Mail_attachments($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->id) &&
    !empty($data->mail_id) &&
    !empty($data->type) &&
    !empty($data->fileName) &&
    !empty($data->preview) &&    
    !empty($data->url) &&
    !empty($data->size) &&
    !empty($data->mail_labels) &&
    !empty($data->mail_folder) &&
){
 
    // set product property values
    $mail_attachments->id = $data->id;
    $mail_attachments->mail_id = $data->mail_id;
    $mail_attachments->type = $data->type;
    $mail_attachments->fileName = $data->fileName;
    $mail_attachments->preview = $data->preview;
    $mail_attachments->url = $data->url;
    $mail_attachments->size = $data->size;
    $mail_attachments->mail_labels = $data->mail_labels;
	$mail_attachments->mail_folder = $data->mail_folder;

    
    // create the product
    if($mail_attachments->create()){
 
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
