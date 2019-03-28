<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once 'config/database.php';
include_once 'objects/contact.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$contact = new Contact($db);

// set ID property of record to read
$contact->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$contact->readOne();

if($contact->title!=null){
    // create array
    $product_arr = array(
        "id" =>  $contact->id,
        "phone" => $contact->phone,
        "description" => $contact->notes,
        "start" =>$contact->nickname,
        "end" => $contact->name,
        "user" => $contact->last_name,
        "job_title" => $contact->job_title,
        "email" => $contact->email,
        "company" => $contact->company,
        "avatar" => $contact->avatar,
        "address" => $contact->address
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($product_arr);
}

    else{
        // set response - 404 Not Found
        http_response_code(404);

        // tell the user product does not exist
        echo json_encode(array("message" => "Product does not exist."));
    }

?>