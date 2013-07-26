<?php global $user, $base_url;?>
<div id="id_retailer_content_plugin" class="retailer_content">
    <?php /// print '<img src="'.$base_url . "/" . drupal_get_path('theme', 'ocarina') . '/images/TheShoppingPro-small.png"  typeof="foaf:Image"/>';?>
  <div id="retailer_content" class="plugin_wrapper">
    <?php
    foreach($data['items'] as $key=> $item) {
      if ($key =="partners") {
        $row = &$item[0];
        $class = user_is_logged_in() ? 'plugin_title_row' : 'ctools-use-modal plugin_title_row';
        $row->field_display_text_value = strip_tags($row->field_display_text_value);
        $row->field_display_text_value = '<div class="plugin_desc" id="plugin_desc">'.$row->field_display_text_value .'&nbsp;  (Cashback cannot exceed order value)</div>';
        $row->field_display_text_value .= '<div class="plugin_image" id="plugin_image"><img id="makecenter" src="'.$base_url . "/" . drupal_get_path('theme', 'ocarina') . '/images/greenbutton.png?q=1"  typeof="foaf:Image"/></div>';
        if (user_is_logged_in()) {
          $target = "_blank";
          $link_title = l(($row->title),  $url, array('attributes'=>array('target'=>'_blank', 'class'=>array($class)),'html'=>TRUE, 'external' => TRUE));
        }else {
          $target = '';
          $link_title = l(($row->title), 'modal_forms/nojs/login' , array('attributes'=>array( 'class'=>array($class)),'html'=>TRUE));
        }
        $row->title = '';
        $title = 'Cashback @ ' . $link_title;

      }elseif($key == "most_populars") {
        // Track user.
        $referrer = token_replace("[user:referral-link]", array('user'=>$user));

        drupal_add_js('jQuery(document).ready(function () {
                       jQuery.ajax({
                          url: "'.corp_retailers_track_user($data["url"], $user->uid, $data["uid2"], $referrer).'",
                          async: true,
                          dataType: "jsonp",
                          success: function (data) {
                            //alert(1);
                          }
                        });
                      });', 'inline');

       # echo l('',corp_retailers_track_user($data['url'], $user->uid, $data['uid2'], $referrer));
        $title = 'Popular Cashback';
      }else {
        $title = ' Best Cashback';
      }


      $content = '<div class="'.$key.' retailer_content_row" id="id_'.$key.'">
            <div class="header_row_h2"><h2 class="h2_plugin">'.$title.'</h2></div>
            <div class="'.$key.'_plugin_scroll">';

      foreach($item as $k => $row) {
        // $image = file_load($row->field_image_fid);
        $class = user_is_logged_in() ? '' : 'ctools-use-modal ctools-modal-modal-popup-small';

        $url = corp_retailers_make_url($row->urls, $row->field_url_value, $data['url'], $data['redirect'], $data['uid2'], $row->field_active_affiliate_tid);
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

        $header_row = '';
        if ($row->title) {
          $header_row = '<div class="row_header"><h3 class="title_plugin">'.$link_title.'</h3></div>';
        }

        $content .= '<div class="'.$key.'_row content_plugin">
                    '.$header_row.'
                    <div class="body_row_plugin">
                       '.$desc_link.'
                    </div>
                  </div>';

      }
//Passing referral info for api
$cookie = unserialize($_COOKIE[referral_data]);
if($user->uid <> 0){
$rid=referral_get_user($user->uid);
}else if(isset($_COOKIE[referral_data])){
$rid=$cookie['uid'];
}else if($rid==""){
$rid="NULL";
}

if($rid==""){ $rid="NULL";}

$referral_info = array(
'referrerid' => $rid,
'uid' => $user->uid,
);
      $content .= '</div></div>';

      echo $content;
    }

//Passing referral info for api
$referral_uri = '<div id="referral_api"></div><input type="text" value="http://54.243.150.171/partnerReferralMapping.php?uid2='.$_GET[uid2].'&referralID='.$referral_info[referrerid].'&drupalUserID='.$referral_info[uid].'" id="url_value" style="display:none;"/>';

echo $referral_uri;
/*
$content1 .= 'uid2='.$_GET[uid2].'<br>';
$content1 .= 'ReferrerId='.$referral_info[referrerid].'<br>';
$content1 .= 'User ID='.$referral_info[uid].'<br>';

$content1 .='http://54.243.150.171/partnerReferralMapping.php?uid2='.$_GET[uid2].'&referralID='.$referral_info[referrerid].'&drupalUserID='.$referral_info[uid].'';

echo $content1;

*/

    ?>
<script>
jQuery(function(){
var urlvalue=jQuery('#url_value').val();

jQuery('#referral_api').replaceWith('<iframe style="width:1px;" name="referral_api" src="'+urlvalue+'">');

});
</script>

  </div>
</div>
