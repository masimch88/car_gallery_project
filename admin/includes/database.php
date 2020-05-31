<?php 

require_once("config.php");

class Database {

    public $connection;

    function __construct(){
        $this->open_db_connection();
    }

    private function open_db_connection(){
        //$this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) OR die("error".mysqli_connect_error());
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) 
        or
        die("database connection failed" . $this->connection->connect_error);
       
    }

    public function query($sql){
        ////it works as mysqli_query
        $result = $this->connection->query($sql);
        
        $this->confirm_query($result);
        return $result;
    }

    private function confirm_query($result){
        if(!$result)
        {
            die ("query is failed " . $this->connection->error);
        }
        
    }
    public function escape_string($string){

        $escaped_string = $this->connection->real_escape_string($string);
        
        return $escaped_string;
    }

    public function the_insert_id(){
        return mysqli_insert_id($this->connection);
    }

}

$database = new Database();



?>