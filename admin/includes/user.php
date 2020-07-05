<?php 


class User  extends db_object
{
    protected static $db_table = "users";
    protected static $db_table_fields = array('username','password','first_name','last_name', 'user_image');

    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $image_placeholder = "http://placehold.it/400X400&text=image";

    public function image_path_and_placeholder(){

        //echo $this->upload_directory.DS.$this->user_image;

        return empty($this->user_image) ? $this->image_placeholder :  static::$upload_directory.DS.$this->user_image;
    }

    // This is passing $_FILES['uploaded_file'] as an argument

    
    public function set_file($file)
    {
        if(empty($file) || !$file || !is_array($file))
        {
            $this->errors[] = "No file has been uploaded";
            return false;
        }
        else if($file['error'] != 0)
        {
            $this->errors[] = self::$upload_errors_array[$file['error']];
            return false;
        }
        else
        {
            $this->user_image = basename($file['name']);
            $this->tmp_path  = $file['tmp_name'];
            $this->type      = $file['type'];
            $this->size      = $file['size'];
            
        }
    }
    public function upload_photo()
    {
        
            if(!empty($this->errors))
            {
                return false;
            }
            if(empty($this->user_image) || empty($this->tmp_path) )
            {
                $this->errors[] = "The file is not available";
                return false;
            }
 //self is for use in static member functions to allow you to access static member variables(static $db_table ). 
 //$this is used in non-static member functions(public $user_image;)
            $target_path = SITE_ROOT . DS . "admin" . DS . self::$upload_directory . DS . $this->user_image;

            if(move_uploaded_file($this->tmp_path, $target_path))
            {
                    unset($this->tmp_path);
                    return true;
            }
            else
            {
                $this->errors[] = "folder permission error.";
                return false;
            }
    }


    public static function user_verify($username,$password)
    {
        global $database;

        $sql="SELECT  * FROM " . self::$db_table . " WHERE username = '$username' AND password = '$password' LIMIT 1";

        $the_result_array = self::find_by_query($sql);

        //The array_shift() function removes the first element from an array, 
        //and returns the value of the removed element.
        return !empty( $the_result_array ) ? array_shift($the_result_array) : false;

    }
    public function delete_user()
    {
        if($this->delete())
        {
            $target_path = SITE_ROOT . DS . "admin" . DS . "images" . DS . $this->user_image;
            return unlink($target_path) ? true : false;
        }
        else
        {
            return false;
        }
    }

    public function ajax_save_user_image($user_image, $user_id){
        $this->user_image = $user_image;
        $this->id = $user_id;
        $this->save();
    }
   

}/////////end of user cls



?>