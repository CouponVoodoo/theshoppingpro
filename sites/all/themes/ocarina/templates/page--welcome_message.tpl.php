<div style="text-align:center;">
  <div>
    <?php

    $browser = getBrowserInfo();
    if ($browser['name']=="Google Chrome") {
      drupal_goto('https://chrome.google.com/webstore/detail/theshoppingpro/lgaakehnefkaeeclkaafaahlbkcoimdh');
    } elseif ($browser['name']=="Apple Safari") {
      $url = 'http://crossrider.com/download/28108';
      print '<img src="sites/all/themes/ocarina/images/Safari_Installation.png" />';
    }elseif ($browser['name']=="Mozilla Firefox") {
      $url = 'http://crossrider.com/download/28108';
      print '<img src="sites/all/themes/ocarina/images/Firefox_Intallation.png" />';
    }elseif($browser['name']=="Internet Explorer") {
      $url = 'http://crossrider.com/download/28108';
      print '<img src="sites/all/themes/ocarina/images/IE_Installation.png" />';
    }
    ?>
  </div>
</div>
<script type="text/javascript">
  // redirect to google after 5 seconds
  window.setTimeout(function() {
    window.location.href = '<?php print $url; ?>';
  }, 5000);
</script>