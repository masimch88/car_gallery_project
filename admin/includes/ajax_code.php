<?php
    require("init.php");
    $user = new User();
    if(isset($_POST['image_name']))
    {
        $user->ajax_save_user_image($_POST['image_name'], $_POST['user_id']);
    }
    if(isset($_POST['photo_id']))
    {
        $photo = Photo::find_by_id($_POST['photo_id']);

        echo $photo->title."<br>";
        echo $photo->caption."<br>";
        echo $photo->description."<br>";
        echo $photo->file_name."<br>";
    }

?>