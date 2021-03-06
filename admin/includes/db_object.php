<?php


class Db_object
{
    public $id;
    public $type;
    public $size;
    public $tmp_path;
    public $errors = array();
    public static $upload_directory = "images";
    public static $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error.",
        UPLOAD_ERR_INI_SIZE => "The upload file Exceed the upload_max_file_size directory",
        UPLOAD_ERR_FORM_SIZE => "The upload file Exceed the max_file_size directive",
        UPLOAD_ERR_PARTIAL => "The uplaod file was only partially uploaded",
        UPLOAD_ERR_NO_FILE => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION => "A php extension stop the file upload"
    );
 //Declaring class properties or methods as static makes them accessible without needing an instantiation of the class. 
//A property declared as static cannot be accessed with an instantiated class object (though a static method can).

    public static function find_all(){

//A static method can be accessed from a method in the same class using the self keyword and double colon (::)
        return static::find_by_query("select * from " . static::$db_table . " ");
    }

    public static function find_by_id($id){
        $the_result_array = static::find_by_query("select * from " . static::$db_table . "  WHERE id=$id LIMIT 1");
        //array shift will return only 1st item of array 
        return !empty( $the_result_array ) ? array_shift($the_result_array) : false;
    }
    public static function find_by_query($sql)
    {
        global $database;
        $result_set= $database->query($sql);
        $the_object_array = array();
        while($row = mysqli_fetch_assoc($result_set))
        {
            $the_object_array[] = static::instansitation($row);
        }

        return $the_object_array;
    }

    public static function instansitation($row)
    {

        /*The function get_called_class() can be used to retrieve a string
          with the name of the called class and static:: introduces its scope
            jis class k through  function call ho ga usi k object bany ga */
        //Returns the class name. Returns FALSE if called from outside a class.
        $calling_class = get_called_class();
        $the_object = new $calling_class;

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
        //It returns an associative array of defined object properties for the specified object. 
        //if a property have not been assigned a value, it will be returned with a NULL value.
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute , $object_properties);
    }
    ////this function not usefull anymore as both photo and user are uploading file
    
    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    protected function properties()
    {
        $properties = array();
        // replace self by static
        foreach(static::$db_table_fields as $db_field)
        {
            if(property_exists($this , $db_field))
            {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }
//the property or method can be accessed within the class and by classes derived from that class.
    protected function clean_properties()
    {
        return sanatization($this->properties());
    }

    public function create()
    {
        global $database;
        
        $properties = $this->clean_properties();
//Join array elements with a string
        $sql ="INSERT INTO " . static::$db_table . "(" . implode(",",array_keys($this->properties())) . ")";
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

        $properties = $this->clean_properties();

        $properties_pairs = array();

        foreach($properties as $key => $value)
        {
            $properties_pairs[] = "{$key}='{$value}'";
        }

        //print_r($properties_pairs);

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode("," , $properties_pairs); 
        $sql .= " WHERE id = ". $database->escape_string($this->id);

        $database->query($sql);
//The affected_rows / mysqli_affected_rows() function returns the number of affected rows 
//in the previous SELECT, INSERT, UPDATE, REPLACE, or DELETE query.
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }

    public function delete()
    {
        global $database;
//Escapes a string for use in a mysql_query   
        $sql="delete from " . static::$db_table . " where id='". $database->escape_string($this->id) ."'";
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

}







?>