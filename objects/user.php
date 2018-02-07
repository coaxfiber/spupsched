<?php
class Users{
 
    // database connection and table name
    private $conn;
    private $table_name = "user";
 
    // object properties
    public $id;
    public $fullname;
    public $username;
    public $password;
    public $address;
    public $email;
    public $acctype;
    public $gender;
    public $birthdate;

 
    public function __construct($db){
        $this->conn = $db;
    }

     function readuser($user){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name." WHERE id = '".$user."'";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }

    function readacc($start_from){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name." WHERE acctype != 'Captain' ORDER BY fullname ASC LIMIT ".$start_from.",18446744073709551615";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
     function readsearch($start_from){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name." WHERE fullname like '%".$start_from."%'";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
    // used by select drop-down list
    function read($u,$pw){
        //select all data
        $pw=sha1($pw);
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name." WHERE username = '" . $u."' and  password = '" . $pw."'";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }

 
// update the product
function update(){
    
    $pw=sha1(htmlspecialchars(strip_tags($this->password)));
    // update query
    $query = "UPDATE 
                " . $this->table_name . "
            SET 
                username = :username, 
                password = '".$pw."'
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->username=htmlspecialchars(strip_tags($this->username));
 
    // bind new values
    $stmt->bindParam(':username', $this->username);
    $stmt->bindParam(':id', $this->id);

    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

function updateacctype2(){
    if ($this->acctype == 'Captain') { 
         $query = "UPDATE 
                " . $this->table_name . "
            SET 
                acctype = 'User'
            WHERE
                acctype = 'Captain'
            ";
        # code...
    }else{
         $query = "UPDATE 
                " . $this->table_name . "
            SET 
                acctype = 'User'
            WHERE
                acctype = 'Secretary'
            ";
    }
   
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // posted values

    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

function updateusername(){
    
    $query = "UPDATE 
                " . $this->table_name . "
            SET 
                username = :username
            WHERE
                id = :id";
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->username=htmlspecialchars(strip_tags($this->username));
 
    // bind new values
    $stmt->bindParam(':username', $this->username); 
    $stmt->bindParam(':id', $this->id); 

    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

function updateacctype(){
    
    $query = "UPDATE 
                " . $this->table_name . "
            SET 
                acctype = :acctype
            WHERE
                id = :id";
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // bind new values
    $stmt->bindParam(':acctype', $this->acctype); 
    $stmt->bindParam(':id', $this->id); 

    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

function updateinfo(){
    
    // update query
    $query = "UPDATE 
                " . $this->table_name . "
            SET 
                fullname = :fullname, 
                address = :address,  
                email = :email, 
                gender=:gender,
                birthdate= :birthdate
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->fullname=htmlspecialchars(strip_tags($this->fullname));
    $this->address=htmlspecialchars(strip_tags($this->address));
    $this->email=htmlspecialchars(strip_tags($this->email));
 
    // bind new values
    $stmt->bindParam(':fullname', $this->fullname);
    $stmt->bindParam(':address', $this->address);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':gender', $this->gender);
    $stmt->bindParam(':birthdate', $this->birthdate);
    $stmt->bindParam(':id', $this->id);

    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}


function create(){
 
    // update query
    $pw=sha1(htmlspecialchars(strip_tags($this->password)));
    $query = "INSERT INTO
                " . $this->table_name . "
            VALUES(null,:fullname,:username,:password,:address,:email,:acctype,:gender,:birthdate )";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // posted valuesF
    $this->fullname=htmlspecialchars(strip_tags($this->fullname));
    $this->username=htmlspecialchars(strip_tags($this->username));
    $this->address=htmlspecialchars(strip_tags($this->address));
    $this->email=htmlspecialchars(strip_tags($this->email));
 
    // bind new values
    $stmt->bindParam(':fullname', $this->fullname);
    $stmt->bindParam(':username', $this->username);
    $stmt->bindParam(':password', $pw);
    $stmt->bindParam(':address', $this->address);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':acctype', $this->acctype);
    $stmt->bindParam(':gender', $this->gender);
    $stmt->bindParam(':birthdate', $this->birthdate);
     
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

}
?>