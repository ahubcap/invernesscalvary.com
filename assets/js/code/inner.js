$(document).ready(function() {
	var ie8 = $('html').hasClass('ie8');
	var ie7 = $('html').hasClass('ie8');
    $('#datepicker').datepicker({
        inline: true,
        dateFormat: 'yy-m-d',
        beforeShowDay: function(date) {
			var search = date.getFullYear() + "/" + (date.getMonth() + 1) + "/" + (date.getDate());
			if (dates[search]) {
           		return [true, 'highlight', ''];
       		}
       		return [false, '', ''];
       	},
		onSelect: function(dateText, inst){
			var date = dateText.split('-');

			if(date[1].length == 1)
				date[1] = '0'+date[1];

			$('#calendar-overlay').show();
			$('iframe#cal_big').css('visibility','hidden').attr('src',origSrc+'&dates='+date[0]+''+date[1]+'01%2F'+date[0]+''+date[1]+'01');

			$('#calendar-wrap').css({'top':'30px'}).removeClass('offline');
			$('#calendar-wrap a.modalCloseImg').click(function(){
				$('#calendar-wrap').css('top','-1200px').addClass('offline');
				$('#calendar-overlay').hide();
			});

			slowLoader = $.timer(1000,function(){
				$('iframe#cal_big').css('visibility','visible');
			});
		}
    });


//*****	Browser Based Form Adjustments  ******//
	if(browserV == 'winchrome'){
		$('body#contact form div').css('width','324px');
		$('body#contact form select').css('height','20px');
	} else if(browserV == 'firefox'){
		$('body#contact form select').css('height','24px');
	} else if(browserV == 'winfox'){
		$('body#contact form select').css('height','20px');
	} else if(browserV == 'iOS'){
		$('form input#zip').css('margin-right', '-8px');
		$('form textarea').css('width','328px');
	}


	if(window.location.hash) {
		var urlhash = (window.location.hash).replace('#','');

		if(urlhash == 'join' || urlhash == 'serve' || urlhash == 'baptized' || urlhash == 'testimony' || urlhash == 'dedication')
		{
			$('input#token').val(urlhash);
			$('select#topic option[value='+urlhash+']').prop('selected','selected');
			urlhash = 'general';
		} else if(urlhash == '/contact/#prayer'){
			$('input#token').val('share');
		}

		var hashtag = $('.secondary a[href$="'+urlhash+'"]').attr('class');
		var loadhash = $('.secondary a[href$="'+urlhash+'"]').html();

		$('#hashcrumb').html(' &bull; '+loadhash.toUpperCase());

		$('.secondary a[href$="'+urlhash+'"]').addClass('current');

 		if((window.location.hash).replace('#','') == 'serve' || (window.location.hash).replace('#','') == 'join'){
 			$('#side_nav ul.drop_06 li a').removeClass('current');
 			$('#side_nav ul.drop_06 li a.'+(window.location.hash).replace('#','')+'link').addClass('current');
			$('div#hash01').fadeIn();
 		} else {
			$('div#'+hashtag).fadeIn();
		}

		if(jSubTwo == 'for_teens' || jSubTwo == 'for_adults' || jSubTwo == 'serve' || jSubOne == 'im_new'|| jSubOne == 'get_involved' || jSubOne == 'who_we_are' || jSubOne == 'resources'){
			$('#inner_header div').fadeOut().css('visibility','hidden');
			$('#inner_header div#'+hashtag+'_quote').css('visibility','visible').fadeIn();
		}
	}

	$('#hashlinks a, #footer_icons li a, footer li.subnav ul li a, #home_nav li.subnav ul li a, a.hashlinks').click(function(){
		var transfer = $(this).attr('href');
		var split;

		if(transfer == '/contact/#join' || transfer == '/contact/#serve' || transfer == '/contact/#baptized' || transfer == '/contact/#testimony' || transfer == '/contact/#dedication')
		{
			split = transfer.split('#');
			$('select#topic option').removeAttr('selected');
			$('input#token').val(split[1]);

			$('select#topic option[value='+split[1]+']').attr('selected','selected');
			transfer = '/contact/#general';
		} else if(transfer == '/contact/#prayer'){
			$('input#token').val('share');
		} else if(transfer == '/contact/#general'){
			$('input#token').val('general');
			$('select#topic option').removeAttr('selected');
			$('select#topic option[value=general]').attr('selected','selected');
		}

		if(split && (split[1] == 'serve' || split[1] == 'join')){
			$('#side_nav ul.drop_06 li a').removeClass('current');
			$('#side_nav ul.drop_06 li a.'+split[1]+'link').addClass('current');
			$('.hashhide').hide();
			$('div#hash01').fadeIn();
		} else {
			$('#side_nav ul.secondary li a[href="'+transfer+'"]').trigger('click');
		}
	});

	$('input[name=privacy]').change(function(){
		$('input#token').val($(this).val());
	});

	$('select[name=topic]').change(function(){
		$('input#token').val($(this).val());
	});

	$('#side_nav li.subnav ul li a, #hashlinks a').click(function(){

		if(!$(this).hasClass('current') && !$(this).hasClass('timespace') && !$(this).hasClass('modal') && !$(this).hasClass('bible') && !$(this).hasClass('calpop')){
			if($(window).scrollTop() > 500)
				$('html, body').animate({scrollTop:160}, 'slow');

			window.location = $(this).attr('href');

			$('#hashcrumb').html(' &bull; '+$(this).text().toUpperCase());
			$('li.subnav ul li a, #hashlinks a').removeClass('current');
			$('.hashhide').hide();

			var hashtag = $(this).attr('class');
			var thisParent = $(this).parent('li').parent('ul');

			if(hashtag == 'hash03 servelink'){
				hashtag = 'hash03';
				$('select#topic option').removeAttr('selected');
				$('input#token').val('serve');
				$('select#topic option[value=serve]').attr('selected','selected');
			} else if(hashtag == 'hash04 joinlink'){
				hashtag = 'hash04';
				$('select#topic option').removeAttr('selected');
				$('input#token').val('join');
				$('select#topic option[value=join]').attr('selected','selected');
			} else if(jPage == 'contact' && hashtag == 'hash01'){
				$('select#topic option').removeAttr('selected');
				$('input#token').val('general');
				$('select#topic option[value=general]').attr('selected','selected');
			} else if(jPage == 'contact' && hashtag == 'hash02'){
				$('input#token').val('share');
			}

			$('li a.'+hashtag, thisParent).addClass('current');
			$('#hashlinks a.'+hashtag).addClass('current');

			$('body').css({'background-position':'0 bottom'})
			if(jSubTwo == 'for_teens' || jSubTwo == 'for_adults' || jSubTwo == 'serve' || ((jSubOne == 'im_new'|| jSubOne == 'get_involved' || jSubOne == 'who_we_are' || jSubOne == 'resources') && hashtag)){
				$('#inner_header div').fadeOut().css('visibility','hidden');
				$('#inner_header div#'+hashtag+'_quote').css('visibility','visible').fadeIn();
			}


			if($('div#'+hashtag).length == 0) {
 				if($(this).attr('href').indexOf(window.location.pathname) == -1) {
 					$(window).load(function() {
						$('div#hash01').show();
					});
				} else {
					$('div#hash01').show();
				}
			} else {

 				if(ie8 == true || ie7 == true){
	 				if($(this).attr('href').indexOf(window.location.pathname) == -1) {
	 					$(window).load(function() {
							$('div#'+hashtag).show();
						});
					} else {
						$('div#'+hashtag).show();
					}
				}else{
					if($(this).attr('href').indexOf(window.location.pathname) == -1) {
	 					$(window).load(function() {
							$('div#'+hashtag).fadeIn();
						});
					} else {
						$('div#'+hashtag).fadeIn();
					}
				}
			}
		}
	});

	$('span.arrowlink').click(function(e){
		var toggleList;
		var parentList = $(this).parent('li');
		if(!$('ul', parentList).is(':visible')) toggleList = 1;
			if(browserV == "ieold") $('#side_nav li.top_shelf ul li.subnav ul').hide();
			else $('#side_nav li.top_shelf ul li.subnav ul').slideUp();
		$('div.tab li.top_shelf ul li.subnav').css("background-image", "url('/assets/images/trangle_white.png')");
		if(toggleList == 1){
			$(parentList).css("background-image", "url('/assets/images/trangle_white_down.png')");
			if(browserV == "ieold") $('ul', parentList).show();
			else $('ul', parentList).slideDown();

		}
		e.preventDefault;
	});

	var tab = $('div#side_nav div.clicked').attr('id').replace('side_nav_','');
// 	if(tab == '06'){
// 			$('div.tab.clicked li.top_shelf ul.secondary').hide();
// 			$('#imagemap_image').prop('usemap','#side_nav_map_'+tab);
// 	} else {
			$('#side_nav_'+tab+' li.top_shelf ul.secondary').show();
			$('#imagemap_image').prop('usemap','#side_nav_map_'+tab);
			$('#side_nav_'+tab).css({'height': $('#side_nav_'+tab).attr('rel')+'px'});
// 	}

	$('#side_nav div.tab li.top_shelf ul li.subnav.clicked ul').show();

// 	var browserV;
// 	if($.browser.msie && ($.browser.version.charAt(0) <= 8 || (document.documentMode && document.documentMode == 7))) {
// 		browserV = "ieold";
// 	}

	$('area').focus(function(){
		$(this).blur();
	});

	$('map[name^=side_nav_map] area').mouseover(function(){
		tab = $(this).attr('id').replace('map_','');
		if(!$('#side_nav_'+tab).hasClass('clicked')){
			tab = $(this).attr('id').replace('map_','');
			$('#side_nav_'+tab).addClass('hover');
		}
	});

	$('map[name^=side_nav_map] area').mouseout(function(){
// 		if(!$('#side_nav_'+tab+' a.top_a').is(':hover'))
			$('#side_nav_'+tab).removeClass('hover');
	});

	$('#side_nav div.tab li.top_shelf a.top_a').mouseover(function(){
			$(this).addClass('hovertop');
			var tab = $(this).parents('div.tab').attr('id').replace('side_nav_','');
			$('#side_nav_'+tab).addClass('hover');
	});

	$('#side_nav div.tab li.top_shelf a.top_a').mouseout(function(){
			$(this).removeClass('hovertop');
			var tab = $(this).parents('div.tab').attr('id').replace('side_nav_','');
			$('#side_nav_'+tab).removeClass('hover');
	});

	$('map[name^side_nav_map] area').click(function(){
		tab = $(this).attr('id').replace('map_','');
		$('#side_nav_'+tab).stop();
		$('#side_nav_'+tab+' li.top_shelf ul.secondary').stop();

// 		if(tab == '06'){
// 			if(!$('#side_nav_'+tab).hasClass('clicked')){
// 				$('div.tab.clicked').animate({'height': '58px'}, 500, function(){ $(this).removeClass('clicked') });
// 				$('div.tab.clicked li.top_shelf ul.secondary').slideUp();
// 				$('#side_nav_'+tab).addClass('clicked');
// 				$('#imagemap_image').prop('usemap','#side_nav_map_'+tab);
// 			} else {
// 				$('#side_nav_'+tab).removeClass('clicked');
// 				$('#imagemap_image').prop('usemap','#side_nav_map');
// 			}
// 		} else {
			if(!$('#side_nav_'+tab).hasClass('clicked')){
				$('div.tab.clicked').animate({'height': '58px'}, 500, function(){ $(this).removeClass('clicked') });
				if(browserV == "ieold") $('div.tab.clicked li.top_shelf ul.secondary').hide();
				else $('div.tab.clicked li.top_shelf ul.secondary').slideUp();
				$('#side_nav_'+tab).addClass('clicked').animate({'height': $('#side_nav_'+tab).attr('rel')+'px'}, 500);
				if(browserV == "ieold") {
					slowLoader = $.timer(500,function(){
						$('#side_nav_'+tab+' li.top_shelf ul.secondary').show();
					});
				}
				else $('#side_nav_'+tab+' li.top_shelf ul.secondary').slideDown();
				$('#imagemap_image').prop('usemap','#side_nav_map_'+tab);
			} else {
				$('#side_nav_'+tab).animate({'height': '58px'}, 500, function(){ $(this).removeClass('clicked') });
				if(browserV == "ieold") $('#side_nav_'+tab+' li.top_shelf ul.secondary').hide();
				else $('#side_nav_'+tab+' li.top_shelf ul.secondary').slideUp();
				$('#imagemap_image').prop('usemap','#side_nav_map');
			}
// 		}
	});
	var opersys = navigator.userAgent;
	if(opersys.match(/(iPhone|iPod|iPad)/i)){
		var put1 = '<a href="http://www.itunes.com/podcast?id=332983622"><p style="background-image: url(http://invernesscalvary.com/assets/images/icon_listen.png);">LISTEN TO A MESSAGE</p></a>';

		$('#icon_listen').html(put1);
	}

});