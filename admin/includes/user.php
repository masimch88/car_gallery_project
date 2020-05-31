<?php 


class User{
    protected static $db_table = "users";
    protected static $db_table_field = array('username','password','first_name','last_name');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    public static function find_all_user()
    {
        return self::find_this_query("select * from users");
    }

    public static function find_user_by_id($id){

        $the_result_array = self::find_this_query("select * from users  WHERE id=$id LIMIT 1");

        //array shift will return only 1st item of array 
        return !empty( $the_result_array ) ? array_shift($the_result_array) : false;
    }

    public static function find_this_query($sql)
    {
        global $database;
        $result_set= $database->query($sql);
        $the_object_array = array();

        while($row = mysqli_fetch_assoc($result_set))
        {
            $the_object_array[] = self::instansitation($row);
        }

        return $the_object_array;
    }

    public static function instansitation($row)
    {
        $the_object = new User();

        /*while($row=mysqli_fetch_assoc($result_set))
        {
            $the_object->id         = $row['id'];
            $the_object->username   = $row['username'];
            $the_object->password   = $row['password'];
            $the_object->first_name = $row['first_name'];
            $the_object->last_name  = $row['last_name'];
        }*/

        foreach($row as $the_attribute=>$value)
        {
            if($the_object->has_the_attribute($the_attribute))
            {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }

    private function has_the_attribute($the_attribute)
    {

        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute , $object_properties);
    }

    public static function user_verify($username,$password)
    {
        global $database;

        $sql="SELECT  * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";

        $the_result_array = self::find_this_query($sql);

        //array shift will return only 1st item of array 
        return !empty( $the_result_array ) ? array_shift($the_result_array) : false;

    }

    

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    protected function properties()
    {
        $properties = array();

        foreach(self::$db_table_field as $db_field)
        {
            if(property_exists($this , $db_field))
            {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    public function create()
    {
        global $database;
        
        $properties = $this->properties();

        $sql ="INSERT INTO " . self::$db_table . "(" . implode(",",array_keys($this->properties())) . ")";
        $sql .= "VALUES('" . implode("','",array_values($this->properties())) . "')";

        if($database->query($sql))
        {
            $this->id = $database->the_insert_id();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function update()
    {
        global $database;

        $sql = "UPDATE " . self::$db_table . " SET ";
        $sql .= "username= '". $database->escape_string($this->username)    . "', "; 
        $sql .= "password= '". $database->escape_string($this->password)    . "', "; 
        $sql .= "first_name= '". $database->escape_string($this->first_name)  . "', "; 
        $sql .= "last_name= '". $database->escape_string($this->last_name)   . "' "; 
        $sql .= " WHERE id = ". $database->escape_string($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }

    public function delete()
    {
        global $database;
        
        $sql="delete from " . self::$db_table . " where id='". $database->escape_string($this->id) ."'";
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

}/////////end of user cls



?>