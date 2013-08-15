<?php

/**
 * @file
 * Default theme implementation to display a term.
 *
 * Available variables:
 * - $name: the (sanitized) name of the term.
 * - $content: An array of items for the content of the term (fields and
 *   description). Use render($content) to print them all, or print a subset
 *   such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $term_url: Direct url of the current term.
 * - $term_name: Name of the current term.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - taxonomy-term: The current template type, i.e., "theming hook".
 *   - vocabulary-[vocabulary-name]: The vocabulary to which the term belongs to.
 *     For example, if the term is a "Tag" it would result in "vocabulary-tag".
 *
 * Other variables:
 * - $term: Full term object. Contains data that may not be safe.
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $page: Flag for the full page state.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the term. Increments each time it's output.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_taxonomy_term()
 * @see template_process()
 */
?>
<?php
$class = user_is_logged_in() ? '' : 'ctools-use-modal ctools-modal-modal-popup-small';

$icon_generate=$content['field_mc_icon']['#object']->field_mc_icon;
$icon_generate=$icon_generate['und'][0]['uri'];

$icon_image=file_create_url($icon_generate);

?>

<!--Current Term Information Box-->
<div id="taxonomy-term-<?php print $term->tid; ?>" class="<?php print $classes; ?>">

<!--First Block start-->
<div class="block block-system block-main block-system-main" style="margin-top:20px;">
<div class="block-inner clearfix">
	<div class="content clearfix">

  <?php if (!$page): ?>
    <h2><a href="<?php print $term_url; ?>"><?php print $term_name; ?></a></h2>
  <?php endif; ?>

  <div class="content">	
		<div class="fl" style="margin:30px 0px 40px 40px;">
			<div class="fl" style="margin-right:30px;">
				<img src="<?php print $icon_image;?>"/>	
			</div>
			<div class="fl" style="margin:20px 0px 0px 26px;">
			<h1 style="color:#f79646;font-family:arial;"><?php print $term->name; ?></h1>
			<strong><?php print $term->description;?></strong>
			</div>
			<div style="clear:both;"><h5><?php print render($content['body']);?></h5></div>    
		</div>	
    <?php //print render($content); ?>
  </div>
  
</div>
</div>  
	</div>

<!--First Block end-->

<!-- Term Retailer relation-->

<!--Second Block start-->
<?php if($nids = taxonomy_select_nodes($term->tid)): ?>

<div id="block-retailers-page" class="block block-system block-main block-system-main retailer_block">
<div class="block-inner clearfix">
	<div class="content clearfix">
	
<?php
$retailer_nid=array();

$nodes = node_load_multiple($nids);

//$build =node_view_multiple($nodes,$view_mode = 'full');


foreach ($nodes as $count => $build):

$retailer_nid[]=$build->field_mc_retailer['und'][0]['nid'];

endforeach;
 
 
$retailer_nodes = node_load_multiple($retailer_nid);

foreach ($retailer_nodes as $retailer_count => $retailer_build):

$retailer_title=$retailer_build->title;

//Domin Value
$domain_value=$retailer_build->field_url['und'][0]['value'];
//Retailer Node ID
$retailer_id=$retailer_build->nid;
//Term ID
$term->tid;

$icon_retailer=$retailer_build->field_image;
$icon_retailer=$icon_retailer['und'][0]['uri'];

$icon_retailer=file_create_url($icon_retailer);

$text_retailer=$retailer_build->field_display_text;
$text_retailer=$text_retailer['und'][0]['safe_value'];

$landing_url=get_landing_url($term->tid,$retailer_id);
$landing_url=$landing_url['landing_url'];

$corp_landing_url=getcashbackurl($domain_value,$landing_url);

print "<a href='".$corp_landing_url."' class='".$class."'><div class='mapped_retailer'><div><div class='mapped_image fl'><img src='".$icon_retailer."'/></div><div class='mapped_title fl'><h3 style='padding-left:20px;'>".$retailer_title."</h3></div></div><div class='mapped_desc'>".$text_retailer."</div></div></a>";

endforeach;

?>		
	</div>
</div>
</div>	

<!--Second Block start-->

<?php endif;?>

<!--Third Block start-->
<script type="text/javascript">
	jQuery(function(){
		jQuery('.taxonomy_menu_retailer li')
			.css('pointer','default')
			.css('list-style-image','none');
		jQuery('.taxonomy_menu_retailer li:has(ul)')
			.click(function(event){
				if (this == event.target) {
					jQuery(this).css('list-style-image',
						(!jQuery(this).children().is(':hidden')) ? 'url(http://theshoppingpro.com/sites/all/themes/ocarina/images/arrow_trans_alt.png)' : 'url(http://theshoppingpro.com/sites/all/themes/ocarina/images/arrow_trans_alt_hr.png)');
					jQuery(this).children().toggle('slow');
				}
				return false;
			})
			.css({cursor:'pointer', 'list-style-image':'url(http://theshoppingpro.com/sites/all/themes/ocarina/images/arrow_trans_alt.png)'})
			.children().hide();
		jQuery('.taxonomy_menu_retailer li:not(:has(ul))').css({cursor:'default', 'list-style-image':'none'});
	});
</script>

	<?php	
	
 // Taxonomy menu block.
    $terms = taxonomy_get_tree(7,$parent =$term->tid); // Use the correct vocabulary id.
   
    // Get the active trail tid-s.
    $active = arg(2);
    $active_parents = taxonomy_get_parents_all($active);
    $active_parents_tids = array();
    foreach ($active_parents as $parent) {
      $active_parents_tids[] = $parent->tid;
    }
   
    // Build the menu.
    $term_count = count($terms);
    $cont = '<ul class="taxonomy_menu_retailer">';
    for ($i = 0; $i < $term_count; $i++) {
      // Build the classes string.
      $classes = '';
	  $depth_term = $terms[$i]->depth;
	  
	   $depth_term;
	  
	  if($depth_term==0) $classes .= 'round_corner ';
      $children = taxonomy_get_children($terms[$i]->tid);
	  
      $active_trail = in_array($terms[$i]->tid, $active_parents_tids);
      if ($active_trail && $children) $classes .= 'expanded active-trail ';
      elseif ($active_trail) $classes .= 'active-trail ';
      elseif ($children) $classes .= 'collapsed ';
	  
	  //$depth = $terms[$i]->depth;
	  
	 // if($depth==0) $classes .= 'expanded active-trail ';
     
      if ($i == 0) $cont .= '<li class="first '.$classes.'">'.$terms[$i]->name;
      else {
        if ($terms[$i]->depth == $depth) $cont .= '</li><li class="'.$classes.'">'.$terms[$i]->name;
        elseif ($terms[$i]->depth > $depth) $cont .= '<ul class="level-'.$terms[$i]->depth.'"><li class="first '.$classes.'">'.$terms[$i]->name;
        elseif ($terms[$i]->depth < $depth) {
          // Add missing end-tags depending of depth level difference.
          for ($j = $terms[$i]->depth; $j < $depth; $j++) {
            $cont .= '</li></ul>';
          }
          $cont .= '</li><li class="'.$classes.'">'.$terms[$i]->name;
        }
        // If we have reached the last element add all possibly missing end-tags.
        if (!isset($terms[$i+1])) {
          for ($j = 0; $j < $terms[$i]->depth; $j++) {
            $cont .= '</li></ul>';
          }
        }
      }
      $depth = $terms[$i]->depth;
    }
    $cont .= '</li></ul>';
	
//	}

	print $cont;
	
	
	?>
		

<!--Third Block end-->


</div>


