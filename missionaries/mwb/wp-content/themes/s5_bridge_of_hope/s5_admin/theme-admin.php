<?php

define('ADMIN_PATH', dirname(__file__));
define('TYPE', 'WP'); //Defines Type PHPBB or WP
define('THEME_NAME', $shortname . '_'); //The style name goes here it transforms all the xml_ vars to start with your style name :)
define('XML_PATH', ADMIN_PATH . '/opts_list.xml'); //This is the path to the XML file
require('theme_globals.php');
require('TTS_func/TTS_WP_FUNC.php');
require ('s5_fw.php');
require ('toggles.php');

//Menu Functions
function s5_page_menu($name=null){
	TTS_custom_menu('1',$name);
}

function mosShowListMenu($menu_name){
	s5_page_menu('mainmenu');
}
//Parse Sidebar Positions

function parse_sb_pos(){

    $file = XML_PATH;
    $xml = simplexml_load_file($file) or die("feed not loading");
    $i = 0;
	if(!isset($xml->positions->position)){return;}
    foreach ($xml->positions->position as $key => $position)
    {
      s5_gen_sidebar("$position");
      $i++;
    }

}
parse_sb_pos();

//Parse Sidebar Styles

function parse_sb_styles(){

    $file = XML_PATH;
    $xml = simplexml_load_file($file) or die("feed not loading");
    $i = 0;
	global $sb_styles;
	if(!isset($xml->colors->color)){return;}
	foreach ($xml->colors->color as $key => $color)
    {
      $sb_styles[$i] = $color;
      $i++;
    }

}
parse_sb_styles();

require ('vertex/functions.php');

require ('vertex/dropdown_func.php');

function mytheme_add_admin()
{

    global $themename, $shortname, $options;

    if ($_GET['page'] == basename(__file__))
    {

        if ('save' == $_REQUEST['action'])
        {

            $display_vars = array('vars' => getBuildAdmin());

            $cfg_array = array();
            $error = array();

            if ($_GET['page'] == basename(__file__))
            {

                if ('save' == $_REQUEST['action'])
                {

                    foreach ($display_vars['vars'] as $config_key => $vars)
                    {
                        update_option($config_key, $_REQUEST[$config_key]);
                    }

                    foreach ($display_vars['vars'] as $config_key => $vars)
                    {
                        if (isset($_REQUEST[$config_key]))
                        {
                            update_option($config_key, $_REQUEST[$config_key]);
                        } else
                        {
                            delete_option($config_key);
                        }
                    }

                    header("Location: themes.php?page=theme-admin.php&saved=true");
                    //die;

                } else
                    if ('reset' == $_REQUEST['action'])
                    {

                        foreach ($display_vars['vars'] as $config_key => $vars)
                        {
                            delete_option($config_key);
                        }

                        header("Location: themes.php?page=theme-admin.php&reset=true");
                        die;

                    }
            }

            header("Location: themes.php?page=theme-admin.php&saved=true");
            //die;

        } elseif ('reset' == $_REQUEST['action'])
        {
            $display_vars = array('vars' => getBuildAdmin());

            $cfg_array = array();
            $error = array();

            foreach ($display_vars['vars'] as $config_key => $vars)
            {
                delete_option($config_key);
            }

            header("Location: themes.php?page=theme-admin.php&reset=true");
            die;

        }
    }

    add_theme_page("S5 Theme Options", "S5 Theme Options", 'edit_themes', basename(__file__), 'mytheme_admin');

}

require ('vertex/main.php');

add_action('admin_menu', 'mytheme_add_admin');


//Custom Menu Capability

if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'mainmenu', 'Main Menu' );
}


automatic_feed_links();

//Module Positions
//parse_sb_pos();

//Validation fix for search widget

function valid_search_form ($form) {
    return str_replace('role="search" ', '', $form);
}
add_filter('get_search_form', 'valid_search_form');


?>