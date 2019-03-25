<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/profile_about.php';
 
// instantiate product object
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
 
$profile_about = new Profile_about($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
$postdata = $_POST['array']; 
$data = json_decode($postdata);  

// make sure data is not empty
if(
    !empty($data->id) &&
    !empty($data->user_id) &&
    !empty($data->contact_address) &&
    !empty($data->groups_category) &&
    !empty($data->work_jobs_date) &&    
    !empty($data->general_locations) &&
    !empty($data->groups_members) &&
    !empty($data->friends_avatar) &&
    !empty($data->friends_id) &&
    !empty($data->general_about) &&
    !empty($data->work_jobs_company) &&
    !empty($data->contact_websites) &&
    !empty($data->friends_name) &&
    !empty($data->groups_id) &&
    !empty($data->general_gender) &&
    !empty($data->work_occupation) &&
    !empty($data->contact_emails) &&    
    !empty($data->general_birthday) &&
    !empty($data->contact_tel) &&
    !empty($data->work_skills) &&

){
 
    // set product property values
    $profile_about->id = $data->id;
    $profile_about->user_id = $data->user_id;
    $profile_about->contact_address = $data->contact_address;
    $profile_about->groups_category = $data->groups_category;
    $profile_about->work_jobs_date = $data->work_jobs_date;
    $profile_about->general_locations = $data->general_locations;
    $profile_about->groups_members = $data->groups_members;
    $profile_about->friends_avatar = $data->friends_avatar;
	$profile_about->friends_id = $data->friends_id;
    $profile_about->general_about = $data->general_about;
    $profile_about->work_jobs_company = $data->work_jobs_company;
	$profile_about->contact_websites = $data->contact_websites;
    $profile_about->friends_name = $data->friends_name;
    $profile_about->groups_id = $data->groups_id;
    $profile_about->general_gender = $data->general_gender;
    $profile_about->work_occupation = $data->work_occupation;
    $profile_about->contact_emails = $data->contact_emails;
    $profile_about->general_birthday = $data->general_birthday;
    $profile_about->contact_tel = $data->contact_tel;
    $profile_about->groups_members = $data->groups_members;
    $profile_about->work_skills = $data->work_skills;

    // create the product
    if($profile_about->create()){
 
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
