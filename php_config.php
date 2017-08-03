<?php
if (!defined('INCLUDE_OK')) {
	header('Location: /');
	exit;
}

//require_once str_replace(DIRECTORY_SEPARATOR.'htdocs', DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT']).'php_paths.php';

require_once $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'php_paths.php';
$code = PATH_CODE.$_SERVER['SCRIPT_NAME'];
if (file_exists($code)) {
	require_once $code;
}

?>