<?php
class Scheduling{
 
    // database connection and table name
    private $conn;
    private $table_name = "gs_scheduling";
 
    // object properties
    public $id;
    public $code;
    public $title;
    public $units;
    public $sched;
    public $room;
    public $professor;
    public $term;
    public $year;
    public $programid;
    public $start;
    public $position;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read(){
        //select all data
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ." WHERE term like :term and year like :year and programid like :programid";  

        $stmt = $this->conn->prepare( $query );
        // posted valuesF
        $this->term=htmlspecialchars(strip_tags($this->term));
        $this->year=htmlspecialchars(strip_tags($this->year));
        $this->programid=htmlspecialchars(strip_tags($this->programid));
        // bind new values
        $stmt->bindParam(':term', $this->term);
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':programid', $this->programid);

        $stmt->execute();
    
        return $stmt;
    }
        function getcode(){
        //select all data
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ." WHERE term like :term and year like :year and programid like :programid and code like :code";  

        $stmt = $this->conn->prepare( $query );
        // posted valuesF
        $this->term=htmlspecialchars(strip_tags($this->term));
        $this->year=htmlspecialchars(strip_tags($this->year));
        $this->programid=htmlspecialchars(strip_tags($this->programid));
        $this->code=htmlspecialchars(strip_tags($this->code));
        // bind new values
        $stmt->bindParam(':term', $this->term);
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':programid', $this->programid);
        $stmt->bindParam(':code', $this->code);

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
function removeall(){
 
    // update query
    $query = "DELETE FROM
                " . $this->table_name . "
            WHERE
                year like :year and term like :term and programid = :programid";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    
    // posted values
 
    // bind new values
    $stmt->bindParam(':year', $this->year);
    $stmt->bindParam(':term', $this->term);
    $stmt->bindParam(':programid', $this->programid);
     
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
            VALUES(null,:code,:title,:units,'','8:30-12/1:30-5','','',:term,:year,:programid,'',0 )";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // bind new values
    $stmt->bindParam(':code', $this->code);
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':units', $this->units);
    $stmt->bindParam(':year', $this->year);
    $stmt->bindParam(':term', $this->term);
    $stmt->bindParam(':programid', $this->programid);    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

}
?>  