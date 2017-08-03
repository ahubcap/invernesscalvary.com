<?php
/**
@version 1.0: mod_s5_image_fader
Author: Shape 5 - Professional Template Community
Available for download at www.shape5.com
*/

global $AccM_Values, $s5_wid_styles;
$AccM_Values = $instance;

function s5_AccM_get_option($opt_name,$demo=false, $shortname=null){
	global $AccM_Values;
	if($shortname == null){$shortname = $opt_name;}
	if(!defined('_JEXEC')){$$opt_name = $AccM_Values["$opt_name"];}

	if($enable = '1' && $demo != false){
		if(AccMset($_GET[$shortname])||($_GET['reset']==1)){
			if($_GET[$shortname] != 'default'){
			$_SESSION[$shortname] = $_GET[$shortname];}
			if(($_GET[$shortname] == 'default')||($_GET['reset']==1)){
			unset($_SESSION[$shortname],$_GET[$shortname]);}
			}
		if(AccMset($_SESSION[$shortname])){
			$$opt_name = $_SESSION[$shortname];}
	}
	if($$opt_name==" "){$$opt_name=null;}
	return $$opt_name;

}


$showAll	= isset($instance['showAllChildren']) ? $instance['showAllChildren'] : '';
$parentlinks = $instance['parentlinks'];
$br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser.
$browser = "other";
if(strrpos($br,"msie 6") > 1) {
$browser = "ie6";
}
if(strrpos($br,"msie 7") > 1) {
$browser = "ie7";
}
$template_vertex = "no";
$template_json_location = get_theme_root() . '/' . get_template().'/vertex';
if(file_exists($template_json_location)) {
$template_vertex = "yes";
}
?>
<script type="text/javascript">
var s5_am_parent_link_enabled = "<?php echo $parentlinks ?>";
<?php if ($browser == "ie6" || $browser == "ie7") { ?>
var s5_accordion_menu_display = "inline";
<?php } ?>
<?php if ($browser != "ie6" && $browser != "ie7") { ?>
var s5_accordion_menu_display = "block";
<?php } ?>
</script>
<?php if(true){ ?>
	<?php if($template_vertex == "no"){ ?>
	<script type="text/javascript">//<![CDATA[
	if(jQuery.easing.easeOutExpo==undefined){
    document.write('<script src="<?php echo $this->check_override('js/jquery-ui.min.js');?>"><\/script>');
    }
	//]]></script>
	<?php } ?>
<script src="<?php echo $this->check_override('js/s5_accordion_menu_jquery.js');?>" type="text/javascript"></script>
<script type="text/javascript">jQuery.noConflict();</script>
<?php } ?>