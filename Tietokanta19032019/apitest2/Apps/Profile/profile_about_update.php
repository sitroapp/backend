<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/profile_about.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$profile_about = new Profile_about($db);
 
// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));

$postdata = $_POST['array']; 
$data = json_decode($postdata);  
// set ID property of product to be edited
$profile_about->id = $data->id;
 
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
$profile_about->groups_name = $data->groups_name;
$profile_about->general_birthday = $data->general_birthday;
$profile_about->contact_tel = $data->contact_tel;
$profile_about->work_skills = $data->work_skills;

// update the product
if($profile_about->update()){
 
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

