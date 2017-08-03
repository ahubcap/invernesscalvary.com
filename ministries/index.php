<?php $pagenav = "ministries";
	  $path = $_SERVER['DOCUMENT_ROOT'];
?>
<?php include $path.'/assets/includes/htmlhead.php'; ?>
	<body id="ministries" class="inner_page">
	<?php include $path.'/assets/includes/header.php'; ?>
	<div id="outer_wrapper">
		<div id="inner_wrapper">
			<div id="top_logo"></div>
<!-- 			<img id="top_logo" src="/assets/images/back_logo.png" /> -->
			<nav>
				<ul id="home_nav">
				<?php $dom = "nav"; include $path.'/assets/includes/nav.php'; ?>
				</ul>
			</nav>
			<div id="inner_header">
				<div>
					<a target="_blank" href="http://www.youversion.com/bible/1pet.4.niv">
					<span style="float: right; width: 2px; height: 140px;"></span>
					<span style="float: right; clear: right; width: 80px; height: 60px;"></span>
					<p>1 Peter 4:10</p>
					<p>"God has given each of you a gift from His great variety of spiritual gifts. Use them well to serve one another."</p>
					</a>
				</div>
			</div>
			<div id="mid_blocks">
				<p id="breadcrumb"><a href="/">HOME</a> <?php echo $crumb; ?><span id="hashcrumb"></span></p>
				<div id="side_nav">
					<?php $dom = "side"; include $path.'/assets/includes/nav.php'; ?>
					<img id="imagemap_image" style="position:absolute; top:0; width:306px; height:600px;" src="/assets/images/blank.png" usemap="#side_nav_map_04" />
				</div>
				<div id="content">
					<h1>MINISTRIES</h1>
					<p>
					In your life, we want to help you get to know God better and enable you to become who He's created you to be.
                                        No matter where you are in life, we'll help you figure out the next steps in your jouney with Him.
                                        A big part of your walk with Christ is being connected in the church.
                                        We offer many ways for you to join small groups and to serve in ministries through the church.
                                        We know our church family has a wide variety of gifts and talents that can help other members of our church and community.
                                        We are here together as a family, to listen and help in every season of your life.
                                        </p>
					<p>
					Check out each ministry area by follow the links on the left side of the page. If you would like to <a href="/contact/#serve">know more</a> about a ministry or small group we would love to help.
					</p>
				</div>
				<?php //include $path.'/assets/includes/right.php'; ?>
				<?php include $path.'/assets/includes/imagemap.php'; ?>
			</div>
			<div style="clear:both;height:0;"></div>
	<?php include $path.'/assets/includes/footer.php'; ?>
