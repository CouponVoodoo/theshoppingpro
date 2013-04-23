<article<?php print $attributes; ?>>

  <header>
    
    <?php if ($new): ?>
      <em class="new"><?php print $new ?></em>
    <?php endif; ?>
    <?php if (isset($unpublished)): ?>
      <em class="unpublished"><?php print $unpublished; ?></em>
    <?php endif; ?>
  </header>
  
  <?php print $picture; ?>

  <footer>
    <div class="coment-time">
     <?php print t('!datetime', array('!datetime' => '<time datetime="' . $datetime . '">' . $created . '</time>')); ?>
    </div>
    <div class="coment-user">
     <?php print t('!username says:', array('!username' => $author)); ?>
    </div>
    
  </footer>

  <div<?php print $content_attributes; ?>>
    <?php
      hide($content['links']);
      print render($content);
    ?>
  </div>

  <?php if ($signature): ?>
    <div class="user-signature"><?php print $signature ?></div>
  <?php endif; ?>

  <?php if (!empty($content['links'])): ?>
    <nav class="links comment-links clearfix"><?php print render($content['links']); ?></nav>
  <?php endif; ?>

</article>
