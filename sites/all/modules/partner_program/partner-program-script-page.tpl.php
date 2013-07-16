<div id="id_referrer_content_plugin" class="referrer_content">
  <div id="referrer_content" class="plugin_wrapper"> 
  &nbsp;
  	<table cell-padding=10>
	<thead>
	<tr>
		<th>Partner Program Script</th>
	</tr>
	</thead>
	<tr>
	<td>
		<textarea class="partner_program" id="box-content"  name="box-content"   wrap='off' autocorrect='off' autocapitalize='off' tabindex='0' rows="6" cols="20">
<!--script start here-->		
<script type="text/javascript">var referralid='<?php print $data['referrerid'] ?>';</script>
<script type="text/javascript" src="http://www.theshoppingpro.com/sites/all/modules/partner_program/shoppingpro.js">
</script>
<!--script end here-->		
		</textarea>
                
<br /><br />
<p><input type="button" id="copy" name="copy" value="Copy to Clipboard" /></p>	
<script>		
		//set path
ZeroClipboard.setMoviePath('http://davidwalsh.name/demo/ZeroClipboard.swf');
//create client
var clip = new ZeroClipboard.Client();
//event
clip.addEventListener('mousedown',function() {
	clip.setText(document.getElementById('box-content').value);
});
clip.addEventListener('complete',function(client,text) {
	alert('copied: ' + text);
});
//glue it to the button
clip.glue('copy');
</script>		
		        

	</td>
	</tr>
	</table>
  </div>
</div>


