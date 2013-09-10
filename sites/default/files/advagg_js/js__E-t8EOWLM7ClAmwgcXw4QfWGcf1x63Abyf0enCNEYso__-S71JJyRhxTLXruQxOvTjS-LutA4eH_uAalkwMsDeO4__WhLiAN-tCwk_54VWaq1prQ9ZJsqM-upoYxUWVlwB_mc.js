/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/modules/views_slideshow/js/views_slideshow.js. */
(function($){Drupal.viewsSlideshow=Drupal.viewsSlideshow||{};Drupal.viewsSlideshowControls=Drupal.viewsSlideshowControls||{};Drupal.viewsSlideshowControls.play=function(options){try{if(typeof Drupal.settings.viewsSlideshowControls[options.slideshowID].top.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].top.type].play=='function')Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].top.type].play(options)}catch(err){};try{if(typeof Drupal.settings.viewsSlideshowControls[options.slideshowID].bottom.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].bottom.type].play=='function')Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].bottom.type].play(options)}catch(err){}};Drupal.viewsSlideshowControls.pause=function(options){try{if(typeof Drupal.settings.viewsSlideshowControls[options.slideshowID].top.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].top.type].pause=='function')Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].top.type].pause(options)}catch(err){};try{if(typeof Drupal.settings.viewsSlideshowControls[options.slideshowID].bottom.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].bottom.type].pause=='function')Drupal[Drupal.settings.viewsSlideshowControls[options.slideshowID].bottom.type].pause(options)}catch(err){}};Drupal.behaviors.viewsSlideshowControlsText={attach:function(context){$('.views_slideshow_controls_text_previous:not(.views-slideshow-controls-text-previous-processed)',context).addClass('views-slideshow-controls-text-previous-processed').each(function(){var uniqueID=$(this).attr('id').replace('views_slideshow_controls_text_previous_','');$(this).click(function(){Drupal.viewsSlideshow.action({action:'previousSlide',slideshowID:uniqueID});return false})});$('.views_slideshow_controls_text_next:not(.views-slideshow-controls-text-next-processed)',context).addClass('views-slideshow-controls-text-next-processed').each(function(){var uniqueID=$(this).attr('id').replace('views_slideshow_controls_text_next_','');$(this).click(function(){Drupal.viewsSlideshow.action({action:'nextSlide',slideshowID:uniqueID});return false})});$('.views_slideshow_controls_text_pause:not(.views-slideshow-controls-text-pause-processed)',context).addClass('views-slideshow-controls-text-pause-processed').each(function(){var uniqueID=$(this).attr('id').replace('views_slideshow_controls_text_pause_','');$(this).click(function(){if(Drupal.settings.viewsSlideshow[uniqueID].paused){Drupal.viewsSlideshow.action({action:'play',slideshowID:uniqueID,force:true})}else Drupal.viewsSlideshow.action({action:'pause',slideshowID:uniqueID,force:true});return false})})}};Drupal.viewsSlideshowControlsText=Drupal.viewsSlideshowControlsText||{};Drupal.viewsSlideshowControlsText.pause=function(options){var pauseText=Drupal.theme.prototype['viewsSlideshowControlsPause']?Drupal.theme('viewsSlideshowControlsPause'):'';$('#views_slideshow_controls_text_pause_'+options.slideshowID+' a').text(pauseText)};Drupal.viewsSlideshowControlsText.play=function(options){var playText=Drupal.theme.prototype['viewsSlideshowControlsPlay']?Drupal.theme('viewsSlideshowControlsPlay'):'';$('#views_slideshow_controls_text_pause_'+options.slideshowID+' a').text(playText)};Drupal.theme.prototype.viewsSlideshowControlsPause=function(){return Drupal.t('Resume')};Drupal.theme.prototype.viewsSlideshowControlsPlay=function(){return Drupal.t('Pause')};Drupal.viewsSlideshowPager=Drupal.viewsSlideshowPager||{};Drupal.viewsSlideshowPager.transitionBegin=function(options){try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].transitionBegin=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].transitionBegin(options)}catch(err){};try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].transitionBegin=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].transitionBegin(options)}catch(err){}};Drupal.viewsSlideshowPager.goToSlide=function(options){try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].goToSlide=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].goToSlide(options)}catch(err){};try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].goToSlide=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].goToSlide(options)}catch(err){}};Drupal.viewsSlideshowPager.previousSlide=function(options){try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].previousSlide=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].previousSlide(options)}catch(err){};try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].previousSlide=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].previousSlide(options)}catch(err){}};Drupal.viewsSlideshowPager.nextSlide=function(options){try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].nextSlide=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].top.type].nextSlide(options)}catch(err){};try{if(typeof Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type!="undefined"&&typeof Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].nextSlide=='function')Drupal[Drupal.settings.viewsSlideshowPager[options.slideshowID].bottom.type].nextSlide(options)}catch(err){}};Drupal.behaviors.viewsSlideshowPagerFields={attach:function(context){$('.views_slideshow_pager_field:not(.views-slideshow-pager-field-processed)',context).addClass('views-slideshow-pager-field-processed').each(function(){var pagerInfo=$(this).attr('id').split('_'),location=pagerInfo[2];pagerInfo.splice(0,3);var uniqueID=pagerInfo.join('_');if(Drupal.settings.viewsSlideshowPagerFields[uniqueID][location].activatePauseOnHover){$(this).children().each(function(index,pagerItem){var mouseIn=function(){Drupal.viewsSlideshow.action({action:'goToSlide',slideshowID:uniqueID,slideNum:index});Drupal.viewsSlideshow.action({action:'pause',slideshowID:uniqueID})},mouseOut=function(){Drupal.viewsSlideshow.action({action:'play',slideshowID:uniqueID})};if(jQuery.fn.hoverIntent){$(pagerItem).hoverIntent(mouseIn,mouseOut)}else $(pagerItem).hover(mouseIn,mouseOut)})}else $(this).children().each(function(index,pagerItem){$(pagerItem).click(function(){Drupal.viewsSlideshow.action({action:'goToSlide',slideshowID:uniqueID,slideNum:index})})})})}};Drupal.viewsSlideshowPagerFields=Drupal.viewsSlideshowPagerFields||{};Drupal.viewsSlideshowPagerFields.transitionBegin=function(options){for(pagerLocation in Drupal.settings.viewsSlideshowPager[options.slideshowID]){$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"]').removeClass('active');$('#views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'_'+options.slideNum).addClass('active')}};Drupal.viewsSlideshowPagerFields.goToSlide=function(options){for(pagerLocation in Drupal.settings.viewsSlideshowPager[options.slideshowID]){$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"]').removeClass('active');$('#views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'_'+options.slideNum).addClass('active')}};Drupal.viewsSlideshowPagerFields.previousSlide=function(options){for(pagerLocation in Drupal.settings.viewsSlideshowPager[options.slideshowID]){var pagerNum=$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"].active').attr('id').replace('views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'_','');if(pagerNum==0){pagerNum=$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"]').length()-1}else pagerNum--;$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"]').removeClass('active');$('#views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'_'+pagerNum).addClass('active')}};Drupal.viewsSlideshowPagerFields.nextSlide=function(options){for(pagerLocation in Drupal.settings.viewsSlideshowPager[options.slideshowID]){var pagerNum=$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"].active').attr('id').replace('views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'_',''),totalPagers=$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"]').length();pagerNum++;if(pagerNum==totalPagers)pagerNum=0;$('[id^="views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'"]').removeClass('active');$('#views_slideshow_pager_field_item_'+pagerLocation+'_'+options.slideshowID+'_'+slideNum).addClass('active')}};Drupal.viewsSlideshowSlideCounter=Drupal.viewsSlideshowSlideCounter||{};Drupal.viewsSlideshowSlideCounter.transitionBegin=function(options){$('#views_slideshow_slide_counter_'+options.slideshowID+' .num').text(options.slideNum+1)};Drupal.viewsSlideshow.action=function(options){var status={value:true,text:''};if(typeof options.action=='undefined'||options.action==''){status.value=false;status.text=Drupal.t('There was no action specified.');return error};if(options.action=='pause'){Drupal.settings.viewsSlideshow[options.slideshowID].paused=1;if(options.force)Drupal.settings.viewsSlideshow[options.slideshowID].pausedForce=1}else if(options.action=='play')if(!Drupal.settings.viewsSlideshow[options.slideshowID].pausedForce||options.force){Drupal.settings.viewsSlideshow[options.slideshowID].paused=0;Drupal.settings.viewsSlideshow[options.slideshowID].pausedForce=0}else{status.value=false;status.text+=' '+Drupal.t('This slideshow is forced paused.');return status};switch(options.action){case"goToSlide":case"transitionBegin":case"transitionEnd":if(typeof options.slideNum=='undefined'||typeof options.slideNum!=='number'||parseInt(options.slideNum)!=(options.slideNum-0)){status.value=false;status.text=Drupal.t('An invalid integer was specified for slideNum.')};case"pause":case"play":case"nextSlide":case"previousSlide":var methods=Drupal.settings.viewsSlideshow[options.slideshowID]['methods'],excludeMethodsObj={};if(typeof options.excludeMethods!=='undefined')for(var i=0;i<excludeMethods.length;i++)excludeMethodsObj[excludeMethods[i]]='';for(i=0;i<methods[options.action].length;i++)if(Drupal[methods[options.action][i]]!=undefined&&typeof Drupal[methods[options.action][i]][options.action]=='function'&&!(methods[options.action][i]in excludeMethodsObj))Drupal[methods[options.action][i]][options.action](options);break;default:status.value=false;status.text=Drupal.t('An invalid action "!action" was specified.',{"!action":options.action})};return status}})(jQuery);
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/modules/views_slideshow/js/views_slideshow.js. */
/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/modules/context/plugins/context_reaction_block.js. */
(function($){Drupal.behaviors.contextReactionBlock={attach:function(context){$('form.context-editor:not(.context-block-processed)').addClass('context-block-processed').each(function(){var id=$(this).attr('id');Drupal.contextBlockEditor=Drupal.contextBlockEditor||{};$(this).bind('init.pageEditor',function(event){Drupal.contextBlockEditor[id]=new DrupalContextBlockEditor($(this))});$(this).bind('start.pageEditor',function(event,context){if(!context)context=$(this).data('defaultContext');Drupal.contextBlockEditor[id].editStart($(this),context)});$(this).bind('end.pageEditor',function(event){Drupal.contextBlockEditor[id].editFinish()})});$('#context-blockform:not(.processed)').each(function(){$(this).addClass('processed');Drupal.contextBlockForm=new DrupalContextBlockForm($(this));Drupal.contextBlockForm.setState()});$('#context-blockform a.remove:not(.processed)').each(function(){$(this).addClass('processed');$(this).click(function(){$(this).parents('tr').eq(0).remove();Drupal.contextBlockForm.setState();return false})});$('div.context-block-browser',context).nextAll('.form-item').hide()}};DrupalContextBlockForm=function(blockForm){this.state={};this.setState=function(){$('table.context-blockform-region',blockForm).each(function(){var region=$(this).attr('id').split('context-blockform-region-')[1],blocks=[];$('tr',$(this)).each(function(){var bid=$(this).attr('id'),weight=$(this).find('select,input').first().val();blocks.push({bid:bid,weight:weight})});Drupal.contextBlockForm.state[region]=blocks});$('form input.context-blockform-state').val(JSON.stringify(this.state));$('table.context-blockform-region tr').each(function(){var bid=$(this).attr('id');$('div.context-blockform-selector input[value='+bid+']').parents('div.form-item').eq(0).hide()});$('div.context-blockform-selector input').each(function(){var bid=$(this).val();if($('table.context-blockform-region tr#'+bid).size()===0)$(this).parents('div.form-item').eq(0).show()})};$('#ctools-export-ui-edit-item-form').submit(function(){Drupal.contextBlockForm.setState()});$.each(Drupal.settings.tableDrag,function(base){var table=$('#'+base+':not(.processed)',blockForm);if(table&&table.is('.context-blockform-region')){table.addClass('processed');table.bind('mouseup',function(event){Drupal.contextBlockForm.setState();return})}});$('td.blocks a',blockForm).each(function(){$(this).click(function(){var region=$(this).attr('href').split('#')[1],base="context-blockform-region-"+region,selected=$("div.context-blockform-selector input:checked");if(selected.size()>0){var weight_warn=false,min_weight_option=-10,max_weight_option=10,max_observed_weight=min_weight_option-1;$('table#'+base+' tr').each(function(){var weight_input_val=$(this).find('select,input').first().val();if(+weight_input_val>+max_observed_weight)max_observed_weight=weight_input_val});selected.each(function(){var block=document.createElement('tr'),text=$(this).parents('div.form-item').eq(0).hide().children('label').text(),select='<div class="form-item form-type-select"><select class="tabledrag-hide form-select">',i;weight_warn=true;var selected_weight=max_weight_option;if(max_weight_option>=(1+ +max_observed_weight)){selected_weight=++max_observed_weight;weight_warn=false};for(i=min_weight_option;i<=max_weight_option;++i){select+='<option';if(i==selected_weight)select+=' selected=selected';select+='>'+i+'</option>'};select+='</select></div>';$(block).attr('id',$(this).attr('value')).addClass('draggable');$(block).html("<td>"+text+"</td><td>"+select+"</td><td><a href='' class='remove'>X</a></td>");Drupal.tableDrag[base].makeDraggable(block);$('table#'+base).append(block);if($.cookie('Drupal.tableDrag.showWeight')==1){$('table#'+base).find('.tabledrag-hide').css('display','');$('table#'+base).find('.tabledrag-handle').css('display','none')}else{$('table#'+base).find('.tabledrag-hide').css('display','none');$('table#'+base).find('.tabledrag-handle').css('display','')};Drupal.attachBehaviors($('table#'+base));Drupal.contextBlockForm.setState();$(this).removeAttr('checked')});if(weight_warn)alert(Drupal.t('Desired block weight exceeds available weight options, please check weights for blocks before saving'))};return false})})};DrupalContextBlockEditor=function(editor){this.editor=editor;this.state={};this.blocks={};this.regions={};return this};DrupalContextBlockEditor.prototype={initBlocks:function(blocks){var self=this;this.blocks=blocks;blocks.each(function(){if($(this).hasClass('context-block-empty'))$(this).removeClass('context-block-hidden');$(this).addClass('draggable');$(this).prepend($('<a class="context-block-handle"></a>'));$(this).prepend($('<a class="context-block-remove"></a>').click(function(){$(this).parent('.block').eq(0).fadeOut('medium',function(){$(this).remove();self.updateBlocks()});return false}))})},initRegions:function(regions){this.regions=regions;var ref=this;$(regions).not('.context-ui-processed').each(function(index,el){$('.context-ui-add-link',el).click(function(e){ref.showBlockBrowser($(this).parent())}).addClass('context-ui-processed')});$('.context-block-browser').hide()},showBlockBrowser:function(region){var toggled=false,activeId=$('.context-editing',this.editor).attr('id').replace('-trigger',''),context=$('#'+activeId)[0];this.browser=$('.context-block-browser',context).addClass('active');if(!this.browser.has('input.filter').size()){var parent=$('.block-browser-sidebar .filter',this.browser),list=$('.blocks',this.browser);new Drupal.Filter(list,false,'.context-block-addable',parent)};this.browser.show().dialog({modal:true,close:function(){$(this).dialog('destroy');$('.category',this).show();$(this).hide().appendTo(context).removeClass('active')},height:(.8*$(window).height()),minHeight:400,minWidth:680,width:680});$('.context-block-browser-categories',this.browser).change(function(e){if($(this).val()==0){$('.category',self.browser).show()}else{$('.category',self.browser).hide();$('.category-'+$(this).val(),self.browser).show()}});if(this.addToRegion)$('.context-block-addable',this.browser).unbind('click.addToRegion');var self=this;this.addToRegion=function(e){var ui={item:$(this).clone(),sender:$(region)};$(this).parents('.context-block-browser.active').dialog('close');$(region).after(ui.item);self.addBlock(e,ui,this.editor,activeId.replace('context-editable-',''))};$('.context-block-addable',this.browser).bind('click.addToRegion',this.addToRegion)},updateBlocks:function(){var browser=$('div.context-block-browser');$('.block, .admin-block').each(function(){var bid=$(this).attr('id').split('block-')[1]});$('.context-block-item',browser).each(function(){var bid=$(this).attr('id').split('context-block-addable-')[1]});$(this.regions).each(function(){if($('.block:has(a.context-block)',this).size()>0){$(this).removeClass('context-block-region-empty')}else $(this).addClass('context-block-region-empty')})},updateRegion:function(event,ui,region,op){switch(op){case'over':$(region).removeClass('context-block-region-empty');break;case'out':if($('.draggable-placeholder',region).size()===1&&$('.block:has(a.context-block)',region).size()==0)$(region).addClass('context-block-region-empty');break}},scriptFix:function(event,ui,editor,context){if($('script',ui.item)){var placeholder=$(Drupal.settings.contextBlockEditor.scriptPlaceholder),label=$('div.handle label',ui.item).text();placeholder.children('strong').html(label);$('script',ui.item).parent().empty().append(placeholder)}},addBlock:function(event,ui,editor,context){var self=this;if(ui.item.is('.context-block-addable')){var bid=ui.item.attr('id').split('context-block-addable-')[1],params=Drupal.settings.contextBlockEditor.params;params.context_block=bid+','+context;if(!Drupal.settings.contextBlockEditor.block_tokens||!Drupal.settings.contextBlockEditor.block_tokens[bid]){alert(Drupal.t('An error occurred trying to retrieve block content. Please contact a site administer.'));return};params.context_token=Drupal.settings.contextBlockEditor.block_tokens[bid];var blockLoading=$('<div class="context-block-item context-block-loading"><span class="icon"></span></div>');ui.item.addClass('context-block-added');ui.item.after(blockLoading);$.getJSON(Drupal.settings.contextBlockEditor.path,params,function(data){if(data.status){var newBlock=$(data.block);if($('script',newBlock))$('script',newBlock).remove();blockLoading.fadeOut(function(){$(this).replaceWith(newBlock);self.initBlocks(newBlock);self.updateBlocks();Drupal.attachBehaviors(newBlock)})}else blockLoading.fadeOut(function(){$(this).remove()})})}else if(ui.item.is(':has(a.context-block)'))self.updateBlocks()},setState:function(){var self=this;$(this.regions).each(function(){var region=$('.context-block-region',this).attr('id').split('context-block-region-')[1],blocks=[];$('a.context-block',$(this)).each(function(){if($(this).attr('class').indexOf('edit-')!=-1){var bid=$(this).attr('id').split('context-block-')[1],context=$(this).attr('class').split('edit-')[1].split(' ')[0];context=context?context:0;var block={bid:bid,context:context};blocks.push(block)}});self.state[region]=blocks});$('input.context-block-editor-state',this.editor).val(JSON.stringify(this.state))},disableTextSelect:function(){if($.browser.safari){$('.block:has(a.context-block):not(:has(input,textarea))').css('WebkitUserSelect','none')}else if($.browser.mozilla){$('.block:has(a.context-block):not(:has(input,textarea))').css('MozUserSelect','none')}else if($.browser.msie){$('.block:has(a.context-block):not(:has(input,textarea))').bind('selectstart.contextBlockEditor',function(){return false})}else $(this).bind('mousedown.contextBlockEditor',function(){return false})},enableTextSelect:function(){if($.browser.safari){$('*').css('WebkitUserSelect','')}else if($.browser.mozilla){$('*').css('MozUserSelect','')}else if($.browser.msie){$('*').unbind('selectstart.contextBlockEditor')}else $(this).unbind('mousedown.contextBlockEditor')},editStart:function(editor,context){var self=this;$(document.body).addClass('context-editing');this.editor.addClass('context-editing');this.disableTextSelect();this.initBlocks($('.block:has(a.context-block.edit-'+context+')'));this.initRegions($('.context-block-region').parent());this.updateBlocks();$('a.context_ui_dialog-stop').hide();$('.editing-context-label').remove();var label=$('#context-editable-trigger-'+context+' .label').text();label=Drupal.t('Now Editing: ')+label;editor.parent().parent().prepend('<div class="editing-context-label">'+label+'</div>');$(this.regions).each(function(){var region=$(this),params={revert:true,dropOnEmpty:true,placeholder:'draggable-placeholder',forcePlaceholderSize:true,items:'> .block:has(a.context-block.editable)',handle:'a.context-block-handle',start:function(event,ui){self.scriptFix(event,ui,editor,context)},stop:function(event,ui){self.addBlock(event,ui,editor,context)},receive:function(event,ui){self.addBlock(event,ui,editor,context)},over:function(event,ui){self.updateRegion(event,ui,region,'over')},out:function(event,ui){self.updateRegion(event,ui,region,'out')},cursorAt:{left:300,top:0}};region.sortable(params)});$(this.regions).each(function(){$(this).sortable('option','connectWith',['.ui-sortable'])});if($.ui.version==='1.6'&&$.browser.safari)$.browser.mozilla=true},editFinish:function(){this.editor.removeClass('context-editing');this.enableTextSelect();$('.editing-context-label').remove();$(this.blocks).each(function(){$('a.context-block-handle, a.context-block-remove',this).remove();if($(this).hasClass('context-block-empty'))$(this).addClass('context-block-hidden');$(this).removeClass('draggable')});$('a.context_ui_dialog-stop').show();this.regions.sortable('destroy');this.setState();if($.ui.version==='1.6'&&$.browser.safari)$.browser.mozilla=false}}})(jQuery);
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/modules/context/plugins/context_reaction_block.js. */
/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/modules/olark/olark.js. */
Drupal.behaviors.olark=function(){if(typeof Drupal.settings.olark.uid!='undefined')olark.extend(function(api){api.chat.updateVisitorNickname({snippet:Drupal.settings.olark.name,hidesDefault:true});api.chat.updateVisitorStatus({snippet:Drupal.settings.olark.mail+' | '+Drupal.settings.olark.userpage});api.chat.onReady(function(){})});if(Drupal.settings.olark.disable_ios&&Drupal.settings.olark.enabled)olark('api.box.onShow',checkIOS)}
function checkIOS(){var agent=navigator.userAgent.toLowerCase(),isIOS=(agent.match(/iP(hone|ad)/i)!==null);if(isIOS)olark('api.box.hide')};
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/modules/olark/olark.js. */
