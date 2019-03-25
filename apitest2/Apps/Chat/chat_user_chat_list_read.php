<?php

// include database and object files
include_once 'config/database.php';
include_once 'objects/chat_user_chat_list.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$chat_user_chat_list = new Chat_user_chat_list($db);

// query products
$stmt = $chat_user_chat_list->read();

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
            "chat_id" => $chat_id,
			"contact_id" => $contact_id,
            "chat_user_chat_list_chat_id" => $chat_user_chat_list_chat_id,
            "chat_user_chat_list_contact_id" => $chat_user_chat_list_contact_id,
            "chat_user_chat_list_last_message_time" => $chat_user_chat_list_last_message_time,
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
