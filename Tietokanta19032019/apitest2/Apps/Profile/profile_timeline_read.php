<?php

// include database and object files
include_once 'config/database.php';
include_once 'objects/profile_timeline.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$profile_timeline = new Profile_timeline($db);

// query products
$stmt = $profile_timeline->read();

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
            "posts_share" => $posts_share,
            "posts_article_media_type" => $posts_article_media_type,
			"posts_message" => $posts_message,
            "posts_media_preview" => $posts_media_preview,
            "posts_id" => posts_id,
            "posts_article_media_preview" => $posts_article_media_preview,
            "activities_user_avatar" => $activities_user_avatar,
            "posts_comments_message" => $posts_comments_message,
            "posts_media_type" => $posts_media_type,
            "posts_comments_user_avatar" => $posts_comments_user_avatar,
			"posts_comments_id" => $posts_comments_id,
            "activities_time" => $activities_time,
            "posts_time" => posts_time,
            "posts_like" => posts_like,
            "activities_user_name" => $activities_user_name,
            "posts_user_avatar" => $posts_user_avatar,
            "posts_article_title" => $posts_article_title,
            "posts_article_subtitle" => $posts_article_subtitle,
			"posts_comments_time" => $posts_comments_time,
            "activities_message" => $activities_message,
            "posts_user_name" => posts_user_name,
            "activities_id" => $activities_id,
            "posts_type" => posts_type,
            "posts_comments_user_name" => posts_comments_user_name,
            "posts_article_excerpt" => $posts_article_excerpt,
			
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
