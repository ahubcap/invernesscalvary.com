<?php
/*
Plugin Name: S5 Accordion Menu
Plugin URI: http://shape5.com
Description: Shape 5 Accordion Menu - This plugin creates a widget which can be placed in the sidebar of your site; the widget is an jQuery accordion-style menu that mirrors your main site menu.
Version: 1.00
*/


include('functions.php');

class s5_acc_mnu extends WP_Widget {
    /** constructor */
    function s5_acc_mnu() {
        parent::WP_Widget(false, $name = 'Shape5 Accordion Menu');
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		if($instance['parent_links'] == "No"){ $parentlinks = '0';} else {$parentlinks = '1';}
		?>

		<?php echo $before_widget; ?>
		<?php if ( $title ){
			echo $before_title . $title . $after_title; }?>
		<?php if ( !$title ){
			echo $before_title . $after_title;} ?>

    <div id="s5_accordion_menu"><div>
    <?php s5_acc_menu_builtin($instance['menu_name']); ?>
    </div></div>

    <?php echo $after_widget; ?>
		<script type="text/javascript">
      var s5_am_parent_link_enabled = "<?php echo $parentlinks ?>";
      <?php if ($browser == "ie6" || $browser == "ie7") { ?>
        var s5_accordion_menu_display = "inline";
      <?php } ?>
      <?php if ($browser != "ie6" && $browser != "ie7") { ?>
       var s5_accordion_menu_display = "block";
      <?php } ?>
    </script>


        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['parent_links'] = $new_instance['parent_links'];
	//$instance['menu_name'] = $new_instance['menu_name'];
    return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
		$defaults = array( 'title' => 'S5 Accordion Menu', 'parent_links' => 'Yes' , 'menu_name' => null );
		$instance = wp_parse_args( (array) $instance, $defaults );
		/*$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		*/?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
<?php /*
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php
			foreach ( $menus as $menu ) {
				$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
			}
		?>
			</select>
		</p>
	  */ ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'parent_links' ); ?>">Enable Parent Links?:</label>
			<select id="<?php echo $this->get_field_id( 'parent_links' ); ?>" name="<?php echo $this->get_field_name( 'parent_links' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'Yes' == $instance['parent_links'] ) echo 'selected="selected"'; ?>>Yes</option>
				<option <?php if ( 'No' == $instance['parent_links'] ) echo 'selected="selected"'; ?>>No</option>
			</select>
		</p>


       <?php
    }

} // class FooWidget

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("s5_acc_mnu");'));

		//if(defined('S5_ACC_PATH') ){
			//define('S5_ACC_PATH', WP_PLUGIN_URL . '/mod_s5_accordion_menu/');}

//function s5_acc_mnu_styles(){echo '<link rel="stylesheet" href="'.S5_ACC_PATH.'css/s5_accordion_menu.css" type="text/css" />';}

//add_action('wp_head','s5_acc_mnu_styles');

function s5_acc_mnu_js(){echo '<script src="'.S5_ACC_PATH.'js/s5_accordion_menu.js" type="text/javascript"></script>';}
add_action('wp_footer','s5_acc_mnu_js');

//wp_enqueue_script( 's5_acc_menu_js', get_bloginfo('template_directory').'/'.$shortname.'/js/s5_accordion_menu.js', false,false,true );

$br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser.

$browser = "other";

if(strrpos($br,"msie 6") > 1) {
$browser = "ie6";
}

if(strrpos($br,"msie 7") > 1) {
$browser = "ie7";
}

?>