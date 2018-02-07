<?php
class Logs{
 
    // database connection and table name
    private $conn;
    private $table_name = "log";
 
    // object properties
    public $logid;
    public $process;
    public $datelog;
    public $timelog;

 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read($x){
        //select all data
      
            $query = "SELECT
                         *
                     FROM
                    " . $this->table_name .
                    " WHERE
                    datelog = '". $x."' 
                    Order by
                    timelog asc
                    "
                    ;  

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
    


// update the product
function create(){
 
    // update query
    $query = "INSERT INTO
                " . $this->table_name . "
            VALUES(null,:process,:datelog,:timelog )";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->process=htmlspecialchars(strip_tags($this->process));
    // bind new values
    $stmt->bindParam(':process', $this->process);
    $stmt->bindParam(':datelog', $this->datelog);
    $stmt->bindParam(':timelog', $this->timelog);
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

}
?>  