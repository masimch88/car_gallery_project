<?php 


class User{

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    public static function find_all_user(){
        return self::find_this_query("select * from users");
    }

    public static function find_user_by_id($id){
        $result_set = self::find_this_query("select * from users  WHERE id=$id");
        $row=mysqli_fetch_assoc($result_set);
        return $row;
    }

    public static function find_this_query($sql){
        global $database;
        $result_set= $database->query($sql);
        return $result_set;
    }

    public static function instansitation($the_record){
        $the_object = new User();

        /*while($row=mysqli_fetch_assoc($result_set))
        {
            $the_object->id         = $row['id'];
            $the_object->username   = $row['username'];
            $the_object->password   = $row['password'];
            $the_object->first_name = $row['first_name'];
            $the_object->last_name  = $row['last_name'];
        }*/

        foreach($the_record as $the_attribute=>$value)
        {
            if($the_object->has_the_attribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }

    private function has_the_attribute($the_attribute){

        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute , $object_properties);
    }

}










?>