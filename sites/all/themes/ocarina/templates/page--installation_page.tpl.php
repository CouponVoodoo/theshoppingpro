<div id ="" style="text-align: center" class="page">
  <?php
  $browser = getBrowserInfo();
  if ($browser['name']=="Google Chrome") {
    drupal_goto('https://chrome.google.com/webstore/detail/theshoppingpro/lgaakehnefkaeeclkaafaahlbkcoimdh');
  } elseif ($browser['name']=="Apple Safari") {
    $url = 'http://crossrider.com/download/28108';
    print '<img id="makecenter"  src="sites/all/themes/ocarina/images/Safari_Installation.png" />';
  }elseif ($browser['name']=="Mozilla Firefox") {
    $url = 'http://crossrider.com/download/28108';
    print '<img id="makecenter" src="sites/all/themes/ocarina/images/Firefox_Intallation.png" />';
  }elseif($browser['name']=="Internet Explorer") {
    $url = 'http://crossrider.com/download/28108';
    print '<img id="makecenter"  src="sites/all/themes/ocarina/images/IE_Installation.png" />';
  }
  ?>
</div>
<script type="text/javascript">
  // redirect to google after 5 seconds
  window.setTimeout(function() {
    window.location.href = '<?php print $url; ?>';
  }, 5000);
  jQuery(document).ready(function($){
    $.fn.extend({
      center: function () {
        return this.each(function() {
          // var top = ($(window).height() - $(this).outerHeight()) / 2;
          // var left = ($(window).width() - $(this).outerWidth()) / 2;
         var top = 120;
         var left = 330;
            
	$(this).css({position:'absolute', margin:0, top: (top > 0 ? top : 0)+'px', left: (left > 0 ? left : 0)+'px'});
        });
      }
    });
    jQuery('#makecenter').center();
  });
</script>
