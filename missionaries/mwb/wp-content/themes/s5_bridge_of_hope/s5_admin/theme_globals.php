<?php
/** Global Variables for Theme Configuration **/
global $s5_wid_styles, $s5_loop_tags;

  /** Generic Widget Styles **/
	$s5_wid_styles['defaults'] = array('default','transparent_box','round_box','round_box_middle','round_box_round_h3');

	/* 'round_box' */
	$s5_wid_styles['round_box']['before_widget'] = '<div id="%id%" class="module%style%"><div><div><div>';
	$s5_wid_styles['round_box']['before_title'] = '<h3 class="s5_mod_h3%style%"><span class="s5_h3_first">';
	$s5_wid_styles['round_box']['after_title'] = '</span></h3>';
	$s5_wid_styles['round_box']['before_content'] = '';
	$s5_wid_styles['round_box']['after_content'] = '';
	$s5_wid_styles['round_box']['after_widget'] = '<div style="clear:both; height:0px"></div></div></div></div></div>';

	/* clean */
	$s5_wid_styles['clean']['before_widget'] = '<div id="%id%" class="module_round_box%style%"><div class="module_round_box_inner"><div class="module_round_box_inner2">';
	$s5_wid_styles['clean']['before_title'] = '<h3 class="s5_mod_h3%style%"><span class="s5_h3_first">';
	$s5_wid_styles['clean']['after_title'] = '</span></h3>';
	$s5_wid_styles['clean']['before_content'] = '';
	$s5_wid_styles['clean']['after_content'] = '';
	$s5_wid_styles['clean']['after_widget'] = '<div style="clear:both; height:0px"></div></div></div></div>';

	/* other */
	$s5_wid_styles['xhtml'] = $s5_wid_styles['clean'];
	$s5_wid_styles['unstyled'] = $s5_wid_styles['clean'];

  /** End Widget Styles **/

  /** WP Loop Styling **/

	$s5_loop_tags['before_loop'] = '<div class="blog">';
	$s5_loop_tags['blog_heading'] = '<div class="s5_maincomponent_wrap_1"><div class="s5_maincomponent_wrap_2"><div class="componentheading"><!--%blog_heading%--></div></div></div>';
	$s5_loop_tags['before_post'] = '<div style="padding:7px;padding-top:14px;padding-bottom:0px;margin-bottom:19px;" class="s5_b_modwrap">';
	$s5_loop_tags['before_title'] = '<table class="contentpaneopen"><tbody><tr><td><div style="float:left;padding-bottom:13px;padding-left:8px;" class="contentheading">';
	$s5_loop_tags['after_title'] = '</div></td></tr></tbody></table>';
	$s5_loop_tags['before_content'] = '<div class="contentpaneopen"><!--%date_block%--><div style="text-transform:none;"><!--%thumb_block%-->';
	$s5_loop_tags['after_content'] = '<div style="clear:both;"></div></div></div>';
	$s5_loop_tags['after_post'] = '<span class="article_separator">&nbsp;</span></div>';
	$s5_loop_tags['after_loop'] = '</div>';
	$s5_loop_tags['date'] = '<div style="float:left;padding-left:17px;width:55px;position:relative;text-align:center;"><div class="s5_daydate">%date_day%</div><span class="s5_first">%date_month%</span><div class="s5_yeardate">%date_year%</div></div>';
	$s5_loop_tags['thumbnail'] = '<img alt="%post_title%" style="position:relative;float:left;padding-right:10px;" src="%thumb_path%" />';


?>