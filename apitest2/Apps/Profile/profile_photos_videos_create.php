<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/profile_photos_videos.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$profile_photos_videos = new Profile_photos_videos($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->id) &&
    !empty($data->user_id) &&
    !empty($data->info) &&
    !empty($data->media_title) &&    
    !empty($data->name) &&
    !empty($data->media_preview) &&
    !empty($data->media_type) &&
 
    // set product property values
    $profile_about->id = $data->id;
    $profile_about->user_id = $data->user_id;
    $profile_about->info = $data->info;
    $profile_about->media_title = $data->media_title;
    $profile_about->media_preview = $data->media_preview;
    $profile_about->name = $data->name;
    $profile_about->media_type = $data->media_type;

    // create the product
    if($profile_photos_videos->create()){
 
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
