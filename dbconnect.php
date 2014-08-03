<?php

require_once "idiorm.php";

$ini = parse_ini_file("dbsettings.ini");

ORM::configure("mysql:host={$ini['dbhost']};dbname={$ini['dbname']}");
ORM::configure("username", $ini['dbuser']);
ORM::configure("password", $ini['dbpassword']);

/*Define constant to connect to database */
DEFINE('DATABASE_HOST',     $ini['dbhost']);
DEFINE('DATABASE_NAME',     $ini['dbname']);
DEFINE('DATABASE_USER',     $ini['dbuser']);
DEFINE('DATABASE_PASSWORD', $ini['dbpassword']);
/*Default time zone ,to be able to send mail */

date_default_timezone_set('UTC');

?>