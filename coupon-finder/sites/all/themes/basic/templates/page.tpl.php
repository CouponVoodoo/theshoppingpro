<?php 
// print_r(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)); die;
$current_domain = get_current_domain();
// <script type="text/javascript" src="<?php echo base_path().path_to_theme(); ?'>/js/jquery.clipboard.js"></script> // removed ' added in ? > to comment out

?>

<div id="page" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <!-- ______________________ HEADER _______________________ -->

  <?php if (empty($_GET['pop'])) { ?>
  
  <header id="header">
   <div class="wrap">
     <?php if ($page['top_menu']): ?>
      <div class="top_menu">
      <?php print render($page['top_menu']) ?>
      </div>  
    <?php endif; ?> 
    <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
        <!-- <img src="http://10.0.0.108/coupon/sites/default/files/CoupponVoodoo_header_logo_60px2.png" alt="<?php print t('Home'); ?>"/> -->
      </a>
    <?php endif; ?>
     
    <button class="btn-toggle" type="button">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    
     
    <?php if ($GLOBALS['_domain']['subdomain'] != 'offers.couponvoodoo.com' && $GLOBALS['_domain']['subdomain'] != 'buyonline.couponvoodoo.com') { ?>
    <div class="main_menu show-menu" id="main_menu_toggle">
            <span class="close-btn">x</span>
    <?php if ($page['main_menu']): ?>
      <?php print render($page['main_menu']) ?>
    <?php endif; ?>  
    </div>
    <?php } ?>

    <?php if ($site_name || $site_slogan): ?>
      <div id="name-and-slogan">

        <?php if ($site_name): ?>
          <?php if ($title): ?>
            <div id="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a>
            </div>
          <?php else: /* Use h1 when the content title is empty */ ?>
            <h1 id="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a>
            </h1>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
          <div id="site-slogan"><?php print $site_slogan; ?></div>
        <?php endif; ?>

      </div>
    <?php endif; ?>

	 <?php if ($page['header']): ?>
      <div id="header-region">
        <?php print render($page['header']); ?>
      </div>
    <?php endif; ?>
     <div class="search-bar-responsive" style="display: none;">
     <?php echo render(drupal_get_form('coupons_finder_form')); ?>
     </div>
     <?php if (arg(0) == 'search') { ?>
    <div class="filter-btn">
      <button type="button" class="filter-toggle">Filter By</button>
    </div>
     <?php } ?>
</div>
    <?php if ($GLOBALS['_domain']['subdomain'] == 'offers.couponvoodoo.com' || $GLOBALS['_domain']['subdomain'] == 'buyonline.couponvoodoo.com') { ?>
    <div class="main_menu">
    <?php if ($page['main_menu']): ?>
      <?php print render($page['main_menu']) ?>
    <?php endif; ?>  
    </div>
    <?php } ?>
  </header> 
    <!-- /header -->
<?php } ?>
	
  <?php if ($main_menu || $secondary_menu): ?>
    <nav id="navigation" class="menu <?php if (!empty($main_menu)) {print "with-primary";}
      if (!empty($secondary_menu)) {print " with-secondary";} ?>">
      <?php print theme('links', array('links' => $main_menu, 'attributes' => array('id' => 'primary', 'class' => array('links', 'clearfix', 'main-menu')))); ?>
      <?php print theme('links', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary', 'class' => array('links', 'clearfix', 'sub-menu')))); ?>
    </nav> <!-- /navigation -->
  <?php endif; ?>

  <!-- ______________________ MAIN _______________________ -->

  <div id="main" class="clearfix">
    
    <div class="locader">
      <p style="text-align:center; position:relative;"></p>
      <p class="frog_title"> Frugal Froggy At Work (may take a minute or two!)</p>
      <img width="400px" alt="Loading..." src="<?php echo base_path() ?>sites/all/themes/basic/images/Frugal_Froggy.jpg" class="frog">
      <img src="<?php echo base_path() ?>sites/all/themes/basic/images/Loader-Dollar.gif" class="dollor">
    </div>
    <section id="content">

        <?php if ($breadcrumb || $title|| $messages || $tabs || $action_links): ?>
		
		<!-- BY ASHISH TO SHOW POP IN NEW TAB FROM LANDING PAGES-->
		<div id="product_popup"><a href="<?php print $_GET['popurl']; ?>" rel='lightframe[|width:980px; height:1200px; scrolling: auto;]' ></a></div>
		<?php
		if (!empty($_GET['popdisplay'])) {
			$refer_url = $_SERVER['HTTP_REFERER'];
			$pos = strpos($refer_url, 'popdisplay');
			if ($pos !== false) {
				$parts = parse_url($refer_url);
				parse_str($parts['query'], $query);
				$popdisplay_refer = $query['popdisplay'];
					if ( $popdisplay_refer !== $_GET['popdisplay']) {
						drupal_add_js ("jQuery(document).ready(function() { jQuery('#product_popup a').trigger('click'); });", array('type' => 'inline', 'scope' => 'footer'));
					}
			} else {
				drupal_add_js ("jQuery(document).ready(function() { jQuery('#product_popup a').trigger('click'); });", array('type' => 'inline', 'scope' => 'footer'));
			}
			}
		?>
		<div id="content-header">

            <?php print $breadcrumb; ?>

            <?php if ($page['highlighted']): ?>
              <div id="highlighted"><?php print render($page['highlighted']) ?></div>
            <?php endif; ?>

            <?php print render($title_prefix); ?>

       

            <?php print render($title_suffix); ?>
              <?php if (!$is_front): ?>
                <?php print $messages; ?>
              <?php endif; ?>
            <?php print render($page['help']); ?>

            <?php if ($tabs): ?>
              <div class="tabs"><?php print render($tabs); ?></div>
            <?php endif; ?>
            <?php if ($page['top_search']): ?>
              <?php print render($page['top_search']) ?>
            <?php endif; ?>  

            <?php if ($action_links): ?>
              <ul class="action-links"><?php print render($action_links); ?></ul>
            <?php endif; ?>

          </div> <!-- /#content-header -->
        <?php endif; ?>

        <div id="content-area">
		     <?php if ($title): ?>
              <h1 class="title"><?php 
									if(arg(0) == 'taxonomy') {
										if ($current_domain == 'couponvoodoo') {
											print str_replace('.com','',$title).' Products Coupons, Deals & Offers in India';
										} else { 
											print 'Coupons and Discount Offers '.str_replace('.com','',$title).' Products';
										} 
									} else {
										print $title;
									}
								?>
								</h1>
            <?php endif; ?>
          <?php if ($is_front):?>
    <!--        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
				<img src="<?php 
							if ($current_domain == 'cuponation') {
								print base_path() . drupal_get_path('theme', 'basic') . '/images/logo-cuponation.png';
							} else { 
								print base_path() . drupal_get_path('theme', 'basic') . '/images/CouponVoodoo_main_logo.png';
							} 
						?>" alt="<?php print t('Home'); ?>"/>
			</a>
	-->		
		<?php endif; ?>
          <?php if ($is_front): ?>
                <?php print $messages; ?>
          <?php endif; ?>
          <?php print render($page['content']) ?>
        </div>

        <?php print $feed_icons; ?>

    </section> <!-- /content-inner /content -->

	<?php if (empty($_GET['pop'])) { ?>
  
	
    <?php if ($page['sidebar_first']): ?>
      <aside id="sidebar-first" class="column sidebar first">
        <span class="filter-close-button">X</span>
        <?php print render($page['sidebar_first']); ?>
        
      </aside>
    <?php endif; ?> <!-- /sidebar-first -->
    
    <?php if ($page['sidebar_second']): ?>
      <aside id="sidebar-second" class="column sidebar second">
        <?php print render($page['sidebar_second']); ?>
      </aside>
    <?php endif; ?> <!-- /sidebar-second -->

	<?php } ?>
	
  </div> <!-- /main -->

  <!-- ______________________ FOOTER _______________________ -->

  <?php if (empty($_GET['pop'])) { ?>
  
  <?php if ($page['footer']): ?>
    <footer id="footer">
      <?php print render($page['footer']); ?>
    </footer> <!-- /footer -->
  <?php endif; ?>

  <?php } ?>
  
</div> <!-- /page -->


