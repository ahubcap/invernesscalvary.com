<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 oldie" lang="en"> <![endif]-->
<!--[if (gt IE 8)|(gt IEMobile 7)]><!--><html class="no-js" lang="en"><!--<![endif]-->

<?php
  $urlArr = explode('/', $_SERVER["REQUEST_URI"]);
  $urlArr = (array_filter($urlArr));
  $titlesuffix = '';
  $depth = 0;
  foreach($urlArr as $url){
  	$title_path .= ($depth<1 ? '> ':' | ').ucwords(str_replace(array('_','.php'),array(' ',''), $url));
  	$depth++;
  }

  if($urlArr[1])
	$crumb = ' &bull; <a href="/'.$urlArr[1].'">'.strtoupper(str_replace('_',' ', $urlArr[1])).'</a>';
  if($urlArr[2])
	$crumb .= ' &bull; <a href="/'.$urlArr[1].'/'.$urlArr[2].'">'.strtoupper(str_replace('_',' ', $urlArr[2])).'</a>';
  if($urlArr[3]){
	$crumb .= ' &bull; '.strtoupper(str_replace(array('_','.php'),array(' ',''), $urlArr[3]));
  }

// Set Default Timezone
    date_default_timezone_set('America/New_York');
?>

<head>
	<meta charset="utf-8" />
	<meta property="fb:app_id" content="" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="cleartype" content="on" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="MobileOptimized" content="320" />

	<title>Calvary Church | Assemblies of God Church in Inverness Florida <?php echo str_replace("Im","I'm",$title_path); ?></title>
	<meta name="description" content="Calvary Church is an Assemblies of God church in Inverness, Florida. We exist to SHARE the good news of God's word, CARE for the needs of those that God entrusts us with, and PREPARE and equip every believer through discipleship programs.">
	<meta name="keywords" content="church, inverness, florida, calvary, assemblies, god, christ, jesus, youth, outreach, missions">

	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="copyright" content="Copyright 2012 Calvary Church http://www.InvernessCalvary.com" />
	<meta name="language" content="English" />
	<meta name="revisit-after" content="7 days" />
	<meta name="robots" content="index, follow" />
	<meta name="rating" content="general" />
	<meta name="viewport" content="width=device-width, user-scalable=yes" />

    <!--ICONS-->
    <link rel="icon" type="image/x-icon" href="/assets/images/browser/favicon.ico" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/images/browser/apple-touch-icon-114x114-precomposed.png" /><!--iPhone 4/Retina Display-->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/images/browser/apple-touch-icon-72x72-precomposed.png" /><!--iPad Gen1-->
	<link rel="apple-touch-icon-precomposed" href="/assets/images/browser/apple-touch-icon-precomposed.png" /><!--Non-Retina/Android 2.1+-->

	<!--GENERAL ASSETS-->
	<link rel="stylesheet" href="/assets/css/style.css" type="text/css" charset="utf-8" />
	<script type="text/javascript" src="/assets/js/lib/modernizr.min.js"></script>
	<script type="text/javascript" src="/assets/js/lib/ie-media-queries.js"></script>
	<script type="text/javascript" src="/assets/js/lib/jquery.min.js"></script>
	<!-- script type="text/javascript" src="/assets/js/lib/jquery.transition.min.js"></script> -->
	<script type="text/javascript" src="/assets/js/lib/jquery.hoverIntent.minified.js"></script>

	<script type="text/javascript" src="/assets/js/code/docload.js"></script>
	<script type="text/javascript">
		var jPage = '<?php echo $pagenav ?>';
		var jSubOne = '<?php echo ($urlArr[1] ? $urlArr[1] : ""); ?>';
		var jSubTwo = '<?php echo ($urlArr[2] ? $urlArr[2] : ""); ?>';
		var jSubTre = '<?php echo ($urlArr[3] ? $urlArr[3] : ""); ?>';
	</script>

	<!-- Load jQuery, SimpleModal and Basic JS files -->
	<script type='text/javascript' src='/assets/js/lib/jquery.simplemodal.js'></script>
	<link type='text/css' href='/assets/css/modal.css' rel='stylesheet' media='screen' />

	<!-- Full Calendar Integration
	<script type="text/javascript" src="/assets/js/lib/fullcalendar.js"></script>
	<script src="/assets/js/lib/moment.min.js"></script>
	<link rel="stylesheet" href="/assets/css/fullcalendar.css" type="text/css" charset="utf-8" />
	-->
	<script type="text/javascript" src="/assets/js/lib/jquery-ui-1.8.21.custom.min.js"></script>
	<link rel="stylesheet" href="/assets/css/smoothness/jquery-ui-1.8.21.custom.css" type="text/css" charset="utf-8" />

	<script type="text/javascript" src="/assets/js/lib/jquery.mCustomScrollbar.min.js"></script>
	<script type="text/javascript" src="/assets/js/lib/jquery.mousewheel.min.js"></script>
	<link rel="stylesheet" href="/assets/css/jquery.mCustomScrollbar.css" type="text/css" charset="utf-8" />

<?php if($pagenav=='home') :?>
	<script type="text/javascript" src="/assets/js/code/slides.min.jquery.js"></script>
	<link rel="stylesheet" href="/assets/css/slides.css" type="text/css" charset="utf-8" />
	<!--script src="http://www.google.com/jsapi?key=ABQIAAAAIL0BMVucvj87R-HFDh6IahS3uPXALdg0NLqxXgoiNBY3m2_gfxStHkwYHjL0wT-8fBvApuDfCj-aVw" type="text/javascript"></script-->
	<!--script type="text/javascript">google.load("feeds", "1")</script-->

<?php else: ?>
	<script type="text/javascript" src="/assets/js/code/inner.js"></script>
<?php endif; ?>

<?php
	echo file_exists('assets/js/code/'.$pagenav.'.js') ? '<script type="text/javascript" src="/assets/js/code/'.$pagenav.'.js"></script>'."\n" : '';
?>

<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="http://www.invernesscalvary.com/magnific-popup/magnific-popup.css">

<!-- jQuery 1.7.2+ or Zepto.js 1.0+
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
-->
<!-- Magnific Popup core JS file -->
<script src="http://www.invernesscalvary.com/magnific-popup/jquery.magnific-popup.js"></script>


<!-- Initialize Full Calendar
	<script type="text/javascript">
	$(document).ready(function() {

    // page is now ready, initialize the calendar...

    $('#calendar').fullCalendar({
        googleCalendarApiKey: '<AIzaSyDDIPTq7AO8dsgWebidHmqsMVHaNPHOubE>',
        events: {
            googleCalendarId: 'invernesscalvary.com_pmstt8lr9gtunqtvo71hk3got0@group.calendar.google.com'
        }
    })

	});
	</script>
-->

</head>
