<?php
require_once 'general.func.php';

$errors = array();

$form_data = array(
	'token'=>'',
	'first_name'=>'',
	'last_name'	=>'',
	'address'  =>'',
	'city'		=>'',
	'state'		=>'',
	'zip'		=>'',
	'email'		=>'',
	'phone'		=>'',
	'message'  	=>''
);

$pv = array(
	'name'		=>'/^(?i)[a-z0-9\s\.\-'."'".']{1,30}$/',
	'address'	=>'/^(?i)[a-z0-9\s\.\-\#'."'".']{1,50}$/',
	'city'		=>'/^(?i)[a-z0-9\s\.\-'."'".']{1,50}$/',
	'state'		=>'/^[A-Z]{0,2}$/',
	'email'		=>'/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$/',
	'phone'		=>'/^([0-9]( |-)?)?(\(?[0-9]{3}\)?|[0-9]{3})( |-)?([0-9]{3}( |-)?[0-9]{4}|[a-zA-Z0-9]{7})$/',
	'zip'		=>'/^(?!0{5})(\d{5})(?!-?0{4})(-?\d{5})?(-\d{4})?$/',
	'message'	=>'/^(.|\r|\n){0,2000}$/'
);

$form_state = array(
	'Alabama' => 'AL',
	'Alaska' => 'AK',
	'Arizona' => 'AZ',
	'Arkansas' => 'AR',
	'California' => 'CA',
	'Colorado' => 'CO',
	'Connecticut' => 'CT',
	'Delaware' => 'DE',
	'District of Columbia' => 'DC',
	'Florida' => 'FL',
	'Georgia' => 'GA',
	'Hawaii' => 'HI',
	'Idaho' => 'ID',
	'Illinois' => 'IL',
	'Indiana' => 'IN',
	'Iowa' => 'IA',
	'Kansas' => 'KS',
	'Kentucky' => 'KY',
	'Louisiana' => 'LA',
	'Maine' => 'ME',
	'Maryland' => 'MD',
	'Massachusetts' => 'MA',
	'Michigan' => 'MI',
	'Minnesota' => 'MN',
	'Mississippi' => 'MS',
	'Missouri' => 'MO',
	'Montana' => 'MT',
	'Nebraska' => 'NE',
	'Nevada' => 'NV',
	'New Hampshire' => 'NH',
	'New Jersey' => 'NJ',
	'New Mexico' => 'NM',
	'New York' => 'NY',
	'North Carolina' => 'NC',
	'North Dakota' => 'ND',
	'Ohio' => 'OH',
	'Oklahoma' => 'OK',
	'Oregon' => 'OR',
	'Pennsylvania' => 'PA',
	'Rhode Island' => 'RI',
	'South Carolina' => 'SC',
	'South Dakota' => 'SD',
	'Tennessee' => 'TN',
	'Texas' => 'TX',
	'Utah' => 'UT',
	'Vermont' => 'VT',
	'Virginia' => 'VA',
	'Washington' => 'WA',
	'West Virginia' => 'WV',
	'Wisconsin' => 'WI',
	'Wyoming' => 'WY'
);

if (isset($_POST['process']) && 'contact'==$_POST['process']) {

	foreach ($form_data as $k=>$v) {
		$_POST[$k] = stripslashes(trim($_POST[$k]));
		if (!empty($_POST[$k])) {
			$form_data[$k] = $_POST[$k];
			$v = $_POST[$k];
		}

		switch($k) {
			case 'first_name':
			case 'last_name':
				if (!preg_match($pv['name'], $v)) {
					$errors[$k] = 'Required';
				}
				break;

			case 'address':
				if (!preg_match($pv['address'], $v)) {
					$errors[$k] = 'Required';
				}
				break;

			case 'city':
				if (!preg_match($pv['city'], $v)) {
					$errors[$k] = 'Required';
				}
				break;

			case 'state':
				if ($v=='Select One') {
					$errors[$k] = 'Required';
				}
				if (!in_array($v, $form_state)) {
					$errors[$k] = 'Invalid';
				}
				break;

			case 'zip':
				if (trim($v)==='') {
					$errors[$k] = 'Required';
				}
				if (!preg_match($pv['zip'], $v)) {
					$errors[$k] = 'Invalid';
				}
				break;

			case 'email':
				if (trim($v)==='')
					$errors[$k] = 'Required';
				else if (!validEmail($v))
					$errors[$k] = 'Invalid';
				break;

			case 'phone':
				if (trim($v)==='') {
					$errors[$k] = 'Required';
				}
				if (!preg_match($pv['phone'], $v)) {
					$errors[$k] = 'Invalid';
				}
				break;

			case 'message':
				if (trim($v)==='')
					$errors[$k] = 'Required';
				else if (!preg_match($pv['message'], $v))
					$errors[$k] = 'Too Long';
				break;

			default: break;
		}
	}

	$error_flag = false;
	foreach ($errors as $k=>$v) {
		if (!empty($v)) {
			$error_flag = true;
		}
	}

	if (!$error_flag && !blacklisted($_SERVER['REMOTE_ADDR'])) {
 		$client_email = "contact@invernesscalvary.com";

		$from = "From: $client_email\r\n";
		$autoreply = "{$form_data['first_name']} {$form_data['last_name']},

Thank you for contacting Calvary Church.

Your submission has been received and we will contact you shortly.

We look forward to serving you.

Sincerely,

Calvary Church";

		mail($form_data['email'], "Thank you for contacting us", $autoreply, $from);

		$todayis = date("l, F j, Y, g:i a") ;
		$subject = "Calvary Church Contact Form Submission" ;
		$message = "$todayis [EST] \r\n
Calvary Church Contact Form Submission \r\n

TOPIC or PRIVACY REQUEST
{$form_data['token']}

CONTACT INFORMATION
First Name: {$form_data['first_name']}
Last Name: {$form_data['last_name']}\r\n

Phone Number: {$form_data['phone']}
Email Address: {$form_data['email']}\r\n

CONTACT ADDRESS
Address: {$form_data['address']}
City: {$form_data['city']}
State: {$form_data['state']}
Zip: {$form_data['zip']}\r\n

COMMENTS
{$form_data['message']}\r\n
";

		if (!empty($client_email)) {
			if (mail($client_email, $subject, $message, $from)) {
				$errors['valid'] = 'true';
			}
		}
	}

	echo json_encode($errors);

exit;
}
?>