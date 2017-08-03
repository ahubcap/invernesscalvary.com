			<footer>
				<ul class="nav_ul">
				<?php $dom = "footer"; include ($path ? $path.'/assets/includes/nav.php' : 'assets/includes/nav.php'); ?>
				
				<div id="social_nav" style="position: relative;">
					<div id="twitter_feed">
						<!-- <a target="_blank" href="https://twitter.com/InvCalvaryFL"><img style="float:right; margin: 25px 25px 4px 4px;" src="/assets/images/twitter_bird_drop.png" /></a> -->
						<ul id="twitter_update_list"></ul>
						<a target="_blank" href="https://twitter.com/InvCalvaryFL"><div id="twitter_word"></div></a>
						<script type="text/javascript" src="/assets/js/code/blogger.js"></script>
						<script type="text/javascript" src="http://api.twitter.com/1/statuses/user_timeline.json?screen_name=InvCalvaryFL&amp;callback=twitterCallback2&amp;count=10"></script>
					</div>
					<div id="social_icons">
						<a target="_blank" href="http://www.facebook.com/invernesscalvary"><img src="/assets/images/icon_facebook_over.png" alt="" /></a>
						<a target="_blank" href="https://twitter.com/InvCalvaryFL"><img src="/assets/images/icon_twit_over.png" alt="" /></a>
						<a target="_blank" href="/resources/blog/feed/"><img src="/assets/images/icon_rss_over.png" alt="" /></a>
					</div>
				</div>
				<div id="footer_icons">
					<ul>
						<li id="icon_join"><a href="/get_involved/#join_a_ministry"><p>JOIN A GROUP</p></a></li>
						<li id="icon_baptized"><a href="/get_involved/#get_baptized"><p>GET BAPTIZED</p></a></li>
						<li id="icon_serve"><a href="/ministries/serve/"><p>SERVE</p></a></li>
						<li id="icon_read"><a href="/resources/#member_testimonies"><p>READ A STORY</p></a></li>
					</ul>
					<ul>
						<li id="icon_tour"><a href="/im_new/#tour_our_church"><p>TAKE A TOUR</p></a></li>
						<li id="icon_donate"><a href="/get_involved/#donate_to_calvary"><p>DONATE TO CALVARY</p></a></li>
						<li id="icon_member"><a href="/get_involved/#become_a_member"><p>BECOME A MEMBER</p></a></li>
						<li id="icon_listen"><a href="#" class="modal"><p>LISTEN TO A MESSAGE</p></a></li>
					</ul>
					<div id="bot_hours">
						<p>Sunday Family Worship Celebration <span>8:30am & 10:30am</span></p>
						<p>Wednesday Prayer & Fellowship <span>6:30pm-8:30pm</span></p>
						<p>Wednesday Youth & Children's Group <span>6:30pm-8:30pm</span></p>
					</div>
					<p id="bot_address">2728 E. Harley St., Inverness, FL 34453 &bull; 352.637.5100</p>
					<a id="footer_logo" href="/" title=""><img src="/assets/images/footer_logo.png" /></a>
				</div>
				<div style="clear: both; height: 0;">&nbsp;</div>
				<div id="copyright">
					<span><a href="/contact/#general">Contact Us</a></span>Copyright &copy;<?php echo date('Y'); ?> Calvary Church, All rights reserved. <a href="/privacy_policy.php">Privacy Policy</a><a href="/sitemap.php">Site Map</a>
				</div>
				<!--[if lt IE 7 ]>
					<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
					<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
				<![endif]-->
			</footer>
			<div id="calendar-wrap" class="offline" style="padding:8px; background:#fff; margin: 0 0 6px 16px;">
				<a class="modalCloseImg simplemodal-close" title="Close"></a>
				<iframe id="cal_big" src="https://www.google.com/calendar/embed?showTitle=0&amp;showCalendars=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=44lui3k18nsu6c5sm9knvi80fg%40group.calendar.google.com&amp;color=%23711616&amp;ctz=America%2FNew_York" style=" border-width:0 " width="940" height="630" frameborder="0" scrolling="no"></iframe>
			</div>
			<div id="basic-modal-content">
				<embed width="320" height="397" align="middle" menu="true" loop="true" play="true" src="http://sermonplayer.com/c/invernesscalvary/player.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="clientid=5546&amp;rgbval=6194075&amp;alpha=64&amp;by=Date&amp;d=http://sermonplayer.com/" type="application/x-shockwave-flash" wmode="transparent" allowfullscreen="true" allowscriptaccess="always" name="player" quality="high" scale="exactfit">			
			</div>
			<?php if($pagenav == 'home') :?>
			<?php endif; ?>	
		</div>
	</div>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-37525354-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
	
	<!-- Initialize Magnific Popup-->	
	<script type="text/javascript">
	$(document).ready(function() {
 	 $('.pop-video').magnificPopup({type:'iframe'});
	});
	</script>
	
	
</body>
</html>