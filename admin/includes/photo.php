<?php



class Photo extends Db_object
{
    protected static $db_table = "photos";
    protected static $db_table_fields = array('photo_id', 'title', 'description', 'file_name', 'type', 'size');
    public $photo_id;
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





}



?>