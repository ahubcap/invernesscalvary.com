<?php
require_once('../assets/includes/Stripe/vendor/autoload.php');

$stripe = array(
    "secret_key"    => "sk_test_Y1IVoQsM5uhVeTMRGsigye27",
    "publishable_key" => "pk_test_dRYb1JZctOJWKYNhhNk3SxYi"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>