<?php

function daFaderCss()
{
    echo '<link href="' . get_bloginfo('template_directory') . '/s5_admin/css/custom.css" rel="stylesheet" type="text/css" />
<link href="' . get_bloginfo('template_directory') . '/s5_admin/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.js"></script>
<script type="text/javascript" src="' . get_bloginfo('template_directory') . '/s5_admin/js/vertexAdmin.js"></script>
<script type="text/javascript" src="' . get_bloginfo('template_directory') . '/s5_admin/js/vertexStyle.js"></script>
';
}

if($_GET['page']=='theme-admin.php'){
add_action('admin_head', 'daFaderCss');
}

function mytheme_admin() {
    global $themename, $shortname, $options;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

    $vertexAdmin = new vertex_admin;

?>

<div class="wrap" style="float:left;">
<h2>Shape 5 Theme Options</h2>

<div id="logoOuter" style="width: 745px;margin: 0 auto;"><div id="vertex-logo"></div></div>
<form method="post">

<div style="height: 100%;margin: 0 auto;width: 745px;">
<div style="width:745px;margin: 0 auto;height: 100%;" class="vertex-admin-wrap">
<ul id="vertex-admin-menu"><?php echo $vertexAdmin->makeHeadTabs(); ?></ul>
<?php echo $vertexAdmin->display(); ?>

<p class="submit" style="clear: both;text-align: center;">
<input name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>
</div></div></form>


<form method="post">
<p class="submit" style="clear: both;text-align: center;">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
</div>
<script type="text/javascript">
function makevertextoggle() {
    jQuery('.vertex-admin-wrap').find('.item-value').find('input:radio:first').each(function(){
        var that = jQuery(this);
        var radio_id = that.attr('id');
        that.hide();
        that.parent('label').css({'font-size':'0'}).next('label').children('input').hide();
        if (radio_id.length) {
            jQuery(that).vertexToggle({
                type: 'radio',
                onClickOff: function () {
                    jQuery(this).parent().parent('.item-value label:last').find('input').attr('checked', 'checked');
                }
            });
        }
    });
}

function makeVertexSelect() {
    var i = 0;
    jQuery('.fader-panel .item-value').find('select').each(function(){
        var that = jQuery(this);
        var select_id = that.attr('id');
        if (!that.attr('multiple')) {
            if (select_id.length) {
                jQuery('#' + select_id).uiSelect({leftOffset: 0, topOffset: 0},'uiList'+i,'uiSelect'+i);
                i++;
            }
        }
    });
}

function changeColorBox(i, hex) {
    jQuery('.fader-window').find('.fader-panel').find('#colorSelector' + i + ' div').css('backgroundColor', '#' + hex);
}

function makeVertexColorpicker() {
    var i = 0;
    jQuery('.fader-panel .item-value').find('input:text').each(function(){
        var that = jQuery(this);
        if(that.attr('size') == 6) {
            var picker_id = that.attr('id');
            if (picker_id.length) {
                var picker_value = that.val();
                jQuery('input#' + picker_id).parent('.item-value').append('<' + 'div class="color-holder" style="z-index:999;"' + '><' + 'div id="colorSelector' + i + '"' + '><' + 'div class="colorp-box" style="background-color:#' + picker_value + ';"><' + '/div><' + '/div><' + '/div>');
                jQuery('#colorSelector' + i).ColorPicker({color: '#000000',
                    onShow: function (colpkr) {jQuery(colpkr).fadeIn(500);return false;},
                    onHide: function (colpkr) {jQuery(colpkr).fadeOut(500);return false;},
                    onChange: function (hsb, hex, rgb) {
                        jQuery('input#' + picker_id).attr('value', hex);
                        jQuery('input#' + picker_id).parent('.item-value').children('div').children('div').children('div.colorp-box').css('backgroundColor', '#' + hex);
                        jQuery('html').find('.' + picker_id).css('backgroundColor', '#' + hex);
                    }
                });
                i++;
            }
        }
    });
}

function findThatUpload() {
    jQuery("input:file").uniform();
}

function makeDiscriptionTooltips() {
    var img_path = '<?php echo get_bloginfo('template_directory'); ?>';
    var i = 0;
    jQuery('.fader-panel dt').find('br').remove();
    jQuery('.fader-panel dt').each(function(){
        var that = jQuery(this);
        if(jQuery(that).find("span").text() != '') {
            var datooltip = jQuery('<' + 'img src="' + img_path + '/s5_admin/css/df-images/help.png" height="24" width="24" alt="Info" /' + '>').css({'float':'right','position':'relative','right':'5px'});
            jQuery(datooltip).mouseenter(function() {
                if(jQuery(that).find("span").css('opacity') != 0) {
                    jQuery(that).find("span").css('opacity', '0');
                }
                jQuery(that).find("span").css('opacity', '1');
                jQuery(that).find("span").stop().fadeIn(350);
            }).mouseleave(function() {
                jQuery(that).find("span").stop().fadeOut(350);
                jQuery(that).find("span").css('opacity', '0');
            });
            jQuery(that).append(datooltip);
        }
    });
}

jQuery(document).ready(function() {
	jQuery('.item-value').children('label').addClass('font-0');
    jQuery('.font-0').css("font-size","0");
    jQuery('.fader-panel .item-name span').hide();
});

jQuery(document).ready(function() {
    var i = 0;

    var savedPage = jQuery.cookie('DFCurPage');
    var savedPanel = jQuery.cookie('DFCurPanel');
    var loader = jQuery('<div />').css({'float': 'right', 'height': '32px', 'width': '32px'}).attr('id', 'pageLoader');

    jQuery('.faderPage').hide();
    jQuery('.da-fader-panel').hide();

    jQuery('.vertex-admin-wrap').find('.faderPage').each(function() {
        var tabs = jQuery('<' + 'ul id' + '="tabnav' + i + '" class' + '="fader-tabs"><' + '/ul>');
        jQuery(this).prepend(tabs);
        jQuery(this).find('.da-fader-panel').each(function() {
            var id = jQuery(this).attr('id');
            var tab = jQuery(this).children('h2').text();
            jQuery(this).parent('.faderPage').children('.fader-tabs').append('<' + 'li class' + '="fader-tab"><' + 'a class' + '="df-tab" href="#' + id + '">' + tab + '<' + '/a><' + '/li>');
        });
        i++;
    });

    jQuery('#vertex-admin-menu').find('.vertex-style-link').each(function() {
        jQuery(this).bind("click", function() {
            jQuery('#logoOuter').append(loader);

            var id = jQuery(this).attr('rel');
            jQuery('.vertex-style-link').parent().removeClass('active');
            jQuery(this).parent().addClass('active');
            var savedPage = jQuery.cookie('DFCurPage');
            if(savedPage != id) {
                jQuery('.faderPage').hide(500);
                jQuery('.da-fader-panel').hide();
                jQuery('#' + id).show(500);
                jQuery('#' + id).children('.da-fader-panel:first').show(500);
                jQuery('#' + id).children('.fader-tabs').find('li a:first').addClass('active');
                jQuery.cookie('DFCurPage', id);
                var first_panel = jQuery('#' + id).children('.da-fader-panel:first').attr('id');
                jQuery.cookie('DFCurPanel', first_panel);
            }
            jQuery('#logoOuter').find('#pageLoader').remove();
            return false;
        });
    });

    if(savedPage) {
        jQuery('#' + savedPage).show(500);
        jQuery('#' + savedPage).children('.da-fader-panel:first').show(500);
        jQuery('#' + savedPage).children('.da-fader-panel:first').children('.fader-tabs').find('li a:first').addClass('active');
        var first_panel = jQuery('#' + savedPage).children('.da-fader-panel:first').attr('id');
        jQuery.cookie('DFCurPage', savedPage);
        jQuery.cookie('DFCurPanel', first_panel);
    } else {
        var newId = jQuery('.vertex-admin-wrap').find('.faderPage:first').attr('id');
        jQuery('.vertex-admin-wrap').find('.faderPage:first').show(500);
        jQuery('.vertex-admin-wrap').find('.faderPage:first').children('.da-fader-panel:first').show(500);
        jQuery('.vertex-admin-wrap').find('.faderPage:first').children('.fader-tabs').find('li a:first').addClass('active');
        jQuery.cookie('DFCurPage', newId);
        var first_panel = jQuery('.vertex-admin-wrap').find('.faderPage:first').children('.da-fader-panel:first').attr('id');
        jQuery.cookie('DFCurPanel', first_panel);
    }

    jQuery('.df-tab').bind("click", function(){
        var id = jQuery(this).attr('href');
        jQuery('.fader-tabs .fader-tab a').removeClass('active');
        jQuery(this).addClass('active');
        var savedPanel = jQuery.cookie('DFCurPanel');
        if(savedPanel != id) {
            jQuery('.da-fader-panel').hide(500);
            jQuery(id).show(500);
            jQuery.cookie('DFCurPanel', id);
        }

        return false;
    });
});

jQuery(document).ready(function() {
    if(jQuery.browser.msie) {
        jQuery('.item-value').css('margin-left', '0');
    }
    makevertextoggle();
    makeVertexSelect();
    makeVertexColorpicker();
    findThatUpload();
    makeDiscriptionTooltips();
    jQuery('input:text').addClass('ui-widget ui-widget-content ui-corner-all vertex-input');
});
</script>


<?php
}

?>