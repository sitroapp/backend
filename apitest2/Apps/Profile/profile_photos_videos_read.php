<?php

// include database and object files
include_once 'config/database.php';
include_once 'objects/profile_photos_videos.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$profile_photos_videos = new Profile_photos_videos($db);

// query products
$stmt = $profile_photos_videos->read();

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
            "videos_info" => $videos_info,
            "videos_media_title" => $videos_media_title
			"videos_name" => $videos_name,
            "videos_media_preview" => $videos_media_preview,
            "videos_media_type" => videos_media_type,
			
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