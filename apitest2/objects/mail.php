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
            mail_id";

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

//update product

//delete product

//search product

//read product with pagination

//used for paging products
 
//count function
}
?>