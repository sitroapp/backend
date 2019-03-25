<?php
class Todo{
 
    // database connection and table name
    private $conn;
    private $table_name = "todo";
 
    // object properties
    public $id;
    public $notes;
    public $title;
    public $startdate;
    public $duedate;
    public $completed;
    public $starred;
    public $important;
    public $deleted;
    public $labels;
    public $user;
	
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
                todo_start";
    
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
           todo_id=:id,todo_notes=:notes,todo_title=:title,todo_startdate=:startdate,todo_duedate=:duedate,todo_completed=:completed,todo_starred=:starred,todo_important=:important,todo_deleted=:deleted,todo_labels=:labels,todo_user=:user;
 
            # file_put_contents("log.txt",$query);
 /*
 $sql = $db->prepare("INSERT INTO " . $this->table_name . " (`todo_title`, `calendar_desc=:description`, `calendar_start`,`calendar_end`,`calendar_user_id`) VALUES (:calendar_title, :calendar_desc, :calendar_start,:calendar_end,:calendar_user_id,:created)");
 $sql->bindParam(':calendar_title', $this->title, PDO::PARAM_STR);
 $sql->bindParam(':calendar_desc', $this-description>, PDO::PARAM_STR));
 $sql->bindParam(':calendar_start',$this->start , PDO::PARAM_INT);
 $sql->bindParam(':calendar_end',$this->end , PDO::PARAM_INT);
 $sql->bindParam(':calendar_user_id',$this->user , PDO::PARAM_INT);
 $sql->bindParam(':created',$this->created , PDO::PARAM_INT);
            */
    	// prepare query
    #	$stmt = $this->conn->prepare($query);
    
    	// sanitize
    	$this->title=htmlspecialchars(strip_tags($this->title));
    	$this->calendar_desc=htmlspecialchars(strip_tags($this->description));
        $this->start=htmlspecialchars(strip_tags($this->start));
        $this->end=htmlspecialchars(strip_tags($this->end));
        $this->user=htmlspecialchars(strip_tags($this->user));
        $this->created=htmlspecialchars(strip_tags($this->created));
        
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
            calendar_title='".$this->title."', calendar_desc= '".$this->description."',calendar_start='".$this->start."',calendar_end='".$this->end."',calendar_user_id='".$this->user."', created='".$this->created."'";
            
           # $stmt = $this->conn->query($query);

        // bind values
        /*
    	$stmt->bindParam(":calendar_title", $this->title);
    	$stmt->bindParam(":calendar_desc", $this->description);
        $stmt->bindParam(":calendar_start", $this->start);
        $stmt->bindParam(":calendar_end", $this->end);
        $stmt->bindParam(":calendar_user_id", $this->user);
        $stmt->bindParam(":created", $this->created);
        */
       # $sql = $this->conn->prepare("INSERT INTO sitrotest (calendar_title,calendar_desc, calendar_start,calendar_end,calendar_user_id,created) VALUES (? ,? ,?, ?, ?, ?)");
/*
        if($sql->execute(array($this->title, $this->description, $this->start,$this->end,$this->user,$this->created))){
            return true;
        }
        */
  
        // execute query
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
 
    // prepare query statement
   #$stmt= $this->conn->query( $query );
  
  #  $stmt = $this->conn->query($query);
    // bind id of product to be updated
   # $stmt->bindParam(1, $this->id);
 
    // execute query
  # $stmt->execute();
 
    // get retrieved row
  
  #  $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
/*
    foreach ($conn->query($query) as $row) {
        
    $this->title = $row['calendar_title']; 
    $this->description = $row['calendar_desc'];
    $this->start = $row['calendar_start'];
    $this->end = $row['calendar_end'];
    $this->user = $row['calendar_user_id'];
    $this->id = $row['calendar_id'];
    
    }
    */
    $stmt = $this->conn->query($query);
    $row = $stmt->fetch();
    $this->title = $row['calendar_title']; 
    $this->description = $row['calendar_desc'];
    $this->start = $row['calendar_start'];
    $this->end = $row['calendar_end'];
    $this->user = $row['calendar_user_id'];
    $this->id = $row['calendar_id'];
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