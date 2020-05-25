<?php 


class User{

    public static function find_all_user(){
        return self::find_this_query("select * from users");
    }
    public static function find_user_by_id($id){
        return self::find_this_query("select * from users  WHERE id=$id");
    }
    public static function find_this_query($sql){
        global $database;
        $result_set= $database->query($sql);
        return $result_set;
    }

}










?>