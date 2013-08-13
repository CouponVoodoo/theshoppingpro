<div id="id_referrer_content_plugin" class="referrer_content">
  <div id="referrer_content" class="plugin_wrapper"> 
  
<?php  $data['url'] ?>

<?php


$url = "http://plugin.theshoppingpro.com/CouponAutoWeb.php?q=".urldecode($data['url']);
$json = file_get_contents($url);
$jsonData = preg_replace("/[\\n\\r]+/", " ", $json);

$jsonArray = json_decode($jsonData);
?>
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
	<td><a href="#" class="apply_coupon">Apply Coupon</a></td>
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
<tr>
	<td><?php echo $value->couponcode; ?></td>
	<td><?php echo $value->Saving; ?></td>
	<td><?php echo $value->description; ?></td>
	<td><a href="#" class="apply_coupon">Apply Coupon</a></td>
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
<tr>
	<td><?php echo $value->couponcode; ?></td>
	<td><?php echo $value->Saving; ?></td>
	<td><?php echo $value->description; ?></td>
	<td><a href="#" class="apply_coupon">Apply Coupon</a></td>
</tr>
<?php endif;?>

<?php endforeach;?>
	
	</table>
</div>
<h2 style="text-align:center;color:#f7971c;">Try Another Product</h2>
<p>Just enter the url of the product page that you want to buy or the cart page and check if any coupons apply to it.</p>
<div>
<?php $coupon_finder_block=block_render('coupon_finder','coupon_finder_block'); 

print $coupon_finder_block;

?>

</div>







  </div>
</div>


