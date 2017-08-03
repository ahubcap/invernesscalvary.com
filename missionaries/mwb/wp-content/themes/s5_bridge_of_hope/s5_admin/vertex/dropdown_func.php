<?php

function vertex_s5_menu($value, $key = '', $s5_menu_options = ''){
    $s5_menu_options .= getBuildAdmin(THEME_NAME . 's5_menu', $value, true);
	return $s5_menu_options;}

function vertex_body_type($value, $key = '', $vertex_body_type_options = ''){
    $vertex_body_type_options .= getBuildAdmin(THEME_NAME . 's5_fixed_fluid', $value, true);
    return $vertex_body_type_options;}

function vertex_fonts($value, $key = '', $vertex_fonts_options = ''){
    $vertex_fonts_options .= getBuildAdmin(THEME_NAME . 's5_fonts', $value, true);
    return $vertex_fonts_options;}

function bridge_s5_shadows($value, $key = '', $vertex_lang_options = ''){
    $vertex_lang_options .= getBuildAdmin(THEME_NAME . 's5_shadows', $value, true);
    return $vertex_lang_options;}

function bridge_s5_bg_fixed($value, $key = '', $vertex_lang_options = ''){
    $vertex_lang_options .= getBuildAdmin(THEME_NAME . 's5_bg_fixed', $value, true);
    return $vertex_lang_options;}

function bridge_s5_subtext($value, $key = '', $vertex_lang_options = ''){
    $vertex_lang_options .= getBuildAdmin(THEME_NAME . 's5_subtext', $value, true);
    return $vertex_lang_options;}

function bridge_s5_tooltips($value, $key = '', $vertex_lang_options = ''){
    $vertex_lang_options .= getBuildAdmin(THEME_NAME . 's5_tooltips', $value, true);
    return $vertex_lang_options;}

function bridge_s5_lytebox($value, $key = '', $vertex_lang_options = ''){
    $vertex_lang_options .= getBuildAdmin(THEME_NAME . 's5_lytebox', $value, true);
    return $vertex_lang_options;}

function bridge_s5_frontpage($value, $key = '', $vertex_lang_options = ''){
    $vertex_lang_options .= getBuildAdmin(THEME_NAME . 's5_frontpage', $value, true);
    return $vertex_lang_options;}

function bridge_s5_show_date($value, $key = '', $vertex_lang_options = ''){
    $vertex_lang_options .= getBuildAdmin(THEME_NAME . 's5_show_date', $value, true);
    return $vertex_lang_options;}

function bridge_s5_show_thumb($value, $key = '', $vertex_lang_options = ''){
    $vertex_lang_options .= getBuildAdmin(THEME_NAME . 's5_show_thumb', $value, true);
    return $vertex_lang_options;}

?>