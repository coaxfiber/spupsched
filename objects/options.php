<?php
class Options{
 
    // database connection and table name
    private $conn;
    private $table_name = "gs_option";
 
    // object properties
    public $id;
    public $gsoption;
    public $value;


 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function readschoolyear(){
        //select all data
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name . " WHERE gsoption like 'active_year'";  

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }// used by select drop-down list
     function readsemester(){
        //select all data
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name . " WHERE gsoption like 'active_term'";  

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }// used by select drop-down list
    function readsearch($car){
        //select all data
            $query = "SELECT Distinct
                         *
                     FROM
                    " . $this->table_name ." WHERE fname Like '%".$car."%' or mname Like '%".$car."%' or  lname Like '%".$car."%' or concat(fname , ' ' , mname , ' ' , lname) LIKE '%".$car."%' or concat(fname , ' ' , mname) LIKE '%".$car."%' or concat(mname , ' ' , lname) LIKE '%".$car."%' or concat(fname, ' ' ,lname) LIKE '%".$car."%' or concat(lname, ' ' ,fname) LIKE '%".$car."%'" ;  

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
                idno = :idno,
                ext = :ext,
                fname = :fname,
                mname = :mname,
                lname = :lname,
                status = :status,
                progname = :progname
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    // posted valuesF
    $this->idno=htmlspecialchars(strip_tags($this->idno));
    $this->ext=htmlspecialchars(strip_tags($this->ext));
    $this->fname=htmlspecialchars(strip_tags($this->fname));
    $this->mname=htmlspecialchars(strip_tags($this->mname));
    $this->lname=htmlspecialchars(strip_tags($this->lname));
    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->progname=htmlspecialchars(strip_tags($this->progname));
    // bind new values
    $stmt->bindParam(':idno', $this->idno);
    $stmt->bindParam(':ext', $this->ext);
    $stmt->bindParam(':fname', $this->fname);
    $stmt->bindParam(':mname', $this->mname);
    $stmt->bindParam(':lname', $this->lname);
    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':progname', $this->progname);
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
             VALUES(null,:idno ,:ext,:fname ,:mname ,:lname ,:status ,:progname )";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
 	$this->idno=htmlspecialchars(strip_tags($this->idno));
    $this->ext=htmlspecialchars(strip_tags($this->ext));
    $this->fname=htmlspecialchars(strip_tags($this->fname));
    $this->mname=htmlspecialchars(strip_tags($this->mname));
    $this->lname=htmlspecialchars(strip_tags($this->lname));
    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->progname=htmlspecialchars(strip_tags($this->progname));
    // bind new values
    $stmt->bindParam(':idno', $this->idno);
    $stmt->bindParam(':ext', $this->ext);
    $stmt->bindParam(':fname', $this->fname);
    $stmt->bindParam(':mname', $this->mname);
    $stmt->bindParam(':lname', $this->lname);
    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':progname', $this->progname);

    if($stmt->execute()){
        return "true";
    }else{
        return "false";
    }
}

}
?>  