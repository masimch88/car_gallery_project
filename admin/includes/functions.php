<?php

///////////this function will load or include files which forget to load in init.php automatically

function classAutoLoader($class){

$class = strtolower($class);

$the_path_of_file = "includes/{$class}.php";

if(is_file($class) && !class_exists($class))
{
    include $the_path_of_file;
}
}

spl_autoload_register('classAutoLoader');


function redirect($location)
{
    header("location: {$location}");
    exit();
}



function isempty($v)
{
    $error=array();
    foreach($v as $k=>$val)
    {
        if(empty($val))
        {
            $error[]=$k." is empty";
        }
        
    }
    return  $error;
}

function sanatization($arr)
{
    foreach($arr as $var => $val)
        {
            $_POST[$var] = filter_var($val, FILTER_SANITIZE_STRING);
            trim($val);
        }
}








?>