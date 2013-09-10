// $Id:

Drupal.behaviors.olark = function() {
  if (typeof Drupal.settings.olark.uid != 'undefined') {
    olark.extend(function(api){
      api.chat.updateVisitorNickname({
        snippet: Drupal.settings.olark.name,
        hidesDefault: true
      });
      api.chat.updateVisitorStatus({
        snippet: Drupal.settings.olark.mail + ' | ' + Drupal.settings.olark.userpage
      });
      api.chat.onReady(function(){
        //$('#habla_pre_chat_name_input').val(Drupal.settings.olark.name);
        //$('#habla_pre_chat_email_input').val(Drupal.settings.olark.mail);
      });
    }); 
  }

  // Hides Olark box if agent is iPod, iPad, iPhone.
  if(Drupal.settings.olark.disable_ios && Drupal.settings.olark.enabled){
    olark('api.box.onShow',checkIOS);
  }
}

function checkIOS() {
  var agent = navigator.userAgent.toLowerCase();
  var isIOS = (agent.match(/iP(hone|ad)/i) !== null);
  if (isIOS) {
    olark('api.box.hide');
  }
}
;
jQuery(function(){if (jQuery('a.colorbox_form').length > 0) {
  var link = jQuery("a.colorbox_form").attr('href');
  link = link.concat('?colorbox=true');
  // colorbox=true is attached for later use (read below).
  jQuery("a.colorbox_form").attr('href', link);
  jQuery("a.colorbox_form").colorbox({iframe:true, width:200, height:250, onClosed:function(){ location.reload(true); } });
}
});;
(function ($) {

/**
 * Provide the HTML to create the modal dialog.
 * Clone of function Drupal.theme.prototype.CToolsModalDialog.
 */
Drupal.theme.prototype.HybridAuthModalDialog = function () {
  var html = '';
  html += '  <div id="ctools-modal">';
  html += '    <div id="hybridauth-modal">';
  html += '      <div class="ctools-modal-content">'; // panels-modal-content
  html += '        <div class="modal-header">';
  html += '          <a class="close" href="#">';
  html +=              Drupal.CTools.Modal.currentSettings.closeText + Drupal.CTools.Modal.currentSettings.closeImage;
  html += '          </a>';
  html += '          <span id="modal-title" class="modal-title"></span>';
  html += '        </div>';
  html += '        <div id="modal-content" class="modal-content">';
  html += '        </div>';
  html += '      </div>';
  html += '    </div>';
  html += '  </div>';
  
  return html;
};

})(jQuery);
;
