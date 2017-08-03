/*
jQuery().ready(function(){
	jQuery("h2.title").each(function(){
		value = jQuery(this).attr("title");
		if(value == '{L_VERTEX_LOGO_CONFIG}') {
			jQuery(this).parent('fieldset').find('#vertex_logo').parent('dd.item-value').append('or <a href="#" id="file_select">Browse</a> for an image');
			jQuery(this).after('<div id="vertex-logo-preview-div"><div id="vertex_logo_preview" style="width:{VERTEX_LOGO_WIDTH}px;height:{VERTEX_LOGO_HEIGHT}px;background: url({VERTEX_LOGO}) no-repeat scroll left top transparent;"></div></div>');
		}
	});
	jQuery('#vertex_logo_preview').resizable({
        start: function(e, ui) {
           jQuery('#S5Tog').height('600px');
        },
        resize: function(e, ui) {
			new_height = jQuery('#vertex_logo_preview').height();
			new_width = jQuery('#vertex_logo_preview').width();
			jQuery('#vertex_logo_height').val(new_height);
			jQuery('#vertex_logo_width').val(new_width);
			jQuery('#s5_logo').height(new_height);
			jQuery('#s5_logo').width(new_width);
			//alert(panel_height_fix);
        },
        stop: function(e, ui) {
            
        }
    });
	
});
*/


