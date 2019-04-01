<?php
class mail_folders{
 
    // database connection and table name
    private $conn;
    private $table_name = "calendar";
 
    // object properties
    public $folders_id;
    public $folders_handle;
    public $folders_title;
    public $folders_icon;
   

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
            folders_title";
    
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
            folders_id=:id, folders_handle=:handle, folders_title=:title, folders_icon=:icon";
 
          
    	// sanitize
    	$this->folders_id=htmlspecialchars(strip_tags($this->id));
    	$this->folders_handle=htmlspecialchars(strip_tags($this->handle));
        $this->folders_title=htmlspecialchars(strip_tags($this->title));
        $this->folders_icon=htmlspecialchars(strip_tags($this->icon));
      
          $query = "INSERT INTO
                " . $this->table_name . "
            SET
            folders_id='".$this->id."', folders_handle= '".$this->handle."',
            folders_title='".$this->title."', folders_icon='".$this->icon."'";
            
         
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
                folders_id = '".$this->id."'
            LIMIT
                0,1";
 
    
    $stmt = $this->conn->query($query);
    $row = $stmt->fetch();
    $this->title = $row['folders_title']; 
    $this->handle = $row['folders_handle'];
    $this->icon = $row['folders_icon'];
    $this->id = $row['folder_id'];
}

// update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
            folders_id = :id,
            folders_handle = :handle,
            folders_title = :title,
            folders_icon = :icon,
            WHERE
                id = :id";
 

 
    // sanitize
    $this->folders_id=htmlspecialchars(strip_tags($this->id));
    $this->folders_handle=htmlspecialchars(strip_tags($this->handle));
    $this->folders_title=htmlspecialchars(strip_tags($this->title));
    $this->folders_icon=htmlspecialchars(strip_tags($this->icon));

    $query = "UPDATE
                " . $this->table_name . "
            SET
            folders_id='".$this->id."', folders_handle= '".$this->handle."',
            folders_title='".$this->title."',folders_icon='".$this->icon."' WHERE folders_id='".$this->id."'";
 
    
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
    $query = "DELETE FROM " . $this->table_name . " WHERE folders_id = '".$this->id."'";
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
            folders_title >= '".$this->title."' AND folders_handle <= '".$this->handle."' AND  folders_id = '".$this->id."'
            ORDER BY
            folders_title  ";

            else
            $query = "SELECT
            *
        FROM
            " . $this->table_name . " 
        WHERE
        folders_title >= '".$this->title."' AND folders_handle <= '".$this->handle."' 
        ORDER BY
        folders_title  ";
 
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