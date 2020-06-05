<?php 


class Comment extends db_object
{
    protected static $db_table = "comments";
    protected static $db_table_fields = array('id','photo_id','author','body' );

    public $id;
    public $photo_id;
    public $author;
    public $body;
    public $image_placeholder = "http://placehold.it/400X400&text=image";

    public function image_path_and_placeholder(){

        //echo $this->upload_directory.DS.$this->user_image;

        return empty($this->user_image) ? $this->image_placeholder :  static::$upload_directory.DS.$this->user_image;
    }

    public static function create_comment($photo_id, $author ="john alia" , $body="")
    {
        if(!empty($photo_id) && !empty($author) && !empty($body))
        {
            $comment = new Comment();

            $comment->photo_id = (int)$photo_id;
            $comment->author   = $author;
            $comment->body     = $body;
            return $comment;
        }
        else
        {
            return false;
        }
    }

    public static function find_the_comments($photo_id=0)
    {
        global $database;

        $sql = "SELECT * FROM " . self::$db_table;
        $sql.= " WHERE photo_id = " . $database->escape_string($photo_id);
        $sql.= " ORDER BY photo_id ASC";

        return self::find_by_query($sql);

    }


}/////////end of user cls



?>