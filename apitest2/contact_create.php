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
include_once 'objects/contact.php'

$database = new Database();
$db = $database->getConnection();

$contact = new Contact($db);


//get posted data
//$data = json_decode(file_get_contents("//php://input"));
$postdata = $_POST['array'];
$data = json_decode($postdata);

//make sure data is not empty
if(
    !empty($data->address) &&
    !empty($data->avatar) &&
    !empty($data->company) &&
    !empty($data->email) &&
    !empty($data->job_title) &&
    !empty($data->last_name) && 
    !empty($data->name) &&
    !empty($data->nickname) && 
    !empty($data->notes) &&
    !empty($data->phone &&
    !empty($data->id) &&
){
    //set product property values
    $contact->address =  $data->address;
    $contact->avatar =  $data->avatar;
    $contact->company =  $data->company;
    $contact->email =  $data->email;
    $contact->job_title =  $data->job_title;
    $contact->last_name =  $data->last_name;
    $contact->name =  $data->name;
    $contact->nickname = $data->nickname;
    $contact->notes =  $data->notes;
    $contact->phone =  $data->phone;
    $contact->id =  $data->id;

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