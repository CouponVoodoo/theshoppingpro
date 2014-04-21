<?php ?>
<!DOCTYPE html>
<html<?php print $html_attributes . $rdf_namespaces; ?>>
<head>
<?php
//	$current_domain = get_current_domain();
//	$node = node_load(arg(1));
//	if (($node->field_no_index['und']['0']['value'] == 1 &&  $current_domain == 'cuponation')|| arg(0) == 'search'){
	if ($node->field_no_index['und']['0']['value'] == 1 || arg(0) == 'search'){
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
</body>
</html>
