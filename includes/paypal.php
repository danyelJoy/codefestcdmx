<?php 
require 'paypal/autoload.php';
define('URL_SITIO', 'http://localhost:3000/index.php');

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        '', //ClienteID
        ''//Secret
    )
);
?>