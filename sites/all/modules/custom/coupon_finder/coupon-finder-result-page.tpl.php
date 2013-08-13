<div id="id_referrer_content_plugin" class="referrer_content">
  <div id="referrer_content" class="plugin_wrapper"> 
  
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
<tr>
	<td><?php echo $value->couponcode; ?></td>
	<td><?php echo $value->Saving; ?></td>
	<td><?php echo $value->description; ?></td>
	<td><a href="?width=804&height=219&inline=true#<?php echo $value->couponcode; ?>" class="apply_coupon colorbox-inline">Apply Coupon</a></td>
</tr>
<?php endif;?>

<?php
$domain_value=$value->domain;
$output=db_query("SELECT * FROM {field_data_field_url} fu WHERE fu.field_url_value=:fuv"  ,array(':fuv'=>$domain_value));
foreach ($output as $output_detail1):
$node_load=node_load($output_detail1->entity_id);
$field_url=$node_load->field_url['und'][0]['value'];
$entity_id=$node_load->field_tracking_url['und'][0]['value'];
//Traccking URL entity ID to get url part one
$output_tracking_url=db_query("SELECT * FROM {field_data_field_url_part1} fup WHERE fup.entity_id=:entity_id"  ,array(':entity_id'=>$entity_id));
foreach ($output_tracking_url as $tracking_url):
$tracking_url_part1=$tracking_url->field_url_part1_value;
endforeach;
endforeach;
$apply_coupon_url=$tracking_url_part1.$field_url;

$single_decode=urldecode($value->url);

$redirect=urldecode($single_decode);

$redirect = $tracking_url_part1."&redirect=".urlencode($redirect);

?>	


<div style="display:none">

<div id="<?php echo $value->couponcode; ?>">
<h2 style="text-align:center;color:#F7971C;">Transferring to Retailer Page</h2>
<p>You will now be taken to the retailer page to purchase your product.</p>
<p>We recommend that you install TheShoppingPro plugin so you have the Find Coupon functionality and other such amazing features right on your favorite retailers.</p>
</ br>
</ br>
<div class="coupon_button"><a>Take Me To The Retailer page & Install The Plugin Too</a></div>
<div class="coupon_button"><a href="<?php print $redirect;?>" target="_blank">Just Take Me To My Retailer Page</a></div>
</div>


</div>

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
	<td><?php echo $value->couponcode; ?></td>
	<td><?php echo $value->Saving; ?></td>
	<td><?php echo $value->description; ?></td>
	<td><a href="?width=804&height=219&inline=true#<?php echo $value->couponcode; ?>" class="apply_coupon colorbox-inline">Apply Coupon</a></td>
</tr>
<?php endif;?>


<?php
$domain_value=$value->domain;
$output=db_query("SELECT * FROM {field_data_field_url} fu WHERE fu.field_url_value=:fuv"  ,array(':fuv'=>$domain_value));
foreach ($output as $output_detail1):
$node_load=node_load($output_detail1->entity_id);
$field_url=$node_load->field_url['und'][0]['value'];
$entity_id=$node_load->field_tracking_url['und'][0]['value'];
//Traccking URL entity ID to get url part one
$output_tracking_url=db_query("SELECT * FROM {field_data_field_url_part1} fup WHERE fup.entity_id=:entity_id"  ,array(':entity_id'=>$entity_id));
foreach ($output_tracking_url as $tracking_url):
$tracking_url_part1=$tracking_url->field_url_part1_value;
endforeach;
endforeach;
$apply_coupon_url=$tracking_url_part1.$field_url;

$single_decode=urldecode($value->url);

$redirect=urldecode($single_decode);

$redirect = $tracking_url_part1."&redirect=".urlencode($redirect);

?>	


<div style="display:none">

<div id="<?php echo $value->couponcode; ?>">
<h2 style="text-align:center;color:#F7971C;">Transferring to Retailer Page</h2>
<p>You will now be taken to the retailer page to purchase your product.</p>
<p>We recommend that you install TheShoppingPro plugin so you have the Find Coupon functionality and other such amazing features right on your favorite retailers.</p>
</ br>
</ br>
<div class="coupon_button"><a>Take Me To The Retailer page & Install The Plugin Too</a></div>
<div class="coupon_button"><a href="<?php print $redirect;?>" target="_blank">Just Take Me To My Retailer Page</a></div>
</div>


</div>	   

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
	<td><?php echo $value->couponcode; ?></td>
	<td><?php echo $value->Saving; ?></td>
	<td><?php echo $value->description; ?></td>
	<td><a href="?width=804&height=219&inline=true#<?php echo $value->couponcode; ?>" class="apply_coupon colorbox-inline">Apply Coupon</a></td>
</tr>
<?php endif;?>

<?php
$domain_value=$value->domain;
$output=db_query("SELECT * FROM {field_data_field_url} fu WHERE fu.field_url_value=:fuv"  ,array(':fuv'=>$domain_value));
foreach ($output as $output_detail1):
$node_load=node_load($output_detail1->entity_id);
$field_url=$node_load->field_url['und'][0]['value'];
$entity_id=$node_load->field_tracking_url['und'][0]['value'];
//Traccking URL entity ID to get url part one
$output_tracking_url=db_query("SELECT * FROM {field_data_field_url_part1} fup WHERE fup.entity_id=:entity_id"  ,array(':entity_id'=>$entity_id));
foreach ($output_tracking_url as $tracking_url):
$tracking_url_part1=$tracking_url->field_url_part1_value;
endforeach;
endforeach;
$apply_coupon_url=$tracking_url_part1.$field_url;

$single_decode=urldecode($value->url);

$redirect=urldecode($single_decode);

$redirect = $tracking_url_part1."&redirect=".urlencode($redirect);

?>	


<div style="display:none">

<div id="<?php echo $value->couponcode; ?>">
<h2 style="text-align:center;color:#F7971C;">Transferring to Retailer Page</h2>
<p>You will now be taken to the retailer page to purchase your product.</p>
<p>We recommend that you install TheShoppingPro plugin so you have the Find Coupon functionality and other such amazing features right on your favorite retailers.</p>
</ br>
</ br>
<div class="coupon_button"><a>Take Me To The Retailer page & Install The Plugin Too</a></div>
<div class="coupon_button"><a href="<?php print $redirect;?>" target="_blank">Just Take Me To My Retailer Page</a></div>
</div>


</div>	 

<?php endforeach;?>
	
	</table>
</div>

<?php else:?>
<h2 style="padding-top:20px;text-align:center;text-transform:none;">Oops! Something went wrong. The current demo works only for Jabong product urls that do not need any size selection.</h2>

<?php endif;?>

<h2 style="text-align:center;color:#f7971c;">Try Another Product</h2>
<p>Just enter the url of the product page that you want to buy or the cart page and check if any coupons apply to it.</p>
<div>
<?php $coupon_finder_block=block_render('coupon_finder','coupon_finder_block'); 

print $coupon_finder_block;

?>

</div>








<!--pOP UP bLOCK-->
<?php
//strtolower
/*$domain_value=strtolower($value->domain);
$output=db_query("SELECT * FROM {field_data_field_url} fu WHERE fu.field_url_value=:fuv"  ,array(':fuv'=>$domain_value));
foreach ($output as $output_detail1):


$node_load=node_load($output_detail1->entity_id);

$field_url=$node_load->field_url['und'][0]['value'];
$entity_id=$node_load->field_tracking_url['und'][0]['value'];



//Traccking URL entity ID to get url part one
$output_tracking_url=db_query("SELECT * FROM {field_data_field_url_part1} fup WHERE fup.entity_id=:entity_id"  ,array(':entity_id'=>$entity_id));
foreach ($output_tracking_url as $tracking_url):
$tracking_url_part1=$tracking_url->field_url_part1_value;

endforeach;


endforeach;


$apply_coupon_url=$tracking_url_part1.$field_url*/

?>

<?php /*?><div style="display:none">

<div id="popup_coupon_result">
<h2 style="text-align:center;color:#F7971C;">Transferring to Retailer Page</h2>
<p>You will now be taken to the retailer page to purchase your product.</p>
<p>We recommend that you install TheShoppingPro plugin so you have the Find Coupon functionality and other such amazing features right on your favorite retailers.</p>
</ br>
</ br>
<div class="coupon_button"><a>Take Me To The Retailer page & Install The Plugin Too</a></div>
<div class="coupon_button"><a href="<?php print $apply_coupon_url;?>" target="_blank">Just Take Me To My Retailer Page</a></div>
</div>


</div><?php */?>



</div>

</div>

