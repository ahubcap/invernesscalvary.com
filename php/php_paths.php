<?php
define('PATH_BASE_PHP'	, dirname(__FILE__).DIRECTORY_SEPARATOR);
define('PATH_LIB'		, PATH_BASE_PHP.'lib'.DIRECTORY_SEPARATOR);
define('PATH_CODE'		, PATH_BASE_PHP.'code');
define('PATH_DOC_ROOT'	, $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR);

//define('DB_HOST', 'localhost');
//define('DB_DB', 'lappelectric_com');
//define('DB_USER', 'lappelectric');
//define('DB_PASS', 'ZL@pp3lectr1c#!');

ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.PATH_LIB);
?>