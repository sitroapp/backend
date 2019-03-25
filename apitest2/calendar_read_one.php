<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/calendar.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$calendar = new Calendar($db);
 
// set ID property of record to read
$calendar->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$calendar->readOne();

if($calendar->title!=null){
    // create array
    $product_arr = array(
        "id" =>  $calendar->id,
        "title" => $calendar->title,
        "description" => $calendar->description,
        "start" => $calendar->start,
        "end" => $calendar->end,
        "user" => $calendar->user,
 
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

