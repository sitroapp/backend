<?php
class User{

    // database connection and table name
    private $conn;
    private $table_name = "chat_user";
    
    // object properties

    public $user_id;
    public $password;
    public $uuid;
    public $user_shortcuts;
    public $user_display_name;
    public $user_email;
    public $user_photo_url;
    public $role;

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
                user_display_name";

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
              user_id=:id, user_password=:password, user_uuid=:uuid, user_shortcuts=:user_shortcuts, 
              user_display_name=:user_display_name, role=:role, user_photo_url=:user_photo_url, user_email=:user_email, ";
   
                $this->user_id=htmlspecialchars(strip_tags($this->user_id));
                $this->password=htmlspecialchars(strip_tags($this->password));
                $this->uuid=htmlspecialchars(strip_tags($this->uuid));
                $this->user_shortcuts=htmlspecialchars(strip_tags($this->user_shortcuts));
                $this->user_display_name=htmlspecialchars(strip_tags($this->user_display_name));
                $this->user_email=htmlspecialchars(strip_tags($this->user_email));
                $this->user_photo_url=htmlspecialchars(strip_tags($this->user_photo_url));
                $this->role=htmlspecialchars(strip_tags($this->role));
                

                $query = "INSERT INTO
                    " . $this->table_name . " 
                    SET
                    user_id='".$this->id."', user_password='".$this->password."', user_uuid='".$this->uuid."', 
                    user_shortcuts='".$this->user_shortcuts."', user_display_name='".$this->user_display_name."', 
                    role='".$this->role."',  user_photo_url='".$this->user_photo_url."',
                     user_email='".$this->user_email."'";

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
                $this->user_id = $row['user_id'];
                $this->password = $row['user_password'];
                $this->uuid = $row['user_uuid'];
                $this->user_shortcuts= $row['user_shortcuts'];
                $this->user_display_name = $row['user_display_name'];
                $this->user_email= $row['user_email'];
                $this->user_photo_url = $row['user_photo_url'];
                $this->role = $row['role'];
               
            }


            // update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            //ask anne about these sections
            SET
            user_id = :user_id,
            user_password = :password,
            user_email = :user_email,
            role = :role,
            user_uuid = :user_uuid
            WHERE
                id = :id";
 
    
    // sanitize
    $this->user_id=htmlspecialchars(strip_tags($this->user_id));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->uuid=htmlspecialchars(strip_tags($this->uuid));
    $this->role=htmlspecialchars(strip_tags($this->role));
    $this->user_photo_url=htmlspecialchars(strip_tags($this->user_photo_url));
    $this->user_email=htmlspecialchars(strip_tags($this->user_email));
    $this->user_shortcuts=htmlspecialchars(strip_tags($this->user_shortcuts));
    $this->user_display_name=htmlspecialchars(strip_tags($this->user_display_name));

    $query = "UPDATE
                " . $this->table_name . "
            SET
            user_id='".$this->id."', user_password='".$this->password."', user_uuid='".$this->uuid."', 
            user_shortcuts='".$this->user_shortcuts."', user_display_name='".$this->user_display_name."', 
            role='".$this->role."',  user_photo_url='".$this->user_photo_url."', user_email='".$this->user_email."'";
 
    
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
    $query = "DELETE FROM " . $this->table_name . " WHERE user_id = '".$this->id."'";
 echo $query;
    
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
            user_email >= '".$this->user_email."' AND user_display_name <= '".$this->user_display_name."' AND  user_id = '".$this->user_id."'
            ORDER BY
            user_email  ";

            else
            $query = "SELECT
            *
        FROM
            " . $this->table_name . " 
        WHERE
        user_email >= '".$this->user_email."' AND v <= '".$this->user_display_name."' 
        ORDER BY
        user_email  ";
 
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