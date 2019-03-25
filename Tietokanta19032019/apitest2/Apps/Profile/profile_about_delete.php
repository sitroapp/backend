<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once 'config/database.php';
include_once 'objects/profile_about.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$profile_about = new Profile_about($db);
 
// get product id
//$data = json_decode(file_get_contents("php://input"));
$profile_about->id = isset($_GET['id']) ? $_GET['id'] : die();

// set product id to be deleted
#$profile_about->id = $data->id;
 
// delete the product

if($profile_about->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Product was deleted."));
}
 
// if unable to delete the product
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to delete product."));
}

?>

