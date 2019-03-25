<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/profile_photos_videos.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$profile_photos_videos = new Profile_photos_videos($db);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));

$postdata = $_POST['array']; 
$data = json_decode($postdata);  
// set ID property of product to be edited
$profile_photos_videos->id = $data->id;
 
// set product property values

$profile_photos_videos->id = $data->id;
$profile_photos_videos->user_id = $data->user_id;
$profile_photos_videos->info = $data->info;
$profile_photos_videos->media_title = $data->media_title;
$profile_photos_videos->name = $data->name;
$profile_photos_videos->media_preview = $data->media_preview;
$profile_photos_videos->media_type = $data->media_type;

// update the product
if($profile_photos_videos->update()){
 
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

