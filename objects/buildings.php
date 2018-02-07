<?php
class Buildings{
 
    // database connection and table name
    private $conn;
    private $table_name = "gs_building";
 
    // object properties
    public $id;
    public $bldg;


 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read(){
        //select all data
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ;  

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
                bldg = :bldg
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    // posted valuesF
    $this->bldg=htmlspecialchars(strip_tags($this->bldg));
    // bind new values
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
            VALUES(null,:bldg )";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // posted valuesF
    $this->bldg=htmlspecialchars(strip_tags($this->bldg));
    // bind new values
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