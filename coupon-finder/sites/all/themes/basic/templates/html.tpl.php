<?php ?>
<!DOCTYPE html>
<html<?php print $html_attributes . $rdf_namespaces; ?>>
<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php 
  // MOVE SCRIPTS TO BOTTOM OF PAGE
  // print $scripts; 
  ?>
  <meta name="viewport" content="width=device-width">
 
 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44240799-1', 'couponvoodoo.com');
  ga('send', 'pageview');

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
