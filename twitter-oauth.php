<?php
function buildBaseString($baseURI, $method, $params)
{
    $r = array(); 
    ksort($params); 
    foreach($params as $key=>$value){
        $r[] = "$key=" . rawurlencode($value); 
    }            

    return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r)); //return complete base string
}

function buildAuthorizationHeader($oauth)
{
    $r = 'Authorization: OAuth ';
    $values = array();
    foreach($oauth as $key=>$value)
        $values[] = "$key=\"" . rawurlencode($value) . "\""; 

    $r .= implode(', ', $values); 
    return $r; 
}

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

$oauth_access_token = "1089300624-7Riy22A7LcpWn85pMY6shljLOoFEs4v3hqTg5Uc";
$oauth_access_token_secret = "CIjCH8Ht8sEJUyHpskNJIp1zW3F9dl8Ml01DT8ALrv8";
$consumer_key = "ktNkeC1spBxcpTnCjATAEw";
$consumer_secret = "bPp8CFRJrIRVN7RmxjaNgCEPpiclmWxYMqpsjBHSsw";

$oauth = array( 'oauth_consumer_key' => $consumer_key,
                'oauth_nonce' => time(),
                'oauth_signature_method' => 'HMAC-SHA1',
                'oauth_token' => $oauth_access_token,
                'oauth_timestamp' => time(),
                'oauth_version' => '1.0');

$base_info = buildBaseString($url, 'GET', $oauth);
$composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
$oauth['oauth_signature'] = $oauth_signature;


$header = array(buildAuthorizationHeader($oauth), 'Expect:');
$options = array( CURLOPT_HTTPHEADER => $header,
                  CURLOPT_HEADER => false,
                  CURLOPT_URL => $url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_SSL_VERIFYPEER => false);

$feed = curl_init();
curl_setopt_array($feed, $options);
$json = curl_exec($feed);
curl_close($feed);

$twitter_data = json_decode($json);

echo $json;
?>