<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/profile_timeline.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$profile_timeline = new Profile_timeline($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->id) &&
    !empty($data->user_id) &&
    !empty($data->posts_share) &&
    !empty($data->posts_article_media_type) &&    
    !empty($data->posts_message) &&
    !empty($data->posts_media_preview) &&
    !empty($data->posts_id) &&
    !empty($data->posts_article_media_preview) &&
    !empty($data->activities_user_avatar) &&
    !empty($data->posts_comments_message) &&
    !empty($data->posts_media_type) &&    
    !empty($data->posts_comments_user_avatar) &&
    !empty($data->posts_comments_id) &&
    !empty($data->posts_time) &&
	!empty($data->posts_like) &&
    !empty($data->activities_user_name) &&
    !empty($data->posts_user_avatar) &&
    !empty($data->posts_article_title) &&    
    !empty($data->posts_article_subtitle) &&
    !empty($data->posts_comments_time) &&
    !empty($data->activities_message) &&
    !empty($data->posts_user_name) &&    
    !empty($data->activities_id) &&
    !empty($data->posts_type) &&
    !empty($data->posts_comments_user_name) &&
    !empty($data->posts_article_excerpt) &&

	
    // set product property values
    $profile_timeline->id = $data->id;
    $profile_timeline->user_id = $data->user_id;
    $profile_timeline->posts_share = $data->posts_share;
    $profile_timeline->posts_article_media_type = $data->posts_article_media_type;
    $profile_timeline->posts_message = $data->posts_message;
    $profile_timeline->posts_media_preview = $data->posts_media_preview;
    $profile_timeline->posts_id = $data->posts_id;
    $profile_timeline->posts_article_media_preview = $data->posts_article_media_preview;
    $profile_timeline->activities_user_avatar = $data->activities_user_avatar;
    $profile_timeline->posts_comments_message = $data->posts_comments_message;
    $profile_timeline->posts_media_type = $data->posts_media_type;
    $profile_timeline->posts_comments_user_avatar = $data->posts_comments_user_avatar;
    $profile_timeline->posts_comments_id = $data->posts_comments_id;
    $profile_timeline->posts_time = $data->posts_time;
    $profile_timeline->posts_like = $data->posts_like;
    $profile_timeline->activities_user_name = $data->activities_user_name;
    $profile_timeline->posts_user_avatar = $data->posts_user_avatar;
    $profile_timeline->posts_article_title = $data->posts_article_title;
    $profile_timeline->posts_article_subtitle = $data->posts_article_subtitle;
    $profile_timeline->posts_comments_time = $data->posts_comments_time;
    $profile_timeline->activities_message = $data->activities_message;
    $profile_timeline->posts_user_name = $data->posts_user_name;
    $profile_timeline->activities_id = $data->activities_id;
    $profile_timeline->posts_type = $data->posts_type;
    $profile_timeline->posts_comments_user_name = $data->posts_comments_user_name;
    $profile_timeline->posts_article_excerpt = $data->posts_article_excerpt;

    // create the product
    if($profile_timeline->create()){
 
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
