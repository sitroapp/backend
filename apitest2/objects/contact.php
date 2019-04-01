<?php
class Contact{

    // database connection and table name
    private $conn;
    private $table_name = "contacts";

    // object properties
    public $id;
    public $address;
    public $avatar;
    public $company;
    public $email;
    public $job_title;
    public $last_name;
    public $nickname;
    public $notes;
    public $phone;

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
                    contact_last_name";

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
               contact_title=:title, contact_desc=:description, contact_start=:start,contact_end=:end,contact_user_id=:user,  created=:created";

                $this->address=htmlspecialchars(strip_tags($this->address));
                $this->avatar=htmlspecialchars(strip_tags($this->avatar));
                $this->company=htmlspecialchars(strip_tags($this->company));
                $this->email=htmlspecialchars(strip_tags($this->email));
                $this->job_title=htmlspecialchars(strip_tags($this->job_title));
                $this->last_name=htmlspecialchars(strip_tags($this->last_name));
                $this->nickname=htmlspecialchars(strip_tags($this->nickname));
                $this->notes=htmlspecialchars(strip_tags($this->notes));
                $this->phone=htmlspecialchars(strip_tags($this->phone));


                $query = "INSERT INTO
                    " . $this->table_name . " 
                    SET
                    contact_title='".$this->title."', contact_desc= '".$this->description."',contact_start='".$this->start."',contact_end='".$this->end."',contact_user_id='".$this->user."', created='".$this->created."'";

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
                contact_id = '".$this->id."'
            LIMIT
                0,1";

                $stmt = $this->conn->query($query);
                $row = $stmt->fetch();
                $this->address = $row['contact_address'];
                $this->avatar = $row['contact_avatar'];
                $this->company = $row['contact_company'];
                $this->email = $row['contact_email'];
                $this->job_title = $row['contact_job_title'];
                $this->last_name = $row['contact_last_name'];
                $this->nickname = $row['contact_nickname'];
                $this->notes = $row['contact_notes'];
                $this->phone = $row['contact_phone'];
                
            }

            // update the product
            function update(){

                // update query
                $query = "UPDATE
                        " . $this->table_name . "
                    SET
                        contact_address='".$this->title."', calendar_desc= '".$this->description."',calendar_start='".$this->start."',calendar_end='".$this->end."',calendar_user_id='".$this->user."' WHERE calendar_id='".$this->id."'";
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