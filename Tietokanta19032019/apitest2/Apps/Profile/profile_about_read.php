<?php

// include database and object files
include_once 'config/database.php';
include_once 'objects/profile_about.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$profile_about = new Profile_about($db);

// query products
$stmt = $profile_about->read();

$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $products_arr=array();
    $products_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $product_item=array(
            "id" => $id,
            "user_id" => $user_id,
            "contact_address" => $contact_address,
            "groups_category" => $groups_category,
            "work_jobs_date" => $work_jobs_date
			"general_locations" => $general_locations,
            "groups_members" => $groups_members,
            "friends_avatar" => $friends_avatar,
            "friends_id" => $friends_id,
            "general_about" => $general_about,
			"work_jobs_company" => $work_jobs_company,
            "contact_websites" => $contact_websites,
            "friends_name" => $friends_name,
			"groups_id" => $groups_id,			
            "general_gender" => $general_gender,
            "work_occupation" => $work_occupation,
			"contact_emails" => $contact_emails,
            "groups_name" => $groups_name,
            "general_birthday" => $general_birthday,
			"contact_tel" => $contact_tel,				
			"work_skills" => $work_skills,	
			
        );
 
        array_push($products_arr["records"], $product_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($products_arr);
}
 
// no products found will be here

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}

?>
