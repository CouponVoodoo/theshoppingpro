<?php $tag = $block->subject ? 'section' : 'div'; ?>
<<?php print $tag; ?><?php print $attributes; ?>>
  <div class="block-inner clearfix">
   <?php print render($title_prefix); ?>
    <?php if ($block->subject): ?>
      <h2<?php print $title_attributes; ?>>
	    <?php 
		$word_subjects = explode(' ', $block->subject);
		$word_subjects[0] = '<span class="first-word">' . $word_subjects[0] . '</span>';
		$last_item = count($word_subjects) - 1;
		$word_subjects[$last_item] = '<span class="last-word">' . $word_subjects[$last_item] . '</span>';
		
		$new_subject = implode ($word_subjects, '&nbsp;');
		print $new_subject; ?>
      </h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    
    <div<?php print $content_attributes; ?>>
      <?php print $content ?>
    </div>
  </div>
</<?php print $tag; ?>>
