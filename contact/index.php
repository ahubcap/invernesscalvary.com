<?php
	$pagenav = "contact";
	$path = $_SERVER['DOCUMENT_ROOT'];
	define('INCLUDE_OK',true);
	require_once $_SERVER['DOCUMENT_ROOT'].'/php_config.php';
?>

<?php include $path.'/assets/includes/htmlhead.php'; ?>
	<body id="contact" class="inner_page">
	<?php include $path.'/assets/includes/header.php'; ?>


	<script type="text/javascript">

		var validation;

		$(document).ready(function () {

			$('input, textarea').focus(function() {
				$(this).next('span.validate').remove();
				$(this).removeClass('required');
			});

			$('input[name=zip]').focus(function() {
				$(this).parent('div').next('span.validate').remove();
			});

			$('select').focus(function() {
				$(this).removeClass('required');
			});

		    $('form').submit(function () {
				$('span.validate').remove();
				$('#submitSend').css('visibility','hidden');
			    $('input, textarea').removeClass('required');
				$.ajax({
					url: '/contact/',
					type: 'POST',
					dataType: 'json',
					data: {
						token: $('input[name=token]').val(),
						first_name: $('input[name=first_name]').val(),
						last_name: $('input[name=last_name]').val(),
						address: $('input[name=address]').val(),
						city: $('input[name=city]').val(),
						state: $('select[name=state]').val(),
						zip: $('input[name=zip]').val(),
						phone: $('input[name=phone]').val(),
						email: $('input[name=from]').val(),
						message: $('textarea[name=message]').val(),
						process: 'contact'
					},
					success: function(data) {
						if(!data.valid) {
							$.each(data, function(key, value) {

								if(value!='') {
									if(key=='state') {
										$('#'+key).addClass('required');
									} else if(key=='zip') {
										$('#'+key).parent('div').after('<span class="zip validate invalid">'+value+'</span>');
										$('#'+key).addClass('required');
									} else {
										$('#'+key).after('<span class="validate invalid">'+value+'</span>');
										$('#'+key).addClass('required');
									}
								}
								$('#submitSend').css('visibility','visible');
							});
						} else {
							if (data.valid == 'true') {
								$('#submitSend').hide();
								$('#submitMessage').show();
							} else {
								alert('Sorry, unexpected error. Please try again later.');
								$('#submitSend').css('visibility','visible');
							}
						}
					}
				});
		        return false;
		    });
		});
	</script>

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
					<span style="float: right; width: 2px; height: 170px;"></span>
					<span style="float: right; clear: right; width: 80px; height: 60px;"></span>
					<?php include $path.'/assets/includes/verses.php'; ?>
				</div>
			</div>
			<div id="mid_blocks">
				<p id="breadcrumb"><a href="/">HOME</a> &bull; CONTACT</p>
				<div id="side_nav">
					<?php $dom = "side"; include $path.'/assets/includes/nav.php'; ?>
					<img id="imagemap_image" style="position:absolute; top:0; width:306px; height:600px;" src="/assets/images/blank.png" usemap="#side_nav_map_04" />
				</div>
				<div id="content">
					<h1>CONTACT</h1>
					<p>Please feel free to contact Calvary Church for any questions you may have:</p>
					<ul>
						<li>Phone: 352.637.5100</li>
						<li>Address: <a target="_blank" href="http://goo.gl/maps/Y4Gw">2728 E. Harley St. Inverness, FL 34453</a></li>
						<li>Email: <a href="mailto:contact@invernesscalvary.com">contact@invernesscalvary.com</a></li>
					</ul>
					<img style="width: 460px; height: 2px; margin-left: 6px; margin-bottom: 12px;" src="/assets/images/right_divider.png" />
					<div id="hash01" class="hashhide">
						<p style="display: inline;">Please choose a topic:</p>
						<select id="topic" name="topic">
							<option value="general">I have a general question</option>
							<option value="join">I want to join a group</option>
							<option value="serve">I want to serve</option>
							<option value="baptized">I want to get Baptized</option>
							<option value="dedication">I want to request a dedication</option>
							<option value="testimony">I want to share my story</option>
                            <option value="discipleship">I want to sign up for Discipleship</option>
						</select>
					</div>

					<div id="hash02" class="hashhide">
						<h3 style="margin:0 0 6px 0;">Request a Prayer or Share a Praise Report</h3>
						<input style="margin-left: 2px;" type="radio" name="privacy" value="share" checked="checked"> Share with the congregation</input>
						<input style="margin-left: 20px;" type="radio" name="privacy" value="private"> Please keep confidential</input>
					</div>

					<form id="contact_form" action="/contact/index.php" method="post">
						<input type="hidden" id="token" name="token" value="general" />

						<label for="first_name">First Name</label> <input type="text" id="first_name" name="first_name" value="<?php echo ($_POST['first_name'] ? $_POST['first_name'] : '');?>" /><br />
						<label for="last_name">Last Name</label> <input type="text" id="last_name" name="last_name" value="<?php echo ($_POST['last_name'] ? $_POST['last_name'] : '');?>" /><br />
						<label for="address">Address</label> <input type="text" id="last_name" name="address" value="<?php echo ($_POST['address'] ? $_POST['address'] : '');?>" /><br />
						<label for="city">City</label> <input type="text" id="city" name="city" value="<?php echo ($_POST['city'] ? $_POST['city'] : '');?>" /><br />
						<label for="state">State</label>
						<div id="zip_div">
							<select id="state" name="state">
								<option selected="selected">Select One</option>
								<?php foreach($form_state as $k => $v) echo '<option value="'.$v.'">'.$k.'</option>'; ?>
							</select>
							<input type="text" id="zip" name="zip" maxlength="10" size="10" value="<?php echo ($_POST['zip'] ? $_POST['zip'] : '');?>" /><label for="zip">Zip Code</label>
						</div><br style="clear: left;"/>
						<label for="email">Email</label> <input type="text" id="email" name="from" value="<?php echo ($_POST['from'] ? $_POST['from'] : '');?>" /><br />
						<label for="phone">Phone</label> <input type="text" id="phone" name="phone" value="<?php echo ($_POST['phone'] ? $_POST['phone'] : '');?>" /><br />
						<label for="message">Message (up to 2000 characters)</label> <textarea id="message" name="message" rows="15" cols="10"><?php echo ($_POST['message'] ? $_POST['message'] : '');?></textarea>
						<br style="clear: left;"/>
						<p style="text-align: right; margin-right: 70px;">
							<span id="submitMessage" style="display: none;" class="valid">Thank You!</span>
							<input type="submit" id="submitSend" value="Send" />
						</p>
					</form>

				</div>
				<?php //include $path.'/assets/includes/right.php'; ?>
				<?php include $path.'/assets/includes/imagemap.php'; ?>
			</div>
			<div style="clear:both;height:0;"></div>
	<?php include $path.'/assets/includes/footer.php'; ?>
