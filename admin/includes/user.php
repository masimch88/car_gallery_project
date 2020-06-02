<?php 


class User  extends db_object
{
    protected static $db_table = "users";
    protected static $db_table_fields = array('username','password','first_name','last_name');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function user_verify($username,$password)
    {
        global $database;

        $sql="SELECT  * FROM " . self::$db_table . " WHERE username = '$username' AND password = '$password' LIMIT 1";

        $the_result_array = self::find_by_query($sql);

        //The array_shift() function removes the first element from an array, 
        //and returns the value of the removed element.
        return !empty( $the_result_array ) ? array_shift($the_result_array) : false;

    }
   

}/////////end of user cls



?>