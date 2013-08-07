<?php 
	$track_url=$content['field_tracking_url']['#items'][0]['value'];
	
	$track_url_all = $content['field_tracking_url'][0]['entity']['field_collection_item'][$track_url]['field_url_part1']['#object'];
	$track_url_all_1=$track_url_all->field_url_part1;
	$url_part_1=trim($track_url_all_1['und'][0]['safe_value']);

	?>
	<div id="block-retailers-page" class="block block-system block-main block-system-main">
		<div class="block-inner clearfix">
			<div class="content clearfix">

			<div class="fl" style="margin-left:20px;">
                <div class="fl">
                <?php print render($content['field_image']); ?>
                </div>
                <div class="fl" style="margin:20px 0px 0px 50px;">
                <h1><?php print $title ?></h1>
                </div>
           		<div style="clear:both;"><h5>Retailer node field</h5></div>    
            </div>
            <div class="fr" style="width:300px;margin-top:20px;">
					<a href="<?php print $url_part_1;?>">
					<div class="block">
						<div class="content">							
							<h2>Cashback Offer</h2>
							<p>Retailer Display Text.</p>
						</div>
					</div>
					</a>
			</div>
            
            </div>
		</div>
	</div>
	
<div>	

<?php
$term_merge=array();
 $result = db_query("SELECT *
FROM {field_revision_field_mc_retailer} fmcr
INNER JOIN {field_data_field_micro_category} fmc ON fmcr.entity_id=fmc.entity_id
WHERE fmcr.field_mc_retailer_nid=:mrn ORDER BY fmc.field_micro_category_tid"  ,array(':mrn'=>$node->nid));

 foreach ($result as $count => $record): 
		$term_relation_list=taxonomy_get_parents_all($record->field_micro_category_tid);		
		$term_relation_list=array_reverse($term_relation_list);
		$count_term_items=count($term_relation_list);
		
		$row_count=$result->rowCount();
		
		$term_merge[$term_relation_list[0]->tid][]=$term_relation_list;
 endforeach; 	

 foreach ($term_merge as $main_category => $term_record): ?>
<div id="block-retailers-page" class="block block-system block-main block-system-main"  style="float:left;margin-right:20px;min-height:315px;">
<div class="block-inner clearfix">
	<div class="content clearfix">
		<?php
		 print "<h2>".$term_record[0][0]->name."</h2>"; 
		
		
		if($term_record[0][0]->description <> ""):
		$maincategory_desc=$term_record[0][0]->description;
		else:
		$maincategory_desc='Retailer - Micro Category Description.';
		endif;
		
		
		 print $maincategory_desc;
		 foreach ($term_record as $child_item => $child_term): 
		
		
		//Loop one
		if($child_term[1]->description <> ""):
		$childcategory_desc1=$child_term[1]->description;
		else:
		$childcategory_desc1='Retailer - Micro Category Description.';
		endif;
		//Loop two
		if($child_term[2]->description <> ""):
		$childcategory_desc2=$child_term[2]->description;
		else:
		$childcategory_desc2='Retailer - Micro Category Description.';
		endif;
		//Loop three
		if($child_term[3]->description <> ""):
		$childcategory_desc3=$child_term[3]->description;
		else:
		$childcategory_desc3='Retailer - Micro Category Description.';
		endif;							
				
		if(isset($child_term[1]->name)):
		print "<ul class='first-level'><li><h3>".$child_term[1]->name."</h3>";
		print $childcategory_desc1;
		if(!isset($child_term[2]->name)):
		print "</li></ul>";
		endif;
		endif;
		if(isset($child_term[2]->name)):
		print "<ul class='second-level'><li><h3>".$child_term[2]->name."</h3>";
		print $childcategory_desc2;
		if(!isset($child_term[3]->name)):
		print "</li></ul></li></ul>";
		endif;
		endif;
		if(isset($child_term[3]->name)):
		print "<ul class='third-level'><li><h3>".$child_term[3]->name."</h3>";
		print $childcategory_desc3;
		print "</li></ul></li></ul></li></ul>";
		endif;


			
		 endforeach; ?>
	</div>
</div>
</div>
<?php endforeach; ?>


</div>
