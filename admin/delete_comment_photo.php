<?php include("includes/init.php"); 



if(!$session->is_signed_in())
{
    redirect("login.php");//////it is a commentdefined function
}

if(empty($_GET['id']))
{
    redirect("comment_photo.php");
}

$comment= Comment::find_by_id($_GET['id']);

if($comment)
{
    
    $comment->delete();
   redirect("comment_photo.php?id={$comment->photo_id}");
}
else
{
    redirect("comment_photo.php?id={$comment->photo_id}");
}









?>