<?php
class Chat_user{

    // database connection and table name
    private $conn;
    private $table_name = "user";
    
    // object properties

    public $id;
    public $chat_user_id;
    public $chat_user_avatar;
    public $chat_user_mood;
    public $chat_user_name;
    public $chat_user_status;

    // constructor with $db as database connection

    public function __constructor($db){
        $this-> = $db;
    }

    // read products

    function read(){

        // select all query
    $query = "SELECT 
            *
            FROM 
                  " . $this->table_name . "
                ORDER BY
                    chat_user_start";

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
                chat_user_title=:title, chat_user_desc=:description, chat_user_start=:start, chat_user_end=:end, chat_user_id=:user,  created=:created";
   
                $this->id=htmlspecialchars(strip_tags($this->id));
                $this->chat_user_id=htmlspecialchars(strip_tags($this->chat_user_id));
                $this->chat_user_avatar=htmlspecialchars(strip_tags($this->chat_user_avatar));
                $this->chat_user_mood=htmlspecialchars(strip_tags($this->chat_user_mood);
                $this->chat_user_name=htmlspecialchars(strip_tags($this->chat_user_name));
                $this->chat_user_status=htmlspecialchars(strip_tags($this->chat_user_status));
                

                $query = "INSERT INTO
                    " . $this->table_name . " 
                    SET
                    chat_user_title='".$this->title."', chat_user_desc= '".$this->description."', chat_user_start='".$this->start."', chat_user_end='".$this->end."', chat_user_id='".$this->user."', created='".$this->created."'";

                if($this->conn->query($query))
                {
                    return true;
                }
                    return false;
            }


            function readOne(){
                $query = "SELECT
                         *
                        FROM
                        " . $this->table_name . "
                            WHERE
                            chat_user_id = '".this->id."'
                            LIMIT
                            0,1";

                $stmt = $this->conn->query($query);
                $row = $stmt->fetch();
                $this->id = $row['user_id'];
                $this->chat_user_id = $row['chat_user_id'];
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
                        chat_user_address='".$this->title."', chat_user_desc= '".$this->description."',chat_user_start='".$this->start."',chat_user_end='".$this->end."',chat_user_id='".$this->user."' WHERE chat_id='".$this->id."'";
                if($this->conn->query($query))
                {
                    return true;
                }
                    return false;
                }

                 // delete the product
                 function delete(){

                    // delete query

                    // sanitize
                    $this->id=htmlspecialchars(strip_tags($this->id));
                    $query = "DELETE FROM " . $this->table_name . " WHERE contact_id = '".$this->id."'";
                    echo $query;
                    
                }


}
?>