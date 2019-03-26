<?php
class Chat_user{

    // database connection and table name
    private $conn;
    private $table_name = "chat_user";
    
    // object properties

    public $id;
    public $chat_user_id;
    public $chat_user_avatar;
    public $chat_user_mood;
    public $chat_user_name;
    public $chat_user_status;

    // constructor with $db as database connection

    public function __constructor($db){
        $this->conn = $db;
    }

    // read products

    function read(){

        // select all query
    $query = "SELECT 
            *
            FROM 
                  " . $this->table_name . "
                ORDER BY
                    chat_user_mood";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // exacute query
        $stmt->execute();

        return $stmt;
    }


    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
                SET
                chat_user_id=:user_id, chat_user_avatar=:avatar, chat_user_mood=:mood, chat_user_name=:name,chat_user_status=:status,  created=:created";
   
                $this->chat_user_id=htmlspecialchars(strip_tags($this->chat_user_id));
                $this->chat_user_avatar=htmlspecialchars(strip_tags($this->chat_user_avatar));
                $this->chat_user_mood=htmlspecialchars(strip_tags($this->chat_user_mood));
                $this->chat_user_name=htmlspecialchars(strip_tags($this->chat_user_name));
                $this->chat_user_status=htmlspecialchars(strip_tags($this->chat_user_status));
                

                $query = "INSERT INTO
                    " . $this->table_name . " 
                    SET
                    chat_user_id='".$this->user_id."', chat_user_avatar= '".$this->avatar."', chat_user_mood='".$this->mood."', chat_user_name='".$this->name."', chat_user_status='".$this->status."', created='".$this->created."'";

                if($this->conn->query($query))
                {
                    return true;
                }
                    return false;
            }

            // used when filling up the update product form
            function readOne(){
 
                // query to read single record
                $query = "SELECT
                            *
                        FROM
                            " . $this->table_name . " 
                        WHERE
                            chat_id = '".$this->id."'
                        LIMIT
                            0,1";

                $stmt = $this->conn->query($query);
                $row = $stmt->fetch();
                $this->id = $row['user_id'];
                $this->chat_user_avatar = $row['chat_user_avatar'];
                $this->chat_user_mood = $row['chat_user_mood'];
                $this->chat_user_name = $row['chat_user_name'];
                $this->chat_user_status = $row['chat_user_status'];
               
                
            }


            // update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                calendar_title = :title,
                calendar_desc = :description,
                calendar_start = :start,
                calendar_end = :end,
                calendar_user_id = :user
            WHERE
                id = :id";
 
    // prepare query statement
 #   $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->start=htmlspecialchars(strip_tags($this->start));
    $this->end=htmlspecialchars(strip_tags($this->end));
    $this->user=htmlspecialchars(strip_tags($this->user));
    $this->id=htmlspecialchars(strip_tags($this->id));

    $query = "UPDATE
                " . $this->table_name . "
            SET
    calendar_title='".$this->title."', calendar_desc= '".$this->description."',calendar_start='".$this->start."',calendar_end='".$this->end."',calendar_user_id='".$this->user."' WHERE calendar_id='".$this->id."'";
 
    // bind new values
    /*
    $stmt->bindParam(':calendar_title', $this->title);
    $stmt->bindParam(':calendar_desc', $this->description);
    $stmt->bindParam(':calendar_start', $this->start);
    $stmt->bindParam(':calendar_end', $this->end);
    $stmt->bindParam(':calendar_user_id', $this->user);
    $stmt->bindParam(':id', $this->id);
 */
    // execute the querycalendar_description
    /*
    if($stmt->execute()){
        return true;
    }
 */
if($this->conn->query($query))
{
    return true;
}
    return false;
}

// delete the product
function delete(){
 
    // delete query
   
    // prepare query
  #  $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
    $query = "DELETE FROM " . $this->table_name . " WHERE calendar_id = '".$this->id."'";
 echo $query;
    // bind id of record to delete
   # $stmt->bindParam(1, $this->id);
 
    // execute query
    #if($stmt->execute()){
    #    return true;
   # }
   if($this->conn->query($query))
{
    return true;
}
 
    return false;
     
}

// search products
function search($keywords){
 
    // select all query
    $kwArr = explode("&",$keywords);
    if($kwArr[2] > 0)
    $query = "SELECT
                *
            FROM
                " . $this->table_name . " 
            WHERE
               calendar_start >= '".$this->start."' AND calendar_end <= '".$this->end."' AND  calendar_user_id = '".$this->user."'
            ORDER BY
            calendar_start  ";

            else
            $query = "SELECT
            *
        FROM
            " . $this->table_name . " 
        WHERE
           calendar_start >= '".$this->start."' AND calendar_end <= '".$this->end."' 
        ORDER BY
        calendar_start  ";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

// read products with pagination
public function readPaging($from_record_num, $records_per_page){
 
    // select query
    $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            ORDER BY p.created DESC
            LIMIT ?, ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values from database
    return $stmt;
}

// used for paging products
public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    return $row['total_rows'];
}

}
?>