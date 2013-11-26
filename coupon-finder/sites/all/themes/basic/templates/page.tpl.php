<div id="page" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <!-- ______________________ HEADER _______________________ -->

  <header id="header">
   <div class="wrap">
    <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
        <!-- <img src="http://10.0.0.108/coupon/sites/default/files/CoupponVoodoo_header_logo_60px2.png" alt="<?php print t('Home'); ?>"/> -->
      </a>
    <?php endif; ?>
    <div class="main_menu">
    <?php if ($page['main_menu']): ?>
      <?php print render($page['main_menu']) ?>
    <?php endif; ?>  
    </div>  

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
</div>
  </header> <!-- /header -->

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
      <p class="frog_title"> Frugal Froggy Is Casting His Spell</p>
      <img width="400px" alt="Loading..." src="<?php echo base_path() ?>sites/all/themes/basic/images/Frugal_Froggy.jpg" class="frog">
      <img src="<?php echo base_path() ?>sites/all/themes/basic/images/Loader-Dollar.gif" class="dollor">
    </div>
    <section id="content">

        <?php if ($breadcrumb || $title|| $messages || $tabs || $action_links): ?>
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
              <h1 class="title"><?php print $title; ?></h1>
            <?php endif; ?>
          <?php if ($is_front):
          global $base_url;
          ?>
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
              <img src="<?php print base_path() . drupal_get_path('theme', 'basic') . "/images/CouponVoodoo_main_logo.png" ?>" alt="<?php print t('Home'); ?>"/>
            </a>
          <?php endif; ?>
          <?php if ($is_front): ?>
                <?php print $messages; ?>
          <?php endif; ?>
          <?php print render($page['content']) ?>
        </div>

        <?php print $feed_icons; ?>

    </section> <!-- /content-inner /content -->

    <?php if ($page['sidebar_first']): ?>
      <aside id="sidebar-first" class="column sidebar first">
        <?php print render($page['sidebar_first']); ?>
      </aside>
    <?php endif; ?> <!-- /sidebar-first -->
    
    <?php if ($page['sidebar_second']): ?>
      <aside id="sidebar-second" class="column sidebar second">
        <?php print render($page['sidebar_second']); ?>
      </aside>
    <?php endif; ?> <!-- /sidebar-second -->

  </div> <!-- /main -->

  <!-- ______________________ FOOTER _______________________ -->

  <?php if ($page['footer']): ?>
    <footer id="footer">
      <?php print render($page['footer']); ?>
    </footer> <!-- /footer -->
  <?php endif; ?>

</div> <!-- /page -->
