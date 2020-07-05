<?php

class Photo extends Db_object
{
    protected static $db_table = "photos";
    protected static $db_table_fields = array('id', 'title', 'caption', 'alternate_text', 'description', 'file_name', 'type', 'size');
    
    public $title;
    public $caption;
    public $alternate_text;
    public $description;
    public $file_name;
    

    // This is passing $_FILES['uploaded_file'] as an argument

    public function set_file($file)
    {
        if(empty($file) || !$file || !is_array($file))
        {
            self::$errors[] = "No file has been uploaded";
            return false;
        }
        else if($file['error'] != 0)
        {
            self::$errors[] = self::$upload_errors_array[$file['error']];
            return false;
        }
        else
        {
            //The basename() function returns the filename from a path.
            $this->file_name = basename($file['name']);
            $this->tmp_path  = $file['tmp_name'];
            $this->type      = $file['type'];
            $this->size      = $file['size'];
            
        }
    }
    
    public function save()
    {
        if(isset($this->id))
        {
            $this->update();
        }
        else if(!empty(self::$errors))
        {
            return false;
        }
        if(empty($this->file_name) || empty($this->tmp_path) )
        {
            $this->errors[] = "The file is not available";
            return false;
        }

        $target_path = SITE_ROOT . DS . "admin" . DS . self::$upload_directory . DS . $this->file_name;
//The move_uploaded_file() function moves an uploaded file to a new destination.
//This function only works on files uploaded via PHP's HTTP POST upload mechanism.
//If the destination file already exists, it will be overwritten.
        if(move_uploaded_file($this->tmp_path, $target_path))
        {
            if($this->create())
            {
                unset($this->tmp_path);
                return true;
            }
        }
        else
        {
            $this->errors[] = "folder permission error.";
            return false;
        }
    }

    public function picture_path()
    {
        return self::$upload_directory.DS.$this->file_name;
    }

    
    public function delete_photo()
    {
        if($this->delete())
        {
            $target_path = SITE_ROOT . DS . "admin" . DS . "images" . DS . $this->file_name;
            return unlink($target_path) ? true : false;
        }
        else
        {
            return false;
        }
    }

    public static function display_sidebar_data($photo_id)
    {
        $photo = Photo::find_by_id($photo_id);

        $output = "<a class='thumbnail' href='#' ><img width='100' src='{$photo->picture_path()}' ></a>";
        $output .= "<p?>{$photo->file_name}</p>";
        $output .= "<p?>{$photo->type}</p>";
        $output .= "<p?>{$photo->size}</p>";

        echo $output;

    }



}



?>