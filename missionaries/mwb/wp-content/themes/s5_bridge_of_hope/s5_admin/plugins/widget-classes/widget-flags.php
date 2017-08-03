<?php
/*
Plugin Name: Widget Classes
Plugin URI: http://blog.aizatto.com/widget-classes
Description: Allows you to add classes to widgets
Author: Ezwan Aizat Bin Abdullah Faiz
Author URI: http://aizatto.com
Version: 0.1
License: LGPLv2
*/

// wp-includes/widgets.php:273
add_action('in_widget_form',         array('s5_widget_flags', 'in_widget_form'), 10, 3);
add_filter('widget_update_callback', array('s5_widget_flags', 'widget_update_callback'), 10, 4);
//add_filter('dynamic_sidebar_params', array('s5_widget_flags', 'dynamic_sidebar_params'));
add_filter('sidebar_admin_setup',    array('s5_widget_flags', 'sidebar_admin_setup'));

class s5_widget_flags {
	/**
     * Ideally all classes are children of the WP_Widget class.
     *
     * Sometimes they are not, for example 'twitter-for-wordpress' and 'akismet'.
     *
     * For these widges which avoid using WP_Widget class, they circumvent a hook which
     * allows me to append the CSS Class form to the bottom of the widget.
     *
     * Instead we intercept the hook, and have it call our own function, which
     * will allow us to inject our the form into the widget.
	 */
	function sidebar_admin_setup() {
		global $wp_registered_widget_controls;

		foreach ($wp_registered_widget_controls as $widget_id => $options) {
			if (is_array($options['callback'])) {
				continue;
			}

			$wp_registered_widget_controls[$widget_id]['_params']   = $wp_registered_widget_controls[$widget_id]['params'];
			$wp_registered_widget_controls[$widget_id]['_callback'] = $wp_registered_widget_controls[$widget_id]['callback'];
			$wp_registered_widget_controls[$widget_id]['params']    = $widget_id;
			$wp_registered_widget_controls[$widget_id]['callback']  = array(__CLASS__, 'intercept');
		}
	}

	/**
     * Injects the CSS class into the 'before_widget' value
     */
	function dynamic_sidebar_params($params) {
		global $wp_registered_sidebars, $wp_registered_widgets;

		$widget_id = $params[0]['widget_id'];
		$widget = $wp_registered_widgets[$widget_id];

		if (! is_array($widget['callback'])) {
			$options = get_option('s5_widget_flags', array());

			if (! array_key_exists($widget_id, $options)) {
				return $params;
			}

			$flag = $options[$widget_id];

		} else {
			$instance = $widget['callback'][0]->get_settings();

			if (! array_key_exists($params[1]['number'], $instance)) {
				return $params;
			}

			$instance = $instance[$params[1]['number']];

			if (! is_array($instance) || ! array_key_exists('flag', $instance)) {
				return $params;
			}

			$flag = $instance['flag'];
		}

		// I don't understand the purpose of this, but it was used in the
        // wp-includes/widgets.php, so I am reproducing it here
		$classname_ = '';
		foreach ( (array) $widget['classname'] as $cn ) {
			if ( is_string($cn) )
				$classname_ .= '_' . $cn;
			elseif ( is_object($cn) )
				$classname_ .= '_' . get_class($cn);
		}
		$classname_ = ltrim($classname_, '_');
		$classname_ .= ' ' . $flag;

		$before_widget = $wp_registered_sidebars[$params[0]['id']]['before_widget'];
		$params[0]['before_widget'] = sprintf($before_widget, $widget['id'], $flagname_);

		return $params;
	}

	/**
     * Our hook which allows us to intercept and inject into widgets which
     * do not use WP_Widget
     */
	function intercept($widget_id) {
		global $wp_registered_widget_controls;
		$callback = $wp_registered_widget_controls[$widget_id]['_callback'];
		$params   = $wp_registered_widget_controls[$widget_id]['_params'];

		$return   = call_user_func_array($callback, $params);

		$options = get_option('s5_widget_flags', array());

		if (! array_key_exists($widget_id, $options)) {
			$options[$widget_id] = '';
		}

		$old_flag = $new_flag = $options[$widget_id];

		if (array_key_exists($widget_id . '-flag', $_POST)) {
			$new_flag = $options[$widget_id] = $_POST[$widget_id . '-flag'];
		}

		self::form($widget_id . '-flag', $widget_id . '-flag', $new_flag);

		if ($old_flag != $new_flag) {
			update_option('s5_widget_flags', $options);
		}

		return $return;
	}

	/**
     * Hook used by WP_Widget and its children
     */
	function in_widget_form($widget, $return, $instance) {
		$instance = wp_parse_args( (array) $instance, array( 'flag' => '' ) );
		$flag = strip_tags($instance['flag']);
		$wid_id = str_replace('-flag','',str_replace('widget-','',$widget->get_field_id('flag')));
		$return = null;
		self::form($widget->get_field_id('flag'), $widget->get_field_name('flag'), $flag, $wid_id);
	}

	/**
     * Simple form to expose the CSS Class form.
     */
	function form($id, $name, $value, $wid_id) {
		global $sb_styles;?>
		<!--p>
			<label for="<?php echo $id; ?>"><?php _e('Widget Style for '.$wid_id.':'); ?>
				<select class="widefat" id="<?php echo $id; ?>" name="<?php echo $name; ?>">
				<?php
					foreach ( $sb_styles as $style ) {
						$selected = $value == $style ? ' selected="selected"' : '';
						echo '<option'. $selected .' value="'. $style .'">'. $style .'</option>';
					}
				?>
				</select>
			</label>
		</p-->
		<p>
			<label for="<?php echo $id; ?>"><?php _e('Widget Flag for '.$wid_id.':'); ?></label>
			<input id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" style="width:100%;" />
		</p>


<?php
	}

	/**
     * Hook used by WP_Widget and its children
     */
	function widget_update_callback($instance, $new_instance, $old_instance, $widget) {
		global $s5_wid_flag_id;
		if (array_key_exists('flag', $new_instance)) {
			$instance['flag'] = str_replace(',', ' ', $new_instance['flag']);
		}
			$option = get_settings('s5_widget_flags');
			$wid_id = str_replace('-flag','',str_replace('widget-','',$widget->get_field_id('flag')));
			$option[$wid_id] = $instance['flag'];
			update_option('s5_widget_flags', $option);


		return $instance;
	}
}
