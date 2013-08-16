<div id="id_referrer_content_plugin" class="referrer_content">
  <div id="referrer_content" class="plugin_wrapper"> 
  <h2 class="coupon_title">Coupon Finder</h2>
<?php  $data['url'] ?>

<?php


$url = "http://plugin.theshoppingpro.com/CouponAutoWeb.php?q=".urldecode($data['url']);
$json = file_get_contents($url);
$jsonData = preg_replace("/[\\n\\r]+/", " ", $json);

$jsonArray = json_decode($jsonData);
?>
<?php if(isset($jsonArray)): ?>
<!--Best Coupon 1-->
<div class="best_coupons">

<a href="?width=804&height=219&inline=true#testpopup" class="apply_coupon colorbox-inline">Test popup</a>

<div style="display:none;">
<div id="testpopup">
<?php print block_render('block','27'); ?>
</div>

</div>

<h4>Best Coupon</h4>
	<table>
	<tr>
		<th>Coupon</th>
		<th>Savings</th>
		<th>Description</th>
		<th>&nbsp;</th>
	</tr>

	
<?php foreach ($jsonArray as $key => $value): ?>

<?php if($value->BestCoupon==1): ?>
<tr>
	<td class="code"><?php echo $value->couponcode; ?></td>
	<td class="save"><?php echo $value->Saving; ?></td>
	<td class="desc"><?php echo $value->description; ?></td>
	<td class="apply"><a href="?width=804&height=219&inline=true#<?php echo $value->couponcode; ?>" class="apply_coupon colorbox-inline">Apply Coupon</a></td>
</tr>


<?php
$domain_value=$value->domain;
$landing_url=$value->url;
$final_url=getcashbackurl($domain_value,$landing_url);
?>	


<div style="display:none">

<div id="<?php echo $value->couponcode; ?>">
<h2 style="text-align:center;color:#F7971C;">Transferring to Retailer Page</h2>
<p>You will now be taken to the retailer page to purchase your product.</p>
<p>We recommend that you install TheShoppingPro plugin so you have the Find Coupon functionality and other such amazing features right on your favorite retailers.</p>
</ br>
</ br>
<div class="coupon_button"><a href="<?php print $final_url;?>" target="_blank" onclick="window.open('https://www.theshoppingpro.com/installation_page');">Take Me To The Retailer page & Install The Plugin Too</a></div>
<div class="coupon_button"><a href="<?php print $final_url;?>" target="_blank">Just Take Me To My Retailer Page</a></div>
</div>


</div>

<?php endif;?>

<?php endforeach;?>

	</table>
   
</div>

<!--Best Coupon 0 & Successful 1-->

<div class="best_coupons">
<h4>Other Coupon That Worked</h4>
	<table>
	<tr>
		<th>Coupon</th>
		<th>Savings</th>
		<th>Description</th>
		<th>&nbsp;</th>
	</tr>
	
	
<?php foreach ($jsonArray as $key => $value): ?>

<?php if($value->BestCoupon==0 && $value->Successful==1): ?>
<tr>
	<td class="code"><?php echo $value->couponcode; ?></td>
	<td class="save"><?php echo $value->Saving; ?></td>
	<td class="desc"><?php echo $value->description; ?></td>
	<td class="apply"><a href="?width=804&height=219&inline=true#<?php echo $value->couponcode; ?>" class="apply_coupon colorbox-inline">Apply Coupon</a></td>
</tr>


<?php
$domain_value=$value->domain;
$landing_url=$value->url;
$final_url=getcashbackurl($domain_value,$landing_url);
?>		


<div style="display:none">

<div id="<?php echo $value->couponcode; ?>">
<h2 style="text-align:center;color:#F7971C;">Transferring to Retailer Page</h2>
<p>You will now be taken to the retailer page to purchase your product.</p>
<p>We recommend that you install TheShoppingPro plugin so you have the Find Coupon functionality and other such amazing features right on your favorite retailers.</p>
</ br>
</ br>
<div class="coupon_button"><a href="<?php print $final_url;?>" target="_blank" onclick="window.open('https://www.theshoppingpro.com/installation_page');">Take Me To The Retailer page & Install The Plugin Too</a></div>
<div class="coupon_button"><a href="<?php print $final_url;?>" target="_blank">Just Take Me To My Retailer Page</a></div>
</div>


</div>	   

<?php endif;?>

<?php endforeach;?>
	
	</table>
  
    
</div>


<!--Successful 0-->

<div class="best_coupons">
<h4>Coupon That Did Not Worked</h4>
	<table>
	<tr>
		<th>Coupon</th>
		<th>Savings</th>
		<th>Description</th>
		<th>&nbsp;</th>
	</tr>
	
	
<?php foreach ($jsonArray as $key => $value): ?>

<?php if($value->Successful==0): ?>
<tr>
	<td class="code"><?php echo $value->couponcode; ?></td>
	<td class="save"><?php echo $value->Saving; ?></td>
	<td class="desc"><?php echo $value->description; ?></td>
	<td class="apply"><a href="?width=804&height=219&inline=true#<?php echo $value->couponcode; ?>" class="apply_coupon colorbox-inline">Apply Coupon</a></td>
</tr>

<?php
$domain_value=$value->domain;
$landing_url=$value->url;
$final_url=getcashbackurl($domain_value,$landing_url);
?>	


<div style="display:none">

<div id="<?php echo $value->couponcode; ?>">
<h2 style="text-align:center;color:#F7971C;">Transferring to Retailer Page</h2>
<p>You will now be taken to the retailer page to purchase your product.</p>
<p>We recommend that you install TheShoppingPro plugin so you have the Find Coupon functionality and other such amazing features right on your favorite retailers.</p>
</ br>
</ br>
<div class="coupon_button"><a href="<?php print $final_url;?>" target="_blank" onclick="window.open('https://www.theshoppingpro.com/installation_page');">Take Me To The Retailer page & Install The Plugin Too</a></div>
<div class="coupon_button"><a href="<?php print $final_url;?>" target="_blank">Just Take Me To My Retailer Page</a></div>
</div>


</div>	 

<?php endif;?>

<?php endforeach;?>
	
	</table>
</div>

<?php else:?>
<div class="messages error clientside-error">
<label class="error">Oops! Something went wrong. The current demo works only for Jabong product urls.</label>
</div>
<?php endif;?>

<h2 style="text-align:center;color:#f7971c;">Try Another Product</h2>
<p style="padding-left:40px;">Just enter the url of the product page that you want to buy or the cart page and check if any coupons apply to it.</p>
<div>
<?php $coupon_finder_block=block_render('coupon_finder','coupon_finder_block'); 

print $coupon_finder_block;

?>

</div>


</div>

</div>

