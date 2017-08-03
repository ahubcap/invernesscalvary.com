<?php $pagenav = "sitemap";
	  $path = $_SERVER['DOCUMENT_ROOT'];
?>
<?php include 'assets/includes/htmlhead.php'; ?>
	<body id="sitemap" class="inner_page">
	<?php include $path.'/assets/includes/header.php'; ?>
	<div id="outer_wrapper">
		<div id="inner_wrapper">
			<div id="top_logo"></div>
			<nav>
				<ul id="home_nav">
				<?php $dom = "nav"; include $path.'/assets/includes/nav.php'; ?>
				</ul>
			</nav>
			<div id="inner_header">
				<div>
					<span style="float: right; width: 6px; height: 170px;"></span>
					<span style="float: right; clear: right; width: 80px; height: 60px;"></span>
					<a target="_blank" href="http://www.youversion.com/bible/isa.40.niv">
					<p>Isaiah 40:31</p>
					<p>"But those who hope in the Lord will renew their Strength. They will soar on wings like eagles; they will run and not grow weary, they will walk and not be faint."</p>
					</a>
				</div>
			</div>
<style type="text/css" media="all">
	ul.bullets { list-style-type: disc; margin-left: 30px; }
	div#content h2 { margin: 6px 0 -8px; }
	div#content { width: 100%; margin-top: 6px; margin-bottom: 60px;}
</style>
			
			<div id="mid_blocks">
				<p id="breadcrumb"><a href="/">HOME</a> &bull; SITE MAP</p>
				<div id="content" class="sitemap">
					<ul class="nav_ul">
						<?php $dom = "sitemap"; include $path.'/assets/includes/nav.php'; ?>
					</ul>
				</div>
			</div>
			<div style="clear:both;height:0;"></div>
	<?php include $path.'/assets/includes/footer.php'; ?>
