<?php

if($_SERVER['SERVER_NAME'] == 'localhost')
{
    define('DBNAME', 'quick-programming-mvc');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASSWORD', '');

    define('ROOT', 'http://localhost/Quick-programming-mvc/public');
} else
{
    die('Unknown server');
}

define('APP_NAME', "My Website");
define('APP_DESCRIPTION', "Best website on the planet");

/** True = show errors **/
define('DEBUG', true);