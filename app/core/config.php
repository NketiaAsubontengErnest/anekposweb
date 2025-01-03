<?php
$server = $_SERVER['SERVER_NAME'];
$scheme = $_SERVER['REQUEST_SCHEME'];

define('ROOT', "$scheme://$server/anekpos/public");
define('ASSETS', "$scheme://$server/anekpos/public/assets");
define('HOME', "$scheme://$server/anekpos");
define('HOMEASSET', "$scheme://$server/anekpos/public/homeasset");

/*

define('ROOT', "$scheme://$server/public");
define('ASSETS', "$scheme://$server/public/assets");
define('HOME', "$scheme://$server");
define('HOMEASSET', "$scheme://$server/public/homeasset");

//database variables

define('DBHOST','localhost');
define('DBNAME','mksblkyf_collationcenter');
define('DBUSER','mksblkyf_collationcenter');
define('DBPASS','XPLW2XcqvvNHRYfanEME');
define('DBDRIVER','mysql');
define('COMPANY','MY COLLATION CENTER');
 */

define('DBHOST','localhost');
define('DBNAME','anekpos');
define('DBUSER','root');
define('DBPASS','0554013980A@');
define('DBDRIVER','mysql');
define('COMPANY','ANEK POS');