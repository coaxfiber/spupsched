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
    public $merge;
 
    public function __construct($db){
        $this->conn = $db;
    }
 // used by select drop-down list
    function check($var,$t,$y,$p,$id){
        //select all data
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ." WHERE id != ".$id." and term like '".$t."' and year like '".$y."'  and sched like '".$var."' and professor like '".$p."'  Order by code ASC";  

        $stmt = $this->conn->prepare( $query );
        // posted valuesF

        $stmt->execute();
    
        return $stmt;
    }
    // used by select drop-down list
    function read(){
        //select all data
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ." WHERE term like :term and year like :year and programid like :programid and position = 0   Order by code ASC";  

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
     function readfac($sy,$t,$name){
        //select all data
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ." WHERE term like '".$t."' and year like '".$sy."' and professor like '".$name."'   Order by code ASC";  

        $stmt = $this->conn->prepare( $query );

        $stmt->execute();
    
        return $stmt;
    }
        function getcode(){
        //select all data
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ." WHERE term like :term and year like :year and programid like :programid and code like :code and position = 0";  

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
function updatesched(){
    // update query
    $query = "UPDATE 
                " . $this->table_name . "
            SET 
                professor = :professor,
                time = :time,
                sched = :sched,
                merge = :merge,
                room = :room
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    // posted valuesF
    $this->professor=htmlspecialchars(strip_tags($this->professor));
    $this->time=htmlspecialchars(strip_tags($this->time));
    $this->sched=htmlspecialchars(strip_tags($this->sched));
    $this->room=htmlspecialchars(strip_tags($this->room));
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->merge=htmlspecialchars(strip_tags($this->merge));
    // bind new values
    $stmt->bindParam(':professor', $this->professor);
    $stmt->bindParam(':time', $this->time);
    $stmt->bindParam(':sched', $this->sched);
    $stmt->bindParam(':room', $this->room);
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':merge', $this->merge);
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
                year like :year and term like :term and programid = :programid and code like :code";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    
    // posted values
 
    // bind new values
    $stmt->bindParam(':year', $this->year);
    $stmt->bindParam(':term', $this->term);
    $stmt->bindParam(':programid', $this->programid);
    $stmt->bindParam(':code', $this->code);
     
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

function removealls(){
 
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
            VALUES(null,:code,:title,:units,'','8:30-12 / 1:30-5','','',:term,:year,:programid,'',0,'' )";
 
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