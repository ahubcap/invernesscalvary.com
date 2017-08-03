/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

/*
jQuery().ready(function(){
	jQuery("#vertex_style_config").click(function() {
	   jQuery('#s5_logo').attr('onclick', '');
		jQuery('#s5_logo').resizable({
		  maxHeight: 113,
          
          autoHide: true,
            start: function(e, ui) {
                jQuery('#vertex_save_config').fadeIn(500);
            },
            resize: function(e, ui) {
			     new_height = jQuery('#s5_logo').height();
			     new_width = jQuery('#s5_logo').width();
			     jQuery('#s5_logo').val(new_height);
			     jQuery('#s5_logo').val(new_width);
                },
            stop: function(e, ui) {
				new_height = jQuery('#s5_logo').height();
			    new_width = jQuery('#s5_logo').width();
				jQuery.cookie('vertex_logo_height', new_height);
                jQuery.cookie('vertex_logo_width', new_width);
            }
        });
	});
*/
/*
	jQuery("#vertex_save_config").click(function() {
	   jQuery('#s5_logo').attr('onclick', 'window.document.location.href=\'index.php\'');
	   jQuery.post("vertex2/vertexAdmin/saveVars.php", { 'config_vars[vertex_logo_width]': [jQuery.cookie('vertex_logo_width')], 'config_vars[vertex_logo_height]': [jQuery.cookie('vertex_logo_height')] } );
	   jQuery(this).fadeOut(500);
    });
	
*/


/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */

/**
 * @author Alexander Farkas
 * v. 1.21
 */


(function(jQuery) {
	if(!document.defaultView || !document.defaultView.getComputedStyle){ // IE6-IE8
		var oldCurCSS = jQuery.curCSS;
		jQuery.curCSS = function(elem, name, force){
			if(name === 'background-position'){
				name = 'backgroundPosition';
			}
			if(name !== 'backgroundPosition' || !elem.currentStyle || elem.currentStyle[ name ]){
				return oldCurCSS.apply(this, arguments);
			}
			var style = elem.style;
			if ( !force && style && style[ name ] ){
				return style[ name ];
			}
			return oldCurCSS(elem, 'backgroundPositionX', force) +' '+ oldCurCSS(elem, 'backgroundPositionY', force);
		};
	}
	
	var oldAnim = jQuery.fn.animate;
	jQuery.fn.animate = function(prop){
		if('background-position' in prop){
			prop.backgroundPosition = prop['background-position'];
			delete prop['background-position'];
		}
		if('backgroundPosition' in prop){
			prop.backgroundPosition = '('+ prop.backgroundPosition;
		}
		return oldAnim.apply(this, arguments);
	};
	
	function toArray(strg){
		strg = strg.replace(/left|top/g,'0px');
		strg = strg.replace(/right|bottom/g,'100%');
		strg = strg.replace(/([0-9\.]+)(\s|\)|$)/g,"$1px$2");
		var res = strg.match(/(-?[0-9\.]+)(px|\%|em|pt)\s(-?[0-9\.]+)(px|\%|em|pt)/);
		return [parseFloat(res[1],10),res[2],parseFloat(res[3],10),res[4]];
	}
	
	jQuery.fx.step. backgroundPosition = function(fx) {
		if (!fx.bgPosReady) {
			var start = jQuery.curCSS(fx.elem,'backgroundPosition');
			
			if(!start){//FF2 no inline-style fallback
				start = '0px 0px';
			}
			
			start = toArray(start);
			
			fx.start = [start[0],start[2]];
			
			var end = toArray(fx.options.curAnim.backgroundPosition);
			fx.end = [end[0],end[2]];
			
			fx.unit = [end[1],end[3]];
			fx.bgPosReady = true;
		}
		//return;
		var nowPosX = [];
		nowPosX[0] = ((fx.end[0] - fx.start[0]) * fx.pos) + fx.start[0] + fx.unit[0];
		nowPosX[1] = ((fx.end[1] - fx.start[1]) * fx.pos) + fx.start[1] + fx.unit[1];           
		fx.elem.style.backgroundPosition = nowPosX[0]+' '+nowPosX[1];

	};
})(jQuery);

(function(jQuery){  
     jQuery.fn.extend({
         uiSelect: function(options,menuID,inputID) { 
			var uiInputStyle = {
				'z-index' : 1
			}
			
			// Default Options
            var defaults = {
                leftOffset: 0,  
                topOffset: 0
            };
               
            var options = jQuery.extend(defaults, options);
			
			// Creat the DIV to hold the menu
			var uiMenu = jQuery('<div/>', {  
			       id: menuID,
			       'class': 'uiSelect ui-widget-content',
			       css: {
			  		position: 'absolute', 
					display: 'none',
					zIndex : 1000
			       }
			  	});

			// Create the input box which will trigger the menu
			var uiInput = jQuery('<input/>', {
				id: inputID,
				name: inputID,
                size: 26,
				css: {
					position: 'relative'
				}
			});
			var uiOptionMenu = jQuery('<ul/>', {
				'class': 'uiOptionMenu',
				css: {
					position: 'relative'
				}
			});

           
             return this.each(function() {
				var obj = jQuery(this).attr('id');
				var o = options;
                var i = 0;
				// Array to hold the Select menu options
				var optionTexts = [];
				// Grab all the option itmes and push them to the optionsTexts array
				var menu = jQuery('#' + obj + ' option').each(function() { optionTexts.push(jQuery(this).text()); });
                
				// add the input field for the select menu to the DOM
				jQuery('#' + obj).after(uiInput);
				jQuery('#' + inputID).after(uiMenu);
				jQuery("#" + menuID).append(uiOptionMenu);
				jQuery('#' + obj + ' option').each(function() {
				    var selected = '';
				    if(jQuery(this).attr('selected') == true) {
                        var selected = ' class="active"';
                    }
					var uiOption = jQuery('<li'+selected+'><a val="' + jQuery(this).val() + '" href="javascript:void(0)">' + jQuery(this).text() + '</a></li>');
					jQuery("#" + menuID + ' .uiOptionMenu').append(uiOption);
                    if(jQuery(this).attr('selected') == true) {
                        jQuery('#' + inputID).val(jQuery(this).text());
                    }
                    
                    i++;
				});
                
                if(i < 10 || i == 10) {
                    jQuery("#" + menuID).width('191px');
                } else if(i > 10 && i < 19) {
                    jQuery("#" + menuID).width('304px');
                }else if(i > 20 && i < 30) {
                    jQuery("#" + menuID).width('456px');
                    jQuery("#" + menuID).css({'overflow': 'auto'});
                } else if(i > 30) {
                    jQuery("#" + menuID).width('486px');
                    jQuery("#" + menuID).css({'overflow': 'auto'});
                }
				jQuery('#' + obj).css('display','none');
				jQuery('#' + inputID)
					.css(uiInputStyle)
					.click(function(){
							jQuery('div.uiSelect').not("#" + menuID).slideUp('fast');
							//get the position of the placeholder element
							var position = jQuery(this).position();
							var uiHeight = parseInt(jQuery(this).css('height')) + 10;
							if (o.topOffset == 0){
								uiHeight = uiHeight;
							}else{
								uiHeight = uiHeight + o.topOffset;
							}
							//show the menu directly under the placeholder
							jQuery("#" + menuID).css({"left": (position.left + o.leftOffset) + "px", "top": (position.top + uiHeight) + "px"});
							jQuery("#" + menuID).slideDown();
							return false;
							}
					)
					.live('keydown',function(){
						jQuery('#' + inputID).blur();
						jQuery("#" + menuID).slideUp('fast');
				}).after(jQuery('<div />').addClass('select_div').css({'z-index': 2}).toggle(function() {
				    jQuery('div.uiSelect').not("#" + menuID).slideUp('fast');
                    var position = jQuery(this).prev().position();
                    var uiHeight = parseInt(jQuery(this).prev().css('height')) + 10;
                    
                    if (o.topOffset == 0){
                        uiHeight = uiHeight;
                    }else{
                        uiHeight = uiHeight + o.topOffset;
                    }
                    //show the menu directly under the placeholder
                    jQuery("#" + menuID).css({"left": (position.left + o.leftOffset) + "px", "top": (position.top + uiHeight) + "px"});
                    jQuery("#" + menuID).slideDown();
                    return false;
				}, function() {
				    jQuery("#" + menuID).slideUp('fast');
				}).live('keydown',function(){
						jQuery('#' + inputID).blur();
						jQuery("#" + menuID).slideUp('fast');
				}));
				jQuery('*').live('click',function(){
					jQuery("#" + menuID).slideUp('fast');
				});
				jQuery('#' + menuID + ' a').click(function() {
				    var current = jQuery('#' + menuID + ' ul').children('li').hasClass('active');
                    jQuery(current).toggleClass('active');
					jQuery('#' + inputID).val(jQuery(this).text());
                    var new_option = jQuery(this).attr('val');
                    jQuery('#' + obj + ' option').each(function() {
                        var current = jQuery(this).attr('value');
                        
                        jQuery(this).attr('selected', '');
                        if(new_option == current) {
                            jQuery(this).attr('selected', 'selected');
                        }
                    });
					jQuery("#" + menuID).fadeOut('fast');
					return false
				});
             });  
         }  
     });  
})(jQuery);

(function (g) {
    g.fn.vertexToggle = function (d) {
        
        clickEnabled = true;
        var f = {
            type: 'checkbox',
            keepLabel: true,
            easing: 'easeOutExpo',
            speed: 200,
            onClick: function () {},
            onClickOn: function () {},
            onClickOff: function () {},
            onSlide: function () {}
        },
        settings = g.extend({}, f, d);
        this.each(function () {
            var b = g(this);
            if (b.attr('tagName') == 'INPUT') {
                
                var c = b.attr('id');
                label(settings.keepLabel, c);
                b.addClass('vertex_checkbox').before('<label class="vertexToggle" for="' + c + '"></label>');
                if (b.attr('checked')) {
                    b.prev('label').addClass('vertexOn')
                } else {
                    b.prev('label').addClass('vertexOff')
                }
            } else {
                b.children('input:' + settings.type).each(function () {
                    var a = g(this).attr('id');
                    label(settings.keepLabel, a);
                    g(this).addClass('vertex_checkbox').before('<label class="vertexToggle" for="' + a + '"></label>');
                    if (g(this).attr('checked')) {
                        g(this).prev('label').addClass('vertexOn')
                    } else {
                        g(this).prev('label').addClass('vertexOff')
                    }
                    if (settings.type == 'radio') {
                        g(this).prev('label').addClass('vertex_radio')
                    }
                })
            }
        });
        function label(e, a) {
            if (e == true) {
                if (settings.type == 'radio') {
                    g('label[for=' + a + ']').addClass('vertex_label_radio')
                } else {
                    g('label[for=' + a + ']').addClass('vertex_label')
                }
            } else {
                g('label[for=' + a + ']').remove()
            }
        }
        g('label.vertexToggle').click(function () {
            if (clickEnabled == true) {
                clickEnabled = false;
                if (g(this).hasClass('vertex_radio')) {
                    if (g(this).hasClass('vertexOn')) {
                        clickEnabled = true
                    } else {
                        slide(g(this), true)
                    }
                } else {
                    slide(g(this))
                }
            }
            return false
        });
        function slide(a, b) {
            settings.onClick.call(a);
            h = a.innerHeight();
            t = a.attr('for');
            if (a.hasClass('vertexOn')) {
				settings.onClickOff.call(a);
                a.animate({
                    backgroundPosition: '100% 100%'
                }, settings.speed, settings.easing, function () {
                    a.removeClass('vertexOn').addClass('vertexOff');
                    clickEnabled = true;
                    settings.onSlide.call(this)
                });
                g('input#' + t).removeAttr('checked')
            } else {
                settings.onClickOn.call(a);
                a.animate({
                    backgroundPosition: '0% 100%'
                }, settings.speed, settings.easing, function () {
                    a.removeClass('vertexOff').addClass('vertexOn');
                    clickEnabled = true;
                    settings.onSlide.call(this)
                });
                g('input#' + t).attr('checked', 'checked')
            }
            if (b == true) {
                name = g('#' + t).attr('name');
                slide(a.siblings('label[for]'))
            }
        }
    }
})(jQuery);

(function(a){a.uniform={options:{selectClass:"selector",radioClass:"radio",checkboxClass:"checker",fileClass:"uploader",filenameClass:"filename",fileBtnClass:"action",fileDefaultText:"No file selected",fileBtnText:"Choose File",checkedClass:"checked",focusClass:"focus",disabledClass:"disabled",buttonClass:"button",activeClass:"active",hoverClass:"hover",useID:true,idPrefix:"uniform",resetSelector:false,autoHide:true},elements:[]};if(a.browser.msie&&a.browser.version<7){a.support.selectOpacity=false}else{a.support.selectOpacity=true}a.fn.uniform=function(k){k=a.extend(a.uniform.options,k);var d=this;if(k.resetSelector!=false){a(k.resetSelector).mouseup(function(){function l(){a.uniform.update(d)}setTimeout(l,10)})}function j(l){$el=a(l);$el.addClass($el.attr("type"));b(l)}function g(l){a(l).addClass("uniform");b(l)}function i(o){var m=a(o);var p=a("<div>"),l=a("<span>");p.addClass(k.buttonClass);if(k.useID&&m.attr("id")!=""){p.attr("id",k.idPrefix+"-"+m.attr("id"))}var n;if(m.is("a")||m.is("button")){n=m.text()}else{if(m.is(":submit")||m.is(":reset")||m.is("input[type=button]")){n=m.attr("value")}}n=n==""?m.is(":reset")?"Reset":"Submit":n;l.html(n);m.css("opacity",0);m.wrap(p);m.wrap(l);p=m.closest("div");l=m.closest("span");if(m.is(":disabled")){p.addClass(k.disabledClass)}p.bind({"mouseenter.uniform":function(){p.addClass(k.hoverClass)},"mouseleave.uniform":function(){p.removeClass(k.hoverClass);p.removeClass(k.activeClass)},"mousedown.uniform touchbegin.uniform":function(){p.addClass(k.activeClass)},"mouseup.uniform touchend.uniform":function(){p.removeClass(k.activeClass)},"click.uniform touchend.uniform":function(r){if(a(r.target).is("span")||a(r.target).is("div")){if(o[0].dispatchEvent){var q=document.createEvent("MouseEvents");q.initEvent("click",true,true);o[0].dispatchEvent(q)}else{o[0].click()}}}});o.bind({"focus.uniform":function(){p.addClass(k.focusClass)},"blur.uniform":function(){p.removeClass(k.focusClass)}});a.uniform.noSelect(p);b(o)}function e(o){var m=a(o);var p=a("<div />"),l=a("<span />");if(!m.css("display")=="none"&&k.autoHide){p.hide()}p.addClass(k.selectClass);if(k.useID&&o.attr("id")!=""){p.attr("id",k.idPrefix+"-"+o.attr("id"))}var n=o.find(":selected:first");if(n.length==0){n=o.find("option:first")}l.html(n.html());o.css("opacity",0);o.wrap(p);o.before(l);p=o.parent("div");l=o.siblings("span");o.bind({"change.uniform":function(){l.text(o.find(":selected").html());p.removeClass(k.activeClass)},"focus.uniform":function(){p.addClass(k.focusClass)},"blur.uniform":function(){p.removeClass(k.focusClass);p.removeClass(k.activeClass)},"mousedown.uniform touchbegin.uniform":function(){p.addClass(k.activeClass)},"mouseup.uniform touchend.uniform":function(){p.removeClass(k.activeClass)},"click.uniform touchend.uniform":function(){p.removeClass(k.activeClass)},"mouseenter.uniform":function(){p.addClass(k.hoverClass)},"mouseleave.uniform":function(){p.removeClass(k.hoverClass);p.removeClass(k.activeClass)},"keyup.uniform":function(){l.text(o.find(":selected").html())}});if(a(o).attr("disabled")){p.addClass(k.disabledClass)}a.uniform.noSelect(l);b(o)}function f(n){var m=a(n);var o=a("<div />"),l=a("<span />");if(!m.css("display")=="none"&&k.autoHide){o.hide()}o.addClass(k.checkboxClass);if(k.useID&&n.attr("id")!=""){o.attr("id",k.idPrefix+"-"+n.attr("id"))}a(n).wrap(o);a(n).wrap(l);l=n.parent();o=l.parent();a(n).css("opacity",0).bind({"focus.uniform":function(){o.addClass(k.focusClass)},"blur.uniform":function(){o.removeClass(k.focusClass)},"click.uniform touchend.uniform":function(){if(!a(n).attr("checked")){l.removeClass(k.checkedClass)}else{l.addClass(k.checkedClass)}},"mousedown.uniform touchbegin.uniform":function(){o.addClass(k.activeClass)},"mouseup.uniform touchend.uniform":function(){o.removeClass(k.activeClass)},"mouseenter.uniform":function(){o.addClass(k.hoverClass)},"mouseleave.uniform":function(){o.removeClass(k.hoverClass);o.removeClass(k.activeClass)}});if(a(n).attr("checked")){l.addClass(k.checkedClass)}if(a(n).attr("disabled")){o.addClass(k.disabledClass)}b(n)}function c(n){var m=a(n);var o=a("<div />"),l=a("<span />");if(!m.css("display")=="none"&&k.autoHide){o.hide()}o.addClass(k.radioClass);if(k.useID&&n.attr("id")!=""){o.attr("id",k.idPrefix+"-"+n.attr("id"))}a(n).wrap(o);a(n).wrap(l);l=n.parent();o=l.parent();a(n).css("opacity",0).bind({"focus.uniform":function(){o.addClass(k.focusClass)},"blur.uniform":function(){o.removeClass(k.focusClass)},"click.uniform touchend.uniform":function(){if(!a(n).attr("checked")){l.removeClass(k.checkedClass)}else{var p=k.radioClass.split(" ")[0];a("."+p+" span."+k.checkedClass+":has([name='"+a(n).attr("name")+"'])").removeClass(k.checkedClass);l.addClass(k.checkedClass)}},"mousedown.uniform touchend.uniform":function(){if(!a(n).is(":disabled")){o.addClass(k.activeClass)}},"mouseup.uniform touchbegin.uniform":function(){o.removeClass(k.activeClass)},"mouseenter.uniform touchend.uniform":function(){o.addClass(k.hoverClass)},"mouseleave.uniform":function(){o.removeClass(k.hoverClass);o.removeClass(k.activeClass)}});if(a(n).attr("checked")){l.addClass(k.checkedClass)}if(a(n).attr("disabled")){o.addClass(k.disabledClass)}b(n)}function h(q){var o=a(q);var r=a("<div />"),p=a("<span>"+k.fileDefaultText+"</span>"),m=a("<span>"+k.fileBtnText+"</span>");if(!o.css("display")=="none"&&k.autoHide){r.hide()}r.addClass(k.fileClass);p.addClass(k.filenameClass);m.addClass(k.fileBtnClass);if(k.useID&&o.attr("id")!=""){r.attr("id",k.idPrefix+"-"+o.attr("id"))}o.wrap(r);o.after(m);o.after(p);r=o.closest("div");p=o.siblings("."+k.filenameClass);m=o.siblings("."+k.fileBtnClass);if(!o.attr("size")){var l=r.width();o.attr("size",l/10)}var n=function(){var s=o.val();if(s===""){s=k.fileDefaultText}else{s=s.split(/[\/\\]+/);s=s[(s.length-1)]}p.text(s)};n();o.css("opacity",0).bind({"focus.uniform":function(){r.addClass(k.focusClass)},"blur.uniform":function(){r.removeClass(k.focusClass)},"mousedown.uniform":function(){if(!a(q).is(":disabled")){r.addClass(k.activeClass)}},"mouseup.uniform":function(){r.removeClass(k.activeClass)},"mouseenter.uniform":function(){r.addClass(k.hoverClass)},"mouseleave.uniform":function(){r.removeClass(k.hoverClass);r.removeClass(k.activeClass)}});if(a.browser.msie){o.bind("click.uniform.ie7",function(){setTimeout(n,0)})}else{o.bind("change.uniform",n)}if(o.attr("disabled")){r.addClass(k.disabledClass)}a.uniform.noSelect(p);a.uniform.noSelect(m);b(q)}a.uniform.restore=function(l){if(l==undefined){l=a(a.uniform.elements)}a(l).each(function(){if(a(this).is(":checkbox")){a(this).unwrap().unwrap()}else{if(a(this).is("select")){a(this).siblings("span").remove();a(this).unwrap()}else{if(a(this).is(":radio")){a(this).unwrap().unwrap()}else{if(a(this).is(":file")){a(this).siblings("span").remove();a(this).unwrap()}else{if(a(this).is("button, :submit, :reset, a, input[type='button']")){a(this).unwrap().unwrap()}}}}}a(this).unbind(".uniform");a(this).css("opacity","1");var m=a.inArray(a(l),a.uniform.elements);a.uniform.elements.splice(m,1)})};function b(l){l=a(l).get();if(l.length>1){a.each(l,function(m,n){a.uniform.elements.push(n)})}else{a.uniform.elements.push(l)}}a.uniform.noSelect=function(l){function m(){return false}a(l).each(function(){this.onselectstart=this.ondragstart=m;a(this).mousedown(m).css({MozUserSelect:"none"})})};a.uniform.update=function(l){if(l==undefined){l=a(a.uniform.elements)}l=a(l);l.each(function(){var n=a(this);if(n.is("select")){var m=n.siblings("span");var p=n.parent("div");p.removeClass(k.hoverClass+" "+k.focusClass+" "+k.activeClass);m.html(n.find(":selected").html());if(n.is(":disabled")){p.addClass(k.disabledClass)}else{p.removeClass(k.disabledClass)}}else{if(n.is(":checkbox")){var m=n.closest("span");var p=n.closest("div");p.removeClass(k.hoverClass+" "+k.focusClass+" "+k.activeClass);m.removeClass(k.checkedClass);if(n.is(":checked")){m.addClass(k.checkedClass)}if(n.is(":disabled")){p.addClass(k.disabledClass)}else{p.removeClass(k.disabledClass)}}else{if(n.is(":radio")){var m=n.closest("span");var p=n.closest("div");p.removeClass(k.hoverClass+" "+k.focusClass+" "+k.activeClass);m.removeClass(k.checkedClass);if(n.is(":checked")){m.addClass(k.checkedClass)}if(n.is(":disabled")){p.addClass(k.disabledClass)}else{p.removeClass(k.disabledClass)}}else{if(n.is(":file")){var p=n.parent("div");var o=n.siblings(k.filenameClass);btnTag=n.siblings(k.fileBtnClass);p.removeClass(k.hoverClass+" "+k.focusClass+" "+k.activeClass);o.text(n.val());if(n.is(":disabled")){p.addClass(k.disabledClass)}else{p.removeClass(k.disabledClass)}}else{if(n.is(":submit")||n.is(":reset")||n.is("button")||n.is("a")||l.is("input[type=button]")){var p=n.closest("div");p.removeClass(k.hoverClass+" "+k.focusClass+" "+k.activeClass);if(n.is(":disabled")){p.addClass(k.disabledClass)}else{p.removeClass(k.disabledClass)}}}}}}})};return this.each(function(){if(a.support.selectOpacity){var l=a(this);if(l.is("select")){if(l.attr("multiple")!=true){if(l.attr("size")==undefined||l.attr("size")<=1){e(l)}}}else{if(l.is(":checkbox")){f(l)}else{if(l.is(":radio")){c(l)}else{if(l.is(":file")){h(l)}else{if(l.is(":text, :password, input[type='email']")){j(l)}else{if(l.is("textarea")){g(l)}else{if(l.is("a")||l.is(":submit")||l.is(":reset")||l.is("button")||l.is("input[type=button]")){i(l)}}}}}}}}})}})(jQuery);


/**
 * Color picker
 * Author: Stefan Petre www.eyecon.ro
 * Dual licensed under the MIT and GPL licenses
 */

(function(j){var k=function(){var g={},inAction,charMin=65,visible,tpl='<div class="colorpicker"><div class="colorpicker_color"><div><div></div></div></div><div class="colorpicker_hue"><div></div></div><div class="colorpicker_new_color"></div><div class="colorpicker_current_color"></div><div class="colorpicker_hex"><input type="text" maxlength="6" size="6" /></div><div class="colorpicker_rgb_r colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_submit"></div></div>',defaults={eventName:'click',onShow:function(){},onBeforeShow:function(){},onHide:function(){},onChange:function(){},onSubmit:function(){},color:'ff0000',livePreview:true,flat:false},fillRGBFields=function(a,b){var c=HSBToRGB(a);j(b).data('colorpicker').fields.eq(1).val(c.r).end().eq(2).val(c.g).end().eq(3).val(c.b).end()},fillHSBFields=function(a,b){j(b).data('colorpicker').fields.eq(4).val(a.h).end().eq(5).val(a.s).end().eq(6).val(a.b).end()},fillHexFields=function(a,b){j(b).data('colorpicker').fields.eq(0).val(HSBToHex(a)).end()},setSelector=function(a,b){j(b).data('colorpicker').selector.css('backgroundColor','#'+HSBToHex({h:a.h,s:100,b:100}));j(b).data('colorpicker').selectorIndic.css({left:parseInt(150*a.s/100,10),top:parseInt(150*(100-a.b)/100,10)})},setHue=function(a,b){j(b).data('colorpicker').hue.css('top',parseInt(150-150*a.h/360,10))},setCurrentColor=function(a,b){j(b).data('colorpicker').currentColor.css('backgroundColor','#'+HSBToHex(a))},setNewColor=function(a,b){j(b).data('colorpicker').newColor.css('backgroundColor','#'+HSBToHex(a))},keyDown=function(a){var b=a.charCode||a.keyCode||-1;if((b>charMin&&b<=90)||b==32){return false}var c=j(this).parent().parent();if(c.data('colorpicker').livePreview===true){change.apply(this)}},change=function(a){var b=j(this).parent().parent(),col;if(this.parentNode.className.indexOf('_hex')>0){b.data('colorpicker').color=col=HexToHSB(fixHex(this.value))}else if(this.parentNode.className.indexOf('_hsb')>0){b.data('colorpicker').color=col=fixHSB({h:parseInt(b.data('colorpicker').fields.eq(4).val(),10),s:parseInt(b.data('colorpicker').fields.eq(5).val(),10),b:parseInt(b.data('colorpicker').fields.eq(6).val(),10)})}else{b.data('colorpicker').color=col=RGBToHSB(fixRGB({r:parseInt(b.data('colorpicker').fields.eq(1).val(),10),g:parseInt(b.data('colorpicker').fields.eq(2).val(),10),b:parseInt(b.data('colorpicker').fields.eq(3).val(),10)}))}if(a){fillRGBFields(col,b.get(0));fillHexFields(col,b.get(0));fillHSBFields(col,b.get(0))}setSelector(col,b.get(0));setHue(col,b.get(0));setNewColor(col,b.get(0));b.data('colorpicker').onChange.apply(b,[col,HSBToHex(col),HSBToRGB(col)])},blur=function(a){var b=j(this).parent().parent();b.data('colorpicker').fields.parent().removeClass('colorpicker_focus')},focus=function(){charMin=this.parentNode.className.indexOf('_hex')>0?70:65;j(this).parent().parent().data('colorpicker').fields.parent().removeClass('colorpicker_focus');j(this).parent().addClass('colorpicker_focus')},downIncrement=function(a){var b=j(this).parent().find('input').focus();var c={el:j(this).parent().addClass('colorpicker_slider'),max:this.parentNode.className.indexOf('_hsb_h')>0?360:(this.parentNode.className.indexOf('_hsb')>0?100:255),y:a.pageY,field:b,val:parseInt(b.val(),10),preview:j(this).parent().parent().data('colorpicker').livePreview};j(document).bind('mouseup',c,upIncrement);j(document).bind('mousemove',c,moveIncrement)},moveIncrement=function(a){a.data.field.val(Math.max(0,Math.min(a.data.max,parseInt(a.data.val+a.pageY-a.data.y,10))));if(a.data.preview){change.apply(a.data.field.get(0),[true])}return false},upIncrement=function(a){change.apply(a.data.field.get(0),[true]);a.data.el.removeClass('colorpicker_slider').find('input').focus();j(document).unbind('mouseup',upIncrement);j(document).unbind('mousemove',moveIncrement);return false},downHue=function(a){var b={cal:j(this).parent(),y:j(this).offset().top};b.preview=b.cal.data('colorpicker').livePreview;j(document).bind('mouseup',b,upHue);j(document).bind('mousemove',b,moveHue)},moveHue=function(a){change.apply(a.data.cal.data('colorpicker').fields.eq(4).val(parseInt(360*(150-Math.max(0,Math.min(150,(a.pageY-a.data.y))))/150,10)).get(0),[a.data.preview]);return false},upHue=function(a){fillRGBFields(a.data.cal.data('colorpicker').color,a.data.cal.get(0));fillHexFields(a.data.cal.data('colorpicker').color,a.data.cal.get(0));j(document).unbind('mouseup',upHue);j(document).unbind('mousemove',moveHue);return false},downSelector=function(a){var b={cal:j(this).parent(),pos:j(this).offset()};b.preview=b.cal.data('colorpicker').livePreview;j(document).bind('mouseup',b,upSelector);j(document).bind('mousemove',b,moveSelector)},moveSelector=function(a){change.apply(a.data.cal.data('colorpicker').fields.eq(6).val(parseInt(100*(150-Math.max(0,Math.min(150,(a.pageY-a.data.pos.top))))/150,10)).end().eq(5).val(parseInt(100*(Math.max(0,Math.min(150,(a.pageX-a.data.pos.left))))/150,10)).get(0),[a.data.preview]);return false},upSelector=function(a){fillRGBFields(a.data.cal.data('colorpicker').color,a.data.cal.get(0));fillHexFields(a.data.cal.data('colorpicker').color,a.data.cal.get(0));j(document).unbind('mouseup',upSelector);j(document).unbind('mousemove',moveSelector);return false},enterSubmit=function(a){j(this).addClass('colorpicker_focus')},leaveSubmit=function(a){j(this).removeClass('colorpicker_focus')},clickSubmit=function(a){var b=j(this).parent();var c=b.data('colorpicker').color;b.data('colorpicker').origColor=c;setCurrentColor(c,b.get(0));b.data('colorpicker').onSubmit(c,HSBToHex(c),HSBToRGB(c),b.data('colorpicker').el)},show=function(a){var b=j('#'+j(this).data('colorpickerId'));b.data('colorpicker').onBeforeShow.apply(this,[b.get(0)]);var c=j(this).offset();var d=getViewport();var e=c.top+this.offsetHeight;var f=c.left;if(e+176>d.t+d.h){e-=this.offsetHeight+176}if(f+356>d.l+d.w){f-=356}b.css({left:f+'px',top:e+'px'});if(b.data('colorpicker').onShow.apply(this,[b.get(0)])!=false){b.show()}j(document).bind('mousedown',{cal:b},hide);return false},hide=function(a){if(!isChildOf(a.data.cal.get(0),a.target,a.data.cal.get(0))){if(a.data.cal.data('colorpicker').onHide.apply(this,[a.data.cal.get(0)])!=false){a.data.cal.hide()}j(document).unbind('mousedown',hide)}},isChildOf=function(a,b,c){if(a==b){return true}if(a.contains){return a.contains(b)}if(a.compareDocumentPosition){return!!(a.compareDocumentPosition(b)&16)}var d=b.parentNode;while(d&&d!=c){if(d==a)return true;d=d.parentNode}return false},getViewport=function(){var m=document.compatMode=='CSS1Compat';return{l:window.pageXOffset||(m?document.documentElement.scrollLeft:document.body.scrollLeft),t:window.pageYOffset||(m?document.documentElement.scrollTop:document.body.scrollTop),w:window.innerWidth||(m?document.documentElement.clientWidth:document.body.clientWidth),h:window.innerHeight||(m?document.documentElement.clientHeight:document.body.clientHeight)}},fixHSB=function(a){return{h:Math.min(360,Math.max(0,a.h)),s:Math.min(100,Math.max(0,a.s)),b:Math.min(100,Math.max(0,a.b))}},fixRGB=function(a){return{r:Math.min(255,Math.max(0,a.r)),g:Math.min(255,Math.max(0,a.g)),b:Math.min(255,Math.max(0,a.b))}},fixHex=function(a){var b=6-a.length;if(b>0){var o=[];for(var i=0;i<b;i++){o.push('0')}o.push(a);a=o.join('')}return a},HexToRGB=function(a){var a=parseInt(((a.indexOf('#')>-1)?a.substring(1):a),16);return{r:a>>16,g:(a&0x00FF00)>>8,b:(a&0x0000FF)}},HexToHSB=function(a){return RGBToHSB(HexToRGB(a))},RGBToHSB=function(a){var b={h:0,s:0,b:0};var c=Math.min(a.r,a.g,a.b);var d=Math.max(a.r,a.g,a.b);var e=d-c;b.b=d;if(d!=0){}b.s=d!=0?255*e/d:0;if(b.s!=0){if(a.r==d){b.h=(a.g-a.b)/e}else if(a.g==d){b.h=2+(a.b-a.r)/e}else{b.h=4+(a.r-a.g)/e}}else{b.h=-1}b.h*=60;if(b.h<0){b.h+=360}b.s*=100/255;b.b*=100/255;return b},HSBToRGB=function(a){var b={};var h=Math.round(a.h);var s=Math.round(a.s*255/100);var v=Math.round(a.b*255/100);if(s==0){b.r=b.g=b.b=v}else{var c=v;var d=(255-s)*v/255;var e=(c-d)*(h%60)/60;if(h==360)h=0;if(h<60){b.r=c;b.b=d;b.g=d+e}else if(h<120){b.g=c;b.b=d;b.r=c-e}else if(h<180){b.g=c;b.r=d;b.b=d+e}else if(h<240){b.b=c;b.r=d;b.g=c-e}else if(h<300){b.b=c;b.g=d;b.r=d+e}else if(h<360){b.r=c;b.g=d;b.b=c-e}else{b.r=0;b.g=0;b.b=0}}return{r:Math.round(b.r),g:Math.round(b.g),b:Math.round(b.b)}},RGBToHex=function(c){var d=[c.r.toString(16),c.g.toString(16),c.b.toString(16)];j.each(d,function(a,b){if(b.length==1){d[a]='0'+b}});return d.join('')},HSBToHex=function(a){return RGBToHex(HSBToRGB(a))},restoreOriginal=function(){var a=j(this).parent();var b=a.data('colorpicker').origColor;a.data('colorpicker').color=b;fillRGBFields(b,a.get(0));fillHexFields(b,a.get(0));fillHSBFields(b,a.get(0));setSelector(b,a.get(0));setHue(b,a.get(0));setNewColor(b,a.get(0))};return{init:function(d){d=j.extend({},defaults,d||{});if(typeof d.color=='string'){d.color=HexToHSB(d.color)}else if(d.color.r!=undefined&&d.color.g!=undefined&&d.color.b!=undefined){d.color=RGBToHSB(d.color)}else if(d.color.h!=undefined&&d.color.s!=undefined&&d.color.b!=undefined){d.color=fixHSB(d.color)}else{return this}return this.each(function(){if(!j(this).data('colorpickerId')){var a=j.extend({},d);a.origColor=d.color;var b='collorpicker_'+parseInt(Math.random()*1000);j(this).data('colorpickerId',b);var c=j(tpl).attr('id',b);if(a.flat){c.appendTo(this).show()}else{c.appendTo(document.body)}a.fields=c.find('input').bind('keyup',keyDown).bind('change',change).bind('blur',blur).bind('focus',focus);c.find('span').bind('mousedown',downIncrement).end().find('>div.colorpicker_current_color').bind('click',restoreOriginal);a.selector=c.find('div.colorpicker_color').bind('mousedown',downSelector);a.selectorIndic=a.selector.find('div div');a.el=this;a.hue=c.find('div.colorpicker_hue div');c.find('div.colorpicker_hue').bind('mousedown',downHue);a.newColor=c.find('div.colorpicker_new_color');a.currentColor=c.find('div.colorpicker_current_color');c.data('colorpicker',a);c.find('div.colorpicker_submit').bind('mouseenter',enterSubmit).bind('mouseleave',leaveSubmit).bind('click',clickSubmit);fillRGBFields(a.color,c.get(0));fillHSBFields(a.color,c.get(0));fillHexFields(a.color,c.get(0));setHue(a.color,c.get(0));setSelector(a.color,c.get(0));setCurrentColor(a.color,c.get(0));setNewColor(a.color,c.get(0));if(a.flat){c.css({position:'relative',display:'block'})}else{j(this).bind(a.eventName,show)}}})},showPicker:function(){return this.each(function(){if(j(this).data('colorpickerId')){show.apply(this)}})},hidePicker:function(){return this.each(function(){if(j(this).data('colorpickerId')){j('#'+j(this).data('colorpickerId')).hide()}})},setColor:function(b){if(typeof b=='string'){b=HexToHSB(b)}else if(b.r!=undefined&&b.g!=undefined&&b.b!=undefined){b=RGBToHSB(b)}else if(b.h!=undefined&&b.s!=undefined&&b.b!=undefined){b=fixHSB(b)}else{return this}return this.each(function(){if(j(this).data('colorpickerId')){var a=j('#'+j(this).data('colorpickerId'));a.data('colorpicker').color=b;a.data('colorpicker').origColor=b;fillRGBFields(b,a.get(0));fillHSBFields(b,a.get(0));fillHexFields(b,a.get(0));setHue(b,a.get(0));setSelector(b,a.get(0));setCurrentColor(b,a.get(0));setNewColor(b,a.get(0))}})}}}();j.fn.extend({ColorPicker:k.init,ColorPickerHide:k.hidePicker,ColorPickerShow:k.showPicker,ColorPickerSetColor:k.setColor})})(jQuery)
