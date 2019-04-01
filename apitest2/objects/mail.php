<?php
class Mail{

//create database connection and table connection
private $conn;
private $table_name = "mail";

// object properties in the database
public $id;
public $mail_id;
public $mail_from_name;
public $mail_from_avatar;
public $mail_from_email;
public $mail_to_name;
public $mail_to_email;
public $mail_subject;
public $mail_message;
public $mail_time;
public $mail_read;
public $mail_starred;
public $mail_important;
public $mail_hasAttachments;

// read products
function read(){
    
    // select all query
    $query = "SELECT
            *
        FROM
            " . $this->table_name . " 
            
        ORDER BY
            mail_time";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
}



function create(){
    
    // query to insert record
    $query = "INSERT INTO
            " . $this->table_name . "
        SET
    mail_id=:id, mail_from_name=:name, mail_from_avatar=:avatar, mail_from_email:email, mail_to_name=:name, mail_to_email=:email, 
        mail_suject=:suject, mail_message=:message, mail_time=:time, mail_read=:read, mail_starred=:starred, mail_important=:important, mail_hasAttachements=:hasAttachements,";
      
        $this->mail_id=htmlspecialchars(strip_tags($this->id));
    	$this->mail_from_name=htmlspecialchars(strip_tags($this->name));
        $this->mail_from_avatar=htmlspecialchars(strip_tags($this->vatar));
        $this->mail_from_email=htmlspecialchars(strip_tags($this->email));
        $this->mail_to_name=htmlspecialchars(strip_tags($this->name));
        $this->mail_to_email=htmlspecialchars(strip_tags($this->email));
        $this->mail_suject=htmlspecialchars(strip_tags($this->subject));
    	$this->mail_message=htmlspecialchars(strip_tags($this->message));
        $this->mail_time=htmlspecialchars(strip_tags($this->time));
        $this->mail_read=htmlspecialchars(strip_tags($this->read));
        $this->mail_starred=htmlspecialchars(strip_tags($this->starred));
        $this->mail_important=htmlspecialchars(strip_tags($this->important));
        $this->mail_hasAttachements=htmlspecialchars(strip_tags($this->hasAttachements));
        
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
            mail_id='".$this->id."', mail_from_name= '".$this->name."', calendar_start='".$this->start."',calendar_end='".$this->end."',calendar_user_id='".$this->user."', created='".$this->created."'";
            

        //create database read
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
            mail_time = '".$this->id."'
            LIMIT
                0,1";
 
    
    $stmt = $this->conn->query($query);
    $row = $stmt->fetch();
    $this->mail_id = $row['mail_id']; 
    $this->mail_from_name = $row['mail_from_name'];
    $this->mail_from_avatar = $row['mail_from_avatar'];
    $this->mail_from_email = $row['mail_from_email'];
    $this->mail_to_name = $row['mail_to_name'];
    $this->mail_to_email = $row['mail_to_email'];
    $this->mail_subject = $row['mail_subject']; 
    $this->mail_message = $row['mail_message'];
    $this->mail_time = $row['mail_time'];
    $this->mail_read = $row['mail_read'];
    $this->mail_starred = $row['mail_starred'];
    $this->mail_important = $row['mail_important'];
    $this->mail_hasAttachments = $row['mail_hasAttachments'];
}

// update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
            mail_id = :mail_id,
            mail_from_name = :mail_from_name,
            mail_from_avatar = :mail_from_avatar,
            mail_from_email = :mail_from_email,
            mail_to_name = :mail_to_name
            mail_to_email = :mail_to_email,
            mail_subject = :mail_subject,
            mail_message = :mail_message,
            mail_time = :mail_time,
            mail_read = :mail_read
            mail_starred = :mail_starred
            mail_important = :mail_important
            mail_hasAttachments = :mail_hasAttachments
            WHERE
                id = :id";
 
    // prepare query statement
 #   $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->mail_id=htmlspecialchars(strip_tags($this->mail_id));
    $this->mail_from_name=htmlspecialchars(strip_tags($this->mail_from_name));
    $this->mail_from_avatar=htmlspecialchars(strip_tags($this->mail_from_avatar));
    $this->mail_from_email=htmlspecialchars(strip_tags($this->mail_from_email));
    $this->mail_to_name=htmlspecialchars(strip_tags($this->mail_to_name));
    $this->mail_to_email=htmlspecialchars(strip_tags($this->mail_to_email));
    $this->mail_subject=htmlspecialchars(strip_tags($this->mail_subject));
    $this->mail_message=htmlspecialchars(strip_tags($this->mail_message));
    $this->mail_time=htmlspecialchars(strip_tags($this->mail_time));
    $this->mail_read=htmlspecialchars(strip_tags($this->mail_read));
    $this->mail_starred=htmlspecialchars(strip_tags($this->mail_starred));
    $this->mail_important=htmlspecialchars(strip_tags($this->mail_important));
    $this->mail_hasAttachments=htmlspecialchars(strip_tags($this->mail_hasAttachments));

    $query = "UPDATE
                " . $this->table_name . "
            SET
            mail_id='".$this->mail_id."', mail_from_name= '".$this->mail_from_name."',
            mail_from_avatar='".$this->mail_from_avatar."',mail_from_email='".$this->mail_from_email."',
            mail_to_name='".$this->mail_to_name."', mail_to_email='".$this->mail_to_email."',
            mail_subject= '".$this->mail_subject."', mail_message='".$this->mail_message."',
            mail_time='".$this->mail_time."', mail_read='".$this->mail_read."', 
            mail_read='".$this->mail_read."' WHERE id='".$this->id."'";
 
if($this->conn->query($query))
{
    return true;
}
    return false;
}

// delete the product
function delete(){
 
   
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
    $query = "DELETE FROM " . $this->table_name . " WHERE id = '".$this->id."'";
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
            mail_from_name >= '".$this->mail_message."' AND mail_to_name <= '".$this->mail_to_name."' AND  mail_id = '".$this->mail_id."'
            ORDER BY
            mail_read  ";

            else
            $query = "SELECT
            *
        FROM
            " . $this->table_name . " 
        WHERE
        mail_from_name >= '".$this->start."' AND mail_to_name <= '".$this->end."' 
        ORDER BY
        mail_read  ";
 
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