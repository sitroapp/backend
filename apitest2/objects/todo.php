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
 $sql = $db->prepare("INSERT INTO " . $this->table_name . " (`todo_id`, `todo_notes=:notes`,`todo_title`,`todo_startdate`,`todo_duedate`,´todo_completed` tinyint`,`todo_starred` tinyint`,`todo_important` tinyint`,`todo_deleted` tinyint`,`todo_labels`,`todo_user`,) VALUES (:todo_id, :todo_notes, :todo_title, :todo_startdate, :todo_duedate, :todo_completed` tinyint, :todo_starred tinyint, :todo_important tinyint, :todo_deleted tinyint, :todo_labels, :todo_user)");
 $sql->bindParam(':todo_id', $this->todo, PDO::PARAM_STR);
 $sql->bindParam(':todo_notes', $this->notes>, PDO::PARAM_STR));
 $sql->bindParam(':todo_title',$this->title , PDO::PARAM_INT);
 $sql->bindParam(':todo_startdate',$this->startdate , PDO::PARAM_INT);
 $sql->bindParam(':todo_duedate',$this->duedate , PDO::PARAM_INT);
 $sql->bindParam(':todo_completed tinyint',$this->completed , PDO::PARAM_INT);
 $sql->bindParam(':todo_starred tinyint', $this->starred , PDO::PARAM_STR);
 $sql->bindParam(':todo_important tinyint', $this->important , PDO::PARAM_STR));
 $sql->bindParam(':todo_deleted tinyint',$this->deleted , PDO::PARAM_INT);
 $sql->bindParam(':todo_labels',$this->labels , PDO::PARAM_INT);
 $sql->bindParam(':todo_user',$this->user , PDO::PARAM_INT);
 $sql->bindParam(':created',$this->created , PDO::PARAM_INT);
            */
    	// prepare query
    #	$stmt = $this->conn->prepare($query);
    
    	// sanitize
    	$this->todo=htmlspecialchars(strip_tags($this->todo));
    	$this->notes=htmlspecialchars(strip_tags($this->notes));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->startdate=htmlspecialchars(strip_tags($this->startdate));
        $this->duedate=htmlspecialchars(strip_tags($this->duedate));
        $this->completed=htmlspecialchars(strip_tags($this->completed));
    	$this->starred=htmlspecialchars(strip_tags($this->starred));
        $this->important=htmlspecialchars(strip_tags($this->important));
        $this->deleted=htmlspecialchars(strip_tags($this->deleted));
        $this->labels=htmlspecialchars(strip_tags($this->labels));
        $this->user=htmlspecialchars(strip_tags($this->user));
        $this->created=htmlspecialchars(strip_tags($this->created));
		
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
         
		  todo_id='".$this->id."',todo_notes='".$this->notes."',todo_title='".$this->title."',todo_startdate='".$this->startdate."', todo_duedate='".$this->duedate."',todo_completed='".$this->completed."',todo_starred='".$this->starred."',todo_important='".$this->important."',todo_deleted='".$this->deleted."',todo_labels='".$this->labels."',todo_user='".$this->user."'";
			
			
           # $stmt = $this->conn->query($query);

        // bind values
        /*
    	$stmt->bindParam(":todo_id", $this->id);
    	$stmt->bindParam(":todo_notes", $this->notes);
        $stmt->bindParam(":todo_title", $this->title);
        $stmt->bindParam(":todo_startdate", $this->startdate);
        $stmt->bindParam(":todo_duedate", $this->duedate);
        $stmt->bindParam(":todo_completed", $this->completed);
		$stmt->bindParam(":todo_starred", $this->starred);
    	$stmt->bindParam(":todo_important", $this->important);
        $stmt->bindParam(":todo_deleted", $this->deleted);
        $stmt->bindParam(":todo_labels", $this->labels);
        $stmt->bindParam(":todo_user", $this->user);
        */
       # $sql = $this->conn->prepare("INSERT INTO sitrotest (todo_id,todo_notes,todo_title,todo_startdate,todo_duedate,todo_completed,todo_starred,todo_important,todo_deleted,todo_labels,todo_user) VALUES (? ,? ,?, ?, ?, ?)");
/*
        if($sql->execute(array($this->id, $this->notes, $this->title, $this->startdate, $this->duedate, $this_completed, $this_starred, $this->important, $this->deleted, $this->labels, $this->user))){
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
                todo_id = '".$this->id."'
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
        
	$this->todo = $row['todo'];
	$this->notes = $row['notes'];
	$this->title = $row['title'];
	$this->startdate = $row['startdate'];
	$this->duedate = $row['duedate'];
	$this->completed = $row['completed'];
	$this->starred = $row['starred'];
	$this->important = $row['important'];
	$this->deleted =$row[' deleted'];
	$this->labels = $row['labels'];
	$this->user = $row['user'];
	$this->created = $row['created'];

    
    }
    */
    $stmt = $this->conn->query($query);
    $row = $stmt->fetch();
	$this->todo = $row['todo'];
	$this->notes = $row['notes'];
	$this->title = $row['title'];
	$this->startdate = $row['startdate'];
	$this->duedate = $row['duedate'];
	$this->completed = $row['completed'];
	$this->starred = $row['starred'];
	$this->important = $row['important'];
	$this->deleted =$row[' deleted'];
	$this->labels = $row['labels'];
	$this->user = $row['user'];
	$this->created = $row['created'];
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