<div id="id_referrer_content_plugin" class="referrer_content">
  <div id="referrer_content" class="plugin_wrapper"> 
  <h2 class="coupon_title">Coupon Finder</h2>
<?php  $data['url'] ?>
<script>
  function getcouponid(id)
  {
document.getElementById("coupon_copy").innerHTML = id;
var id=id;
  }

</script>



<?php


$url = "http://plugin.theshoppingpro.com/CouponAutoWeb.php?q=".urldecode($data['URL']);
$json = file_get_contents($url);
$jsonData = preg_replace("/[\\n\\r]+/", " ", $json);

$jsonArray = json_decode($jsonData);
?>
<?php if(isset($jsonArray)): ?>
<!--Best Coupon 1-->
<div class="best_coupons">
<h4>BEST COUPON:</h4>
	<table>
	<tr>
		<th>Description</th>
		<th>Savings</th>
		<th>&nbsp;</th>
	</tr>

	
<?php foreach ($jsonArray as $key => $value): ?>

<?php if($value->BestCoupon==10): ?>
<?php
$domain_value=$value->domain;
$landing_url=$value->url;
$final_url=getcashbackurl($domain_value,$landing_url);
?>
<tr>
	<td class="desc"><?php echo $value->description; ?></td>
    <td class="save"><?php echo $value->Saving; ?></td>
	<td class="apply coupon_button"><a href="?width=804&height=560&inline=true#welcome-message" target="_blank" onclick="window.open('<?php print $final_url;?>');getcouponid(this.id); return false;" class="apply_coupon colorbox-inline" id="<?php echo $value->couponcode; ?>">Copy Coupon</a></td>
</tr>
<?php else:?>
<tr><td colspan="3">No Coupons of this type found.</td></tr>

<?php endif;?>

<?php endforeach;?>

	</table>
   
</div>

<!--Best Coupon 0 & Successful 1-->

<div class="best_coupons">
<h4>OTHER COUPONS THAT WORK:</h4>
	<table>
	<tr>
		<th>Description</th>
		<th>Savings</th>
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
	<td class="desc"><?php echo $value->description; ?></td>
	<td class="save"><?php echo $value->Saving; ?></td>    
	<td class="apply coupon_button"><a href="?width=804&height=560&inline=true#welcome-message" target="_blank" onclick="window.open('<?php print $final_url;?>');getcouponid(this.id); return false;" class="apply_coupon colorbox-inline" id="<?php echo $value->couponcode; ?>" name="<?php echo $value->couponcode; ?>">Copy Coupon</a></td>
</tr>
<?php else:?>
<tr><td colspan="3">No Coupons of this type found.</td></tr>

<?php endif;?>

<?php endforeach;?>
	
	</table>
  
    
</div>


<!--Successful 0-->

<div class="best_coupons">
<h4>COUPONS THAT DID NOT WORK:</h4>
	<table>
	<tr>
		<th>Description</th>
		<th>Savings</th>
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
	<td class="desc"><?php echo $value->description; ?></td>
    <td class="save"><?php echo $value->Saving; ?></td>
	<td class="apply coupon_button"><a href="?width=804&height=560&inline=true#welcome-message" target="_blank" onclick="window.open('<?php print $final_url;?>');getcouponid(this.id); return false;" class="apply_coupon colorbox-inline" id="<?php echo $value->couponcode; ?>">Copy Coupon</a></td>
</tr>
<?php else:?>
<tr><td colspan="3">No Coupons of this type found.</td></tr>
<?php endif;?>

<?php endforeach;?>
	
	</table>
</div>

<?php else:?>
<div class="error clientside-error" style="padding:11px;">
<label class="error">Oops! Something went wrong. The current demo works only for Jabong product urls.</label>
</div>
<?php endif;?>

<h2 style="text-align:center;color:#f7971c;">Try Another Product</h2>
<p style="padding-left:10px;">Coupon finder is your magical tool that automatically finds coupons for the product that you want to buy. Just enter the URL of the product you want to buy below and get the best coupons that work right away:</p>
<div>
<?php $coupon_finder_block=block_render('coupon_finder','coupon_finder_block'); 

print $coupon_finder_block;

?>

</div>

<!--Pop Up Section-->

<div style="display:none;">
<div style="display:table-cell; text-align: center; padding-top:5px" id="welcome-message">
<div id="hide_content">
<div>
<img src="/sites/default/files/The_Shopping_Pro_Logo-250px.png" style="width:150px;" />
</div>
<div style="float:left; width:100%; margin:5px 0;">

<h2 style="color:#F7971C">Coupon Code "<span id="coupon_copy"></span>" copied! Paste it in the coupon code box on the retailer site</h2>
<p style="width:auto;padding:5px;font-size:11pt;font-weight:bold;margin-top:0px;">
</p>

<div style="float:left; width:100%; margin:0">
<!--Installer Button-->
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


<p>We strongly recommend that you install TheShoppingPro plugin that will get the coupon finder functionality, prices and cashback offers right to you as you shop. Here's a quick video to get you started:</p>
<iframe frameborder="0" name="cbox1376655443154" src="http://www.youtube.com/embed/rWFoIQTAOQI?wmode=transparent&amp;amp;rel=0&amp;amp;autoplay=1&amp;amp;end=93&amp;width=300&amp;height=281&amp;iframe=true" scrolling="no" class="cboxIframe"></iframe>
<!--<a id="video_block" href="#" cursor:pointer>
<img src="/sites/all/themes/ocarina/images/Play_Video.png"  alt="Play Video"/>
</a>-->
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



<?php
drupal_add_js((drupal_get_path('module', 'partner_program') .'/zeroclipboard.js'),
array('type' => 'file', 'scope' => 'header', 'weight' => 1)
);

?>

<input type="text" name="boxcopy" id="boxcopy" value="COPY TEXT"/>

<input type="button" id="copys" name="copys" value="Copy to Clipboard" />

<script>

//function getcopy(id){
/*var button_name=jQuery('#coupon_copy').text();
alert(button_name);*/
//alert(id);
//set path
ZeroClipboard.setMoviePath('http://davidwalsh.name/demo/ZeroClipboard.swf');
//create client
var clip = new ZeroClipboard.Client();
//event
clip.addEventListener('mousedown',function() {
clip.setText(document.getElementById('boxcopy').value);
});
clip.addEventListener('complete',function(client,text) {
alert('copied: ' + text);
});
//glue it to the button
clip.glue('copys');

//}

</script>