/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/misc/progress.js. */
(function($){Drupal.progressBar=function(id,updateCallback,method,errorCallback){var pb=this;this.id=id;this.method=method||'GET';this.updateCallback=updateCallback;this.errorCallback=errorCallback;this.element=$('<div class="progress" aria-live="polite"></div>').attr('id',id);this.element.html('<div class="bar"><div class="filled"></div></div><div class="percentage"></div><div class="message">&nbsp;</div>')};Drupal.progressBar.prototype.setProgress=function(percentage,message){if(percentage>=0&&percentage<=100){$('div.filled',this.element).css('width',percentage+'%');$('div.percentage',this.element).html(percentage+'%')};$('div.message',this.element).html(message);if(this.updateCallback)this.updateCallback(percentage,message,this)};Drupal.progressBar.prototype.startMonitoring=function(uri,delay){this.delay=delay;this.uri=uri;this.sendPing()};Drupal.progressBar.prototype.stopMonitoring=function(){clearTimeout(this.timer);this.uri=null};Drupal.progressBar.prototype.sendPing=function(){if(this.timer)clearTimeout(this.timer);if(this.uri){var pb=this;$.ajax({type:this.method,url:this.uri,data:'',dataType:'json',success:function(progress){if(progress.status==0){pb.displayError(progress.data);return};pb.setProgress(progress.percentage,progress.message);pb.timer=setTimeout(function(){pb.sendPing()},pb.delay)},error:function(xmlhttp){pb.displayError(Drupal.ajaxError(xmlhttp,pb.uri))}})}};Drupal.progressBar.prototype.displayError=function(string){var error=$('<div class="messages error"></div>').html(string);$(this.element).before(error).hide();if(this.errorCallback)this.errorCallback(this)}})(jQuery);
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/misc/progress.js. */
/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/modules/ctools/js/modal.js. */
(function($){Drupal.CTools=Drupal.CTools||{};Drupal.CTools.Modal=Drupal.CTools.Modal||{};Drupal.CTools.Modal.show=function(choice){var opts={};if(choice&&typeof choice=='string'&&Drupal.settings[choice]){$.extend(true,opts,Drupal.settings[choice])}else if(choice)$.extend(true,opts,choice);var defaults={modalTheme:'CToolsModalDialog',throbberTheme:'CToolsModalThrobber',animation:'show',animationSpeed:'fast',modalSize:{type:'scale',width:.8,height:.8,addWidth:0,addHeight:0,contentRight:25,contentBottom:45},modalOptions:{opacity:.55,background:'#fff'}},settings={};$.extend(true,settings,defaults,Drupal.settings.CToolsModal,opts);if(Drupal.CTools.Modal.currentSettings&&Drupal.CTools.Modal.currentSettings!=settings){Drupal.CTools.Modal.modal.remove();Drupal.CTools.Modal.modal=null};Drupal.CTools.Modal.currentSettings=settings;var resize=function(e){var context=e?document:Drupal.CTools.Modal.modal;if(Drupal.CTools.Modal.currentSettings.modalSize.type=='scale'){var width=$(window).width()*Drupal.CTools.Modal.currentSettings.modalSize.width,height=$(window).height()*Drupal.CTools.Modal.currentSettings.modalSize.height}else{var width=Drupal.CTools.Modal.currentSettings.modalSize.width,height=Drupal.CTools.Modal.currentSettings.modalSize.height};$('div.ctools-modal-content',context).css({width:width+Drupal.CTools.Modal.currentSettings.modalSize.addWidth+'px',height:height+Drupal.CTools.Modal.currentSettings.modalSize.addHeight+'px'});$('div.ctools-modal-content .modal-content',context).css({width:(width-Drupal.CTools.Modal.currentSettings.modalSize.contentRight)+'px',height:(height-Drupal.CTools.Modal.currentSettings.modalSize.contentBottom)+'px'})};if(!Drupal.CTools.Modal.modal){Drupal.CTools.Modal.modal=$(Drupal.theme(settings.modalTheme));if(settings.modalSize.type=='scale')$(window).bind('resize',resize)};resize();$('span.modal-title',Drupal.CTools.Modal.modal).html(Drupal.CTools.Modal.currentSettings.loadingText);Drupal.CTools.Modal.modalContent(Drupal.CTools.Modal.modal,settings.modalOptions,settings.animation,settings.animationSpeed);$('#modalContent .modal-content').html(Drupal.theme(settings.throbberTheme))};Drupal.CTools.Modal.dismiss=function(){if(Drupal.CTools.Modal.modal)Drupal.CTools.Modal.unmodalContent(Drupal.CTools.Modal.modal)};Drupal.theme.prototype.CToolsModalDialog=function(){var html='';html+='  <div id="ctools-modal">';html+='    <div class="ctools-modal-content">';html+='      <div class="modal-header">';html+='        <a class="close" href="#">';html+=Drupal.CTools.Modal.currentSettings.closeText+Drupal.CTools.Modal.currentSettings.closeImage;html+='        </a>';html+='        <span id="modal-title" class="modal-title">&nbsp;</span>';html+='      </div>';html+='      <div id="modal-content" class="modal-content">';html+='      </div>';html+='    </div>';html+='  </div>';return html};Drupal.theme.prototype.CToolsModalThrobber=function(){var html='';html+='  <div id="modal-throbber">';html+='    <div class="modal-throbber-wrapper">';html+=Drupal.CTools.Modal.currentSettings.throbber;html+='    </div>';html+='  </div>';return html};Drupal.CTools.Modal.getSettings=function(object){var match=$(object).attr('class').match(/ctools-modal-(\S+)/);if(match)return match[1]};Drupal.CTools.Modal.clickAjaxCacheLink=function(){Drupal.CTools.Modal.show(Drupal.CTools.Modal.getSettings(this));return Drupal.CTools.AJAX.clickAJAXCacheLink.apply(this)};Drupal.CTools.Modal.clickAjaxLink=function(){Drupal.CTools.Modal.show(Drupal.CTools.Modal.getSettings(this));return false};Drupal.CTools.Modal.submitAjaxForm=function(e){var $form=$(this),url=$form.attr('action');setTimeout(function(){Drupal.CTools.AJAX.ajaxSubmit($form,url)},1);return false};Drupal.behaviors.ZZCToolsModal={attach:function(context){$('area.ctools-use-modal, a.ctools-use-modal',context).once('ctools-use-modal',function(){var $this=$(this);$this.click(Drupal.CTools.Modal.clickAjaxLink);var element_settings={};if($this.attr('href')){element_settings.url=$this.attr('href');element_settings.event='click';element_settings.progress={type:'throbber'}};var base=$this.attr('href');Drupal.ajax[base]=new Drupal.ajax(base,this,element_settings)});$('input.ctools-use-modal, button.ctools-use-modal',context).once('ctools-use-modal',function(){var $this=$(this);$this.click(Drupal.CTools.Modal.clickAjaxLink);var button=this,element_settings={};element_settings.url=Drupal.CTools.Modal.findURL(this);element_settings.event='click';var base=$this.attr('id');Drupal.ajax[base]=new Drupal.ajax(base,this,element_settings);$('.'+$(button).attr('id')+'-url').change(function(){Drupal.ajax[base].options.url=Drupal.CTools.Modal.findURL(button)})});$('#modal-content form',context).once('ctools-use-modal',function(){var $this=$(this),element_settings={};element_settings.url=$this.attr('action');element_settings.event='submit';element_settings.progress={type:'throbber'};var base=$this.attr('id');Drupal.ajax[base]=new Drupal.ajax(base,this,element_settings);Drupal.ajax[base].form=$this;$('input[type=submit], button',this).click(function(event){Drupal.ajax[base].element=this;this.form.clk=this;if(event.bubbles==undefined){$(this.form).trigger('submit');return false}})});$('.ctools-close-modal',context).once('ctools-close-modal').click(function(){Drupal.CTools.Modal.dismiss();return false})}};Drupal.CTools.Modal.modal_display=function(ajax,response,status){if($('#modalContent').length==0)Drupal.CTools.Modal.show(Drupal.CTools.Modal.getSettings(ajax.element));$('#modal-title').html(response.title);$('#modal-content').html(response.output).scrollTop(0);Drupal.attachBehaviors()};Drupal.CTools.Modal.modal_dismiss=function(command){Drupal.CTools.Modal.dismiss();$('link.ctools-temporary-css').remove()};Drupal.CTools.Modal.modal_loading=function(command){Drupal.CTools.Modal.modal_display({output:Drupal.theme(Drupal.CTools.Modal.currentSettings.throbberTheme),title:Drupal.CTools.Modal.currentSettings.loadingText})};Drupal.CTools.Modal.findURL=function(item){var url='',url_class='.'+$(item).attr('id')+'-url';$(url_class).each(function(){var $this=$(this);if(url&&$this.val())url+='/';url+=$this.val()});return url};Drupal.CTools.Modal.modalContent=function(content,css,animation,speed){if(!animation){animation='show'}else if(animation!='fadeIn'&&animation!='slideDown')animation='show';if(!speed)speed='fast';css=jQuery.extend({position:'absolute',left:'0px',margin:'0px',background:'#000',opacity:'.55'},css);css.filter='alpha(opacity='+(100*css.opacity)+')';content.hide();if($('#modalBackdrop'))$('#modalBackdrop').remove();if($('#modalContent'))$('#modalContent').remove();if(self.pageYOffset){var wt=self.pageYOffset}else if(document.documentElement&&document.documentElement.scrollTop){var wt=document.documentElement.scrollTop}else if(document.body)var wt=document.body.scrollTop;var docHeight=$(document).height()+50,docWidth=$(document).width(),winHeight=$(window).height(),winWidth=$(window).width();if(docHeight<winHeight)docHeight=winHeight;$('body').append('<div id="modalBackdrop" style="z-index: 1000; display: none;"></div><div id="modalContent" style="z-index: 1001; position: absolute;">'+$(content).html()+'</div>');modalEventHandler=function(event){target=null;if(event){target=event.target}else{event=window.event;target=event.srcElement};var parents=$(target).parents().get();for(var i in $(target).parents().get()){var position=$(parents[i]).css('position');if(position=='absolute'||position=='fixed')return true};if($(target).filter('*:visible').parents('#modalContent').size())return true;if($('#modalContent'))$('#modalContent').get(0).focus();return false};$('body').bind('focus',modalEventHandler);$('body').bind('keypress',modalEventHandler);var modalContent=$('#modalContent').css('top','-1000px'),mdcTop=wt+(winHeight/2)-(modalContent.outerHeight()/2),mdcLeft=(winWidth/2)-(modalContent.outerWidth()/2);$('#modalBackdrop').css(css).css('top',0).css('height',docHeight+'px').css('width',docWidth+'px').show();modalContent.css({top:mdcTop+'px',left:mdcLeft+'px'}).hide()[animation](speed);modalContentClose=function(){close();return false};$('.close').bind('click',modalContentClose);modalEventEscapeCloseHandler=function(event){if(event.keyCode==27){close();return false}};$(document).bind('keypress',modalEventEscapeCloseHandler)
function close(){$(window).unbind('resize',modalContentResize);$('body').unbind('focus',modalEventHandler);$('body').unbind('keypress',modalEventHandler);$('.close').unbind('click',modalContentClose);$('body').unbind('keypress',modalEventEscapeCloseHandler);$(document).trigger('CToolsDetachBehaviors',$('#modalContent'));if(animation=='fadeIn')animation='fadeOut';if(animation=='slideDown')animation='slideUp';if(animation=='show')animation='hide';modalContent.hide()[animation](speed);$('#modalContent').remove();$('#modalBackdrop').remove()};modalContentResize=function(){var docHeight=$(document).height(),docWidth=$(document).width(),winHeight=$(window).height(),winWidth=$(window).width();if(docHeight<winHeight)docHeight=winHeight;var modalContent=$('#modalContent'),mdcTop=(winHeight/2)-(modalContent.outerHeight()/2),mdcLeft=(winWidth/2)-(modalContent.outerWidth()/2);$('#modalBackdrop').css('height',docHeight+'px').css('width',docWidth+'px').show();modalContent.css('top',mdcTop+'px').css('left',mdcLeft+'px').show()};$(window).bind('resize',modalContentResize);$('#modalContent').focus()};Drupal.CTools.Modal.unmodalContent=function(content,animation,speed){if(!animation){var animation='show'}else if((animation!='fadeOut')&&(animation!='slideUp'))animation='show';if(!speed)var speed='fast';$(window).unbind('resize',modalContentResize);$('body').unbind('focus',modalEventHandler);$('body').unbind('keypress',modalEventHandler);$('.close').unbind('click',modalContentClose);$(document).trigger('CToolsDetachBehaviors',$('#modalContent'));content.each(function(){if(animation=='fade'){$('#modalContent').fadeOut(speed,function(){$('#modalBackdrop').fadeOut(speed,function(){$(this).remove()});$(this).remove()})}else if(animation=='slide'){$('#modalContent').slideUp(speed,function(){$('#modalBackdrop').slideUp(speed,function(){$(this).remove()});$(this).remove()})}else{$('#modalContent').remove();$('#modalBackdrop').remove()}})};$(function(){Drupal.ajax.prototype.commands.modal_display=Drupal.CTools.Modal.modal_display;Drupal.ajax.prototype.commands.modal_dismiss=Drupal.CTools.Modal.modal_dismiss})})(jQuery);
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/modules/ctools/js/modal.js. */
/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/modules/modal_forms/js/modal_forms_popup.js. */
Drupal.theme.prototype.ModalFormsPopup=function(){var html='';html+='<div id="ctools-modal" class="popups-box">';html+='  <div class="ctools-modal-content modal-forms-modal-content">';html+='    <div class="popups-container">';html+='      <div class="modal-header popups-title">';html+='        <span id="modal-title" class="modal-title"></span>';html+='        <span class="popups-close close">'+Drupal.CTools.Modal.currentSettings.closeText+'</span>';html+='        <div class="clear-block"></div>';html+='      </div>';html+='      <div class="modal-scroll"><div id="modal-content" class="modal-content popups-body"></div></div>';html+='    </div>';html+='  </div>';html+='</div>';return html};
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/modules/modal_forms/js/modal_forms_popup.js. */
/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/modules/views_slideshow/js/views_slideshow.js. */
(function($){Drupal.viewsSlideshow=Drupal.viewsSlideshow||{};Drupal.viewsSlideshowControls=Drupal.viewsSlideshowControls||{};Drupal.viewsSlideshowControls.play=function(options){try{if(typeof Drupal.settings.viewsSlideshowControls[options.slideshowID].top.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].top.type].play=='function')Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].top.type].play(options)}catch(err){};try{if(typeof Drupal.settings.viewsSlideshowControls[options.slideshowID].bottom.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].bottom.type].play=='function')Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].bottom.type].play(options)}catch(err){}};Drupal.viewsSlideshowControls.pause=function(options){try{if(typeof Drupal.settings.viewsSlideshowControls[options.slideshowID].top.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].top.type].pause=='function')Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].top.type].pause(options)}catch(err){};try{if(typeof Drupal.settings.viewsSlideshowControls[options.slideshowID].bottom.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].bottom.type].pause=='function')Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].bottom.type].pause(options)}catch(err){}};Drupal.behaviors.viewsSlideshowControlsText={attach:function(context){$('.views_slideshow_controls_text_previous:not(.views-slideshow-controls-text-previous-processed)',context).addClass('views-slideshow-controls-text-previous-processed').each(function(){var uniqueID=$(this).attr('id').replace('views_slideshow_controls_text_previous_','');$(this).click(function(){Drupal.viewsSlideshow.action({action:'previousSlide',slideshowID:uniqueID});return false})});$('.views_slideshow_controls_text_next:not(.views-slideshow-controls-text-next-processed)',context).addClass('views-slideshow-controls-text-next-processed').each(function(){var uniqueID=$(this).attr('id').replace('views_slideshow_controls_text_next_','');$(this).click(function(){Drupal.viewsSlideshow.action({action:'nextSlide',slideshowID:uniqueID});return false})});$('.views_slideshow_controls_text_pause:not(.views-slideshow-controls-text-pause-processed)',context).addClass('views-slideshow-controls-text-pause-processed').each(function(){var uniqueID=$(this).attr('id').replace('views_slideshow_controls_text_pause_','');$(this).click(function(){if(Drupal.settings.viewsSlideshow[uniqueID].paused){Drupal.viewsSlideshow.action({action:'play',slideshowID:uniqueID,force:true})}else Drupal.viewsSlideshow.action({action:'pause',slideshowID:uniqueID,force:true});return false})})}};Drupal.viewsSlideshowControlsText=Drupal.viewsSlideshowControlsText||{};Drupal.viewsSlideshowControlsText.pause=function(options){var pauseText=Drupal.theme.prototype['viewsSlideshowControlsPause']?Drupal.theme('viewsSlideshowControlsPause'):'';$('#views_slideshow_controls_text_pause_'+options.slideshowID+' a').text(pauseText)};Drupal.viewsSlideshowControlsText.play=function(options){var playText=Drupal.theme.prototype['viewsSlideshowControlsPlay']?Drupal.theme('viewsSlideshowControlsPlay'):'';$('#views_slideshow_controls_text_pause_'+options.slideshowID+' a').text(playText)};Drupal.theme.prototype.viewsSlideshowControlsPause=function(){return Drupal.t('Resume')};Drupal.theme.prototype.viewsSlideshowControlsPlay=function(){return Drupal.t('Pause')};Drupal.viewsSlideshowPager=Drupal.viewsSlideshowPager||{};Drupal.viewsSlideshowPager.transitionBegin=function(options){try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].transitionBegin=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].transitionBegin(options)}catch(err){};try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].transitionBegin=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].transitionBegin(options)}catch(err){}};Drupal.viewsSlideshowPager.goToSlide=function(options){try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].goToSlide=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].goToSlide(options)}catch(err){};try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].goToSlide=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].goToSlide(options)}catch(err){}};Drupal.viewsSlideshowPager.previousSlide=function(options){try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].previousSlide=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].previousSlide(options)}catch(err){};try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].previousSlide=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].previousSlide(options)}catch(err){}};Drupal.viewsSlideshowPager.nextSlide=function(options){try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].nextSlide=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].nextSlide(options)}catch(err){};try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].nextSlide=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].nextSlide(options)}catch(err){}};Drupal.behaviors.viewsSlideshowPagerFields={attach:function(context){$('.views_slideshow_pager_field:not(.views-slideshow-pager-field-processed)',context).addClass('views-slideshow-pager-field-processed').each(function(){var pagerInfo=$(this).attr('id').split('_'),location=pagerInfo[2];pagerInfo.splice(0,3);var uniqueID=pagerInfo.join('_');if(Drupal.settings.viewsSlideshowPagerFields[uniqueID][location].activatePauseOnHover){$(this).children().each(function(index,pagerItem){var mouseIn=function(){Drupal.viewsSlideshow.action({action:'goToSlide',slideshowID:uniqueID,slideNum:index});Drupal.viewsSlideshow.action({action:'pause',slideshowID:uniqueID})},mouseOut=function(){Drupal.viewsSlideshow.action({action:'play',slideshowID:uniqueID})};if(jQuery.fn.hoverIntent){$(pagerItem).hoverIntent(mouseIn,mouseOut)}else $(pagerItem).hover(mouseIn,mouseOut)})}else $(this).children().each(function(index,pagerItem){$(pagerItem).click(function(){Drupal.viewsSlideshow.action({action:'goToSlide',slideshowID:uniqueID,slideNum:index})})})})}};Drupal.viewsSlideshowPagerFields=Drupal.viewsSlideshowPagerFields||{};Drupal.viewsSlideshowPagerFields.transitionBegin=function(options){for(pagerLocation in Drupal.settings.viewsSlideshowPager[options.slideshowID]){$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"]').removeClass('active');$('#views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'_'+options.slideNum).addClass('active')}};Drupal.viewsSlideshowPagerFields.goToSlide=function(options){for(pagerLocation in Drupal.settings.viewsSlideshowPager[options.slideshowID]){$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"]').removeClass('active');$('#views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'_'+options.slideNum).addClass('active')}};Drupal.viewsSlideshowPagerFields.previousSlide=function(options){for(pagerLocation in Drupal.settings.viewsSlideshowPager[options.slideshowID]){var pagerNum=$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"].active').attr('id').replace('views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'_','');if(pagerNum==0){pagerNum=$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"]').length()-1}else pagerNum--;$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"]').removeClass('active');$('#views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'_'+pagerNum).addClass('active')}};Drupal.viewsSlideshowPagerFields.nextSlide=function(options){for(pagerLocation in Drupal.settings.viewsSlideshowPager[options.slideshowID]){var pagerNum=$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"].active').attr('id').replace('views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'_',''),totalPagers=$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"]').length();pagerNum++;if(pagerNum==totalPagers)pagerNum=0;$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"]').removeClass('active');$('#views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'_'+slideNum).addClass('active')}};Drupal.viewsSlideshowSlideCounter=Drupal.viewsSlideshowSlideCounter||{};Drupal.viewsSlideshowSlideCounter.transitionBegin=function(options){$('#views_slideshow_slide_counter_'+options.slideshowID+' .num').text(options.slideNum+1)};Drupal.viewsSlideshow.action=function(options){var status={value:true,text:''};if(typeof options.action=='undefined'||options.action==''){status.value=false;status.text=Drupal.t('There was no action specified.');return error};if(options.action=='pause'){Drupal.settings.viewsSlideshow[options.slideshowID].paused=1;if(options.force)Drupal.settings.viewsSlideshow[options.slideshowID].pausedForce=1}else if(options.action=='play')if(!Drupal.settings.viewsSlideshow[options.slideshowID].pausedForce||options.force){Drupal.settings.viewsSlideshow[options.slideshowID].paused=0;Drupal.settings.viewsSlideshow[options.slideshowID].pausedForce=0}else{status.value=false;status.text+=' '+Drupal.t('This slideshow is forced paused.');return status};switch(options.action){case"goToSlide":case"transitionBegin":case"transitionEnd":if(typeof options.slideNum=='undefined'||typeof options.slideNum!=='number'||parseInt(options.slideNum)!=(options.slideNum-0)){status.value=false;status.text=Drupal.t('An invalid integer was specified for slideNum.')};case"pause":case"play":case"nextSlide":case"previousSlide":var methods=Drupal.settings.viewsSlideshow[options.slideshowID]['methods'],excludeMethodsObj={};if(typeof options.excludeMethods!=='undefined')for(var i=0;i<excludeMethods.length;i++)excludeMethodsObj[excludeMethods[i]]='';for(i=0;i<methods[options.action].length;i++)if(Drupal[methods[options.action][i]]!=undefined&&typeof Drupal[methods[options.action][i]][options.action]=='function'&&!(methods[options.action][i]in excludeMethodsObj))Drupal[methods[options.action][i]][options.action](options);break;default:status.value=false;status.text=Drupal.t('An invalid action "!action" was specified.',{"!action":options.action})};return status}})(jQuery);
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/modules/views_slideshow/js/views_slideshow.js. */
/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/modules/views/js/base.js. */
(function($){Drupal.Views={};Drupal.behaviors.viewsTabs={attach:function(context){if($.viewsUi&&$.viewsUi.tabs)$('#views-tabset').once('views-processed').viewsTabs({selectedClass:'active'});$('a.views-remove-link').once('views-processed').click(function(event){var id=$(this).attr('id').replace('views-remove-link-','');$('#views-row-'+id).hide();$('#views-removed-'+id).attr('checked',true);event.preventDefault()});$('a.display-remove-link').addClass('display-processed').click(function(){var id=$(this).attr('id').replace('display-remove-link-','');$('#display-row-'+id).hide();$('#display-removed-'+id).attr('checked',true);return false})}};Drupal.Views.parseQueryString=function(query){var args={},pos=query.indexOf('?');if(pos!=-1)query=query.substring(pos+1);var pairs=query.split('&');for(var i in pairs)if(typeof(pairs[i])=='string'){var pair=pairs[i].split('=');if(pair[0]!='q'&&pair[1])args[decodeURIComponent(pair[0].replace(/\+/g,' '))]=decodeURIComponent(pair[1].replace(/\+/g,' '))};return args};Drupal.Views.parseViewArgs=function(href,viewPath){var returnObj={},path=Drupal.Views.getPath(href);if(viewPath&&path.substring(0,viewPath.length+1)==viewPath+'/'){var args=decodeURIComponent(path.substring(viewPath.length+1,path.length));returnObj.view_args=args;returnObj.view_path=path};return returnObj};Drupal.Views.pathPortion=function(href){var protocol=window.location.protocol;if(href.substring(0,protocol.length)==protocol)href=href.substring(href.indexOf('/',protocol.length+2));return href};Drupal.Views.getPath=function(href){href=Drupal.Views.pathPortion(href);href=href.substring(Drupal.settings.basePath.length,href.length);if(href.substring(0,3)=='?q=')href=href.substring(3,href.length);var chars=['#','?','&'];for(i in chars)if(href.indexOf(chars[i])>-1)href=href.substr(0,href.indexOf(chars[i]));return href}})(jQuery);
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/modules/views/js/base.js. */
/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/modules/jcarousel/js/jcarousel.js. */
(function($){Drupal.behaviors.jcarousel={};Drupal.behaviors.jcarousel.attach=function(context,settings){settings=settings||Drupal.settings;if(!settings.jcarousel||!settings.jcarousel.carousels)return;$.each(settings.jcarousel.carousels,function(key,options){var $carousel=$(options.selector+':not(.jcarousel-processed)',context);if(!$carousel.length)return;$.each(options,function(optionKey){if(optionKey.match(/Callback$/)&&typeof options[optionKey]=='string'){var callbackFunction=window,callbackParents=options[optionKey].split('.');$.each(callbackParents,function(objectParent){callbackFunction=callbackFunction[callbackParents[objectParent]]});options[optionKey]=callbackFunction}});if(options.ajax&&!options.itemLoadCallback)options.itemLoadCallback=Drupal.jcarousel.ajaxLoadCallback;if(options.auto&&options.autoPause&&!options.initCallback)options.initCallback=function(carousel,state){Drupal.jcarousel.autoPauseCallback(carousel,state)};if(!options.setupCallback){options.setupCallback=function(carousel){Drupal.jcarousel.setupCarousel(carousel);if(options.navigation)Drupal.jcarousel.addNavigation(carousel,options.navigation)};if(options.navigation&&!options.itemVisibleInCallback)options.itemLastInCallback={onAfterAnimation:Drupal.jcarousel.updateNavigationActive}};if(!options.hasOwnProperty('buttonNextHTML')&&!options.hasOwnProperty('buttonPrevHTML')){options.buttonNextHTML=Drupal.theme('jCarouselButton','next');options.buttonPrevHTML=Drupal.theme('jCarouselButton','previous')};$carousel.addClass('jcarousel-processed').jcarousel(options)})};Drupal.jcarousel={};Drupal.jcarousel.ajaxLoadCallback=function(jcarousel,state){if(state=='init'||jcarousel.has(jcarousel.first,jcarousel.last))return;var $list=jcarousel.list,$view=$list.parents('.view:first'),ajaxPath=Drupal.settings.jcarousel.ajaxPath,target=$view.get(0),settings;$.each(Drupal.settings.jcarousel.carousels,function(domID,carouselSettings){if($list.is('.'+domID))settings=carouselSettings.view_options});var viewData={js:1,first:jcarousel.first-1,last:jcarousel.last};$.extend(viewData,settings);$.ajax({url:ajaxPath,type:'GET',data:viewData,success:function(response){Drupal.jcarousel.ajaxResponseCallback(jcarousel,target,response)},error:function(xhr){Drupal.jcarousel.ajaxErrorCallback(xhr,ajaxPath)},dataType:'json'})};Drupal.jcarousel.autoPauseCallback=function(carousel,state){function pauseAuto(){carousel.stopAuto()}
function resumeAuto(){carousel.startAuto()};carousel.clip.hover(pauseAuto,resumeAuto);carousel.buttonNext.hover(pauseAuto,resumeAuto);carousel.buttonPrev.hover(pauseAuto,resumeAuto)};Drupal.jcarousel.setupCarousel=function(carousel){carousel.pageSize=carousel.last-(carousel.first-1);var itemCount=carousel.options.size?carousel.options.size:$(carousel.list).children('li').length;carousel.pageCount=Math.ceil(itemCount/carousel.pageSize);carousel.pageNumber=1;if(carousel.pageCount==1){carousel.buttonNext.addClass('jcarousel-next-disabled').attr('disabled',true);carousel.buttonPrev.addClass('jcarousel-prev-disabled').attr('disabled',true)};carousel.buttonNext.css('display','');carousel.buttonPrev.css('display','')};Drupal.jcarousel.addNavigation=function(carousel,position){if(carousel.pageCount<=1)return;$(carousel.list).parents('.jcarousel-container:first').addClass('jcarousel-navigation-'+position);var navigation=$('<ul class="jcarousel-navigation"></ul>');for(var i=1;i<=carousel.pageCount;i++){var pagerItem=$(Drupal.theme('jCarouselPageLink',i)),listItem=$('<li></li>').attr('jcarousel-page',i).append(pagerItem);navigation.append(listItem);if(i===1)listItem.addClass('active');pagerItem.bind('click',function(){var newPageNumber=$(this).parent().attr('jcarousel-page'),itemOffset=(newPageNumber-carousel.pageNumber)*carousel.pageSize;if(itemOffset)carousel.scroll(carousel.first+itemOffset);return false})};$(carousel.list).parents('.jcarousel-clip:first')[position](navigation)};Drupal.jcarousel.updateNavigationActive=function(carousel,item,idx,state){var $listItems=$(carousel.list).parents('.jcarousel-container:first').find('.jcarousel-navigation li');if($listItems.length==0)return;var pageNumber=Math.ceil(idx/carousel.pageSize);if(pageNumber<=0||pageNumber>carousel.pageCount){pageNumber=pageNumber%carousel.pageCount;pageNumber=pageNumber==0?carousel.pageCount:pageNumber;pageNumber=pageNumber<0?pageNumber+carousel.pageCount:pageNumber};carousel.pageNumber=pageNumber;var currentPage=$listItems.get(carousel.pageNumber-1);$listItems.not(currentPage).removeClass('active');$(currentPage).addClass('active')};Drupal.jcarousel.ajaxResponseCallback=function(jcarousel,target,response){if(response.debug)alert(response.debug);var $view=$(target),jcarousel=$view.find('ul.jcarousel').data('jcarousel');$('ul.jcarousel > li',response.display).each(function(i){var itemNumber=this.className.replace(/.*?jcarousel-item-(\d+).*/,'$1');jcarousel.add(itemNumber,this.innerHTML)});Drupal.attachBehaviors(jcarousel.list.get(0));if(response.messages)$view.find('.views-messages').remove().end().prepend(response.messages)};Drupal.jcarousel.ajaxErrorCallback=function(xhr,path){var error_text='';if((xhr.status==500&&xhr.responseText)||xhr.status==200){error_text=xhr.responseText;error_text=error_text.replace("/&(lt|gt);/g",function(m,p){return(p=="lt")?"<":">"});error_text=error_text.replace(/<("[^"]*"|'[^']*'|[^'">])*>/gi,"");error_text=error_text.replace(/[\n]+\s+/g,"\n")}else if(xhr.status==500){error_text=xhr.status+': '+Drupal.t("Internal server error. Please see server or PHP logs for error information.")}else error_text=xhr.status+': '+xhr.statusText;alert(Drupal.t("An error occurred at @path.\n\nError Description: @error",{'@path':path,'@error':error_text}))};Drupal.theme.prototype.jCarouselButton=function(type){return'<a href="javascript:void(0)"></a>'};Drupal.theme.prototype.jCarouselPageLink=function(pageNumber){return'<a href="javascript:void(0)"><span>'+pageNumber+'</span></a>'}})(jQuery);
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/modules/jcarousel/js/jcarousel.js. */
