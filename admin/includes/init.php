<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

define('SITE_ROOT' ,  'C:' . DS . 'xampp' . DS . 'htdocs' . DS . 'gallery');

defined('INCLUDE_PATH') ? null : define('INCLUDE_PATH' , SITE_ROOT . DS . 'admin' . DS . 'includes');






require_once("functions.php");///////////this function will load or include files which forget to load in init.php automatically
require_once("config.php");
require_once("database.php");
require_once("db_object.php");
require_once("user.php");
require_once("photo.php");
require_once("session.php");
require_once("comment.php");
require_once("paginate.php");





?>