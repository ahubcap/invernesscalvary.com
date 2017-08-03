function twitterCallback2(twitters) {
  var statusHTML = [];
  for (var i=0; i<10; i++){
    var username = twitters[i].user.screen_name;
    var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
      return '<a href="'+url+'">'+url+'</a>';
    }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
      return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
    });
    statusHTML.push('<li><span>'+status+'</span> <a style="font-size:85%" href="http://twitter.com/'+username+'/statuses/'+twitters[i].id+'">'+relative_time(twitters[i].created_at)+'</a></li>');
  }
  document.getElementById('twitter_update_list').innerHTML = statusHTML.join('');
}

function twitterCallback3(twitters) {
  var statusHTML = [];
  for (var i=0; i<twitters.length; i++){
    var username = twitters[i].user.screen_name;
    var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
      return '<a href="'+url+'">'+url+'</a>';
    }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
      return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
    });
    statusHTML.push('<li><span>'+status+'</span> <a style="font-size:85%" href="http://twitter.com/'+username+'/statuses/'+twitters[i].id+'">'+relative_time(twitters[i].created_at)+'</a></li>');
  }
  document.getElementById('twitter_update_list3').innerHTML = statusHTML.join('');
}

function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
  var parsed_date = Date.parse(time_value);
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
  delta = delta + (relative_to.getTimezoneOffset() * 60);

  if (delta < 60) {
    return 'less than a minute ago';
  } else if(delta < 120) {
    return 'about a minute ago';
  } else if(delta < (60*60)) {
    return (parseInt(delta / 60)).toString() + ' minutes ago';
  } else if(delta < (120*60)) {
    return 'about an hour ago';
  } else if(delta < (24*60*60)) {
    return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
  } else if(delta < (48*60*60)) {
    return '1 day ago';
  } else {
    return (parseInt(delta / 86400)).toString() + ' days ago';
  }
}

$.timer = function(time,func,callback){
    var a = {timer:setTimeout(func,time),callback:null}
    if(typeof(callback) == 'function'){a.callback = callback;}
    return a;
};

$.clearTimer = function(a){
    clearTimeout(a.timer);
    if(typeof(a.callback) == 'function'){a.callback();};
    return this;
};
isChrome = function() {
	return Boolean(window.chrome);
}

var origSrc;
var browserV;
var slowloader;
var topic;

$(document).ready(function () {

	$.ajax({
		url: "/twitter-oauth.php",
		dataType: "json",
		success: function(twitters) {
			twitterCallback2(twitters);
			
			if($.browser.msie && ($.browser.version.charAt(0) <= 8 || (document.documentMode && document.documentMode == 7))) {
				$("#twitter_feed ul").mCustomScrollbar({
					scrollButtons: { enable: false },
					scrollEasing: 'linear'
				});
			} else if(navigator.appVersion.indexOf("Win")!=-1 && isChrome()) {
				$("#twitter_feed ul").mCustomScrollbar({
					scrollButtons: { enable: false },
					scrollEasing: 'linear'
				}).css({
					'overflow-y': 'hidden',
					'width': '210px',
					'padding-right': 0
				});
			} else if($.browser.mozilla){
				
				$("#twitter_feed ul").mCustomScrollbar({
					scrollButtons: { enable: false },
					scrollEasing: 'linear'
				}).css({
					'overflow-y': 'hidden',
					'width': '210px',
					'padding-right': 0
				});
			}
		}
	})

	function openTop(){
		$('#top_map').css('opacity','1');
		$('a#home_link').addClass('prevent');
		$('header').animate({
		'marginTop': '0'
		},500);
		$('a.closeHeader').fadeIn();

		if(browserV == "ieold") {
			$('#top_info, #top_map, #top_hours').show();
			$('#header_mark').show();
			$('#header_mark').animate({
			'height': '185px'
			},500);
			$('#top_fixed').hide();
		} else {
			$('#top_info, #top_map, #top_hours').fadeIn(500);
			$('#header_mark').animate({
			'opacity': '.8',
			'height': '185px'
			},500);
			$('#top_fixed').fadeOut(500);
		}
	}

	function closeTop(){
		$('header').animate({
		'marginTop': '-144px'
		},500);
		$('a.closeHeader').fadeOut();
		if(browserV == "ieold") {
			$('#top_info, #top_map, #top_hours').hide();
			$('#header_mark').animate({
				'height': '41px'
			},500, function(){
				$('#header_mark').hide();
			});
			$('#top_fixed').show();
		} else {
			$('#header_mark').animate({
			'opacity': '0',
			'height': '41px'
			},500);
			$('#top_info, #top_map, #top_hours').fadeOut(500);
			$('#top_fixed').fadeIn(500);
		}
		$('a#home_link').removeClass('prevent');
	}

	if($.browser.msie && ($.browser.version.charAt(0) <= 8 || (document.documentMode && document.documentMode == 7))) {
		browserV = "ieold";
	} else if(navigator.appVersion.indexOf("Win")!=-1 && isChrome()) {
		browserV = "winchrome";
	} else if($.browser.mozilla){
		browserV = "firefox";
		if(navigator.appVersion.indexOf("Win")==-1)
			$('ul#home_nav li ul.drop_04 p a').css({'background-position': 'right 4px'})
		if(navigator.appVersion.indexOf("Win")!=-1)
			browserV = "winfox";
	} else if(navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad)/)) {
		browserV = "iOS"
	}
	
	origSrc = $('iframe#cal_big').attr('src');
	
	$('.modal').click(function(event){
		$('#basic-modal-content').modal();
			event.preventDefault;
			return false;
	});
	
	$('.calpop').click(function(event){

		$('#calendar-overlay').show();
		$('iframe#cal_big').css('visibility','hidden').attr('src',origSrc);
		
		$('#calendar-wrap').css('top','50px').removeClass('offline');
		$('#calendar-wrap a.modalCloseImg').click(function(){
			$('#calendar-wrap').css('top','-1200px').addClass('offline');
			$('#calendar-overlay').hide();
		});
		
		slowLoader = $.timer(1000,function(){
			$('iframe#cal_big').css('visibility','visible');
		});

		event.preventDefault;
		return false;
	});
	
	$('#social_icons img').hover(
		function(){
			var newsource = $(this).attr('src').replace('_over','');
			$(this).attr('src',newsource);
		},
		function(){
			var newsource = $(this).attr('src').replace('.png','_over.png');
			$(this).attr('src',newsource);
	});
	
	$('#twitter_feed img').hover(
		function(){
			var newsource = $(this).attr('src').replace('_drop','');
			$(this).attr('src',newsource).css('margin','26px 26px 3px 3px');
		},
		function(){
			var newsource = $(this).attr('src').replace('.png','_drop.png');
			$(this).attr('src',newsource).css('margin','25px 25px 4px 4px');
	});
	
	$('#twitter_feed ul li:last-child').addClass('last');
	
	var backpic;
	$('div#footer_icons li p').hover(
		function(){
			backpic = $(this).css('background-image');
			$(this).css('background-image', backpic.replace('.png','_over.png'));
		},
		function(){
			$(this).css('background-image', backpic);
	});
	
	$('#top_nav_right').click(function(){
		openTop();
	});	

	$('#outer_wrapper').click(function(){
		if($('a#home_link').hasClass('prevent')){
			closeTop();
		}
	});
	
	$('a.closeHeader').click(function(){
		closeTop();
	});
	
	$('a#home_link').click(function(event){
		if($(this).hasClass('prevent')){
			event.preventDefault();
		}
	});
	
	$('#home_nav li.top_shelf').hoverIntent(
	function(){
	  $(this).addClass('hover');
	  $(this).children('ul').slideDown();
	},
	function(){
	  if(!$(this).children('li').hasClass('hover')){
		  $(this).removeClass("hover");
		  $(this).children('ul').slideUp();
	  }
	});
});
