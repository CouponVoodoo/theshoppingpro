<?php
/**
 * @file
 * Views Slideshow: Single Frame template file.
 *
 * - $rows: The themed rows from the view.
 * - $settings: The settings for the views slideshow type.
 * - $view: The view object.
 * - $vss_id: The views slideshow id.
 */

$i = 0;
?>
<div id="views_slideshow_liquid_slider_content_<?php print $vss_id; ?>" class="liquid-slider">
    <?php foreach ($rows as $row): ?>
      <section>
	<?php $tab_name = $view->render_field($settings['caption_field'], $i++); ?>
	<h2 class="title"><?php print $tab_name; ?></h2>
	<p><?php print $row; ?>
	</p>
      </section>
    <?php endforeach; ?>
</div>
