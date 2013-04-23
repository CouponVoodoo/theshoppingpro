<?php

// $Id: views-coda.tpl.php,v 1.3 2010/11/19 18:52:34 cristhian Exp $

/**
 * @file
 * Default view template to display a coda slider.
 *
 * - $view: The view object.
 * - $options: Style options. See below.
 * - $rows: The output for the rows.
 * - $title: The title of this group of rows.  May be empty.
 *
 * - $options['type'] will either be ul or ol.
 *
 * @ingroup views_templates
 */
?>
<?php if($title != ''): ?>
  <h3 class="views-coda-title"><?php print $title ?></h3>
<?php endif; ?>
<div class="coda-slider-wrapper">
  <div class="coda-slider preload" id="<?php print $view->views_coda['codaid'] ?>">
    <?php foreach ($rows as $row): ?>
      <div class="panel">
        <div class="panel-wrapper">
          <?php print $row; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>