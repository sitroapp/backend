<?php
class Mail_attachments{

//create database connection and table connection
private $conn;
private $table_name = "mail_attachements";

// object properties in the database
public $id;
public $mail_id;
public $mail_attachments_type;
public $mail_attachments_fileName;
public $mail_attachments_preview;
public $mail_attachments_url;
public $mail_attachments_size;
public $mail_labels;
public $mail_folder;

 // constructor with $db as database connection
 public function __construct($db){
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
    mail_id=:id, mail_attachments_type=:type, mail_attachments_fileName=:fileName, mail_attachments_preview:preview,
    mail_attachments_url=:url, mail_attachments_size=:size, mail_labels=:labels, mail_folder=:folder, ";
      
        $this->mail_id=htmlspecialchars(strip_tags($this->id));
    	$this->mail_attachments_type=htmlspecialchars(strip_tags($this->type));
        $this->mail_attachments_fileName=htmlspecialchars(strip_tags($this->fileName));
        $this->mail_attachments_preview=htmlspecialchars(strip_tags($this->preview));
        $this->mail_attachments_url=htmlspecialchars(strip_tags($this->url));
        $this->mail_attachments_size=htmlspecialchars(strip_tags($this->size));
        $this->mail_labels=htmlspecialchars(strip_tags($this->labels));
    	$this->mail_folder=htmlspecialchars(strip_tags($this->folder));
        
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
            mail_id='".$this->id."', mail_attachments_type= '".$this->type."', mail_attachments_fileName='".$this->fileName."', mail_attachments_preview='".$this->preview."', mail_attachments_url='".$this->url."', 
            mail_attachments_url='".$this->url."', mail_attachments_size='".$this->size."',
            mail_labels='".$this->labels."', mail_folder='".$this->folder."'";
            

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
                calendar_id = '".$this->id."'
            LIMIT
                0,1";
 
    $stmt = $this->conn->query($query);
    $row = $stmt->fetch();
    $this->mail_id = $row['id']; 
    $this->mail_attachments_type = $row['type'];
    $this->mail_attachments_fileName = $row['fileName'];
    $this->mail_attachments_preview = $row['preview'];
    $this->mail_attachments_url = $row['url'];
    $this->mail_attachments_size = $row['size'];
    $this->mail_labels = $row['labels'];
    $this->mail_folder = $row['folder'];
}

// update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
            mail_id = :id,
            mail_attachments_type = :type,
            mail_attachments_fileName = :fileName,
            mail_attachments_preview = :preview,
            mail_attachments_url = :url,
            mail_attachments_size = :size,
            mail_labels = :labels,
            mail_folder = :folder,
            WHERE
                id = :id";
 
    // sanitize
    $this->mail_id=htmlspecialchars(strip_tags($this->id));
    $this->mail_attachments_type=htmlspecialchars(strip_tags($this->type));
    $this->mail_attachments_fileName=htmlspecialchars(strip_tags($this->fileName));
    $this->mail_attachments_preview=htmlspecialchars(strip_tags($this->preview));
    $this->mail_attachments_url=htmlspecialchars(strip_tags($this->url));
    $this->mail_attachments_size=htmlspecialchars(strip_tags($this->size));
    $this->mail_labels=htmlspecialchars(strip_tags($this->labels));
    $this->mail_folder=htmlspecialchars(strip_tags($this->folder));

    $query = "UPDATE
                " . $this->table_name . "
            SET
            mail_id='".$this->id."', mail_attachments_type= '".$this->type."',mail_attachments_fileName='".$this->fileName."',
            mail_attachments_preview='".$this->preview."',mail_attachments_url='".$this->url."',
            mail_attachments_size='".$this->size."',mail_labels='".$this->labels."',mail_folder='".$this->folder."'
              WHERE id='".$this->id."'";
    
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
    $query = "DELETE FROM " . $this->table_name . " WHERE mail_id = '".$this->id."'";
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
            mail_attachments_fileName >= '".$this->name."' AND mail_attachments_type <= '".$this->type."' AND  mail_id = '".$this->id."'
            ORDER BY
            mail_attachments_fileName  ";

            else
            $query = "SELECT
            *
        FROM
            " . $this->table_name . " 
        WHERE
        mail_attachments_fileName >= '".$this->name."' AND mail_attachments_type <= '".$this->type."' 
        ORDER BY
        mail_attachments_fileName  ";
 
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