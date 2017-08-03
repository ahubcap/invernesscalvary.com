<?php $pagenav = "home";
error_reporting(E_ALL);
?>
<?php include 'assets/includes/htmlhead.php'; ?>
	<body id="home">
		<?php include 'assets/includes/header.php'; ?>
		<div id="outer_wrapper">
			<div id="inner_wrapper">
				<div id="top_logo"></div>
				<nav>
					<ul id="home_nav">
						<?php $dom = "nav"; include 'assets/includes/nav.php'; ?>
						</ul>
					</nav>
				<div id="slides">
					<div class="slides_container">
						<a href="/im_new/#whats_calvary_all_about" style="width: 1023px; height: 411px;"><img src="/assets/images/slide-01.jpg" width="1023" height="411" alt="" /></a>
						<a href="https://invernesscalvary.churchcenteronline.com/registrations/events/50938" target="_blank"><img src="/assets/images/renew2017.png" width="1023" height="411" alt="" /></a>
                                                <a href="https://invernesscalvary.churchcenteronline.com/groups/life-groups-classes" target="_blank"><img src="/assets/images/slide-05.jpg" width="1023" height="411" alt="" /></a>
                                                <a href="/ministries/for_teens/#the_well"><img src="/assets/images/slider/Wednesdays3.jpg" width="1023" height="411" alt="" /></a>
						<a href="/ministries/for_kids/#calvary_kids"><img src="/assets/images/slide-04.jpg" width="1023" height="411" alt="" /></a>
						<a href="/ministries/for_adults/#prayer"><img src="/assets/images/prayer.png" width="1023" height="411" alt="" /></a>
						</div>
					</div>
				<div id="mid_blocks">
					<div id="ministries_block">
						<a href="/ministries/">
							<div id="ministries_pic"></div>
							</a>
						<ul>
							<li><a href="/ministries/for_kids/">Ministries for Kids</a></li>
							<li><a href="/ministries/for_adults/">Ministries for Adults</a></li>
							</ul>
						<ul class="min_ul_02">
							<li><a href="/ministries/for_teens/">Ministries for Teens</a></li>
							<li><a href="/ministries/serve/">Ways to Serve</a></li>
							</ul>
						</div>
					<a href="http://invernesscalvary.com/resources/blog/sermon-archive"><div id="audio"></div></a>
					<a href="/get_involved/"><div id="involved"></div></a>
					</div>
				<img id="middiv" src="/assets/images/mid_divider.png" />
				<div id="bot_blocks">
					<div id="blog_box" class="backfade">
						<div class="box_top">
							<a href="/resources/blog/"><span>READ MORE</span></a>
							</div>
						<script src="http://feeds.feedburner.com/CalvaryChurchBlog?format=sigpro" type="text/javascript" ></script>
						</div>
					<div id="event_box" class="backfade">
                                            <a class="calpop" href="javascript:void();" >
                                                <div class="box_top">
							<span class="outer"><?php echo strtoupper(date('M')); ?></span>
							<span class="outer"><?php echo date('j'); ?></span>
							<span class="outer"><span id="the_time"></span></span>
						</div>
                                            </a>
						<div id="agenda">
							<ul>

    <?php include 'assets/includes/upcomingevents.php'; ?>

</ul>
</div>
</div>
<div style="clear:both;"></div>
</div>
<div id='calendar'></div>
<?php include 'assets/includes/footer.php'; ?>
