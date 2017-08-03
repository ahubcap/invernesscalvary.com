<?php

if ( !defined('WP_CONTENT_URL') )
	define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
if ( !defined('WP_PLUGIN_URL') )
	define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' );

// Custom Menu Creation
//if(!defined('TTS_FUNC_ACTIVE')){require_once('inc/TTS_WP_FUNC.php');}

function s5_acc_menu_builtin($menu_name=null){

	$home = '<h3 activeval class="s5_am_not_parent not_parent"><span class="s5_accordion_menu_left"><a class="mainlevel" href="' . home_url( '/' ) . '">	<span>Home</span></a></span></h3><div class="s5_accordion_menu_element" style="overflow: hidden; padding: 0px; margin: 0px; opacity: 0; border: medium none; display: block; height: 0px; visibility: hidden;"></div>';
	if(is_front_page()){$home = str_replace('activeval','id="current"',$home);}
	else{$home = str_replace('activeval','',$home);}
	echo $home;


 	$arguments = array(
		'sort_order' 	=>	'asc',
		'sort_column'	=>	'menu_order',
		'hierarchical' 	=> 	0,
		'parent' 		=>	0);
  $pages = get_pages($arguments);
  foreach ($pages as $pagg) {
 	$children = wp_list_pages("title_li=&child_of=".$pagg->ID."&echo=0");
	if($children){$is_parent = 's5_am_parent ';}
	else{$is_parent = 's5_am_not_parent ';}
	if(is_page($pagg->ID)){$is_active = 'id="current"';}
	else{$is_active = '';}
 	$option = '<h3 '.$isactive.' class="'.$is_parent.'s5_am_toggler"><span class="s5_accordion_menu_left"><a class="mainlevel" href="'.get_page_link($pagg->ID).'"><span>';
	$option .= $pagg->post_title;
	$option .= '</span></a></span></h3><div class="s5_accordion_menu_element" style="overflow: hidden; padding: 0px; margin: 0px; opacity: 0; border: medium none; display: block; height: 0px; visibility: hidden;">';

	if($children){
		$option .= '
		<ul class="s5_am_innermenu">';
		$parent = $pagg->ID;
		$arguments = array(
			'sort_order' 	=>	'asc',
			'sort_column'	=>	'menu_order',
			'hierarchical' 	=> 	0,
			'parent' 		=>	$parent,
			'child_of' 		=> 	$parent);
		$sub1_pages = get_pages($arguments);
		foreach($sub1_pages as $pagg_1){
		 	$children = wp_list_pages("title_li=&child_of=".$pagg_1->ID."&echo=0");
			$sub_1 = '<li class="s5_am_inner_li"><span class="s5_accordion_menu_left"><a href="'.get_page_link($pagg_1->ID).'" class="mainlevel"><span>';
			$sub_1 .= $pagg_1->post_title;
			$sub_1 .= '</span></a></span>';

				if($children){
					$sub_1 .= '<ul class="s5_am_innermenu">';
					$parent = $pagg_1->ID;
					$arguments = array(
						'sort_order' 	=>	'asc',
						'sort_column'	=>	'menu_order',
						'hierarchical' 	=> 	1,
						'parent' 		=>	$parent,
						'child_of' 		=> 	$parent);
					$sub2_pages = get_pages($arguments);
					foreach($sub2_pages as $pagg_2){
						$children = wp_list_pages("title_li=&child_of=".$pagg_2->ID."&echo=0");
						$sub_2 = '<li class="s5_am_inner_li"><span class="s5_accordion_menu_left"><a href="'.get_page_link($pagg_2->ID).'" class="mainlevel"><span>';
						$sub_2 .= $pagg_2->post_title;
						$sub_2 .= '</span></a></span>';

						if($children){
							$sub_2 .= '
							<ul class="s5_am_innermenu">';
							$parent = $pagg_2->ID;
							$arguments = array('hierarchical' => 1, 'parent' => $parent, 'child_of' => $parent);
							$sub3_pages = get_pages($arguments);
							foreach($sub3_pages as $pagg_3){
								$children = wp_list_pages("title_li=&child_of=".$pagg_3->ID."&echo=0");
								$sub_3 = '<li class="s5_am_inner_li"><span class="s5_accordion_menu_left"><a href="'.get_page_link($pagg_3->ID).'" class="mainlevel"><span>';
								$sub_3 .= $pagg_3->post_title;
								$sub_3 .= '</span></a></span>';

								$sub_3 .= '</li>';
								$sub_2 .= $sub_3;

							}
							$sub_2 .= '</li></ul>';
						}

						$sub_1 .= $sub_2;
					}
					$sub_1 .= '</li></ul>';
				}

			$option .= $sub_1;
		}
		$option .= '</ul>';
	}
	$option .= '</div>';
	$option = str_replace(' class=""','',$option);
	$option = str_replace('</span><li','</span></li><li',$option);
	$option = str_replace('</span></ul>','</span></li></ul>',$option);
	$option = str_replace('</ul><li','</ul></li><li',$option);
	$option = str_replace('</li></li>','</li>',$option);
	$option = str_replace('</ul></ul>','</ul></li></ul>',$option);

	echo $option;
  }
 ?>
<?php
}



?>
