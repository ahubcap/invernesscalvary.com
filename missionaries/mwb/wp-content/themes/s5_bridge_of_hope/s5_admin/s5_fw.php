<?php
function s5_header_top(){
	$header_html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" ><head><title>';
	if(is_home() && strlen(s5_get_option('xml_s5_blog_heading')) >= 2){
		$header_html .= s5_get_option('xml_s5_blog_heading').' on ';
	}else{
		$header_html .= the_title('',' on ',false);
	}
	$header_html .= get_bloginfo('title');
	$header_html .= '</title><meta http-equiv="Content-Type" content="text/html; ';
	$header_html .= _ISO;
	$header_html .= '" /><meta http-equiv="Content-Style-Type" content="text/css" /><link href="';
	$header_html .= get_bloginfo('template_directory');
	$header_html .= '/favicon.ico" rel="shortcut icon" type="image/x-icon" />';
	//$header_html .= '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/s5_admin/js/mootools124.js"></script>';

	wp_dequeue_script( 'mootools' );
	wp_enqueue_script( 'mootools', get_bloginfo('template_directory').'/s5_admin/js/mootools124.js', '', '1.2.4' );
	wp_enqueue_style('style.css',get_bloginfo('stylesheet_url'));

	echo $header_html;
}

function s5_footer_actions(){
	echo '
	<script type="text/javascript">
    var searchBoxId = "s";
    var searchBoxTerm = "Search The Site...";
    var searchBox = document.getElementById(searchBoxId);
    function setSearchValue(id, val) {var searchBox = document.getElementById(id);searchBox.value = val;}
    setSearchValue(searchBoxId, searchBoxTerm);
    searchBox.onfocus = function() {if(searchBox.value == "" || searchBox.value == searchBoxTerm){setSearchValue(searchBoxId, "");}}
    searchBox.onblur = function() {if(searchBox.value == "") {setSearchValue(searchBoxId, searchBoxTerm);}}
	</script>';
}

add_action('wp_footer', 's5_footer_actions');
add_theme_support( 'post-thumbnails' );

if(defined('_JEXEC')){
	global $s5_jThis; $s5_jThis = $this;}


function s5_get_option($opt_name,$demo=false, $shortname=null){
	$opt_name = str_replace('xml_',THEME_NAME,$opt_name);
	if($shortname == null){$shortname = $opt_name;}
	if(defined('_JEXEC')){	global $s5_jThis;
		$$opt_name = $s5_jthis->params->get($opt_name);$enable=$s5_jthis->params->get('demo_mode');}
	else{$$opt_name = get_option($opt_name);$enable=get_option('demo_mode');}

	if($enable == '1' && $demo != false){
		if(isset($_GET[$shortname])||($_GET['reset']==1)){
			if($_GET[$shortname] != 'default'){
			$_SESSION[$shortname] = $_GET[$shortname];}
			if(($_GET[$shortname] == 'default')||($_GET['reset']==1)){
			unset($_SESSION[$shortname],$_GET[$shortname]);}
			}
		if(isset($_SESSION[$shortname])){
			$$opt_name = $_SESSION[$shortname];}
	}
	if($$opt_name==" " || strtolower($$opt_name)=="none"){$$opt_name=null;}
	return $$opt_name;

}

function s5_gen_sidebar($sb_names,$sb_style='clean'){
	if(!is_array($sb_names)){
		global $themename, $shorttitle, $shortname;
		$sb_title = ucwords(strtolower(str_replace('_',' ',$sb_names)));
		$clean = array(
			'name' =>  __( $sb_title, $shortname ),
			'id' => $sb_names,
		  'description' =>  __( $sb_title, $shortname ),
			'before_widget' => '<div>',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		);
		if ( function_exists('register_sidebar') ){
			register_sidebar($$sb_style);}
	}elseif(is_array($sb_names)){
		foreach($sb_names as $names){
			s5_gen_sidebar($names,$sb_style);
		}
	}
}

function s5_active_sidebar($name){if(is_active_sidebar($name)||isset($_GET['tp'])){return true;}}

function s5_sidebar_sizes($sb_names, $sizes=null,$addpercent=1){
	$count=0;$max=100;
	if($sizes != null && !is_array($sizes)){
		$max=$sizes;
	}
	if(!is_array($sb_names) && s5_active_sidebar($sb_names)){
		$count = 1;
	}
	if(is_array($sb_names)){
		foreach($sb_names as $sb_name){
			if(s5_active_sidebar($sb_name)){$count++;}
		}
	}
	if($count == 0){return $count;}
	elseif(is_array($sizes)){return $sizes[($count-1)];}
	else{
		if($addpercent==1){return floor($max/$count).'%';}
		else{return floor($max/$count);}
	}
}

function s5_get_loop(){
	TTS_custom_loop();}

//Generic Position Widget
function widget_s5_generic_pos($args) {
  global $current_SB_title;
  extract($args);
  echo $before_widget;
  echo $before_title;
  echo $current_SB_title;
  echo $after_title;
  echo 'This is the default '.$current_SB_title.' position widget style.';
  echo $after_widget;
}

function s5_generic_pos_wid()
{
  register_sidebar_widget(__('Generic S5 Positions'), 'widget_s5_generic_pos');
}
add_action("plugins_loaded", "s5_generic_pos_wid");

/** Loop Functions **/
	global $s5_loop_tags;

	if(is_singular()){$s5_loop_tags['is_single'] = 'true';}else{$s5_loop_tags['is_single'] = 'false';}

	function s5_inject_date(){
		global $s5_loop_tags;
		if(! is_page()) {
		$date_block = $s5_loop_tags['date'];
		if(get_the_time()){
			$return = str_replace('%date_day%',get_the_time('j'),$date_block);
			$return = str_replace('%date_month%',get_the_time('M'),$return);
			$return = str_replace('%date_year%',get_the_time('Y'),$return);}
		else{
			$return = str_replace('%date_day%',date('j'),$date_block);
			$return = str_replace('%date_month%',date('M'),$return);
			$return = str_replace('%date_year%',date('Y'),$return);}
		return $return;
		}
		}

	function s5_inject_thumb(){
		global $s5_loop_tags;
		$thumb_block = $s5_loop_tags['thumbnail'];
		if(has_post_thumbnail()) {
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($s5_loop_tags['current_post'], 'thumbnail' ));
			$url = $thumb['0'];
			$return = str_replace('%post_title%',get_the_title(),$thumb_block);
			$return = str_replace('%thumb_path%',$url,$return);}
		else $return = '';
		return $return;
		}

	function s5_loop_blocks($to_filter){
		global $s5_loop_tags;
		if(s5_get_option('xml_s5_show_date')!= 0){
		$return = str_replace('<!--%date_block%-->',s5_inject_date(),$to_filter);}else{$return=$to_filter;}
		if(s5_get_option('xml_s5_show_date')!= 0){
		$return = str_replace('<!--%thumb_block%-->',s5_inject_thumb(),$return);}else{$return=$return;}
		if(strlen(s5_get_option('xml_s5_blog_heading')) >= 2){
		$return = str_replace('<!--%blog_heading%-->',s5_get_option('xml_s5_blog_heading'),$return);}else{$return=$return;}

		return $return;

	}
/** End Loop Functions **/
?>