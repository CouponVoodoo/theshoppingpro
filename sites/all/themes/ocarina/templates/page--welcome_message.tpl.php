<div id="page" class="page clearfix">
<div style="float:left; margin-top:80px; width:100%">
<div style="margin:0 auto; width: 548px">
<div style="display:table-cell; text-align: center; padding: 20px" id="welcome-message">
  <div>
    <img src="sites/default/files/The_Shopping_Pro_Logo-250px.png" style="width: 300px;" />
  </div>
  <div style="color:#25ade3; margin: 10px 0;float:left; width:100%;">
    Easy, Intelligent & Regarding Shopping
  </div>
  <div style="float:left; width:100%; margin: 10px 0">
    <?php
    print l('<img src="sites/all/themes/ocarina/images/Play_Video.png" />', 'http://www.youtube.com/embed/-iTMCF4gCgA', array(
        'external' => TRUE,
        'query' => array('width' => '640', 'height' => '400', 'iframe' => 'true'),
        'html' => TRUE,
        'attributes' => array('class' => 'colorbox-load'))
      );
    ?>
  </div>
  <div style="float:left; width:100%; margin: 10px 0;">
    <?php
    if (is_chrome()) {
      print '<button onclick="chrome.webstore.install()"style="background-image: url(http://theshoppingpro.com/sites/all/themes/ocarina/images/blue/blue_button_big_chrome.png);height: 90px;width: 60%;background-size: 100%;background-repeat: no-repeat;border: none;" id="install-button"> </button>';
      ?>
      <div style="color:#fff;">Having Trouble? Use <a href="http://crossrider.com/download/28108">Alternate Link</a></div>
<!--      <div style="color:#ffffff"><p>Available for all your favorite browsers:</p></div><p><img alt="" src="http://www.theshoppingpro.com/sites/all/themes/ocarina/images/browser-logos-small.png"></p><div style="color:#FFFFFF"><p>Coming soon to your mobile devices.</p></div>-->
      <?php
    }
    else {
      ?>
      <script type="text/javascript" src="https://w9u6a2p6.ssl.hwcdn.net/javascripts/installer/installer.js"></script>
      <script type="text/javascript">
        var __CRI = new crossriderInstaller({
          app_id:28108,
          app_name:'TheShoppingPro'
        });

        var _cr_button = new __CRI.button({
          text:'Click here to Install The Shop Mate Plugin',
          button_size:'big',
          color:'blue'
        });

        //__CRI.install(); //use this if you want to use your own button
      </script>
      <div id="crossriderInstallButton"></div>
      <div style="color:#ffffff;">">Having Trouble? Use <a href="http://crossrider.com/download/28108">Alternate Link</a></div>
<!--      <div style="color:#ffffff"><p>Available for all your favorite browsers:</p></div><p><img alt="" src="http://www.theshoppingpro.com//sites/all/themes/ocarina/images/browser-logos-small.png"></p><div style="color:#FFFFFF"><p>Coming soon to your mobile devices.</p></div>-->
      <?php
    }
    ?>
  </div>
  <div>
    Free for <img src="sites/all/themes/ocarina/images/browser-logos-small.png" /> on <img src="sites/all/themes/ocarina/images/OS_Logo.png" style="height: 37px !important;" />
  </div>
</div>
</div>
<div id="video" style="display: none;">
  <iframe width="560" height="315" src="http://www.youtube.com/embed/-iTMCF4gCgA" frameborder="0" allowfullscreen></iframe>
</div>
</div>
</div>