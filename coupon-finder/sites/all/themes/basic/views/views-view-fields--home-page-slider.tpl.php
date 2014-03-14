<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>


<?php
global $base_url;
$product_name =  strip_tags($fields['field_retailer_product_name']->content);
$nid =  $row->nid;
$path = $base_url.'/'.drupal_lookup_path('alias',"node/".$nid);
?>
<a href='<?php echo $path; ?>'>
	<div class="ribbon-wrapper-green">
			<div class="ribbon-green"><?php echo strip_tags($fields['field_best_coupon_saving']->content).' Off'; ?></div>
	</div>
</a>

<?php foreach ($fields as $id => $field): ?>
  <?php if (!empty($field->separator)): ?>
    <?php print $field->separator; ?>
  <?php endif; ?>

  <?php print $field->wrapper_prefix; ?>
    <?php print $field->label_html; ?>
	
	
    <?php 
	switch ($field->class) {
			case "field-retailer-product-name":
				echo "<a href='{$path}'>".substr(strip_tags($field->content),0,30).'...'"</a>";
			break;
	?>
	<?php
			case "field-product-image":
				$image = strip_tags($field->content);
				echo "<a href='{$path}'><img src='{$image}' typeof='foaf:Image' alt='name'></a>";
			break;
			case "field-product-price":
				echo "<strike>".$field->content."</strike>";
			break;
			case "field-best-coupon-saving";
				//echo 'Save: '.strip_tags($field->content); //commenting out saving as its being used in the ribbon
			break;

			
			default:
				print $field->content;
	}
	
	
	?>
  <?php print $field->wrapper_suffix; ?>
<?php endforeach; ?>