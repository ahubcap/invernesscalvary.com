<?php

/**
 * Display dynamic sidebar.
 *
 * By default it displays the default sidebar or 'sidebar-1'. The 'sidebar-1' is
 * not named by the theme, the actual name is '1', but 'sidebar-' is added to
 * the registered sidebars for the name. If you named your sidebar 'after-post',
 * then the parameter $index will still be 'after-post', but the lookup will be
 * for 'sidebar-after-post'.
 *
 * It is confusing for the $index parameter, but just know that it should just
 * work. When you register the sidebar in the theme, you will use the same name
 * for this function or "Pay no heed to the man behind the curtain." Just accept
 * it as an oddity of WordPress sidebar register and display.
 *
 * @since 2.2.0
 *
 * @param int|string $index Optional, default is 1. Name or ID of dynamic sidebar.
 * @return bool True, if widget sidebar was found and called. False if not found or not called.
 */
function s5_sidebar($index = 1,$default='clean') {
	global $wp_registered_sidebars, $wp_registered_widgets;

	if ( is_int($index) ) {
		$index = "sidebar-$index";
	} else {
		$index = sanitize_title($index);
		foreach ( (array) $wp_registered_sidebars as $key => $value ) {
			if ( sanitize_title($value['name']) == $index ) {
				$index = $key;
				break;
			}
		}
	}

	$sidebars_widgets = wp_get_sidebars_widgets();

	if ( empty($wp_registered_sidebars[$index]) || !array_key_exists($index, $sidebars_widgets) || !is_array($sidebars_widgets[$index]) || empty($sidebars_widgets[$index]) )
		return false;

	$sidebar = $wp_registered_sidebars[$index];

	$did_one = false;
	foreach ( (array) $sidebars_widgets[$index] as $id ) {

		if ( !isset($wp_registered_widgets[$id]) ) continue;

		$params = array_merge(
			array( array_merge( $sidebar, array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']) ) ),
			(array) $wp_registered_widgets[$id]['params']
		);

		// Substitute HTML id and class attributes into before_widget
		$classname_ = '';
		foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn ) {
			if ( is_string($cn) )
				$classname_ .= '_' . $cn;
			elseif ( is_object($cn) )
				$classname_ .= '_' . get_class($cn);
		}

		$classname_ = ltrim($classname_, '_');
		$params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, $classname_); //Original Method

	//New Method
		global $sb_styles, $wid_get;
		/*Add Widget Flags*/
		$flag = get_settings('s5_widget_flags');
		if(isset($flag[$id])){
		$s_flag = $flag[$id];}
		else{$s_flag='';}
		if($s_label == '-none'){$s_flag='';}
		/*End Widget Flags*/
		$class = get_settings('s5_widget_styles');
		if(isset($class[$id]) && $class['id'] != 'default'){
		$s_label = $class[$id];}
		else{$s_label=$default;}
		if($s_label==$default || $s_label == 'default'){$s_flag='';}
		//$s_label = str_replace('default',$default,$s_label);
		//print $s_label;
		$params[0]['before_widget'] = $wid_get->before_widget($default,$s_label,$id,$s_flag);
		$params[0]['before_title'] = $wid_get->before_title($default,$s_label,$id,$s_flag);
		$params[0]['after_title'] = $wid_get->after_title($default,$s_label,$id,$s_flag);
		$params[0]['after_widget'] = $wid_get->after_widget($default,$s_label,$id,$s_flag);


		unset($wid_count);

		$params = apply_filters( 'dynamic_sidebar_params', $params );

		$callback = $wp_registered_widgets[$id]['callback'];

		do_action( 'dynamic_sidebar', $wp_registered_widgets[$id] );

		if ( is_callable($callback) ) {
			call_user_func_array($callback, $params);
			$did_one = true;
		}
	}

	return $did_one;
}

function s5_show_sidebar($name=1,$default='default'){
	global $current_SB_title;
	$title = ucwords(strtolower(str_replace('_',' ',$name)));
	$current_SB_title = $title;
	$show_before = '<div class="mod-preview"><div class="mod-preview-info">';
	$show_before .= "Sidebar Position: ";
	$show_before .= $title;
	$show_before .='</div><div class="mod-preview-wrapper"><br />';

	$show_after = '</div></div>';
	if(isset($_GET['tp'])){ echo $show_before; } s5_sidebar($name,$default);
	if(isset($_GET['tp'])){ echo $show_after; }
}


//Add "the_breadcrumb()" function to allow for placing an inline breadcrumb


function the_breadcrumb() {
	global $post;
	global $shortname;
	$before_crumbs = '<div class="moduletable"><span class="breadcrumbs pathway">';
	$before_first_item = '';
	$before_item = ' /&nbsp; ';
	$before_last_item = ' /&nbsp; ';
	$before_link = '<a class="pathway" href="';
	$before_title = '">';
	$after_title = '</a>';
	$after_first_item = '';
	$after_item = '';
	$after_last_item = '';
	$after_crumbs = '</span></div>';
	echo $before_crumbs;
	if (!is_home()) {
		echo $before_first_item;
		echo $before_link;
		echo get_option('home');
		echo $before_title;
		bloginfo('name');
		echo $after_title;
		echo $after_first_item;
		if (is_category() || is_single()) {
			single_cat_title();
			if (is_single()) {
				echo $before_last_item;
				echo the_title();
				echo $after_last_item;
			}

		} elseif ( is_page() && $post->post_parent ) {
			$anc = get_post_ancestors($post);
			foreach($anc as $ancestor);{
				echo $before_item;
				echo $before_link. get_permalink($ancestor).$before_title;
				echo get_the_title($ancestor);
				echo $after_title;
				echo $after_item;
				if($ancestor != $post->post_parent){
					echo $before_item;
					echo $before_link.get_permalink($post->post_parent).$before_title;
					echo get_the_title($post->post_parent);
					echo $after_title;
					echo $after_item;
				}

			}
			echo $before_last_item;
			echo the_title();
			echo $after_last_item;

		} elseif (is_page()) {
			echo $before_last_item;
			echo the_title();
			echo $after_last_item;
		}

		elseif (is_tag()) {
			echo $before_last_item;
			single_tag_title();
			echo $after_last_item;
		}
		elseif (is_day()) {
			echo $before_last_item;
			echo"Archive for "; the_time('F jS, Y');
			echo $after_last_item;
		}
		elseif (is_month()) {
			echo $before_last_item;
			echo"Archive for "; the_time('F, Y');
			echo $after_last_item;
		}
		elseif (is_year()) {
			echo $before_last_item;
			echo"Archive for "; the_time('Y');
			echo $after_last_item;
		}
		elseif (is_author()) {
			echo $before_last_item;
			echo"Author Archive";
			echo $after_last_item;
		}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
			echo $before_last_item;
			echo "Blog Archives";
			echo $after_last_item;
		}
		elseif (is_search()) {
			echo $before_last_item;
			echo"Search Results";
			echo $after_last_item;
		}
	}
	elseif (is_home()) {
		echo $before_first_item;
		echo $before_link;
		echo get_option('home');
		echo $before_title;
		bloginfo('name');
		echo $after_title;
		echo $after_first_item;
	}

	echo $after_crumbs;

}

?>