<?php global $user, $base_url;?>
<div id="id_referrer_content_plugin" class="referrer_content">
  <div id="referrer_content" class="plugin_wrapper"> 
  &nbsp;
  	<table cell-padding=10>
	<thead>
	<tr>
		<th>My User ID</th><th>Referrer User ID</th>
	</tr>
	</thead>
	<tr>
      <?php
  //  foreach($data as $key=> $datas) {
		
		echo "<td style='text-align:center'><strong>".$data['uid']."</strong></td>";
		echo "<td style='text-align:center'><strong>".$data['referrerid']."</strong></td>";
		//$content = print_r($data['uid']);
		//  echo $content;

	// }
    ?>
	</tr>
	</table>
  </div>
</div>
