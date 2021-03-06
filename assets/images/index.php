<?php $pagenav = "home"; ?>
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
                                    <a href="http://invernesscalvary.com/resources/blog/events/harvest-night-2014/" style="width:1023px; height:411px;"><img src="/assets/images/HarvestNight2014.jpg" width="1023" height="411" alt="" /></a>
					<a href="/im_new/#whats_calvary_all_about" style="width: 1023px; height: 411px;"><img src="/assets/images/slide-01.jpg" width="1023" height="411" alt="" /></a>
                    <a href="/resources/blog/events/worship-nights/" style="width: 1023px; height: 411px;"><img src="/assets/images/worshipnights.png" width="1023" height="411" alt="" /></a>
					<a class="pop-video" href="https://vimeo.com/105698675" style="width: 1023px; height: 411px;"><img src="/assets/images/slider/growth-track.jpg" width="1023" height="411" alt="Growth Track Promo" /></a>
					<!--<a href="/resources/blog/events/renew-2014-calvary-churchs-ladies-retreat/" style="width: 1023px; height: 411px;"><img src="/assets/images/slider/Renew2014WebsiteCoverBanner.jpg" width="1023" height="411" alt="Renew 2014 - Calvary Church Ladies Retreat" /></a>-->
					<!--<a href="/resources/blog/events/"><img src="/assets/images/slider/events.jpeg" width="1023" height="411" alt="Special Events" /></a>-->
                    <a href="/ministries/for_teens/#the_well"><img src="/assets/images/slider/the_well_new.jpg" width="1023" height="411" alt="" /></a>
					<!--a href="/ministries/for_adults/#axis_young_adults"><img src="/assets/images/slide-03.jpg" width="1023" height="411" alt="" /></a-->
					<a href="/ministries/for_kids/#calvary_kids"><img src="/assets/images/slide-04.jpg" width="1023" height="411" alt="" /></a>
					<a href="/ministries/for_adults/#adult_life_group"><img src="/assets/images/slide-05.jpg" width="1023" height="411" alt="" /></a>
                    <a href="/ministries/for_adults/#citrus_prayer_group"><img src="/assets/images/slider/cpr.jpg" width="1023" height="411" alt="" /></a>
                                </div>
			</div>
			<div id="mid_blocks">
				<div id="ministries_block">
					<a href="/ministries/"><div id="ministries_pic"></div></a>
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
				<div id="blog_feed" style="width: 493px;"></div>
			</div>	
				<div id="event_box" class="backfade">
				<div class="box_top">
					<span class="outer"><?php echo strtoupper(date('M')); ?></span>
					<span class="outer"><?php echo date('j'); ?></span>
					<span class="outer"><span id="the_time"></span></span>
				</div>
				<div id="agenda">
					<ul>
					<?php 
						date_default_timezone_set('America/New_York');
						$cache_time = 3600*12;
						
						$feedRegular = "https://www.google.com/calendar/feeds/44lui3k18nsu6c5sm9knvi80fg%40group.calendar.google.com/public/full?orderby=starttime&singleevents=true&futureevents=true&max-results=999&sortorder=a";
						$feedFeature = "http://www.google.com/calendar/feeds/invernesscalvary.com_erkodmt87n8bi4fatcpc1ri0ac%40group.calendar.google.com/public/full?orderby=starttime&singleevents=true&futureevents=true&max-results=3&sortorder=a";
						
        				$cache_file_reg = $_SERVER['DOCUMENT_ROOT'].'/cache/gcal.xml';
					    $timedif_reg = @(time() - filemtime($cache_file_reg));
					    $xmlRegular = "";
					    
						if (file_exists($cache_file_reg) && $timedif_reg < $cache_time) {
							$str_reg = file_get_contents($cache_file_reg);
							$xmlRegular = simplexml_load_string($str_reg);
						} else {
							$xmlRegular = simplexml_load_file($feedRegular);
							if ($f_reg = fopen($cache_file_reg, 'w')) {
								$str_reg = $xmlRegular->asXML();
								fwrite ($f_reg, $str_reg, strlen($str_reg));
								fclose($f_reg);
							} else { echo "<p>Can't write to the cache.</p>"; }
						}
					    $xmlRegular->asXML();
					    
        				$cache_file_fea = $_SERVER['DOCUMENT_ROOT'].'/cache/gcal_featured.xml';
					    $timedif_fea = @(time() - filemtime($cache_file_fea));
					    $xmlFeature = "";
					    
						if (file_exists($cache_file_fea) && $timedif_fea < $cache_time) {
							$str_fea = file_get_contents($cache_file_fea);
							$xmlFeature = simplexml_load_string($str_fea);
						} else {
							$xmlFeature = simplexml_load_file($feedFeature);
							if ($f_fea = fopen($cache_file_fea, 'w')) {
								$str_fea = $xmlFeature->asXML();
								fwrite ($f_fea, $str_fea, strlen($str_fea));
								fclose($f_fea);
							} else { echo "<p>Can't write to the cache.</p>"; }
						}
						
						if (is_object($xmlFeature)) {
					    	$xmlFeature->asXML();
					    }
					    
						$n = 0;
// 						foreach ($xmlFeature->entry as $entry) {
// 							if($entry->title != '') $n++;
// 							$ns_gd = $entry->children('http://schemas.google.com/g/2005');
// 							
// 							$eDate = date("M", strtotime($ns_gd->when->attributes()->startTime));
// 							$eDay = date("j", strtotime($ns_gd->when->attributes()->startTime));
// 							$eTime = date("g:ia", strtotime($ns_gd->when->attributes()->startTime));
// 							
// 							$eLink = date("Y/m/d", strtotime($ns_gd->when->attributes()->startTime));
// 							
// 							$title = str_replace(" & ", " &amp; ", $entry->title);
// 							$where = $ns_gd->where->attributes()->valueString;
// 
//  							$link = $entry->link->attributes()->href;
// 							echo "<li class=\"featured\">\n";
// 							echo "<span class=\"eDate\">$eDate <span class=\"eDay\">$eDay</span> @ $eTime</span><a rel=\"$eLink\" title=\"@ $where\" href=\"#\">";
// 							echo "<p class=\"eTitle\">$title</p></a>\n";
// 							echo "</li>\n\n"; 
// 							if($entry->title == '') break;
// 						}

						foreach ($xmlRegular->entry as $entry) {
							$n++;
							$ns_gd = $entry->children('http://schemas.google.com/g/2005');
							
							$eDate = date("M", strtotime($ns_gd->when->attributes()->startTime));
							$eDay = date("j", strtotime($ns_gd->when->attributes()->startTime));
							$eTime = date("g:ia", strtotime($ns_gd->when->attributes()->startTime));
							
							$eLink = date("Y/m", strtotime($ns_gd->when->attributes()->startTime));
							
							$title = str_replace(" & ", " &amp; ", $entry->title);
							$where = $ns_gd->where->attributes()->valueString;

 							$link = $entry->link->attributes()->href;
							echo "<li>\n";
							echo "<span class=\"eDate\">$eDate <span class=\"eDay\">$eDay</span> @ $eTime</span><a rel=\"$eLink\" title=\"@ $where\" href=\"#\">";
							echo "<p class=\"eTitle\">$title</p></a>\n";
							echo "</li>\n\n"; 
							if($n == 3) break;
						}
						
					?>
					</ul>
				</div>
			</div>
				<div style="clear:both;"></div>
			</div>
	<?php include 'assets/includes/footer.php'; ?>