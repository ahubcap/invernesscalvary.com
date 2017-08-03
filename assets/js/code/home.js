function startclock()
{
	var thetime = new Date();
	var nhours = thetime.getHours();
	var nmins= thetime.getMinutes();
	var nsecn = thetime.getSeconds();
	var AorP = (nhours >= 12) ? "PM" : "AM";
	if (nhours >= 13)
	  nhours-=12;
	if (nhours < 1)
	 nhours=12;
	if (nsecn < 10)
	 nsecn="0"+nsecn;
	if (nmins < 10)
	 nmins="0"+nmins;

	if(nsecn%2 == 0)
		$('#the_time').html(nhours+'<span class="blink">:</span>'+nmins+AorP);
	else
		$('#the_time').html(nhours+'<span class="blink" style="color:#fafafa;">:</span>'+nmins+AorP);

	setTimeout('startclock()',1000);
}

/*function initBlog()
{
	var feedpointer = new google.feeds.Feed('http://invernesscalvary.com/resources/blog/atom');
	feedpointer.setNumEntries(3);
	feedpointer.load(displayfeed);
}

function displayfeed(result)
{
	if (!result.error){
		var thefeeds = result.feed.entries;



		var rssoutput = "<ul>";
		for (var i=0; i<thefeeds.length; i++){

		// Truncate and Ellipse titles longer than 40 characters.
			if (thefeeds[i].title.length < 42){
				var newfeedtitle = (thefeeds[i].title);
			} else {
				var newfeedtitle = (thefeeds[i].title.substring(0,40) + "...");
			}


			rssoutput+="<li"+(i==2?' class="last"':'')+"><a class=\"readlink\" href='" + thefeeds[i].link + "'>READ</a><a class=\"titlelink\" href='" + thefeeds[i].link + "'><h2>" + (newfeedtitle) + "<span>, "+$.datepicker.formatDate('mm.dd.yy', new Date(Date.parse(thefeeds[i].publishedDate)))+"</span></h2></a><p>" + thefeeds[i].author + "</p></li>";
		}
		rssoutput+="</ul>";
		$('#blog_feed').html(rssoutput);

		$('.titlelink').hover(
			function(){$(this).siblings('a').addClass('hover')},
			function(){$(this).siblings('a').removeClass('hover')}
		);

		$('.readlink').hover(
			function(){$(this).siblings('a').addClass('hover')},
			function(){$(this).siblings('a').removeClass('hover')}
		);

	} else
		$('#blog_feed').html('Error retrieving blog posts. Please try again later.');
}*/

$(document).ready(function() {

	//initBlog();

	$('#slides').slides({
		preload: true,
		preloadImage: '/assets/images/loading.gif',
		play: 4500,
		pause: 4000,
		hoverPause: true
	});
	$('ul.pagination li:last-child').css('margin-right','0px');

	$('#agenda ul li:last-child').css('border-bottom','none');

	$('.eTitle').each(function(){
		if($(this).height() < 30)
			$(this).css('vertical-align','-8px')
	});

	$('a#home_link').click(function(event){
		event.preventDefault;
		return false;
	});

	$('#agenda li a').click(function(event){
		var date = $(this).attr('rel').split('/');

		if(date[1].length == 1)
			date[1] = '0'+date[1];

		$('#calendar-overlay').show();
		$('iframe#cal_big').css('visibility','hidden').attr('src',origSrc+'&dates='+date[0]+''+date[1]+'01%2F'+date[0]+''+date[1]+'01');

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


	$(window).load(function() {
		startclock();
	});
	var opersys = navigator.userAgent;
	if(opersys.match(/(iPhone|iPod|iPad)/i)){
		var put1 = '<a href="https://itunes.apple.com/us/podcast/calvary-church-service-podcast/id1063152449?mt=2"><p style="background-image: url(http://invernesscalvary.com/assets/images/icon_listen.png);">LISTEN TO A MESSAGE</p></a>';
		var put2 = '<div id="ministries_block"><a href="/ministries/"><div id="ministries_pic"></div></a><ul><li><a href="/ministries/for_kids/">Ministries for Kids</a></li><li><a href="/ministries/for_adults/">Ministries for Adults</a></li></ul><ul class="min_ul_02"><li><a href="/ministries/for_teens/">Ministries for Teens</a></li><li><a href="/ministries/serve/">Ways to Serve</a></li></ul></div><a href="https://itunes.apple.com/us/podcast/calvary-church-service-podcast/id1063152449?mt=2"><div id="audio"></div></a><a href="/get_involved/"><div id="involved"></div></a>';

		$('#icon_listen').html(put1);
		$('#mid_blocks').html(put2);
	}
});
