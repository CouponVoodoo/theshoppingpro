<?php

/* Example usage of the Amazon Product Advertising API */
include("amazon_api_class.php");
echo "run";
$public_key     = "AKIAJUOJHH7HN4LQ44TA";
$private_key    = "S0nw66PVIsPTljcQl53pHh1h+Po0BA8B6ERZQXdr";
$region         = "com"; // or "CA" or "DE" etc.
 
$obj = new AmazonProductAPI($public_key, $private_key, $region);
$obj->setMedia("display");
$obj->getBrowseNodes("229534");

?>