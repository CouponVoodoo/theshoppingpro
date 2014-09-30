<?php ?>
<!DOCTYPE html>
<html<?php print $html_attributes . $rdf_namespaces; ?>>
<head>
<?php
//	$current_domain = get_current_domain();
//	if (($node->field_no_index['und']['0']['value'] == 1 &&  $current_domain == 'cuponation')|| arg(0) == 'search'){
	$node = node_load(arg(1));
	
	if ($node->field_no_index['und']['0']['value'] == 1 || arg(0) == 'search'|| arg(0) == 'coupon-redirect'|| arg(0) == 'coupon-details-popup' || $_GET['showpop'] == 1){
?>
	<META NAME="ROBOTS" CONTENT="NOINDEX, FOLLOW">
<?php
	} 
?>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php 
  // MOVE SCRIPTS TO BOTTOM OF PAGE
  // print $scripts; 
  ?>
  <meta name="viewport" content="width=device-width">
 
 
  
</head>
<body class="<?php print $classes; ?>" <?php print $attributes; ?>>
  <div id="skip">
    <a href="#main-menu"><?php print t('Jump to Navigation'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php 
  // MOVE SCRIPTS TO BOTTOM OF PAGE
  print $scripts; 
  ?>
  <?php print $page_bottom; ?>
<?php
 $current_domain = get_current_domain();
 If ($current_domain == 'cuponation'){
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44240799-2', 'cuponation.in');
  ga('require', 'linkid', 'linkid.js');
  ga('send', 'pageview');

</script>


<?php
} else {
?>

 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44240799-1', 'couponvoodoo.com');
  ga('require', 'linkid', 'linkid.js');
  ga('send', 'pageview');

</script>
<?php
}
?> 

<script type="text/javascript">
//<![CDATA[
  (function() {
    var shr = document.createElement('script');
    shr.setAttribute('data-cfasync', 'false');
    shr.src = '//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js';
    shr.type = 'text/javascript'; shr.async = 'true';
    shr.onload = shr.onreadystatechange = function() {
      var rs = this.readyState;
      if (rs && rs != 'complete' && rs != 'loaded') return;
      var site_id = '068cd967a1633fbb1713e5159436759d';
      try { Shareaholic.init(site_id); } catch (e) {}
    };
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(shr, s);
  })();
//]]>
</script>
<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/** COMMENTED BY ASHISH TO DISABLE ECOMMERCE TRACKING

 var google_tag_params = {
ecomm_prodid: 'REPLACE_WITH_VALUE',
ecomm_pagetype: 'REPLACE_WITH_VALUE',
ecomm_totalvalue: 'REPLACE_WITH_VALUE',
};
*/
</script>
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 984586909;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/984586909/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery(".btn-toggle").click(function(){
      jQuery("#main_menu_toggle").show(1000);
    });
    jQuery(".close-btn").click(function(){
      jQuery("#main_menu_toggle").hide(1000);
    });
    jQuery(".filter-toggle").click(function(){
      jQuery("#sidebar-first").toggleClass("sidebar-toggle");
    });
 
    jQuery(".nice_menu1 .content ul li a, .nice_menu1 .content ul li span").click(function(){
      jQuery(this).siblings('ul').toggleClass("open");
      jQuery(this).parent("li").siblings("li").toggleClass("hidden");
    });
    jQuery(".nice_menu1 .content ul li a, .nice_menu1 .content ul li span").hover(function(){
      if(jQuery(window).width()>=750){
        jQuery(this).toggleClass("");
      } else {
        jQuery(this).siblings('ul').css({'display': 'none', 'visibility': 'hidden'});
        return false;
      }
    });
  });
</script>

</body>
</html>
