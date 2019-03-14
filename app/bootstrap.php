<?php
//Load config
require_once 'config/config.php';

//Load helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

//Autoload Core libraries
function my_autoloader($class) {
    require_once 'libraries/'.$class.'.php';
}

spl_autoload_register('my_autoloader');
