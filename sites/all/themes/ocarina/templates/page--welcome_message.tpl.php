<div style="text-align:center;">
  <div>
    <img src="sites/default/files/The_Shopping_Pro_Logo-250px.png" />
  </div>
  <div style="color:#25ade3;">
    Easy, Intelligent & Personalized Shopping
  </div>
  <div>
    <?php
    print l('<img src="sites/all/themes/ocarina/images/Play_Video.png" />', 'http://www.youtube.com/embed/dj9UXzyDsOA',
      array(
        'query' => array('width' => '560', 'height' => '315', 'iframe' => 'true'),
        'html' =>TRUE,
        'attributes' => array('class' => 'colorbox-load'))
      );     
    ?>
  </div>
  <div>
    <?php
    if (is_chrome()) {
      print '<button onclick="chrome.webstore.install()" style="background-image: url(sites/all/themes/ocarina/images/blue/blue_button_chrome.png);height: 70px;width: 100%;background-size: 100%;background-repeat: no-repeat;border: none;" id="install-button"> </button>';
    } else {
      ?>
      <script type="text/javascript" src="https://w9u6a2p6.ssl.hwcdn.net/javascripts/installer/installer.js"></script>
      <script type="text/javascript">
        var __CRI = new crossriderInstaller({
          app_id: 28108,
          app_name: 'TheShoppingPro'
        });

        var _cr_button = new __CRI.button({
          text: 'Click here to install The Shop Mate plugin',
          button_size: 'medium',
          color: 'blue'
        });
      //__CRI.install(); //use this if you want to use your own button
      </script>
      <div id="crossriderInstallButton"></div>
      <?php
    }
    ?>
  </div>
  <div>
    Free for <img src="sites/all/themes/ocarina/images/OS_Logo.png" /> on <img src="sites/all/themes/ocarina/images/browser-logos-small.png" />
  </div>
</div>