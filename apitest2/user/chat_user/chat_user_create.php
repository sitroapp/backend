<?php
//Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//get database connection
include_once 'config/database.php'
// instantiate product object
include_once 'objects/chat_user.php'

$database = new Database();
$db = $database->getConnection();

$chart_user = new Chat_user($db);


//get posted data
//$data = json_decode(file_get_contents("//php://input"));
$postdata = $_POST['array'];
$data = json_decode($postdata);

//make sure data is not empty
if(
    !empty($data->id) &&
    !empty($data->$chart_user_id) &&
    !empty($data->$chart_user_avatar) &&
    !empty($data->$chart_user_mood) &&
    !empty($data->$chart_user_name) &&
    !empty($data->$chart_user_status) && 
    
){
    //set product property values
    $contact->id =  $data->id;
    $contact->chart_user_id =  $data->chart_user_id;
    $contact->chart_user_avatar =  $data->chart_user_avatar;
    $contact->chart_user_mood =  $data->chart_user_mood;
    $contact->chart_user_name =  $data->chart_user_name;
    $contact->$chart_user_status =  $data->$chart_user_status;
    

    //create the product
    if( $contact->create()){
    
        //set response code - 201 created
http_response_code(201);

        
        // tekk the user
echo json_encode(araay("message" => "Product was created."));

    }
        
}
    
//if unable to create the product, tell the use
    else{
     //set response code -503 service unavailable
        http_response_code(503);

    // tell the user data is incomplete
        echo json_encode(array("message" => "unable to create product"));
    }
   }

    //set response code - 400 bad request
   else{
       http_response_code(400)
   }
    //tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
?>