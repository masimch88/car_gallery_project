<?php



class Photo extends Db_object
{
    protected static $db_table = "photos";
    protected static $db_table_fields = array('id', 'title', 'description', 'file_name', 'type', 'size');
    public $id;
    public $title;
    public $description;
    public $file_name;
    public $type;
    public $size;

    public $tmp_path;
    public $upload_directory = "images";
    public $errors = array();

    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error.",
        UPLOAD_ERR_INI_SIZE => "The upload file Exceed the upload_max_file_size directory",
        UPLOAD_ERR_FORM_SIZE => "The upload file Exceed the max_file_size directive",
        UPLOAD_ERR_PARTIAL => "The uplaod file was only partially uploaded",
        UPLOAD_ERR_NO_FILE => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION => "A php extension stop the file upload"
    );

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
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }
        else
        {
            $this->file_name = basename($file['name']);
            $this->tmp_path  = $file['tmp_name'];
            $this->type      = $file['type'];
            $this->size      = $file['size'];
            
        }
    }
    public function picture_path()
    {
        return $this->upload_directory.DS.$this->file_name;
    }
    public function save()
    {
        if($this->id)
        {
            $this->update();
        }
        else if(!empty($this->errors))
        {
            return false;
        }
        if(empty($this->file_name) || empty($this->tmp_path) )
        {
            $this->errors[] = "The file is not available";
            return false;
        }

        $target_path = SITE_ROOT . DS . "admin" . DS . $this->upload_directory . DS . $this->file_name;

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




}



?>