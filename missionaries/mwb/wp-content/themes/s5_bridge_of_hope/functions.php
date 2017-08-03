<?php
session_start();
global $shorttitle,$themename,$shortname;
$themename = "Shape 5 Bridge of Hope";
$shorttitle = $shortname = "bridge";

define('THEMEDIR', dirname(__FILE__));
define('DS','/');
define('TEMPLATEURL', THEMEDIR.DS.$shortname);
define('S5_ACC_PATH', get_bloginfo('template_directory').DS.'s5_admin/plugins/mod_s5_accordion_menu/');
require('s5_admin/theme-admin.php');

add_filter('widget_text', 'do_shortcode');

?>