<?php
/*	TTS WP Functions
 *	Created and Provided by
 *	Three TEN Seven Design, LLC
 *	http://ThreeTENSeven.com
 *	Coding by Tristan Rineer
 *
 *	This is a collection of custom functions for Wordpress.
 *	Each of the functions in this file was designed to meet
 *	a  specific need that I  discovered while custom-coding
 *	certain aspects of Wordpress that aren't easily modified
 *	with the standard Wordpress core code.
 *
 *	Feel  free to use/modify  any  of  these functions to meet
 *	your specific need (that's  what  they're for), but please
 *	give credit where due when using this file, and leave this
 *	message where it is.
 *
 *	License: GNU GPL
 */
define('TTS_FUNC_ACTIVE',true);

// Function to help force validation of tag structure
// (this function will grow quite a bit over time)

function TTS_Validate($target){

	$target = str_replace(' class=""','',$target);
	$target = str_replace('</span><li','</span></li><li',$target);
	$target = str_replace('</li><ul','<ul',$target);
	$target = str_replace('</span></ul>','</span></li></ul>',$target);
	$target = str_replace('</ul><li','</ul></li><li',$target);
	$target = str_replace('</li></li>','</li>',$target);
//	$target = str_replace('</ul></ul>','</ul></li></ul>',$target);


	return $target;

}

// Functions to create a custom menu structure using whatever
// tag structure you want for up to three levels deep, and any
// number of variations on that structure instead of the standard
// <ul><li><ul><li>... structure given by the wp_page_menu() or
// wp_list_pages() functions in WP Core code.


 function TTS_custom_menu($menu_type,$menu_name='mainmenu'){
	//Feel free to rename the menu types to something other than numbers if needed

	if(!isset($menu_type) || $menu_type == '1' || $menu_type == 'mike'){

		$tags = array(

			//Home Options
			'show_home'			=>	'yes', 		//Do you want to display the "Home" link?
			'home_title'		=>	'Home',		//If so, what should it be labeled as?
			'num_subs'			=>	'2',		//How many sub levels deep before repeating the lowest (make sure to define each level)?
			'active_if_parent'	=>	'true',);	//Use 'true' is you want parent pages to indicate as active when a child/grandchild page is active

			/*	Structure Explanation:
			 *	Menu items will be generated in the following manner:
			 *	[before] URL [pre_title] PAGE TITLE [post_title] (If the menu has sub-menus:
			 *	[pre_sub] SUB MENU WILL BE GENERATED HERE [post_sub]) [after]
			 *	The "post_title" item is for any code that needs to always be generated after the title
			 *	but has to be before any submenus if thre are any.  "pre_sub" and "post_sub" will only
			 *	be generated if there is a submenu to encapsulate (e.g. the "<ul>" would go there - "<li>"s
			 *	would go in the "before" of the sub menu).
			 */

			//Top Level Tag Structure For Menu Items
			//(Use "activeval" & "parentval" to have it replace those items with the "isactive" or "nonactive"
			// and "parent" or "not_parent" values when the appropriate condition is true)

		$tags['level_0'] = array(
			//Top Level
			'pre_level'		=>	'<ul>',
			'before'		=>	'<li class="activeval parentval"><span class="s5_outer_active"><span><a class="active"',
			'pre_title'		=>	'>',
			'post_title'	=>	'<span class="s5_bottom_text"></span></a><span class="s5_outerr"></span></span></span>',
			'after'			=>	'</li>',
			'post_level'	=>	'</ul>',
			'isactive'		=>	'active',
			'nonactive'		=>	'',
			'not_parent'	=>	's5_am_not_parent',
			'parent'		=>	's5_level_one_parent',);

		$tags['level_1'] = array(
			//Sub Level 1 Tag Structure For Menu Items
			'pre_level'		=>	'<ul style="visibility: hidden; display: block;"><li class="s5_toparrow"></li>',
			'before'		=>	'<li class="noback parentval"><span><span class="span_nonactive"><a class="sub parentval"',
			'pre_title'		=>	'>',
			'post_title'	=>	'</a></span></span>',
			'after'			=>	'</li>',
			'post_level'	=>	'<li class="s5_menubottom"></li></ul>',
			'isactive'		=>	'active ',
			'nonactive'		=>	'',
			'not_parent'	=>	'',
			'parent'		=>	'parent',);

		$tags['level_2'] = array(
			//Sub Level 1 Tag Structure For Menu Items
			'pre_level'		=>	'<ul><li class="s5_menutop"/>',
			'before'		=>	'<li><span><span class="span_nonactive"><a class="sub parentval"',
			'pre_title'		=>	'>',
			'post_title'	=>	'</a></span></span>',
			'after'			=>	'</li>',
			'post_level'	=>	'<li class="s5_menubottom"></li></ul>',
			'isactive'		=>	'active ',
			'nonactive'		=>	'',
			'not_parent'	=>	'',
			'parent'		=>	'parent',);

	}

	global $custom_nav_tags;$custom_nav_tags=$tags;

	if(is_nav_menu($menu_name)||has_nav_menu($menu_name)){
		TTS_Validate(wp_nav_menu( array(
			'menu'			=>	$menu_name,
			'container'		=>	false,
			'menu_class'	=>	'',
			'fallback_cb'	=>	'wp_page_menu',
			'echo'			=>	true,
			'depth'			=>	0,
			'walker'		=>	new TTS_menu_walker())
		));
	}else{
		echo $tags['level_0']['pre_level'];
		TTS_BuildMenu($tags);
		echo $tags['level_0']['post_level'];
	}

 }

 function TTS_BuildMenu($tags,$parent=0,$level=0,$depth=0){

	if(!$level || $level == 0){
		$level = 0;
	 	$depth = 0;

		if ($tags['show_home'] === 'yes' || $tags['show_home'] ===  'true'|| $tags['show_home'] === '1'){
			$home = $tags['level_'.$level]['before'].' href="'.home_url('/').'"'.$tags['level_'.$level]['pre_title'].$tags['home_title'].$tags['level_'.$level]['post_title'].$tags['level_'.$level]['after'];
			if(is_front_page()){$home = str_replace('activeval',$tags['level_'.$level]['isactive'],$home);}
			else{$home = str_replace('activeval',$tags['level_'.$level]['nonactive'],$home);}
			echo str_replace('class=" "','',str_replace('parentval','',$home));

		}

	}

 	$arguments = array(
		'sort_order' 	=>	'asc',
		'sort_column'	=>	'menu_order',
		'hierarchical' 	=> 	0,
		'parent' 		=>	$parent,
		'child_of' 		=> 	$parent);
	$pages = get_pages($arguments);
	foreach ($pages as $pagg) {
		$children = wp_list_pages("title_li=&child_of=".$pagg->ID."&echo=0");

		if($children){$is_parent = $tags['level_'.$level]['parent'];}
		else{$is_parent = $tags['level_'.$level]['not_parent'];}

		if(is_page($pagg->ID)){$is_active = $tags['level_'.$level]['isactive'];}
		else{$is_active = $tags['level_'.$level]['nonactive'];}

		$before = $tags['level_'.$level]['before'].' href="'.get_page_link($pagg->ID).'"'.$tags['level_'.$level]['pre_title'];
		$before = str_replace('parentval',$is_parent,$before);
		$before = str_replace('activeval',$is_active,$before);
		$option .= $before;
		$option .= $pagg->post_title;
		$option .= $tags['level_'.$level]['post_title'];

		if($children){
			$level ++;
			$depth ++;
			if($level>=$tags['num_subs']){$level = $tags['num_subs'];}
			$option .= $tags['level_'.$level]['pre_level'];
			$parent = $pagg->ID;
			$option .= TTS_BuildMenu($tags,$parent,$level,$depth);
			$option .= $tags['level_'.$level]['post_level'];
			if($depth==$level){$level--;$depth--;
			}else{$depth--;
			}
		}

	}
	$option .= $tags['level_'.$level]['after'];


	$option = str_replace(' class=""','',$option);
	$option = str_replace('</span><li','</span></li><li',$option);
	$option = str_replace('</span></ul>','</span></li></ul>',$option);
	$option = str_replace('</ul><li','</ul></li><li',$option);
	$option = str_replace('</li></li>','</li>',$option);
	if($level==0){echo $option;
	}else{return $option;}

}
function TTS_custom_loop($style='default'){
	global $shortname;
	if($style=='default'){

	get_template_part( $shortname.'/loop', 'index' );

	}

}

class TTS_menu_walker extends Walker_Nav_Menu{
	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl(&$output, $depth) {
		global $custom_nav_tags, $TTS_walker_level;
		if(!isset($TTS_walker_level)){$TTS_walker_level=0;}
		$level=$TTS_walker_level;
		$tags=$custom_nav_tags;
		if($level>=$tags['num_subs']){$level = $tags['num_subs'];}
		$output .= $tags['level_'.$level]['pre_level'];
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el(&$output, $item, $depth, $args) {
		global $custom_nav_tags, $TTS_walker_level;
		if(!isset($TTS_walker_level)){$TTS_walker_level=0;}
		$level=$TTS_walker_level;
		$tags=$custom_nav_tags;
		if($level>=$tags['num_subs']){$level = $tags['num_subs'];}
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		/*if(strpos($class_names,'current')){$is_active=true;}
		if(strpos($class_names,'ancestor')){$is_parent=true;}*/
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		//$class_names = str_replace(array('current-menu-ancestor','current-menu-parent','current_page_parent','current_page_ancestor'),$tags['level_'.$level]['parent'].' '.$tags['level_'.$level]['isactive'],$class_names);
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		//$output .= $indent . '<li' /*. $id . $value */. $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		//$attributes .= ' temp="'   . $class_names .'"' ;

		$item_output = $tags['level_'.$level]['before'];//$args->before;
		$item_output .= $attributes;
		$item_output .= $tags['level_'.$level]['pre_title'] . apply_filters( 'the_title', $item->title, $item->ID ) . $tags['level_'.$level]['post_title'];

		if(check_in_string($class_names,array('current-menu-ancestor','current-menu-parent','current_page_parent','current_page_ancestor','current-menu-item','current_page_item'))&& $custom_nav_tags['active_if_parent']!=false){
			$item_output = str_replace('activeval',$tags['level_'.$level]['isactive'],$item_output);
			$custom_nav_tags['active_if_parent']=false;
		}else{
			$item_output = str_replace('activeval',$tags['level_'.$level]['nonactive'],$item_output);
		}

		if(check_in_string($class_names,array('has_children','current-menu-ancestor','current-menu-parent','current_page_parent','current_page_ancestor'))||in_array('has_children',$classes)){
			$item_output = str_replace('parentval',$tags['level_'.$level]['parent'],$item_output);
		}else{
			$item_output = str_replace('parentval',$tags['level_'.$level]['not_parent'],$item_output);
		}



		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		$TTS_walker_level++;
	}

	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 */
	function end_el(&$output, $item, $depth) {
		global $custom_nav_tags, $TTS_walker_level;
		if(!isset($TTS_walker_level)){$TTS_walker_level=0;}
		$TTS_walker_level--;
		$level=$TTS_walker_level;
		$tags=$custom_nav_tags;
		if($level>=$tags['num_subs']){$level = $tags['num_subs'];}
		$output .= $tags['level_'.$level]['after'];
	}



	/**
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function end_lvl(&$output, $depth) {
		global $custom_nav_tags, $TTS_walker_level;
		if(!isset($TTS_walker_level)){$TTS_walker_level=0;}
		$level=$TTS_walker_level;
		$tags=$custom_nav_tags;
		if($level>=$tags['num_subs']){$level = $tags['num_subs'];}
		$output .= $tags['level_'.$level]['post_level'];
		$output = TTS_Validate($output);
	}
}

class TTS_Widgets{

	function check_defaults($default,$style){
		$defaults = array(
					'default',
					'transparent_box',
					'round_box',
					'round_box_middle'
					,'round_box_round_h3',
					$default);
		return check_in_string($style,$defaults);
	}

	function check_title($style){
		$return = false;
		if(strpos($style,'no_title')||strpos($style,'notitle')){$return=true;}
		return $return;
	}

	function before_widget($default,$style,$id,$suffix=''){
		global $s5_wid_styles;
		$style = str_replace('default','',$style);
		if(strpos($style,'-')==FALSE){$style = ''.$style;}
		$return = str_replace('%style%',$style,str_replace('%id%',$id,$s5_wid_styles["$default"]['before_widget']));
		if($this->check_title($style)){
			$return .= str_replace('%style%',$style,str_replace('%id%',$id,$s5_wid_styles["$default"]['before_content']));
		}
		if($style==='clean'){$return = '<div id="'.$id.'" class="moduletable">';}
		if($style==='unstyled'){$return = '<div id="'.$id.'">';}
		if($_GET['tp']=='1'){$return .= '<span style="text-transform:none;">Widget ID = '.$id.'</span>';}
		return str_replace(array(' notitle',' no_title','notitle','no_title'),'',$return);
	}
	function before_title($default,$style,$id,$suffix=''){
		global $s5_wid_styles;
		$style = str_replace('default','',$style);
		if(strpos($style,'-')==FALSE){$style = ''.$style;}
		$return2 = str_replace('%style%',$style,str_replace('%id%',$id,$s5_wid_styles["$default"]['before_title']));
		if($style==='clean'){$return2 = '<h3>';}
		if($style==='unstyled'){$return2 = '<h3>';}
		if($this->check_title($style)){$return2 ='<!--';}
		return str_replace(array(' notitle',' no_title','notitle','no_title'),'',$return2);
	}
	function after_title($default,$style,$id,$suffix=''){
		global $s5_wid_styles;
		$style = str_replace('default','',$style);
		if(strpos($style,'-')==FALSE){$style = ''.$style;}
		$return3 = str_replace('%style%',$style,str_replace('%id%',$id,$s5_wid_styles["$default"]['after_title']));
		$return3 .= str_replace('%style%',$style,str_replace('%id%',$id,$s5_wid_styles["$default"]['before_content']));
		if($style==='clean'){$return3 = '</h3>';}
		if($style==='unstyled'){$return3 = '</h3>';}
		if($this->check_title($style)){$return3 ='-->';}
		return str_replace(array(' notitle',' no_title','notitle','no_title'),'',$return3);
	}
	function after_widget($default,$style,$id,$suffix=''){
		global $s5_wid_styles;
		$style = str_replace('default','',$style);
		if(strpos($style,'-')==FALSE){$style = ' '.$style;}
		$return4 = str_replace('%style%',$style,str_replace('%id%',$id,$s5_wid_styles["$default"]['after_content']));
		$return4 .= str_replace('%style%',$style,str_replace('%id%',$id,$s5_wid_styles["$default"]['after_widget']));
		if($style==='clean'){$return4 = '<div style="clear:both"></div></div>';}
		if($style==='unstyled'){$return4 = '<div style="clear:both"></div></div>';}
		return str_replace(array(' notitle',' no_title','notitle','no_title'),'',$return4);
	}
}

global $wid_get;
$wid_get = new TTS_Widgets;

function check_in_string($haystack, $needles) {
    if ( is_array($needles) ) {
        foreach ($needles as $str) {
            if ( is_array($str) ) {
                $pos = check_in_string($haystack, $str);
            } else {
                $pos = strpos($haystack, $str);
            }
            if ($pos !== FALSE) {
                return $pos;
            }
        }
    } else {
        return strpos($haystack, $needles);
    }
}

//Fix menu child detection
function check_for_submenu($classes, $item) {
    global $wpdb, $post;
    if ($item->ID == $post->ID) array_push($classes,'current_menu_item');
    $has_children = $wpdb->get_var("SELECT COUNT(meta_id) FROM wp_postmeta WHERE meta_key='_menu_item_menu_item_parent' AND meta_value='".$item->ID."'");
    if ($has_children > 0) {
        array_push($classes,'has_children');
        $child_pages = $wpdb->get_col("SELECT c.meta_value FROM wp_postmeta AS c, wp_postmeta AS th
                                      WHERE c.meta_key = '_menu_item_object_id' AND c.post_id = th.meta_value
                                      AND th.meta_key= '_menu_item_menu_item_parent' AND th.post_id = {$item->ID}");
        if (in_array($post->ID,$child_pages)) array_push($classes,'current_menu_parent');
    }
    return $classes;
}

add_filter( 'nav_menu_css_class', 'check_for_submenu', 10, 2);
?>