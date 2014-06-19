<?php

/* Example usage of the Amazon Product Advertising API */
include("amazon_api_class.php");
echo "run";
$public_key     = "AKIAJUOJHH7HN4LQ44TA";
$private_key    = "S0nw66PVIsPTljcQl53pHh1h+Po0BA8B6ERZQXdr";
$region         = "com"; // or "CA" or "DE" etc.
 
$arr = array(1036592,2619525011,2617941011,15690151,165796011,11055981,1000,301668,4991425011,195208011,2625373011,172282,3580501,16310101,3760931,285080,228239,3880591,133141011,284507,2972638011,599872,10304191,2350149011,195211011,301668,11091801,1084128,286168,541966,12923371,502394,409488,3375251,468240,165793011,404272,130,468642,377110011,508494,13900851);
foreach ($arr as &$value) {
	echo $value;
	$obj = new AmazonProductAPI($public_key, $private_key, $region);
	//$obj->setMedia("display");
	/* Write the BrowseNodes to a CSV file */
	$obj->setMedia("csv", "./sites/all/libraries/amazon-browsenodes/exports/nodes-".$value.".csv");
	$obj->getBrowseNodes($value);
	nl2br("/n/n");
	echo "end";
	nl2br("/n/n");
}
 



?>