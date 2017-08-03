				<div id="right">
					<?php if($pagenav=='blog') :?>
					<div id="blog_sidebar">

						<?php include (TEMPLATEPATH . '/searchform.php'); ?>

					<?php get_sidebar(); ?>
					
					</div><!--End blog_sidebar)-->
					<?php endif; ?>

				
					<div id="join_button"><a class="hashlinks" href="/contact/#join"></a></div>
					<div id="serve_button"><a class="hashlinks" href="/contact/#serve"></a></div>
					<div id="give_button"><a class="hashlinks" href="/get_involved/#donate_to_calvary"></a></div>
					<?php error_reporting(0);
						date_default_timezone_set('America/New_York');
						$feed = "https://www.google.com/calendar/feeds/invernesscalvary.com_fipcro22aiul8uaa2hg80h6gmc%40group.calendar.google.com/public/basic?orderby=starttime&singleevents=true&futureevents=true&max-results=999&sortorder=a";
					
					    $cache_time = 3600*12;
        				$cache_file = $_SERVER['DOCUMENT_ROOT'].'/cache/gcal.xml';
					    $timedif = @(time() - filemtime($cache_file));
					    $xml = "";
					    
						if (file_exists($cache_file) && $timedif < $cache_time) {
							$str = file_get_contents($cache_file);
							$xml = simplexml_load_string($str);
						} else {
							$xml = simplexml_load_file($feed);
							if ($f = fopen($cache_file, 'w')) {
								$str = $xml->asXML();
								fwrite ($f, $str, strlen($str));
								fclose($f);
							} else { echo "<p>Can't write to the cache.</p>"; }
						}
						
					   
					    
						foreach ($xml->entry as $entry) {
							$ns_gd = $entry->children('http://schemas.google.com/g/2005');
							$dates[] = date("Y/n/j", strtotime($ns_gd->when->attributes()->startTime));
						}
						$dates = array_unique($dates);
						
						foreach($dates as $date)
							$jstring .= "'".$date."':' ' , ";

						$jstring = substr($jstring,0,-3);
						echo "<script type=\"text/javascript\">var dates = {".$jstring."};</script>";
					?>

					<img src="/assets/images/right_divider.png" />
					
					<h4>CALENDAR OF EVENTS</h4>
					<div id="datepicker"></div>
				</div>
				
