<?php global $user; ?>

<div class="view-header">
  <?php print '<img src="' . theme_get_setting('logo') . '"  typeof="foaf:Image"/>';?>
</div>
<?php

#($data);exit;

foreach($data['items'] as $key=> $item) {
  $partner_block = new stdClass();
  if ($key =="partners"){
    $partner_block->title = 'Matching';
  }elseif($key == "most_populars"){
    $partner_block->title = 'Most Popular';
  }else{
    $partner_block->title = 'Recommended';
  }
  
  $partner_block->content = '';
  foreach($item as $k => $row) {
    $image = file_load($row->field_image_fid);
    $class = user_is_logged_in() ? '' : 'ctools-use-modal';

    $url = corp_retailers_make_url($row, $data['url'], $data['redirect'], $data['uid2']);
    $desc_link = user_is_logged_in() ? $url : url('/modal_forms/nojs/login');
    $image_path = file_create_url($image->uri);

    $desc_text = user_is_logged_in() ? 'CLICK & '.$row->field_display_text_value : 'LOGIN &amp;'.$row->field_display_text_value;


    if (user_is_logged_in()) {
      $target = "_blank";
      $link_title = l($row->title,  $url, array('query' => array('uid'=>$user->uid, 'uid2'=>$data['uid2']), 'attributes'=>array('target'=>'_blank'), 'external' => TRUE));
    }else {
      $target = '';
      $link_title = l($row->title, $url, array('colorbox'=>true, 'attributes'=>array('class'=>'colorbox_form', 'id'=>'colorbox_form')));
    }

    $partner_block->content .= '
    <div class="view-content">
      <div class="views-row">
      <div class="views-field">
          <span class="field-content">
            '.$link_title.'
          </span>
      </div>
      <div class="views-field">
          <span class="field-content">
            <a class="'.$class.'" href="'.$desc_link.'">
              <img width="100" height="100" typeof="foaf:Image" src="'.$image_path.'">
            </a>
            <a class="'.$class.'" href="'.$desc_link.'" target="'.$target.'">'.$desc_text.'</a>
          </span>
      </div>
      </div>
    </div>';

  }
  $contents[] = $partner_block;
}
echo theme('accordion_block', array('content'=>$contents));
?>
