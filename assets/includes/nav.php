<?php $resources = '
				<li class="top_shelf subnav'.($dom=='sitemap'?' section':'').'"><a class="top_a" href="/resources/">RESOURCES</a>
					<ul class="drop_07 secondary">
						<li><a class="'.($pagenav=='blog'?' current':'').'" href="/resources/blog/">Read Our Blog</a></li>
						<li><a class="'.($pagenav=='sermon-archive'?' current':'').'" href="http://invernesscalvary.com/resources/blog/sermon-archive">Audio Sermons</a></li>
						<li><a class="hash02" href="/resources/#member_testimonies">Member Testimonies</a></li>
						<li><a class="calpop" href="javascript:void();" >Church Calendar</a></li>
						<li><a class="'.($pagenav=='events'?' current':'').'" target="_self" href="http://www.invernesscalvary.com/resources/blog/events">Special Events<br /></a></li>
						<li><a class="hash03" href="/resources/#our_bookstore">Our Bookstore</a></li>
						<li><a class="bible" target="_blank" href="http://www.youversion.com/bible/john.1.niv">Online Bible</a></li>
						<li><a class="'.($pagenav=='videos'?' current':'').'" target="_self" href="http://www.invernesscalvary.com/resources/blog/videos">Video Library</a></li>
					</ul>
				</li>
';
?>
<?php if($dom == 'side') :?>
		<img id="side_shadow" src="/assets/images/shadow.png" />
		<div rel="235" id="side_nav_01" class="tab<?php echo ($pagenav=='im_new'?' clicked':''); ?>">
			<ul>
<?php endif ;?>
				<li class="top_shelf section subnav"><a class="top_a" href="/im_new">I'M NEW</a>
					<ul class="drop_01 secondary">
						<li><a class="hash01" href="/im_new/#whats_calvary_all_about">What's Calvary All About?</a></li>
						<li><a class="hash02" href="/im_new/#what_can_i_expect">What Can I Expect?</a></li>
						<li><a class="hash03" href="/im_new/#what_can_my_kids_expect">What Can My Kids Expect?</a></li>
						<li><a class="hash04" href="/im_new/#when_are_the_services">When Are the Services?</a></li>
						<li><a class="hash05" href="/im_new/#how_do_i_get_to_calvary">How Do I Get to Calvary?</a></li>
						<li><a class="hash06" href="/im_new/#meet_our_pastor">Meet Our Pastor</a></li>
						<li><a class="hash07" href="/im_new/#tour_our_church">Tour Our Church</a></li>
					</ul>
				</li>
<?php if($dom == 'side') :?>
			</ul>
		</div>
		<div rel="195" id="side_nav_02" class="tab<?php echo ($pagenav=='get_involved'?' clicked':''); ?>">
			<ul>
<?php endif ;?>
		<?php if($dom == "sitemap") :?>
			</ul>
			<ul class="nav_ul">
		<?php endif ;?>
				<li class="top_shelf subnav<?php echo ($dom=='sitemap'?' section':''); ?>"><a class="top_a" href="/get_involved/">GET INVOLVED</a>
					<ul class="drop_02 secondary">
						<li><a class="hash01" href="/get_involved/#come_worship_with_us">Come Worship with Us</a></li>
						<li><a class="hash02" href="/get_involved/#become_a_member">Become a Member</a></li>
						<li><a class="hash03" href="/get_involved/#join_a_ministry">Join a Ministry</a></li>
						<li><a class="hash04" href="/get_involved/#get_baptized">Get Baptized</a></li>
						<li><a target="_blank" class="hash05" href="https://invernesscalvary.churchcenteronline.com/giving">Donate to Calvary</a></li>
					</ul>
				</li>
<?php if($dom == 'side') :?>
			</ul>
		</div>
		<div rel="195" id="side_nav_03" class="tab<?php echo ($pagenav=='who_we_are'?' clicked':''); ?>">
			<ul>
<?php endif ;?>
		<?php if($dom == "sitemap") :?>
			</ul>
			<ul class="nav_ul">
		<?php endif ;?>
				<li class="top_shelf subnav<?php echo ($dom=='sitemap'?' section':''); ?>"><a class="top_a" href="/who_we_are/">WHO WE ARE</a>
					<ul class="drop_03 secondary">
						<li><a class="hash01" href="/who_we_are/#our_mission">Our Mission, Vision, &amp; Strategy</a></li>
						<li><a class="hash02" href="/who_we_are/#meet_the_pastor">Meet the Pastor</a></li>
						<li><a class="hash03" href="/who_we_are/#meet_the_staff">Meet the Staff</a></li>
						<li><a class="hash04" href="/who_we_are/#tour_the_church">Tour the Church</a></li>
						<li><a class="hash05" href="/who_we_are/#what_we_believe">What We Believe</a></li>
					</ul>
				</li>
		<?php if($dom == "footer" || $dom == "sitemap") :?>
			<?php if($dom == "sitemap") :?>
				</ul>
				<ul class="nav_ul">
			<?php endif ;?>
				<?php echo $resources; ?>
			</ul>
			<ul class="nav_ul">
		<?php endif ;?>
<?php if($dom == 'side') :?>
			</ul>
		</div>
		<div rel="305" id="side_nav_04" class="tab<?php echo ($pagenav=='ministries'?' clicked':''); ?>">
			<ul>
<?php endif ;?>
				<li class="top_shelf section"><a class="top_a" href="/ministries/">MINISTRIES</a>
					<ul class="drop_04 secondary">
						<li class="subnav<?php echo ($urlArr[2] && $urlArr[2]=='for_kids' ? ' clicked' : ''); ?>"><?php echo ($dom=='side'?'<span class="arrowlink">&nbsp;</span>':''); ?><a href="/ministries/for_kids/"><span>For Kids</span></a>
							<ul>
								<li><a class="hash01" href="/ministries/for_kids/#kidslife">Kids Life</a></li>
								<li><a class="hash02" href="/ministries/for_kids/#preschool">Preschool</a></li>
								<li><a class="hash03" href="/ministries/for_kids/#nursery">Nursery</a></li>
                                                        </ul>
						</li>
						<li class="subnav<?php echo ($urlArr[2] && $urlArr[2]=='for_teens' ? ' clicked' : ''); ?>"><?php echo ($dom=='side'?'<span class="arrowlink">&nbsp;</span>':''); ?><a href="/ministries/for_teens/"><span>For Teens</span></a>
							<ul>
								<li><a class="hash01" href="/ministries/for_teens/#the_well">The Well</a></li>
								<li><a class="hash02" href="/ministries/for_teens/#first_friday">First Friday</a></li>
								<li><a class="hash03" href="/ministries/for_teens/#small_groups">Small Groups</a></li>
							</ul>
						</li>
						<li class="subnav<?php echo ($urlArr[2] && $urlArr[2]=='for_adults' ? ' clicked' : ''); ?>"><?php echo ($dom=='side'?'<span class="arrowlink">&nbsp;</span>':''); ?><a href="/ministries/for_adults/"><span>For Adults</span></a>
							<ul>
								<li><a class="hash01" href="/ministries/for_adults/#adult_life_group">Life Groups</a></li>
								<li><a class="hash02" href="/ministries/for_adults/#missions">Missions</a></li>
								<li><a class="hash03" href="/ministries/for_adults/#prayer">Prayer</a></li>
								<li><a class="hash04" href="/ministries/for_adults/#discipleship">Discipleship</a></li>
                                                                <!--li><a class="hash04" href="/ministries/for_adults/#growth_track">Growth Track</a></li -->

                                                        </ul>
						</li>
						<li class="subnav<?php echo ($urlArr[2] && $urlArr[2]=='serve' ? ' clicked' : ''); ?>"><?php echo ($dom=='side'?'<span class="arrowlink">&nbsp;</span>':''); ?><a href="/ministries/serve/"><span>Serve</span></a>
							<ul class="last">
								<!-- <li><a class="hash01" href="/ministries/serve/#every_home_for_christ">Every Home for Christ</a></li> -->
								<li><a class="hash02" href="/ministries/serve/#usher_team">Greeter &amp; Usher Team</a></li>
								<!-- li><a class="hash03" href="/ministries/serve/#coffee_and_concessions">Coffee &amp; Concessions</a></li -->
								<li><a class="hash04" href="/ministries/serve/#worship_teams">Worship Teams</a></li>
								<li><a class="hash05" href="/ministries/serve/#food_pantry">Food Pantry</a></li>
							</ul>
						</li>
		<?php if($dom == "nav") :?>
						<p>Interested in serving in one of our ministries? <a href="/ministries/">CLICK HERE</a></p>
					</ul>
				</li>
			<?php echo $resources; ?>
			
				<li class="top_shelf subnav"><a class="top_a hashlinks" href="/contact/#general">CONTACT</a>
					<ul class="drop_06 secondary">
						<li><a class="hash01" href="/contact/#general">General Inquiries</a></li>
						<li><a class="hash02" href="/contact/#prayer">Request a Prayer</a></li>
						<li><a class="hash03 joinlink" href="/contact/#join">I Want to Join a Group</a></li>
						<li><a class="hash04 servelink" href="/contact/#serve">I Want to Serve</a></li>
					</ul>
				</li>
		<?php elseif($dom == "side") :?>
			</ul>
		</div>
		<div rel="246" id="side_nav_05" class="tab<?php echo (($pagenav=='resources' || $pagenav=='blog' || $pagenav=='sermon-archive' || $pagenav=='events'  || $pagenav=='videos')?' clicked':''); ?>">
			<ul>
				<?php echo $resources; ?>
			</ul>
		</div>
		<div rel="150" id="side_nav_06" class="tab<?php echo ($pagenav=='contact'?' clicked':''); ?>">
			<ul>
				<li class="top_shelf subnav"><a class="top_a hashlinks" href="/contact/#general">CONTACT</a>
					<ul class="drop_06 secondary">
						<li><a class="hash01" href="/contact/#general">General Inquiries</a></li>
						<li><a class="hash02" href="/contact/#prayer">Request Prayer</a></li>
						<li><a class="hash03 servelink" href="/contact/#serve">I Want to Serve</a></li>
						<li><a class="hash04 joinlink" href="/contact/#join">I Want to Join a Group</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<?php else :?>
			<?php if($dom != "sitemap") :?>
		
						<p>
						Interested in serving in<br />
						one of our ministries?<br />
						<a class="ministry_link hashlinks" href="/contact/#serve">CLICK HERE</a>
						</p>
					</ul>
				</li>
			</ul>
			<?php endif ;?>
			
		<?php endif ;?>
