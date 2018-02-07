<?php
class Rooms{
 
    // database connection and table name
    private $conn;
    private $table_name = "gs_rooms";
 
    // object properties
    public $id;
    public $room;
    public $type;
    public $bldg;


 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read($var){
        if ($var==0) {
           $query = "SELECT
                         *
                     FROM
                    " . $this->table_name;
        }else{
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ." where bldg = ".$var;  
        }
        //select all data
            

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }

    

// update the product
function update(){
 
    // update query
    $query = "UPDATE 
                " . $this->table_name . "
            SET 
                room = :room, 
                bldg = :bldg,
                type = :type 
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // posted valuesF
    $this->bldg=htmlspecialchars(strip_tags($this->bldg));
    $this->type=htmlspecialchars(strip_tags($this->type));
    $this->room=htmlspecialchars(strip_tags($this->room));
    // bind new values
    $stmt->bindParam(':room', $this->room);
    $stmt->bindParam(':type', $this->type);
    $stmt->bindParam(':bldg', $this->bldg);
    $stmt->bindParam(':id', $this->id);
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}
function remove(){
 
    // update query
    $query = "DELETE FROM
                " . $this->table_name . "
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // posted values
 
    // bind new values
    $stmt->bindParam(':id', $this->id);
     
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

// update the product
function create(){
 
   // update query
    $query = "INSERT INTO
                " . $this->table_name . "
            VALUES(null,:room,:type,:bldg )";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // posted valuesF
    $this->bldg=htmlspecialchars(strip_tags($this->bldg));
    $this->type=htmlspecialchars(strip_tags($this->type));
    $this->room=htmlspecialchars(strip_tags($this->room));
    // bind new values
    $stmt->bindParam(':room', $this->room);
    $stmt->bindParam(':type', $this->type);
    $stmt->bindParam(':bldg', $this->bldg);
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

}
?>  