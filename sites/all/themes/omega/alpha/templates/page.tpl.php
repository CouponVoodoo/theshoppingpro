<?php 
/**
 * @file
 * Alpha's theme implementation to display a single Drupal page.
 */
?>
 <?php
function curPageURL() {
$pageURL = 'http';
if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
$pageURL .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
return $pageURL;
}
?>

<?php
echo curPageURL();
?>


<?php if(arg(0)=='plugin' && arg(0)=='retailers-partners-list') { ?>
    <div class="retailers">
 <?php } ?>
<div<?php print $attributes; ?>>
<?php if(arg(0)!='plugin' && arg(0)!='retailers-partners-list') { ?>

  <?php if (isset($page['header'])) : ?>
    <?php print render($page['header']); ?>
  <?php endif; }?>

  <?php if (isset($page['content'])) : ?>
    <?php print render($page['content']); ?>
  <?php endif; ?>

  <?php if(arg(0)!='plugin' && arg(0)!='retailers-partners-list') { ?>
  <?php if (isset($page['footer'])) : ?>
    <?php print render($page['footer']); ?>
  <?php endif; }?>
</div>
 <?php if(arg(0)=='plugin' && arg(0)=='retailers-partners-list') { ?>
     </div>
 <?php } ?>