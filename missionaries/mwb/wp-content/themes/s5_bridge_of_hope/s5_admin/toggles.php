<?php

//Plugin Include Toggles
if(s5_get_option('s5_page_links_disable')!='1'){
include('plugins/page-links-to.php');}

if(s5_get_option('s5_page_iinclude_disable')!='1'){
include('plugins/iinclude_page.php');}

if(s5_get_option('s5_page_exclude_disable')!='1'){
include('plugins/exclude-pages/exclude_pages.php');}

if(s5_get_option('s5_widget_classes_disable')!='1'){
include('plugins/widget-classes/widget-classes.php');}

if(s5_get_option('s5_widget_context_disable')!='1'){
	include('plugins/widget-context/widget-context.php');}

if(s5_get_option('s5_accordion_disable')!='1'){
	include('plugins/mod_s5_accordion_menu/mod_s5_accordion_menu.php');}



//Feature Toggles

if(s5_get_option('s5_disable_filters')!='0'){
	remove_filter('the_content', 'wpautop');
	remove_filter('the_content', 'convert_chars');
	remove_filter('the_content', 'wptexturize');}

?>