<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

define('SITE_ROOT' ,  'C:' . DS . 'xampp' . DS . 'htdocs' . DS . 'gallery');

defined('INCLUDE_PATH') ? null : define('INCLUDE_PATH' , SITE_ROOT . DS . 'admin' . DS . 'includes');






require_once(INCLUDE_PATH.DS."functions.php");///////////this function will load or include files which forget to load in init.php automatically
require_once(INCLUDE_PATH.DS."config.php");
require_once(INCLUDE_PATH.DS."database.php");
require_once(INCLUDE_PATH.DS."db_object.php");
require_once(INCLUDE_PATH.DS."user.php");
require_once(INCLUDE_PATH.DS."photo.php");
require_once(INCLUDE_PATH.DS."session.php");
require_once(INCLUDE_PATH.DS."comment.php");
require_once(INCLUDE_PATH.DS."paginate.php");





?>