<?php
/*******************************************************************************
Validate an email address.
Provide email address (raw input)
Returns true if the email address has the email
address format and the domain exists.
*******************************************************************************/
function validEmail($email_address) {
	$isValid = true;
	$atIndex = strrpos($email_address, '@');
	if (is_bool($atIndex) && !$atIndex) {
		$isValid = false;
	} else {
		$domain = substr($email_address, $atIndex+1);
		$local = substr($email_address, 0, $atIndex);
		$localLen = strlen($local);
		$domainLen = strlen($domain);
		if ($localLen < 1 || $localLen > 64) {
			// local part length exceeded
			$isValid = false;
		} elseif ($domainLen < 1 || $domainLen > 255) {
			// domain part length exceeded
			$isValid = false;
		} elseif ($local[0] == '.' || $local[$localLen-1] == '.') {
			// local part starts or ends with '.'
			$isValid = false;
		} elseif (preg_match('/\.\./', $local)) {
			// local part has two consecutive dots
			$isValid = false;
		} elseif (!preg_match('/^[A-Za-z0-9\-\.]+$/', $domain)) {
			// character not valid in domain part
			$isValid = false;
		} elseif (preg_match('/\.\./', $domain)) {
			// domain part has two consecutive dots
			$isValid = false;
		} elseif (!preg_match('/^(\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', stripslashes($local))) {
			// character not valid in local part unless
			// local part is quoted
			if (!preg_match('/^"(\"|[^"])+"$/', stripslashes($local))) {
				$isValid = false;
			}
		}
		if ($isValid && (!checkdnsrr($domain,'MX') || !checkdnsrr($domain,'A'))) {
			// domain not found in DNS
			$isValid = false;
		}
	}
	return $isValid;
}

function blacklisted($ip) {
	// Get DNSBL at http://www.dnsbl.info/dnsbl-list.php
	// list.dsbl.org <= Takes too long.
	// bl.spamcop.net
	// sbl.spamhaus.org
	// virus.rbl.jp
	// cbl.abuseat.org
    $dnsbl_lists = array('bl.spamcop.net', 'sbl.spamhaus.org');
	if (!preg_match('/^([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}){1}$/', $ip)) {
		$ip = gethostbyname($ip);
	}
    if ($ip && preg_match('/^([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}){1}$/', $ip)) {
        $reverse_ip = implode('.', array_reverse(explode('.', $ip)));
        $on_win = substr(PHP_OS, 0, 3) == 'WIN' ? true : false;
        foreach ($dnsbl_lists as $dnsbl_list) {
            if (function_exists('checkdnsrr')) {
                if (checkdnsrr($reverse_ip.'.'.$dnsbl_list.'.', 'MX')) {
                    return true;
                }
                if (checkdnsrr($reverse_ip.'.'.$dnsbl_list.'.', 'A')) {
                    return true;
                }
            } elseif ($on_win) {
                $lookup = '';
                @exec('nslookup -type=A '.$reverse_ip.'.'.$dnsbl_list.'.', $lookup);
                foreach ($lookup as $line) {
                    if (strstr($line, $dnsbl_list)) {
                        return true;
                    }
                }
            }
        }
    }
    return false;
}
?>