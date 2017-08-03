<?php s5_header_top(); ?>

<!--Google Web Fonts-->
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

<?php
      function is_iPhone($agent='') {
	  $s5_isiphone;
      if(empty($agent)) $agent = $_SERVER['HTTP_USER_AGENT'];
      if(!empty($agent) and preg_match("~Mozilla/[^ ]+ \((iPhone|iPod); U; CPU [^;]+ Mac OS X; [^)]+\) AppleWebKit/[^ ]+ \(KHTML, like Gecko\) Version/[^ ]+ Mobile/[^ ]+ Safari/[^ ]+~",$agent,$match)) {
      return "YES"; } elseif(stristr($agent,'iphone') or stristr($agent,'ipod')){
      return "YES";} else {return "NO"; }}
	  $s5_isiphone = is_iPhone();
?>
<?php if ($s5_isiphone == "YES") { ?>
<meta name="viewport" content="width=370;" />
<?php } ?>
<?php if ($s5_isiphone == "YES") { ?><link href="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/css/template_iphone.css" rel="stylesheet" type="text/css" media="screen" /><?php } ?>
<?php if ($s5_isiphone == "NO") { ?><link href="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/css/template.css" rel="stylesheet" type="text/css" media="screen" /><?php } ?>

<script type="text/javascript">//<![CDATA[
document.write('<link href="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/css/editor.css" rel="stylesheet" type="text/css" media="screen" />');
//]]></script>
<?php
// Disable lytebox when VM is loaded
if (false) {
 } else { ?>
<?php if ($s5_lytebox  == "yes") { ?>
<link href="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/css/lytebox.css" rel="stylesheet" type="text/css" media="screen" />
<?php } ?>
<?php } ?>
<link href="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/css/suckerfish.css" rel="stylesheet" type="text/css" media="screen" />
<?php if ($s5_effects == "jq") { ?>
<?php if (($s5_menu  == "1") || ($s5_menu  == "3") || ($s5_menu  == "4")) { ?>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/js/jquery13.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/js/jquery.no.conflict.js"></script>
<script type="text/javascript">
function s5_jqmainmenu(){
jQuery(" #navlist ul ").css({display: "none"}); // Opera Fix
jQuery(" #s5_navv li").hover(function(){
		jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).<?php if ($s5_menu  == "1") { ?>show(400)<?php } ?><?php if ($s5_menu  == "3") { ?>fadeIn("fast")<?php } ?><?php if ($s5_menu  == "4") { ?>slideDown("fast")<?php } ?>;
		},function(){jQuery(this).find('ul:first').css({visibility: "hidden"});	});}
  jQuery(document).ready(function(){ s5_jqmainmenu();});
</script>
<?php } ?>
<?php } ?>
<?php
// Disable lytebox when VM is loaded
if ($something == 'com_virtuemart' ) {
 } else { ?>
<?php if ($s5_lytebox  == "yes") { ?>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/js/lytebox.js"></script>
<?php } ?>
<?php } ?>

<?php if ($s5_subtext == "yes") {
echo "<script language=\"javascript\" type=\"text/javascript\" >var s5_text_menu_1 = '".$s5_text_menu_1."';</script>";
echo "<script language=\"javascript\" type=\"text/javascript\" >var s5_text_menu_2 = '".$s5_text_menu_2."';</script>";
echo "<script language=\"javascript\" type=\"text/javascript\" >var s5_text_menu_3 = '".$s5_text_menu_3."';</script>";
echo "<script language=\"javascript\" type=\"text/javascript\" >var s5_text_menu_4 = '".$s5_text_menu_4."';</script>";
echo "<script language=\"javascript\" type=\"text/javascript\" >var s5_text_menu_5 = '".$s5_text_menu_5."';</script>";
echo "<script language=\"javascript\" type=\"text/javascript\" >var s5_text_menu_6 = '".$s5_text_menu_6."';</script>";
echo "<script language=\"javascript\" type=\"text/javascript\" >var s5_text_menu_7 = '".$s5_text_menu_7."';</script>";
echo "<script language=\"javascript\" type=\"text/javascript\" >var s5_text_menu_8 = '".$s5_text_menu_8."';</script>";
echo "<script language=\"javascript\" type=\"text/javascript\" >var s5_text_menu_9 = '".$s5_text_menu_9."';</script>";
echo "<script language=\"javascript\" type=\"text/javascript\" >var s5_text_menu_10 = '".$s5_text_menu_10."';</script>";
}?>


<?php
$br = strtolower($_SERVER['HTTP_USER_AGENT']);
$browser = "other";

if(strrpos($br,"msie 6") > 1) {
$is_ie6 = "yes";}
else {$is_ie6 = "no";}

if(strrpos($br,"msie 7") > 1) {
$is_ie7 = "yes";}
else {$is_ie7 = "no";}

if(strrpos($br,"msie 8") > 1) {
$is_ie8 = "yes";}
else {$is_ie8 = "no";}
?>

<?php if ($is_ie6 == "yes" || $is_ie7 == "yes" || $is_ie8 == "yes") { ?>
<?php if (($s5_menu  == "1") || ($s5_menu  == "2") || ($s5_menu  == "3") || ($s5_menu  == "4")) { ?>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/js/IEsuckerfish.js"></script>
<?php } ?>
<?php } ?>
<!--[if IE]>
	<style type="text/css">
	#s5_navv ul li.s5_menubottom, #s5_fm_ul0 ul li.s5_menubottom, #s5_navv ul li.s5_menubottom:hover, #s5_fm_ul0 ul li.s5_menubottom:hover {
	background:none;
	filter:
	progid:dximagetransform.microsoft.alphaimageloader(src='<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/images/default/Shape5_bridgeofhope_menubottom.png', sizingmethod='crop');}

	#s5_navv ul li.s5_menutop, #s5_navv ul li.s5_menutop:hover {
	background:none;
	filter:
	progid:dximagetransform.microsoft.alphaimageloader(src='<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/images/default/Shape5_bridgeofhope_menutop.png', sizingmethod='crop');}
	</style>
<![endif]-->

<?php if ($is_ie6 == "yes") { ?>
<!--[if IE 6]>
	<?php include("templates/bridgeofhope/iestyles.php"); ?>
<![endif]-->
<?php } ?>

<style type="text/css">
.s5_wrap {width:<?php echo ($s5_body_width);?>;}
body, h5,h4,h3,h2,h1, a { color:#<?php echo ($s5_fontcolor);?>;}
#s5_menubar, #s5_getmaincolheight .s5_b_modwrap .contentheading, #s5_getmaincolheight .s5_b_modwrap a, #s5_breadcrumbs, #s5_breadcrumbs a, .s5_backmiddlemiddle, .s5_whitemodleftwrap, body div.module-h3 div div div, #s5_navv a, .s5_b_modwrap, #s5_navv li ul, #s5_navv ul li:hover ul li span span a, #s5_navv ul li.over ul li span span a, #s5_navv ul li:hover ul li a, #s5_navv ul li.over ul li a, #s5_navv ul li a.parent:hover, #s5_navv ul li ul li a.parent:hover{
color:#<?php echo ($s5_fontcolor);?>;background-color:#<?php echo ($s5_sitecolor);?>;}
#s5_accordion_menu h3.s5_am_open {background:none;}
#s5_accordion_menu h3.s5_am_toggler {background:#<?php echo ($s5_accordcolor);?>;border:none;position:static;}
ul.menu-mainmenu li a, a.mainlevel {border-bottom:1px dotted #<?php echo ($s5_accordcolor);?>;}
#s5_rightcolumn div.module-mod1 div div div, #s5_leftcolumn div.module-mod1 div div div {background:#<?php echo ($s5_mod1);?>;}
#s5_rightcolumn div.module-mod2 div div div, #s5_leftcolumn div.module-mod2 div div div {background:#<?php echo ($s5_mod2);?>;}
.s5_w_modwrap div.module-user1 div div, .s5_backmiddlemiddle div.module-user1 div div {background:#<?php echo ($s5_user1);?>;}
.s5_w_modwrap div.module-user2 div div, .s5_backmiddlemiddle div.module-user2 div div{background:#<?php echo ($s5_user2);?>;}
.s5_backmiddlemiddle ul li {border-bottom:1px solid #222222;}
body div h3 span.s5_h3_first, .s5_first, .contentheading, #s5_navv a span {color:#<?php echo ($s5_highlightcolor);?>;}
#s5_getmaincolheight, #s5_getmaincolheight .contentheading, #s5_getmaincolheight a, #s5_getmaincolheight h3, #s5_getmaincolheight h2, #s5_getmaincolheight h1, #s5_getmaincolheight h4, #s5_getmaincolheight h5,#s5_footermiddle li a, #s5_footermiddle, #s5_footermiddle a {color:#<?php echo $s5_mainbodcolor;?>;}
#s5_navv ul li.s5_menubottom, #s5_fm_ul0 ul li.s5_menubottom, #s5_navv ul li.s5_menubottom:hover, #s5_fm_ul0 ul li.s5_menubottom:hover {
	background: url(<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/images/Shape5_BridgeofHope_menubottom.png) repeat-x bottom;}
<?php if(s5_active_sidebar('right')) { ?>
#s5_mainbody {margin-right:<?php echo ($s5_right_width) + 20;?>px;}
<?php } ?><?php if(s5_active_sidebar('left')) { ?>
#s5_mainbody {margin-left:<?php echo ($s5_left_width) + 20;?>px;}
<?php } ?>
<?php if ($s5_isiphone == "YES") { ?>
#s5_accordion_menu h3.s5_am_toggler {font-size:22px;}
#s5_rightcolumn, #s5_leftcolumn {margin:0px;float:none;margin-bottom:13px;padding-right:0px;}
<?php } ?>
<?php if ($is_ie6 == "yes") { ?>

#s5_navv ul li.s5_menubottom, #s5_fm_ul0 ul li.s5_menubottom, #s5_navv ul li.s5_menubottom:hover, #s5_fm_ul0 ul li.s5_menubottom:hover {
	background-image:none;}

<?php } ?>
<?php if(s5_get_option('xml_s5_logourl')){?>#s5_logo { background: url("<?php echo s5_get_option('xml_s5_logourl'); ?>") no-repeat scroll 0 0 transparent;}<?php } ?>
</style>
<?php wp_head();?> </head>
<?php if ($s5_isiphone == "YES") { ?>
<body style="background:<?php echo $s5_backcolor; ?> url(<?php echo $s5_headerback; ?>) repeat;">
<div style="background:transparent url(<?php echo $s5_backimage; ?>) repeat-x;">
<br/>
<center>
<img src="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/images/MWB_logo1.png" alt="logo" onclick="window.document.location.href='index.php'"/>
</center>
<div style="clear:both;"></div>
<br />
<br />
<div id="s5_rightcolumn">
<?php s5_show_sidebar("iphone_top","round_box"); ?>
</div>
<br/><br/>
<div style="clear:both;"></div>
<div id="s5_leftcolumn">
<?php s5_show_sidebar("iphone_bottom","round_box"); ?>
</div>
<br/><br/>
<div style="clear:both;"></div>
<div style="margin:0 auto;width:82px;">
<?php if ($s5_twitter  != "") { ?>
				<div id="s5_twitter" onclick="window.document.location.href='<?php echo $s5_twitter; ?>'"></div>
	<?php } ?>
	<?php if ($s5_facebook  != "") { ?>
				<div id="s5_facebook" onclick="window.document.location.href='<?php echo $s5_facebook; ?>'"></div>
<?php } ?>
<div style="clear:both;"></div>
</div>
<br/><br/>
<div style="text-align:center;">
<?php include("templates/bridgeofhope/footer.php"); ?></div>
<br/>
</div>
</body>
<?php } ?>

<?php if ($s5_isiphone == "NO") { ?>
<body style="background:<?php echo $s5_backcolor; ?> url(<?php echo get_bloginfo('template_directory').'/'.$shortname;?><?php echo $s5_headerback; ?>) repeat;">
<div style="background:transparent url(<?php echo $s5_backimage; ?>) repeat-x;">
<!-- Header -->
<div class="s5_wrap">

	<div id="s5_logo" style="cursor:pointer;" onclick="window.document.location.href='index.php'"></div>


	<div id="s5_iconsearch">
		<div id="s5_footicons">
			<?php if ($s5_rss  != "") { ?>
				<div id="s5_rss" onclick="window.document.location.href='<?php echo $s5_rss; ?>'"></div>
			<?php } ?>
			<?php if ($s5_twitter  != "") { ?>
				<div id="s5_twitter" onclick="window.document.location.href='<?php echo $s5_twitter; ?>'"></div>
			<?php } ?>
			<?php if ($s5_facebook  != "") { ?>
				<div id="s5_facebook" onclick="window.document.location.href='<?php echo $s5_facebook; ?>'"></div>
			<?php } ?>

		</div>

		<div style="clear:both;"></div>

		<?php if(s5_active_sidebar('search')) { ?>
			<div id="s5_topgradsearch">
				<?php s5_show_sidebar("search","no_title"); ?>
			</div>
		<?php } ?>
	</div>
	<div style="clear:both;"></div>



	<?php if (($s5_menu  == "1") || ($s5_menu  == "2") || ($s5_menu  == "3") || ($s5_menu  == "4")) { ?>
	<div class="s5_backcolor" id="s5_menubar">
		<!-- Start Menu -->
			<div id="s5_menu">
				<?php if ($s5_shadows == "yes") { ?>
				<div id="s5_topmenushadleft"></div><?php } ?>
				<div id="s5_navv">

							<?php mosShowListMenu($menu_name);	?>
							<?php if ($s5_effects == "s5") { ?>
							<?php if ($s5_menu  == "1") { ?>
								<script type="text/javascript" src="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/js/s5_no_moo_menu.js"></script>
							<?php } ?>
							<?php if ($s5_menu  == "3") { ?>
								<script type="text/javascript" src="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/js/s5_fading_no_moo_menu.js"></script>
							<?php } ?>
							<?php if ($s5_menu  == "4") { ?>
								<script type="text/javascript" src="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/js/s5_scroll_down_no_moo_menu.js"></script>
							<?php } ?>
							<?php } ?>
				</div>
				<?php if ($s5_shadows == "yes") { ?>
				<div id="s5_topmenushadright"></div><?php } ?>
			</div>
		<!-- End Menu -->
	</div>
	<?php } ?>

</div>
<!-- End Header -->



<div style="clear:both;"></div>



<?php if(s5_active_sidebar('topleft')) { ?>
<!-- Top Module -->
<div class="s5_wrap">
<?php if ($s5_shadows == "yes") { ?>
<div id="s5_topmodshadleft"></div><?php } ?>
		<div class="s5_toplefrig">
				<?php if(s5_active_sidebar('topleft')) { ?>
					<div id="s5_topleft" style="width:100%;">
						<?php s5_show_sidebar("topleft","round_box"); ?>
					</div>
				<?php } ?>
			<?php if ($s5_shadows == "yes") { ?>
			<div id="s5_topmodshadright"></div><?php } ?>
		</div>
</div>
<!-- End Top Module -->
<?php } ?>






<div style="clear:both;"></div>

<div class="s5_wrap">
<?php if(s5_active_sidebar('advert1') || s5_active_sidebar('advert2') || s5_active_sidebar('advert3')) { ?>
<!-- Adverts -->
<div class="s5_w_modwrap">
	<?php if(s5_active_sidebar('advert1')) { ?>
		<div id="s5_advert1_<?php echo $advert; ?>">
			<?php s5_show_sidebar("advert1","round_box"); ?>
		</div>
	<?php } ?>
	<?php if(s5_active_sidebar('advert2')) { ?>
		<div id="s5_advert2_<?php echo $advert; ?>">
			<?php s5_show_sidebar("advert2","round_box"); ?>
		</div>
	<?php } ?>
	<?php if(s5_active_sidebar('advert3')) { ?>
		<div id="s5_advert3_<?php echo $advert; ?>">
			<?php s5_show_sidebar("advert3","round_box"); ?>
		</div>
	<?php } ?>
	<div style="clear:both;"></div>
</div>
<!-- End Adverts -->
<?php } ?>






<div style="clear:both;"></div>


<?php if(s5_get_option('xml_s5_breadcrumb_toggle')=='1') { ?>

<!-- Breadcrumbs -->
	<div id="s5_breadcrumbs">
		<div id="s5_breadcrumbsinner">
			<?php the_breadcrumb (); ?>
		</div>
	</div>
<!-- End Breadcrumbs -->

<?php } ?>



<!-- Main Body -->
<div style="width:100%;margin-bottom:20px;overflow:hidden;position:relative;">


	<div id="s5_mainbodyfullw">
	<div id="s5_mainbodywrapper">
	<div id="s5_mainbody">
		<div id="s5_middlecolwrap">
								<div class="s5_mainmiddleinnerwrap" style="padding-bottom:3px;">
									<div id="s5_getmaincolheight">
									<div class="s5_mainmiddle_padding">
									<?php if ($is_ie6 == "yes") { ?>
									<div style="position:relative;">
									<?php } ?>
										<?php if(s5_active_sidebar('user1') || s5_active_sidebar('user2')) { ?>
											<div id="s5_positions">
												<?php if(s5_active_sidebar('user1')) { ?>
													<div id="s5_user1_<?php echo $user23; ?>">
														<?php s5_show_sidebar("user1","round_box"); ?>
													</div>
												<?php } ?>
												<?php if(s5_active_sidebar('user2')) { ?>
													<div id="s5_user2_<?php echo $user23; ?>">
														<?php s5_show_sidebar("user2","round_box"); ?>
													</div>
												<?php } ?>
											</div>
											<div style="clear:both;"></div>
										<?php } ?>

											<?php s5_get_loop(); ?>

										<?php if ($is_ie6 == "yes") { ?>
										</div>
										<?php } ?>
										<div style="clear:both;"></div>
									</div>
									</div>

					<div style="clear:both;"></div>


				</div>
			</div>
		</div>
	</div>



	<?php if(s5_active_sidebar('left')) { ?>
	<div id="s5_leftcolumn" style="width:<?php echo ($s5_left_width) + 1;?>px;">
		<div style="clear:both;"></div>
		<div class="s5_whitemodleftwrap">
			<div class="s5_whitemodrightwrap">
				<div class="s5_backmiddlemiddle_r" style="width:<?php echo ($s5_left_width) - 13;?>px;">
					<?php s5_show_sidebar("left","round_box"); ?>
				<div style="clear:both;"></div>
				</div>
			</div>
		</div>
		<div style="clear:both;"></div>

	</div>
	<?php } ?>


	<?php if(s5_active_sidebar('right')) { ?>
	<div id="s5_rightcolumn" style="width:<?php echo ($s5_right_width) + 1;?>px;margin-left:-<?php if(s5_active_sidebar('left') && s5_active_sidebar('right')) { echo (($s5_right_width) + ($s5_right_width) - 77); } else { echo ($s5_right_width) + 1; } ?>px;">
		<div class="s5_whitemodleftwrap">
			<div class="s5_whitemodrightwrap">
				<div class="s5_backmiddlemiddle_r" style="width:<?php echo ($s5_right_width) - 13;?>px;">

						<?php s5_show_sidebar("right","round_box"); ?>

					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>



	<?php if(s5_active_sidebar('contentbottom1') || s5_active_sidebar('contentbottom2') || s5_active_sidebar('contentbottom3')) { ?>
	<div style="clear:both;"></div>
	<div class="s5_w_modwrap" style="width:50%;">
		<!-- Start User 1-3 -->
				<?php if(s5_active_sidebar('contentbottom1')) { ?>
					<div id="s5_contentbottom1_<?php echo $contentbottom; ?>">
						<?php s5_show_sidebar("contentbottom1","round_box"); ?>
					</div>
				<?php } ?>
				<?php if(s5_active_sidebar('contentbottom2')) { ?>
					<div id="s5_contentbottom2_<?php echo $contentbottom; ?>">
						<?php s5_show_sidebar("contentbottom2","round_box"); ?>
					</div>
				<?php } ?>
				<?php if(s5_active_sidebar('contentbottom3')) { ?>
					<div id="s5_contentbottom3_<?php echo $contentbottom; ?>">
						<?php s5_show_sidebar("contentbottom3","round_box"); ?>
					</div>
				<?php } ?>
				<div style="clear:both;"></div>
		<!-- EndUser 1-3 -->
	</div>


	<div style="clear:both;"></div>
	<?php } ?>
	</div>

</div>


	<div style="clear:both;"></div>
</div>
<!-- End Main Body -->



<?php if(s5_active_sidebar('advert4') || s5_active_sidebar('advert5') || s5_active_sidebar('advert6')) { ?>
<div style="clear:both;width:100%;"></div>
<div class="s5_wrap">
	<div class="s5_w_modwrap">
		<!-- Start Advert 1-3 -->
				<?php if(s5_active_sidebar('advert4')) { ?>
					<div id="s5_advert4_<?php echo $advert2; ?>">
						<?php s5_show_sidebar("advert4","round_box"); ?>
					</div>
				<?php } ?>
				<?php if(s5_active_sidebar('advert5')) { ?>
					<div id="s5_advert5_<?php echo $advert2; ?>">
						<?php s5_show_sidebar("advert5","round_box"); ?>
					</div>
				<?php } ?>
				<?php if(s5_active_sidebar('advert6')) { ?>
					<div id="s5_advert6_<?php echo $advert2; ?>">
						<?php s5_show_sidebar("advert6","round_box"); ?>
					</div>
				<?php } ?>
				<div style="clear:both;"></div>
		<!-- End Advert 1-3 -->
	</div>
	<div style="clear:both;"></div>
</div>
<?php } ?>



<?php if(s5_active_sidebar('user3') || s5_active_sidebar('user4') || s5_active_sidebar('user5') || s5_active_sidebar('user6') || s5_active_sidebar('user7')) { ?>
<!-- Bottom Modules -->
<div style="clear:both;width:100%;"></div>
<div class="s5_wrap">
					<div class="s5_backmiddlemiddle">
						<?php if ($s5_shadows == "yes") { ?>
						<div id="s5_botmodshadleft"></div><?php } ?>
							<?php if(s5_active_sidebar('user3')) { ?>
								<div id="s5_user3_<?php echo $bottom4; ?>">
									<?php s5_show_sidebar("user3","round_box"); ?>
								</div>
							<?php } ?>
							<?php if(s5_active_sidebar('user4')) { ?>
								<div id="s5_user4_<?php echo $bottom4; ?>">
									<?php s5_show_sidebar("user4","round_box"); ?>
								</div>
							<?php } ?>
							<?php if(s5_active_sidebar('user5')) { ?>
								<div id="s5_user5_<?php echo $bottom4; ?>">
									<?php s5_show_sidebar("user5","round_box"); ?>
								</div>
							<?php } ?>
							<?php if(s5_active_sidebar('user6')) { ?>
								<div id="s5_user6_<?php echo $bottom4; ?>">
									<?php s5_show_sidebar("user6","round_box"); ?>
								</div>
							<?php } ?>
							<?php if(s5_active_sidebar('user7')) { ?>
								<div id="s5_user7_<?php echo $bottom4; ?>">
									<?php s5_show_sidebar("user7","round_box"); ?>
								</div>
							<?php } ?>
						<?php if ($s5_shadows == "yes") { ?>
						<div id="s5_botmodshadright"></div><?php } ?>
						<div style="clear:both;"></div>
					</div>
	<div style="clear:both;"></div>
</div>
<!-- End Bottom Modules -->

<?php } ?>









<div style="clear:both;"></div>




<!-- Footer -->

<div class="s5_wrap">
		<div id="s5_footermiddle">
			<div id="s5_footerwrap">
				<?php if(s5_active_sidebar('bottom')) { ?>
				<div id="s5_footermenu">
						<?php if ($is_ie6 == "yes") { ?>
						<div style="position:absolute;">
						<?php } ?>
							<?php s5_show_sidebar("bottom","no_title"); ?>
						<?php if ($is_ie6 == "yes") { ?>
						</div>
						<?php } ?>
					<div style="clear:both;"></div>
				</div>
				<?php } ?>


			</div>
			<div id="s5_footcopy">
				<?php include("footer.php"); ?>
			</div>

			<div style="clear:both;"></div>

			<div id="s5_logofooter">
				<img src="<?php
				if(s5_get_option('xml_s5_logourl')){echo s5_get_option('xml_s5_logourl');}
				else{echo get_bloginfo('template_directory').'/'.$shortname;?>/images/logo.png<?php } ?>"
				alt="S5 Logo" width="143" height="54"/>
			</div>
		</div>
</div>
<!-- End Footer -->




<div style="height:30px;clear:both;"></div>



<?php if (($s5_menu  == "1") || ($s5_menu  == "2") || ($s5_menu  == "3") || ($s5_menu  == "4")) { ?>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/js/s5_suckerfish.js"></script>
<?php } ?>
<?php if ($s5_tooltips  == "yes") { ?>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/js/tooltips.js"></script>
<?php } ?>
<?php if(s5_active_sidebar('debug')) { ?>
	<?php s5_show_sidebar("debug","no_title"); ?>
<?php } ?>

</div>
<?php if (($s5_menu  == "1") || ($s5_menu  == "2") || ($s5_menu  == "3") || ($s5_menu  == "4")) { ?>
<?php if ($s5_subtext == "yes") { ?>
	<script type="text/javascript" src="<?php echo get_bloginfo('template_directory').'/'.$shortname;?>/js/s5_textmenu.js"></script>
<?php } ?>
<?php } ?>
<?php wp_footer();?> </body>
<?php } ?>
</html>