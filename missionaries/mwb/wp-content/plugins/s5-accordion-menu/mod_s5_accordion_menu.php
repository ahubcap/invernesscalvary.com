<?php
/*
Plugin Name: S5 Accordion Menu
Plugin URI: http://s5co.us/IFDetails
Description: Shape 5 Accordion Menu - This plugin creates a widget which can be placed in the sidebar of your site; the widget is an jQuery accordion-style menu that mirrors your main site menu.
Version: 2.0.2
Author: Shape 5 LLC
Author URI: http://www.shape5.com
License: GPL2
*/
/*  Copyright 2011  Shape 5 LLC (email : contact@shape5.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
require_once('accordion_menu_walker.php');

class S5_Acc_Menu_Widget extends WP_Widget {

  var $plugin_dir;
  var $wid_instance;

	function __construct() {
		$this->plugin_dir = plugins_url( '/' , __FILE__ );
		$this->override_folder = 'mod_s5_accordion_menu';
		$this->xml_dir = plugin_dir_path( __FILE__ );
		$widget_ops = array( 'description' => __('Use this widget to add one of your custom menus as an accordion menu widget.') );
		if(true){
			add_action('wp_head',array(&$this,'print_head'));
			add_action('wp_footer',array(&$this,'print_foot'));
			$acc_script = $this->check_override('js/s5_accordion_menu_jquery.js');
			//wp_enqueue_script('s5_accordion_menu',$acc_script,false,true);
		}


		parent::WP_Widget(false, __('Shape5 Accordion Menu'), $widget_ops );
	}

	function print_head(){

	}

	function print_foot(){
		if(!file_exists(get_theme_root() . '/' . get_template().'/vertex')){
			echo '<script type="text/javascript">//<![CDATA[
				if(jQuery.easing.easeOutExpo==undefined){
				document.write(\'<script src="'.$this->check_override('js/jquery-ui.min.js').'"><\/script>\');
				}
				//]]></script>';
		}
		//echo '<script src="'.$this->check_override('js/s5_accordion_menu_jquery.js').'"></script>';
		//echo '<script type="text/javascript">jQuery.noConflict();</script>';
	}

	function check_override($filename){
		$this->override_path = get_theme_root() . '/' . get_template().'/html/'.$this->override_folder;
		$this->override_url = get_bloginfo('template_url').'/html/'.$this->override_folder;

		$has_override = file_exists($this->override_path.'/'.$filename)? true : false;
		if($has_override){ return $this->override_url.'/'.$filename;}
		else{ return $this->plugin_dir.'/'.$filename;}
	}

	function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
		if ( !$nav_menu )
			return;
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo $args['before_widget'];
		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		wp_nav_menu( array(
			'fallback_cb' 	  => '',
			'container'       => false,
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'items_wrap'      => '<div id="s5_accordion_menu"><div>%3$s</div></div>',
			'menu_id'         => '',
			'menu'			  => $nav_menu,
			'depth' 		  => $instance['endLevel'],
			'walker'		  => new Accordion_Menu_Walker(),
			'walker_arg' 	  => $instance,)
		);
		require_once('params.php');
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		$instance = $new_instance;
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>" class="widefat" style="width:100%;">
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $nav_menu, $menu->term_id, false )
					. '>'. $menu->name . '</option>';
			}
		?>
			</select>
		</p>
        <?php include('tmpl/form.php');
	}
}

add_action('widgets_init', create_function('', 'return register_widget("S5_Acc_Menu_Widget");'));