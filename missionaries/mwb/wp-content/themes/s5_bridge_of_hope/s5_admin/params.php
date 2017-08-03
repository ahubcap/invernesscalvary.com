<?php
///////////////////////////////////////////////////////////////////////////////////////

	$s5_menu = s5_get_option ("xml_s5_menu",1,'menu');
	$s5_effects = 'jq';
	$s5_text_menu_1 = s5_get_option  ("xml_s5_text_menu_1");
	$s5_text_menu_2 = s5_get_option  ("xml_s5_text_menu_2");
	$s5_text_menu_3 = s5_get_option  ("xml_s5_text_menu_3");
	$s5_text_menu_4 = s5_get_option  ("xml_s5_text_menu_4");
	$s5_text_menu_5 = s5_get_option  ("xml_s5_text_menu_5");
	$s5_text_menu_6 = s5_get_option  ("xml_s5_text_menu_6");
	$s5_text_menu_7 = s5_get_option  ("xml_s5_text_menu_7");
	$s5_text_menu_8 = s5_get_option  ("xml_s5_text_menu_8");
	$s5_text_menu_9 = s5_get_option  ("xml_s5_text_menu_9");
	$s5_text_menu_10 = s5_get_option  ("xml_s5_text_menu_10");
	$s5_subtext = s5_get_option  ("xml_s5_subtext");
	$s5_body_width = s5_get_option  ("xml_s5_body_width");
	$s5_left_width = s5_get_option  ("xml_s5_left_width");
	$s5_right_width = s5_get_option  ("xml_s5_right_width");
	$s5_shadows = s5_get_option  ("xml_s5_shadows");
	$s5_mainbodcolor  = s5_get_option  ("xml_s5_mainbodcolor");
	$s5_fontcolor = s5_get_option  ("xml_s5_fontcolor");
	$s5_sitecolor = s5_get_option  ("xml_s5_sitecolor");
	$s5_accordcolor = s5_get_option  ("xml_s5_accordcolor");
	$s5_mod1 = s5_get_option  ("xml_s5_mod1");
	$s5_mod2 = s5_get_option  ("xml_s5_mod2");
	$s5_user1 = s5_get_option  ("xml_s5_user1");
	$s5_user2 = s5_get_option  ("xml_s5_user2");
	$s5_highlightcolor = s5_get_option  ("xml_s5_highlightcolor",1,'color');
	$s5_tooltips = s5_get_option  ("xml_s5_tooltips");
	$s5_lytebox = s5_get_option  ("xml_s5_lytebox");
	$s5_headerback  = s5_get_option  ("xml_s5_headerback");
	$s5_backimage  = s5_get_option  ("xml_s5_backimage");
	$s5_subtext = s5_get_option("xml_s5_subtext");
	$s5_login = s5_get_option  ("xml_s5_login");
	$s5_facebook  = s5_get_option  ("xml_s5_facebook");
	$s5_twitter = s5_get_option  ("xml_s5_twitter");
	$s5_rss = s5_get_option  ("xml_s5_rss");
	$s5_backcolor = s5_get_option  ("xml_s5_backcolor");
	$s5_urlforSEO = s5_get_option  ("xml_s5_seourl");


// It is recommended that you do not edit below this line.
///////////////////////////////////////////////////////////////////////////////////////
$s5_jsmenu = "jq";
$menu_name = s5_get_option ("xml_menuname");

if ($s5_urlforSEO  == ""){
$LiveSiteUrl = get_bloginfo('url');}
if ($s5_urlforSEO  != ""){
$LiveSiteUrl = get_bloginfo('url');}

$br = strtolower($_SERVER['HTTP_USER_AGENT']);
$browser = "other";

if(strrpos($br,"msie 7") > 1) {
$browser = "ie7";}

if(strrpos($br,"msie 8") > 1) {
$browser = "ie8";}



// Module size calculations

// Middle content calculations
if (!s5_active_sidebar("left") && !s5_active_sidebar("right")) { $s5_mainbody_width = (($s5_body_width) - 39); }
else if (s5_active_sidebar("left") && !s5_active_sidebar("right")) { $s5_mainbody_width = $s5_body_width - ($s5_left_width + 52);}
else if (!s5_active_sidebar("left") && s5_active_sidebar("right")) { $s5_mainbody_width = $s5_body_width - ($s5_right_width + 52);}
else if (s5_active_sidebar("left") && s5_active_sidebar("right")) { $s5_mainbody_width = $s5_body_width - (($s5_left_width + $s5_right_width) + 66); }

// advert 1, 2, and 3 collapse calculations
if (s5_active_sidebar("advert1") && s5_active_sidebar("advert2")  && s5_active_sidebar("advert3")) { $advert="33"; }
else if (s5_active_sidebar("advert1") && s5_active_sidebar("advert2") && !s5_active_sidebar("advert3")) { $advert="50"; }
else if (s5_active_sidebar("advert1") && !s5_active_sidebar("advert2") && s5_active_sidebar("advert3")) { $advert="50"; }
else if (!s5_active_sidebar("advert1") && s5_active_sidebar("advert2") && s5_active_sidebar("advert3")) { $advert="50"; }
else if (s5_active_sidebar("advert1") && !s5_active_sidebar("advert2") && !s5_active_sidebar("advert3")) { $advert="100"; }
else if (!s5_active_sidebar("advert1") && s5_active_sidebar("advert2") && !s5_active_sidebar("advert3")) { $advert="100"; }
else if (!s5_active_sidebar("advert1") && !s5_active_sidebar("advert2") && s5_active_sidebar("advert3")) { $advert="100"; }

// advert 4, 5, and 6 collapse calculations
if (s5_active_sidebar("advert4") && s5_active_sidebar("advert5")  && s5_active_sidebar("advert6")) { $advert2="33"; }
else if (s5_active_sidebar("advert4") && s5_active_sidebar("advert5") && !s5_active_sidebar("advert6")) { $advert2="50"; }
else if (s5_active_sidebar("advert4") && !s5_active_sidebar("advert5") && s5_active_sidebar("advert6")) { $advert2="50"; }
else if (!s5_active_sidebar("advert4") && s5_active_sidebar("advert5") && s5_active_sidebar("advert6")) { $advert2="50"; }
else if (s5_active_sidebar("advert4") && !s5_active_sidebar("advert5") && !s5_active_sidebar("advert6")) { $advert2="100"; }
else if (!s5_active_sidebar("advert4") && s5_active_sidebar("advert5") && !s5_active_sidebar("advert6")) { $advert2="100"; }
else if (!s5_active_sidebar("advert4") && !s5_active_sidebar("advert5") && s5_active_sidebar("advert6")) { $advert2="100"; }

// contentbottom 1, 2, and 3 collapse calculations
if (s5_active_sidebar("contentbottom1") && s5_active_sidebar("contentbottom2")  && s5_active_sidebar("contentbottom3")) { $contentbottom="33"; }
else if (s5_active_sidebar("contentbottom1") && s5_active_sidebar("contentbottom2") && !s5_active_sidebar("contentbottom3")) { $contentbottom="50"; }
else if (s5_active_sidebar("contentbottom1") && !s5_active_sidebar("contentbottom2") && s5_active_sidebar("contentbottom3")) { $contentbottom="50"; }
else if (!s5_active_sidebar("contentbottom1") && s5_active_sidebar("contentbottom2") && s5_active_sidebar("contentbottom3")) { $contentbottom="50"; }
else if (s5_active_sidebar("contentbottom1") && !s5_active_sidebar("contentbottom2") && !s5_active_sidebar("contentbottom3")) { $contentbottom="100"; }
else if (!s5_active_sidebar("contentbottom1") && s5_active_sidebar("contentbottom2") && !s5_active_sidebar("contentbottom3")) { $contentbottom="100"; }
else if (!s5_active_sidebar("contentbottom1") && !s5_active_sidebar("contentbottom2") && s5_active_sidebar("contentbottom3")) { $contentbottom="100"; }

//user1 and 2 calculations
if (s5_active_sidebar("user1") && s5_active_sidebar("user2")) { $user23="50"; }
else if (!s5_active_sidebar("user1") && s5_active_sidebar("user2")) { $user23="100";  }
else if (s5_active_sidebar("user1") && !s5_active_sidebar("user2")) { $user23="100";  }

//user3, 4, 5, 6 and 7 calculations
if (s5_active_sidebar("user3") && s5_active_sidebar("user4") && s5_active_sidebar("user5")  && s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="20"; }
else if (s5_active_sidebar("user3") && s5_active_sidebar("user4") && s5_active_sidebar("user5")  && s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="25"; }
else if (s5_active_sidebar("user3") && s5_active_sidebar("user4") && s5_active_sidebar("user5")  && !s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="25"; }
else if (s5_active_sidebar("user3") && s5_active_sidebar("user4") && !s5_active_sidebar("user5")  && s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="25"; }
else if (s5_active_sidebar("user3") && !s5_active_sidebar("user4") && s5_active_sidebar("user5")  && s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="25"; }
else if (!s5_active_sidebar("user3") && s5_active_sidebar("user4") && s5_active_sidebar("user5")  && s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="25"; }
else if (!s5_active_sidebar("user3") && s5_active_sidebar("user4") && s5_active_sidebar("user5") && s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="33";  }
else if (s5_active_sidebar("user3") && !s5_active_sidebar("user4") && s5_active_sidebar("user5") && s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="33";  }
else if (s5_active_sidebar("user3") && s5_active_sidebar("user4") && !s5_active_sidebar("user5") && s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="33";  }
else if (s5_active_sidebar("user3") && s5_active_sidebar("user4") && s5_active_sidebar("user5") && !s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="33";  }
else if (s5_active_sidebar("user3") && s5_active_sidebar("user4") && !s5_active_sidebar("user5") && !s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="33";  }
else if (!s5_active_sidebar("user3") && s5_active_sidebar("user4") && s5_active_sidebar("user5") && !s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="33";  }
else if (!s5_active_sidebar("user3") && !s5_active_sidebar("user4") && s5_active_sidebar("user5") && s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="33";  }
else if (s5_active_sidebar("user3") && !s5_active_sidebar("user4") && s5_active_sidebar("user5") && !s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="33";  }
else if (s5_active_sidebar("user3") && !s5_active_sidebar("user4") && !s5_active_sidebar("user5") && s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="33";  }
else if (!s5_active_sidebar("user3") && !s5_active_sidebar("user4") && s5_active_sidebar("user5") && s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="50"; }
else if (s5_active_sidebar("user3") && !s5_active_sidebar("user4") && !s5_active_sidebar("user5") && s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="50"; }
else if (s5_active_sidebar("user3") && s5_active_sidebar("user4") && !s5_active_sidebar("user5") && !s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="50"; }
else if (!s5_active_sidebar("user3") && s5_active_sidebar("user4") && s5_active_sidebar("user5") && !s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="50"; }
else if (!s5_active_sidebar("user3") && s5_active_sidebar("user4") && !s5_active_sidebar("user5") && s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="50"; }
else if (s5_active_sidebar("user3") && !s5_active_sidebar("user4") && s5_active_sidebar("user5") && !s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="50"; }
else if (s5_active_sidebar("user3") && !s5_active_sidebar("user4") && !s5_active_sidebar("user5") && !s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="50"; }
else if (!s5_active_sidebar("user3") && s5_active_sidebar("user4") && !s5_active_sidebar("user5") && !s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="50"; }
else if (!s5_active_sidebar("user3") && !s5_active_sidebar("user4") && s5_active_sidebar("user5") && !s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="50"; }
else if (!s5_active_sidebar("user3") && !s5_active_sidebar("user4") && !s5_active_sidebar("user5") && s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="50"; }
else if (s5_active_sidebar("user3") && !s5_active_sidebar("user4") && !s5_active_sidebar("user5") && !s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="100"; }
else if (!s5_active_sidebar("user3") && s5_active_sidebar("user4") && !s5_active_sidebar("user5") && !s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="100"; }
else if (!s5_active_sidebar("user3") && !s5_active_sidebar("user4") && s5_active_sidebar("user5") && !s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="100"; }
else if (!s5_active_sidebar("user3") && !s5_active_sidebar("user4") && !s5_active_sidebar("user5") && s5_active_sidebar("user6") && !s5_active_sidebar("user7")) { $bottom4="100"; }
else if (!s5_active_sidebar("user3") && !s5_active_sidebar("user4") && !s5_active_sidebar("user5") && !s5_active_sidebar("user6") && s5_active_sidebar("user7")) { $bottom4="100"; }

$br = strtolower($_SERVER['HTTP_USER_AGENT']);
$browser = "other";
if(strrpos($br,"msie 6") > 1) {$browser = "ie6";}
if(strrpos($br,"msie 7") > 1) {$browser = "ie7";}
if(strrpos($br,"msie 8") > 1) {$browser = "ie8";}

$s5_domain = $_SERVER['HTTP_HOST'];
$s5_url = "http://" . $s5_domain . $_SERVER['REQUEST_URI'];
$s5_frontpage = "yes";
$s5_current_page = "";
if (is_front_page()) {
	$s5_current_page = "frontpage";
}
if (!is_front_page()) {
	$s5_current_page = "not_frontpage";
}
$s5_check_frontpage = strrpos($s5_url,"index.php");
if ($s5_check_frontpage > 1) {
	$s5_current_page = "not_frontpage";
}
$s5_check_frontpage2 = strrpos($s5_url,"view=frontpage&Itemid=1");
if ($s5_check_frontpage2 > 1) {
	$s5_current_page = "frontpage";
}
if ($s5_show_frontpage == "0" && $s5_current_page == "frontpage") {
	$s5_frontpage = "no";
}/**/

?>
