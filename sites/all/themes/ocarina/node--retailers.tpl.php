<?php 
global $base_url;
global $user;

/*	$track_url=$content['field_tracking_url']['#items'][0]['value'];
	
	$track_url_all = $content['field_tracking_url'][0]['entity']['field_collection_item'][$track_url]['field_url_part1']['#object'];
	$track_url_all_1=$track_url_all->field_url_part1;
	$track_url_all_2=$track_url_all->field_url_part2;
	$url_part_1=trim($track_url_all_1['und'][0]['safe_value']);
	$url_part_2=trim($track_url_all_2['und'][0]['safe_value']);
	$affiliate_name=$track_url_all->field_affiliate;*/

	
/**
* 36 : DGMPRO
* 10 : Direct
* 35 : Komli
* 19 : OMG
* 34 : Shoogloo
* 33 : Tyroo
*/
/*
		$affiliate_id=$affiliate_name=$affiliate_name['und'][0]['tid'];
		
		if($user->uid<>0)
		{
		if($affiliate_id==19):
		$cashback_url=$url_part_1."&uid1=$user->uid";
		elseif($affiliate_id==33 || $affiliate_id==35):
		$cashback_url=$url_part_1."&subid1=$user->uid";
		elseif($affiliate_id==36):
		$cashback_url=$url_part_1."&k=$user->uid";
		endif;
		}else{
		$cashback_url=$base_url."/modal_forms/nojs/login";
		}
		$class = user_is_logged_in() ? '' : 'ctools-use-modal ctools-modal-modal-popup-small';*/
		
		$type=strip_tags(render($content['field_type']));

	?>
	<div id="block-retailers-page" class="block block-system block-main block-system-main">
		<div class="block-inner clearfix">
			<div class="content clearfix">

			<div class="fl" style="margin-left:20px;">
                <div class="fl">
                <?php print render($content['field_image']); ?>
                </div>
                <div class="fl" style="margin:20px 0px 0px 26px;">
                <h1><?php print $title ?></h1>
                </div>
           		<div style="clear:both;"><h5><?php print render($content['body']);?></h5></div>    
            </div>
            <?php if($type=='Partner'): ?>
            <div class="fr" style="width:300px;margin-top:20px;">
<?php /*?>					<a href="<?php print $cashback_url;?>" class="<?php print $class;?>">
<?php */?>					<div class="block">
						<div class="content">							
							<h2>Cashback Offer</h2>
							<h5><?php print render($content['field_display_text']);?></h5>
						</div>
					</div>
<!--					</a>
-->			</div>
            <?php endif; ?>
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
		
		$desc_detail = get_microrelation_display_text($term_record[0][0]->tid,arg(1));	
		if($desc_detail['row_count'] > 0){
		$maincategory_desc=$desc_detail['maincategory_desc'];
		}else{	$maincategory_desc=render($content['field_display_text']); }
		echo $landing_url=$desc_detail['landing_url'];
		// $redirect=strip_tags(render($content['field_url']));
				
	if($term_record[0][0]->name<>""):			
	//$corp_landing_url=get_corp_url($landing_url,$redirect,$url_part_1,$url_part_2,$affiliate_id);
	 $corp_landing_url=getcashbackurl(strip_tags(render($content['field_url'])),$landing_url);
	print "<a href='".$corp_landing_url."' class=".$class."><h2>".$term_record[0][0]->name."</h2>".strip_tags($maincategory_desc)."</a>"; 			
	endif;	
		

		 foreach ($term_record as $child_item => $child_term): 
		$desc_detail1 = get_microrelation_display_text($child_term[1]->tid,arg(1));	
		$desc_detail2 = get_microrelation_display_text($child_term[2]->tid,arg(1));	
		$desc_detail3 = get_microrelation_display_text($child_term[3]->tid,arg(1));	



		//Loop one
		if($child_term[1]->name <> ""):
		if($desc_detail1['row_count'] > 0){
			$maincategory_desc=$desc_detail1['maincategory_desc'];
		 }else{	$maincategory_desc=render($content['field_display_text']); }
		 endif;
		//Loop two
		
		if($child_term[2]->name <> ""):
		if($desc_detail2['row_count'] > 0){
			$maincategory_desc=$desc_detail2['maincategory_desc'];
		 }else{	$maincategory_desc=render($content['field_display_text']); }
		 endif;
		//Loop three
		if($child_term[3]->name <> ""):
		if($desc_detail3['row_count'] > 0){
			$maincategory_desc=$desc_detail3['maincategory_desc'];
		 }else{	$maincategory_desc=render($content['field_display_text']); }
		 endif;		
						
		 //unset($child_term[0]);
		if(isset($child_term[1]->name)):
		echo $landing_url=$desc_detail1['landing_url'];
		//$redirect=strip_tags(render($content['field_url']));	
		
		//$corp_landing_url=get_corp_url($landing_url,$redirect,$url_part_1,$url_part_2,$affiliate_id);
	    $corp_landing_url=getcashbackurl(strip_tags(render($content['field_url'])),$landing_url);
		print "<ul class='first-level'><li><a href='".$corp_landing_url."' class=".$class.">".$child_term[1]->name."<p>".strip_tags($maincategory_desc)."</p></a>"; 			

		if(!isset($child_term[2]->name)):
		print "</li></ul>";
		endif;
		endif;
		if(isset($child_term[2]->name)):
		echo $landing_url=$desc_detail2['landing_url'];
		//$redirect=strip_tags(render($content['field_url']));	
		
		//$corp_landing_url=get_corp_url($landing_url,$redirect,$url_part_1,$url_part_2,$affiliate_id);
		$corp_landing_url=getcashbackurl(strip_tags(render($content['field_url'])),$landing_url);
		print "<ul class='second-level'><li><a href='".$corp_landing_url."' class=".$class.">".$child_term[2]->name."<p>".strip_tags($maincategory_desc)."</p></a>"; 		
		if(!isset($child_term[3]->name)):
		print "</li></ul></li></ul>";
		endif;
		endif;
		if(isset($child_term[3]->name)):
		echo $landing_url=$desc_detail2['landing_url'];
		//$redirect=strip_tags(render($content['field_url']));	
		
		//$corp_landing_url=get_corp_url($landing_url,$redirect,$url_part_1,$url_part_2,$affiliate_id);
		$corp_landing_url=getcashbackurl(strip_tags(render($content['field_url'])),$landing_url);	
	
		print "<ul class='third-level'><li><a href='".$corp_landing_url."' class=".$class."><a>".$child_term[3]->name."<p>".strip_tags($maincategory_desc)."</p></a>";		
		print "</li></ul></li></ul></li></ul>";
		endif;


			
		 endforeach; ?>
	</div>
</div>
</div>
<?php endforeach; ?>


</div>
