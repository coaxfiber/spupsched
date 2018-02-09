<?php
class Programs{
 
    // database connection and table name
    private $conn;
    private $table_name = "gs_program";
 
    // object properties
    public $id;
    public $short;
    public $program;
    public $specialization;


 
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
                short = :short,
                program = :program,
                specialization = :specialization
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    // posted valuesF
    $this->short=htmlspecialchars(strip_tags($this->short));
    $this->program=htmlspecialchars(strip_tags($this->program));
    $this->specialization=htmlspecialchars(strip_tags($this->specialization));
    // bind new values
    $stmt->bindParam(':specialization', $this->specialization);
    $stmt->bindParam(':program', $this->program);
    $stmt->bindParam(':short', $this->short);
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
            VALUES(null,:short,:program,:specialization )";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // posted valuesF
    $this->short=htmlspecialchars(strip_tags($this->short));
    $this->program=htmlspecialchars(strip_tags($this->program));
    $this->specialization=htmlspecialchars(strip_tags($this->specialization));
    // bind new values
    $stmt->bindParam(':program', $this->program);
    $stmt->bindParam(':short', $this->short);
    $stmt->bindParam(':specialization', $this->specialization);
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

}
?>  