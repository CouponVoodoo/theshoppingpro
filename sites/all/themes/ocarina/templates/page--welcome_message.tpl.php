<div id="page" class="page clearfix">
  <div style="float:left; margin-top:80px; width:100%">
    <div style="margin:0 auto; width: 548px">
      <div style="display:table-cell; text-align: center; padding-top: 20px" id="welcome-message">
        <div>
          <img src="/sites/default/files/The_Shopping_Pro_Logo-250px.png" style="width: 300px;" />
        </div>
        <div style="color:#25ade3; margin-bottom: 10px;float:left; width:100%;">
          Easy, Intelligent & Rewarding Shopping
        </div>
        <div style="float:left; width:100%; margin: 10px 0">
          <?php
          print l('<img src="/sites/all/themes/ocarina/images/Play_Video.png" />', 'http://www.youtube.com/embed/rWFoIQTAOQI?wmode=transparent&amp;rel=0&amp;autoplay=0&amp;end=93', array(
              'external' => TRUE,
              'query' => array('width' => '640', 'height' => '400', 'iframe' => 'true'),
              'html' => TRUE,
              'attributes' => array('class' => 'colorbox-load'))
            );
          ?>
        </div>
        <div style="float:left; width:100%; margin: 10px 0;">
          <?php

          $browser = getBrowserInfo();
          if ($browser['name']=="Google Chrome") {
        //  if (is_chrome()) {
            print '<button onclick="chrome.webstore.install()" style="background-image: url(http://theshoppingpro.com/sites/all/themes/ocarina/images/blue/blue_button_big_chrome.png);height: 90px;width: 60%;background-size: 100%;background-repeat: no-repeat;border: none;" id="install-button"> </button>';
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
                text:'Click Here to Install TheShoppingPro Plugin',
                button_size:'big',
                color:'blue'
              });

              //__CRI.install(); //use this if you want to use your own button
            </script>
            <div id="crossriderInstallButton"></div>
            <?php
          }
          ?>
        </div>
        <div style="float:left; width:100%; margin: 10px 0;">
          Free for <img src="/sites/all/themes/ocarina/images/browser-logos-small.png" /> on <img src="sites/all/themes/ocarina/images/OS_Logo.png" style="height: 37px !important;" />
        </div>
      </div>
      <div style="float: left;">
        <?php
        print l('Login', 'user') . ' / ' . l('Register', 'user/register');
        ?>
      </div>
      <div style="float: right;">
      		<div style="padding-right: 50;">
			<?php echo 'Patent Pending'; ?>
      		</div>
        <?php print l('Enter Site >>', 'get_the_plugin'); ?>
      </div>
    </div>
  </div>
  <a href="https://mixpanel.com/f/partner"><img src="//cdn.mxpnl.com/site_media/images/partner/badge_blue.png" alt="Mobile Analytics" /></a>
</div>
