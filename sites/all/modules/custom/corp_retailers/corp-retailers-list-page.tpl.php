<?php global $user, $base_url;?>
<div id="id_retailer_content_plugin" class="retailer_content">
  <div class="retailer_header_image">
    <?php /// print '<img src="'.$base_url . "/" . drupal_get_path('theme', 'ocarina') . '/images/TheShoppingPro-small.png"  typeof="foaf:Image"/>';?>
  </div>
  <div id="retailer_content" class="plugin_wrapper">
    <?php

    
    foreach($data['items'] as $key=> $item) {
      if ($key =="partners") {
        $title = 'Matching';
      }elseif($key == "most_populars") {
        $title = 'Most Popular';
      }else {
        $title = 'Recommended';
      }

      
      $content = '<div class="'.$key.' retailer_content_row" id="id_'.$key.'">
            <div class="header_row_h2"><h2 class="h2_plugin">'.$title.'</h2></div>
            <div class="'.$key.'_plugin_scroll">';

      foreach($item as $k => $row) {
        // $image = file_load($row->field_image_fid);
        $class = user_is_logged_in() ? '' : 'ctools-use-modal';

        $url = corp_retailers_make_url($row, $data['url'], $data['redirect'], $data['uid2']);
        $desc_text = $row->field_display_text_value;
        if (user_is_logged_in()) {
          $target = "_blank";
          $link_title = l(($row->title),  $url, array('attributes'=>array('target'=>'_blank',),'html'=>TRUE, 'external' => TRUE));
          $desc_link = l(($desc_text),  $url, array('attributes'=>array('target'=>'_blank'),'html'=>TRUE, 'external' => TRUE));
        }else {
          $target = '';
          $link_title = l(($row->title), 'modal_forms/nojs/login' , array('attributes'=>array( 'class'=>array($class)),'html'=>TRUE));
          $desc_link = l(($desc_text), 'modal_forms/nojs/login' , array('attributes'=>array( 'class'=>array($class)),'html'=>TRUE));
        }

        $content .= '<div class="'.$key.'_row content_plugin">
                    <div class="row_header"><h3 class="title_plugin">'.$link_title.'</h3></div>
                    <div class="body_row_plugin">
                       '.$desc_link.'
                    </div>
                  </div>';

      }
      $content .= '</div></div>';
      echo $content;
    }

    ?>
  </div>
</div>