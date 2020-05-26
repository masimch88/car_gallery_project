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



?>