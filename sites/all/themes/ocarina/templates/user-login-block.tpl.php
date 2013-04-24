<?php
global $base_url;
?>
<div id="user-login-block-container">
  <div id="user-login-block-form-fields">
    <?php print $name; // Display username field ?>
    <?php print $pass; // Display Password field ?>
    <?php print $submit; // Display submit button ?>
    <?php print $rendered; // Display hidden elements (required for successful login) ?>
  </div>
  <div class="links">
    <?php
    $destination = '';
    if (isset($_GET['destination'])) {
      $destination = urldecode($_GET['destination']);
    }
    print l('REGISTER NOW', 'user/register', array('query' => array('destination' => $destination), 'attributes' => array('target' => '_blank'), 'external' => TRUE));
    ?>
  </div>
  <div class="views-field-php">
    <?php print('And start earning with every purchase by you or your referral'); ?>
  </div>
</div>