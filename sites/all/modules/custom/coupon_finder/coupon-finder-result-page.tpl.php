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
<?php
$domain_value=$value->domain;
$landing_url=$value->url;
$final_url=getcashbackurl($domain_value,$landing_url);
?>
<tr>
	<td class="code"><?php echo $value->couponcode; ?></td>
	<td class="save"><?php echo $value->Saving; ?></td>
	<td class="desc"><?php echo $value->description; ?></td>
	<td class="apply coupon_button"><a href="?width=804&height=525&inline=true#welcome-message" target="_blank" onclick="window.open('<?php print $final_url;?>');" class="apply_coupon colorbox-inline">Copy Coupon</a></td>
</tr>

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
<?php
$domain_value=$value->domain;
$landing_url=$value->url;
$final_url=getcashbackurl($domain_value,$landing_url);
?>
<tr>
	<td class="code"><?php echo $value->couponcode; ?></td>
	<td class="save"><?php echo $value->Saving; ?></td>
	<td class="desc"><?php echo $value->description; ?></td>
	<td class="apply coupon_button"><a href="?width=804&height=525&inline=true#<?php echo $value->couponcode; ?>" target="_blank" onclick="window.open('<?php print $final_url;?>');" class="apply_coupon colorbox-inline">Copy Coupon</a></td>
</tr>


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
<?php
$domain_value=$value->domain;
$landing_url=$value->url;
$final_url=getcashbackurl($domain_value,$landing_url);
?>
<tr>
	<td class="code"><?php echo $value->couponcode; ?></td>
	<td class="save"><?php echo $value->Saving; ?></td>
	<td class="desc"><?php echo $value->description; ?></td>
	<td class="apply coupon_button"><a href="?width=804&height=525&inline=true#welcome_home" target="_blank" onclick="window.open('<?php print $final_url;?>');" class="apply_coupon colorbox-inline">Apply Coupon</a></td>
</tr>

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

<!--Pop Up Section-->

<div style="display:none;">
<div style="display:table-cell; text-align: center; padding-top: 20px" id="welcome-message">
<div id="hide_content">
<div>
<img src="/sites/default/files/The_Shopping_Pro_Logo-250px.png" style="width: 300px;" />
</div>
<div style="color:#25ade3; margin-bottom: 10px;float:left; width:100%;">
Easy, Intelligent & Rewarding Shopping
</div>
<div style="float:left; width:100%; margin: 10px 0">
<a id="video_block" href="#" cursor:pointer>
<img src="/sites/all/themes/ocarina/images/Play_Video.png"  alt="Play Video"/>
</a>
</div>
<div style="float:left; width:100%; margin: 10px 0;">


<?php foreach ($jsonArray as $key => $value): ?>

<?php if($value->BestCoupon==1): ?>
<div class="block"><?php echo $value->couponcode; ?></div>
<?php endif;?>
<?php if($value->BestCoupon==0 && $value->Successful==1): ?>
<div class="block"><?php echo $value->couponcode; ?></div>
<?php endif;?>
<?php if($value->Successful==0): ?>
<div class="block"><?php echo $value->couponcode; ?></div>
<?php endif;?>
<?php endforeach;?>



<div style="float:left; width:100%; margin: 10px 0;">
<?php

$browser = getBrowserInfo();
if ($browser['name']=="Google Chrome") {
// if (is_chrome()) {
print '<button onclick="chrome.webstore.install()" style="background-image: url(http://theshoppingpro.com/sites/all/themes/ocarina/images/blue/blue_button_big_chrome.png);height: 90px;width: 60%;background-size: 100%;background-repeat: no-repeat;border: none;" id="install-button"> </button>';
}
else {
?>
<script type="text/javascript" src="https://w9u6a2p6.ssl.hwcdn.net/javascripts/installer/installer.js"></script>
<script type="text/javascript">
var __CRI = new crossriderInstaller({
app_id:28108,
app_name:'TheShoppingPro'
});

var _cr_button = new __CRI.button({
text:'Click Here to Install TheShoppingPro Plugin',
button_size:'big',
color:'blue'
});

//__CRI.install(); //use this if you want to use your own button
</script>
<div id="crossriderInstallButton"></div>
<?php
}
?>
</div>
<div style="float:left; width:100%; margin: 10px 0;">
Free for <img src="/sites/all/themes/ocarina/images/browser-logos-small.png" /> on <img src="sites/all/themes/ocarina/images/OS_Logo.png" style="height: 37px !important;" />
</div>

</div>
</div>
<div id="plugin_video" style="display:none;width:640px;height:281px">
<iframe frameborder="0" name="cbox1376655443154" src="http://www.youtube.com/embed/rWFoIQTAOQI?wmode=transparent&amp;amp;rel=0&amp;amp;autoplay=0&amp;amp;end=93&amp;width=640&amp;height=281&amp;iframe=true" scrolling="no" class="cboxIframe"></iframe>
</div>
</div>
</div>


<!--Popu end-->



</div>

</div>


<script>
jQuery( "#video_block" ).click(function() {
jQuery( "#hide_content" ).css( "display", "none" );
jQuery( "#plugin_video" ).css( "display", "block" );
});

jQuery( ".apply_coupon" ).click(function() {
jQuery( "#plugin_video" ).css( "display", "none" );
jQuery( "#hide_content" ).css( "display", "block" );
});
</script>