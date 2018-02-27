<?php
class Subjects{
 
    // database connection and table name
    private $conn;
    private $table_name = "gs_subject";
 
    // object properties
    public $id;
    public $code;
    public $title;
    public $units;
    public $remarks;
    public $program;
    public $type;


 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read($var){
       if ($var == 0) {
           $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ." where program = ".$var;  
       }else{
            $query = "SELECT DISTINCT
                         gs_subject.id,gs_subject.title,gs_subject.units,gs_subject.remarks,gs_subject.type,gs_subject.code,gs_subject.program
                     FROM
                    " . $this->table_name ." inner join gs_program on ".$this->table_name.".program = gs_program.id  where (".$this->table_name.".program = ".$var.")";  
       }
        //select all data
            

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }


    // used by select drop-down list
    function readlist($var){
       if ($var == 0) {
           $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ." where program = ".$var;  
       }else{
            $query = "SELECT DISTINCT
                         gs_subject.id,gs_subject.title,gs_subject.units,gs_subject.remarks,gs_subject.type,gs_subject.code,gs_subject.program
                     FROM
                    " . $this->table_name ." left join gs_program on ".$this->table_name.".program = gs_program.id  where (gs_subject.program = 0) or (".$this->table_name.".program = ".$var.")";  
       }
        //select all data
            

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }  function readins($var){
       
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ." where program = ".$var;  
        //select all data
            

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
      function getcode($var){
       
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ." where code = '".$var."'";  
        //select all data
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
     // used by select drop-down list
    function getsub($var,$txt){
       
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ." where program = ".$var.        " and type like '".$txt."'";  
        //select all data
            

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }  // used by select drop-down list
    function getsubc($var,$txt){
       
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name ." Inner join gs_program on ".$this->table_name.".program = gs_program.id  where short like '".$var."' and type like '".$txt."' ";  
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
                code = :code, 
                title = :title,
                units = :units,
                remarks = :remarks,
                type = :type
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // posted valuesF
    $this->code=htmlspecialchars(strip_tags($this->code));
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->units=htmlspecialchars(strip_tags($this->units));
    $this->remarks=htmlspecialchars(strip_tags($this->remarks));
    $this->type=htmlspecialchars(strip_tags($this->type));
    // bind new values
    $stmt->bindParam(':code', $this->code);
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':units', $this->units);
    $stmt->bindParam(':remarks', $this->remarks);
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':type', $this->type);
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
            VALUES(null,:code,:title,:units,:remarks,:program,:type)";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // posted valuesF
    $this->code=htmlspecialchars(strip_tags($this->code));
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->units=htmlspecialchars(strip_tags($this->units));
    $this->remarks=htmlspecialchars(strip_tags($this->remarks));
    $this->program=htmlspecialchars(strip_tags($this->program));
    $this->type=htmlspecialchars(strip_tags($this->type));
    // bind new values
    $stmt->bindParam(':code', $this->code);
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':units', $this->units);
    $stmt->bindParam(':remarks', $this->remarks);
    $stmt->bindParam(':program', $this->program);
    $stmt->bindParam(':type', $this->type);
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

}
?>  