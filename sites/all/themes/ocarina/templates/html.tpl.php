<?php print $doctype; ?>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf->version . $rdf->namespaces; ?>>
<head<?php print $rdf->profile; ?>>
 <?php if(arg(0)!='login_register') { ?>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>  
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]--> 
  
 
  
  <!--[if IE 8]>
    <link type="text/css" rel="stylesheet" media="all" href="<?php print base_path().path_to_theme(); ?>/css/ie8-fixes.css" />
  <![endif]-->
  <!--[if IE 7]>  
    <link type="text/css" rel="stylesheet" media="all" href="<?php print base_path().path_to_theme(); ?>/css/ie7-fixes.css" />
  <![endif]-->
  <?php } ?>
  <link rel="chrome-webstore-item" href="https://chrome.google.com/webstore/detail/lgaakehnefkaeeclkaafaahlbkcoimdh" />

  <script src="sites/all/libraries/fitvids/jquery.fitvids.js"></script>
  <script>
    jQuery(document).ready(function(){
      jQuery('.video-container').fitVids();
    });
  </script>

</head>
<body<?php print $attributes;?>>
<?php if(arg(0)!='login_register') { ?>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
 
  <?php print $page_top; ?>
    <?php } ?>
  <?php print $page; ?>
    <?php if(arg(0)!='login_register') { ?>
  <?php print $page_bottom; ?>
    <?php } ?>

</body>
</html>

