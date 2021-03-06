<?php print $doctype; ?>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf->version . $rdf->namespaces; ?>>
<head<?php print $rdf->profile; ?>>
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
</head>
<body<?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>