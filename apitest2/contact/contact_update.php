<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once 'config/database.php';
include_once 'objects/contact_update.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$calender = new Contact($db);

// get id of product to be edited
//$data = json_decode(file_get_contents("php://input"));

$postdata = $_POST['array'];
$data = json_decode($postdata);
// set ID property of product to be edited
$contact->id = $data-id;

// set product property values

//update the product

    //set response code - 200 ok

    //tell the user

// if unable to update the product, tell the user

    //set response code - 503 service
?>