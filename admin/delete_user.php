<?php
    include("includes/init.php"); 



    if(!$session->is_signed_in())
    {
    redirect("login.php");//////it is a userdefined function
    }

    if(empty($_GET['id']))
    {
    redirect("users.php");
    }

    $user=User::find_by_id($_GET['id']);

    if($user)
    {
    $user->delete_user();
    $session->message("the {$user->username} has been deleted");
    redirect("users.php");
    }
    else
    {
    $session->message("the user has not been deleted");
    redirect("users.php");
    }









?>