/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/modules/views/js/ajax_view.js. */
(function($){Drupal.behaviors.ViewsAjaxView={};Drupal.behaviors.ViewsAjaxView.attach=function(){if(Drupal.settings&&Drupal.settings.views&&Drupal.settings.views.ajaxViews)$.each(Drupal.settings.views.ajaxViews,function(i,settings){Drupal.views.instances[i]=new Drupal.views.ajaxView(settings)})};Drupal.views={};Drupal.views.instances={};Drupal.views.ajaxView=function(settings){var selector='.view-dom-id-'+settings.view_dom_id;this.$view=$(selector);var ajax_path=Drupal.settings.views.ajax_path;if(ajax_path.constructor.toString().indexOf("Array")!=-1)ajax_path=ajax_path[0];var queryString=window.location.search||'';if(queryString!==''){var queryString=queryString.slice(1).replace(/q=[^&]+&?|&?render=[^&]+/,'');if(queryString!=='')queryString=((/\?/.test(ajax_path))?'&':'?')+queryString};this.element_settings={url:ajax_path+queryString,submit:settings,setClick:true,event:'click',selector:selector,progress:{type:'throbber'}};this.settings=settings;this.$exposed_form=$('form#views-exposed-form-'+settings.view_name.replace(/_/g,'-')+'-'+settings.view_display_id.replace(/_/g,'-'));this.$exposed_form.once(jQuery.proxy(this.attachExposedFormAjax,this));this.$view.filter(jQuery.proxy(this.filterNestedViews,this)).once(jQuery.proxy(this.attachPagerAjax,this))};Drupal.views.ajaxView.prototype.attachExposedFormAjax=function(){var button=$('input[type=submit], input[type=image]',this.$exposed_form);button=button[0];this.exposedFormAjax=new Drupal.ajax($(button).attr('id'),button,this.element_settings)};Drupal.views.ajaxView.prototype.filterNestedViews=function(){return!this.$view.parents('.view').size()};Drupal.views.ajaxView.prototype.attachPagerAjax=function(){this.$view.find('ul.pager > li > a, th.views-field a, .attachment .views-summary a').each(jQuery.proxy(this.attachPagerLinkAjax,this))};Drupal.views.ajaxView.prototype.attachPagerLinkAjax=function(id,link){var $link=$(link),viewData={},href=$link.attr('href');$.extend(viewData,this.settings,Drupal.Views.parseQueryString(href),Drupal.Views.parseViewArgs(href,this.settings.view_base_path));$.extend(viewData,Drupal.Views.parseViewArgs(href,this.settings.view_base_path));this.element_settings.submit=viewData;this.pagerAjax=new Drupal.ajax(false,$link,this.element_settings)};Drupal.ajax.prototype.commands.viewsScrollTop=function(ajax,response,status){var offset=$(response.selector).offset(),scrollTarget=response.selector;while($(scrollTarget).scrollTop()==0&&$(scrollTarget).parent())scrollTarget=$(scrollTarget).parent();if(offset.top-10<$(scrollTarget).scrollTop())$(scrollTarget).animate({scrollTop:(offset.top-10)},500)}})(jQuery);
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/modules/views/js/ajax_view.js. */
/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/modules/context/plugins/context_reaction_block.js. */
(function($){Drupal.behaviors.contextReactionBlock={attach:function(context){$('form.context-editor:not(.context-block-processed)').addClass('context-block-processed').each(function(){var id=$(this).attr('id');Drupal.contextBlockEditor=Drupal.contextBlockEditor||{};$(this).bind('init.pageEditor',function(event){Drupal.contextBlockEditor[id]=new DrupalContextBlockEditor($(this))});$(this).bind('start.pageEditor',function(event,context){if(!context)context=$(this).data('defaultContext');Drupal.contextBlockEditor[id].editStart($(this),context)});$(this).bind('end.pageEditor',function(event){Drupal.contextBlockEditor[id].editFinish()})});$('#context-blockform:not(.processed)').each(function(){$(this).addClass('processed');Drupal.contextBlockForm=new DrupalContextBlockForm($(this));Drupal.contextBlockForm.setState()});$('#context-blockform a.remove:not(.processed)').each(function(){$(this).addClass('processed');$(this).click(function(){$(this).parents('tr').eq(0).remove();Drupal.contextBlockForm.setState();return false})});$('div.context-block-browser',context).nextAll('.form-item').hide()}};DrupalContextBlockForm=function(blockForm){this.state={};this.setState=function(){$('table.context-blockform-region',blockForm).each(function(){var region=$(this).attr('id').split('context-blockform-region-')[1],blocks=[];$('tr',$(this)).each(function(){var bid=$(this).attr('id'),weight=$(this).find('select,input').first().val();blocks.push({bid:bid,weight:weight})});Drupal.contextBlockForm.state[region]=blocks});$('form input.context-blockform-state').val(JSON.stringify(this.state));$('table.context-blockform-region tr').each(function(){var bid=$(this).attr('id');$('div.context-blockform-selector input[value='+bid+']').parents('div.form-item').eq(0).hide()});$('div.context-blockform-selector input').each(function(){var bid=$(this).val();if($('table.context-blockform-region tr#'+bid).size()===0)$(this).parents('div.form-item').eq(0).show()})};$('#ctools-export-ui-edit-item-form').submit(function(){Drupal.contextBlockForm.setState()});$.each(Drupal.settings.tableDrag,function(base){var table=$('#'+base+':not(.processed)',blockForm);if(table&&table.is('.context-blockform-region')){table.addClass('processed');table.bind('mouseup',function(event){Drupal.contextBlockForm.setState();return})}});$('td.blocks a',blockForm).each(function(){$(this).click(function(){var region=$(this).attr('href').split('#')[1],base="context-blockform-region-"+region,selected=$("div.context-blockform-selector input:checked");if(selected.size()>0){var weight_warn=false,min_weight_option=-10,max_weight_option=10,max_observed_weight=min_weight_option-1;$('table#'+base+' tr').each(function(){var weight_input_val=$(this).find('select,input').first().val();if(+weight_input_val>+max_observed_weight)max_observed_weight=weight_input_val});selected.each(function(){var block=document.createElement('tr'),text=$(this).parents('div.form-item').eq(0).hide().children('label').text(),select='<div class="form-item form-type-select"><select class="tabledrag-hide form-select">',i;weight_warn=true;var selected_weight=max_weight_option;if(max_weight_option>=(1+ +max_observed_weight)){selected_weight=++max_observed_weight;weight_warn=false};for(i=min_weight_option;i<=max_weight_option;++i){select+='<option';if(i==selected_weight)select+=' selected=selected';select+='>'+i+'</option>'};select+='</select></div>';$(block).attr('id',$(this).attr('value')).addClass('draggable');$(block).html("<td>"+text+"</td><td>"+select+"</td><td><a href='' class='remove'>X</a></td>");Drupal.tableDrag[base].makeDraggable(block);$('table#'+base).append(block);if($.cookie('Drupal.tableDrag.showWeight')==1){$('table#'+base).find('.tabledrag-hide').css('display','');$('table#'+base).find('.tabledrag-handle').css('display','none')}else{$('table#'+base).find('.tabledrag-hide').css('display','none');$('table#'+base).find('.tabledrag-handle').css('display','')};Drupal.attachBehaviors($('table#'+base));Drupal.contextBlockForm.setState();$(this).removeAttr('checked')});if(weight_warn)alert(Drupal.t('Desired block weight exceeds available weight options, please check weights for blocks before saving'))};return false})})};DrupalContextBlockEditor=function(editor){this.editor=editor;this.state={};this.blocks={};this.regions={};return this};DrupalContextBlockEditor.prototype={initBlocks:function(blocks){var self=this;this.blocks=blocks;blocks.each(function(){if($(this).hasClass('context-block-empty'))$(this).removeClass('context-block-hidden');$(this).addClass('draggable');$(this).prepend($('<a class="context-block-handle"></a>'));$(this).prepend($('<a class="context-block-remove"></a>').click(function(){$(this).parent('.block').eq(0).fadeOut('medium',function(){$(this).remove();self.updateBlocks()});return false}))})},initRegions:function(regions){this.regions=regions;var ref=this;$(regions).not('.context-ui-processed').each(function(index,el){$('.context-ui-add-link',el).click(function(e){ref.showBlockBrowser($(this).parent())}).addClass('context-ui-processed')});$('.context-block-browser').hide()},showBlockBrowser:function(region){var toggled=false,activeId=$('.context-editing',this.editor).attr('id').replace('-trigger',''),context=$('#'+activeId)[0];this.browser=$('.context-block-browser',context).addClass('active');if(!this.browser.has('input.filter').size()){var parent=$('.block-browser-sidebar .filter',this.browser),list=$('.blocks',this.browser);new Drupal.Filter(list,false,'.context-block-addable',parent)};this.browser.show().dialog({modal:true,close:function(){$(this).dialog('destroy');$('.category',this).show();$(this).hide().appendTo(context).removeClass('active')},height:(.8*$(window).height()),minHeight:400,minWidth:680,width:680});$('.context-block-browser-categories',this.browser).change(function(e){if($(this).val()==0){$('.category',self.browser).show()}else{$('.category',self.browser).hide();$('.category-'+$(this).val(),self.browser).show()}});if(this.addToRegion)$('.context-block-addable',this.browser).unbind('click.addToRegion');var self=this;this.addToRegion=function(e){var ui={item:$(this).clone(),sender:$(region)};$(this).parents('.context-block-browser.active').dialog('close');$(region).after(ui.item);self.addBlock(e,ui,this.editor,activeId.replace('context-editable-',''))};$('.context-block-addable',this.browser).bind('click.addToRegion',this.addToRegion)},updateBlocks:function(){var browser=$('div.context-block-browser');$('.block, .admin-block').each(function(){var bid=$(this).attr('id').split('block-')[1]});$('.context-block-item',browser).each(function(){var bid=$(this).attr('id').split('context-block-addable-')[1]});$(this.regions).each(function(){if($('.block:has(a.context-block)',this).size()>0){$(this).removeClass('context-block-region-empty')}else $(this).addClass('context-block-region-empty')})},updateRegion:function(event,ui,region,op){switch(op){case'over':$(region).removeClass('context-block-region-empty');break;case'out':if($('.draggable-placeholder',region).size()===1&&$('.block:has(a.context-block)',region).size()==0)$(region).addClass('context-block-region-empty');break}},scriptFix:function(event,ui,editor,context){if($('script',ui.item)){var placeholder=$(Drupal.settings.contextBlockEditor.scriptPlaceholder),label=$('div.handle label',ui.item).text();placeholder.children('strong').html(label);$('script',ui.item).parent().empty().append(placeholder)}},addBlock:function(event,ui,editor,context){var self=this;if(ui.item.is('.context-block-addable')){var bid=ui.item.attr('id').split('context-block-addable-')[1],params=Drupal.settings.contextBlockEditor.params;params.context_block=bid+','+context;if(!Drupal.settings.contextBlockEditor.block_tokens||!Drupal.settings.contextBlockEditor.block_tokens[bid]){alert(Drupal.t('An error occurred trying to retrieve block content. Please contact a site administer.'));return};params.context_token=Drupal.settings.contextBlockEditor.block_tokens[bid];var blockLoading=$('<div class="context-block-item context-block-loading"><span class="icon"></span></div>');ui.item.addClass('context-block-added');ui.item.after(blockLoading);$.getJSON(Drupal.settings.contextBlockEditor.path,params,function(data){if(data.status){var newBlock=$(data.block);if($('script',newBlock))$('script',newBlock).remove();blockLoading.fadeOut(function(){$(this).replaceWith(newBlock);self.initBlocks(newBlock);self.updateBlocks();Drupal.attachBehaviors(newBlock)})}else blockLoading.fadeOut(function(){$(this).remove()})})}else if(ui.item.is(':has(a.context-block)'))self.updateBlocks()},setState:function(){var self=this;$(this.regions).each(function(){var region=$('.context-block-region',this).attr('id').split('context-block-region-')[1],blocks=[];$('a.context-block',$(this)).each(function(){if($(this).attr('class').indexOf('edit-')!=-1){var bid=$(this).attr('id').split('context-block-')[1],context=$(this).attr('class').split('edit-')[1].split(' ')[0];context=context?context:0;var block={bid:bid,context:context};blocks.push(block)}});self.state[region]=blocks});$('input.context-block-editor-state',this.editor).val(JSON.stringify(this.state))},disableTextSelect:function(){if($.browser.safari){$('.block:has(a.context-block):not(:has(input,textarea))').css('WebkitUserSelect','none')}else if($.browser.mozilla){$('.block:has(a.context-block):not(:has(input,textarea))').css('MozUserSelect','none')}else if($.browser.msie){$('.block:has(a.context-block):not(:has(input,textarea))').bind('selectstart.contextBlockEditor',function(){return false})}else $(this).bind('mousedown.contextBlockEditor',function(){return false})},enableTextSelect:function(){if($.browser.safari){$('*').css('WebkitUserSelect','')}else if($.browser.mozilla){$('*').css('MozUserSelect','')}else if($.browser.msie){$('*').unbind('selectstart.contextBlockEditor')}else $(this).unbind('mousedown.contextBlockEditor')},editStart:function(editor,context){var self=this;$(document.body).addClass('context-editing');this.editor.addClass('context-editing');this.disableTextSelect();this.initBlocks($('.block:has(a.context-block.edit-'+context+')'));this.initRegions($('.context-block-region').parent());this.updateBlocks();$('a.context_ui_dialog-stop').hide();$('.editing-context-label').remove();var label=$('#context-editable-trigger-'+context+' .label').text();label=Drupal.t('Now Editing: ')+label;editor.parent().parent().prepend('<div class="editing-context-label">'+label+'</div>');$(this.regions).each(function(){var region=$(this),params={revert:true,dropOnEmpty:true,placeholder:'draggable-placeholder',forcePlaceholderSize:true,items:'> .block:has(a.context-block.editable)',handle:'a.context-block-handle',start:function(event,ui){self.scriptFix(event,ui,editor,context)},stop:function(event,ui){self.addBlock(event,ui,editor,context)},receive:function(event,ui){self.addBlock(event,ui,editor,context)},over:function(event,ui){self.updateRegion(event,ui,region,'over')},out:function(event,ui){self.updateRegion(event,ui,region,'out')},cursorAt:{left:300,top:0}};region.sortable(params)});$(this.regions).each(function(){$(this).sortable('option','connectWith',['.ui-sortable'])});if($.ui.version==='1.6'&&$.browser.safari)$.browser.mozilla=true},editFinish:function(){this.editor.removeClass('context-editing');this.enableTextSelect();$('.editing-context-label').remove();$(this.blocks).each(function(){$('a.context-block-handle, a.context-block-remove',this).remove();if($(this).hasClass('context-block-empty'))$(this).addClass('context-block-hidden');$(this).removeClass('draggable')});$('a.context_ui_dialog-stop').show();this.regions.sortable('destroy');this.setState();if($.ui.version==='1.6'&&$.browser.safari)$.browser.mozilla=false}}})(jQuery);
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/modules/context/plugins/context_reaction_block.js. */
/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/modules/google_analytics/googleanalytics.js. */
(function($){$(document).ready(function(){var isInternal=new RegExp("^(https?):\/\/"+window.location.host,"i");$(document.body).click(function(event){$(event.target).closest("a,area").each(function(){var ga=Drupal.settings.googleanalytics,isInternalSpecial=new RegExp("(\/go\/.*)$","i"),isDownload=new RegExp("\\.("+ga.trackDownloadExtensions+")$","i");if(isInternal.test(this.href)){if($(this).is('.colorbox'));else if(ga.trackDownload&&isDownload.test(this.href)){var extension=isDownload.exec(this.href);_gaq.push(["_trackEvent","Downloads",extension[1].toUpperCase(),this.href.replace(isInternal,'')])}else if(isInternalSpecial.test(this.href))_gaq.push(["_trackPageview",this.href.replace(isInternal,'')])}else if(ga.trackMailto&&$(this).is("a[href^='mailto:'],area[href^='mailto:']")){_gaq.push(["_trackEvent","Mails","Click",this.href.substring(7)])}else if(ga.trackOutbound&&this.href.match(/^\w+:\/\//i))if(ga.trackDomainMode==2&&isCrossDomain($(this).attr('hostname'),ga.trackCrossDomains)){event.preventDefault();_gaq.push(["_link",this.href])}else _gaq.push(["_trackEvent","Outbound links","Click",this.href])})});$(document).bind("cbox_complete",function(){var href=$.colorbox.element().attr("href");if(href)_gaq.push(["_trackPageview",href.replace(isInternal,'')])})})
function isCrossDomain(hostname,crossDomains){if(!crossDomains){return false}else return $.inArray(hostname,crossDomains)>-1?true:false}})(jQuery);
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/modules/google_analytics/googleanalytics.js. */
/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/modules/olark/olark.js. */
Drupal.behaviors.olark=function(){if(typeof Drupal.settings.olark.uid!='undefined')olark.extend(function(api){api.chat.updateVisitorNickname({snippet:Drupal.settings.olark.name,hidesDefault:true});api.chat.updateVisitorStatus({snippet:Drupal.settings.olark.mail+' | '+Drupal.settings.olark.userpage});api.chat.onReady(function(){})});if(Drupal.settings.olark.disable_ios&&Drupal.settings.olark.enabled)olark('api.box.onShow',checkIOS)}
function checkIOS(){var agent=navigator.userAgent.toLowerCase(),isIOS=(agent.match(/iP(hone|ad)/i)!==null);if(isIOS)olark('api.box.hide')};
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/modules/olark/olark.js. */
/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/themes/ocarina/js/colorbox.js. */
jQuery(function(){if(jQuery('a.colorbox_form').length>0){var link=jQuery("a.colorbox_form").attr('href');link=link.concat('?colorbox=true');jQuery("a.colorbox_form").attr('href',link);jQuery("a.colorbox_form").colorbox({iframe:true,width:200,height:250,onClosed:function(){location.reload(true)}})}});
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/themes/ocarina/js/colorbox.js. */
/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/themes/omega/omega/js/jquery.formalize.js. */
var FORMALIZE=(function($,window,document,undefined){var PLACEHOLDER_SUPPORTED='placeholder'in document.createElement('input'),AUTOFOCUS_SUPPORTED='autofocus'in document.createElement('input'),IE6=!!($.browser.msie&&parseInt($.browser.version,10)===6),IE7=!!($.browser.msie&&parseInt($.browser.version,10)===7);return{go:function(){for(var i in FORMALIZE.init)FORMALIZE.init[i]()},init:{ie6_skin_inputs:function(){if(!IE6||!$('input, select, textarea').length)return;var button_regex=/button|submit|reset/,type_regex=/date|datetime|datetime-local|email|month|number|password|range|search|tel|text|time|url|week/;$('input').each(function(){var el=$(this);if(this.getAttribute('type').match(button_regex)){el.addClass('ie6-button');if(this.disabled)el.addClass('ie6-button-disabled')}else if(this.getAttribute('type').match(type_regex)){el.addClass('ie6-input');if(this.disabled)el.addClass('ie6-input-disabled')}});$('textarea, select').each(function(){if(this.disabled)$(this).addClass('ie6-input-disabled')})},autofocus:function(){if(AUTOFOCUS_SUPPORTED||!$(':input[autofocus]').length)return;$(':input[autofocus]:visible:first').focus()},placeholder:function(){if(PLACEHOLDER_SUPPORTED||!$(':input[placeholder]').length)return;FORMALIZE.misc.add_placeholder();$(':input[placeholder]').each(function(){var el=$(this),text=el.attr('placeholder');el.focus(function(){if(el.val()===text)el.val('').removeClass('placeholder-text')}).blur(function(){FORMALIZE.misc.add_placeholder()});el.closest('form').submit(function(){if(el.val()===text)el.val('').removeClass('placeholder-text')}).bind('reset',function(){setTimeout(FORMALIZE.misc.add_placeholder,50)})})}},misc:{add_placeholder:function(){if(PLACEHOLDER_SUPPORTED||!$(':input[placeholder]').length)return;$(':input[placeholder]').each(function(){var el=$(this),text=el.attr('placeholder');if(!el.val()||el.val()===text)el.val(text).addClass('placeholder-text')})}}}})(jQuery,this,this.document);jQuery(document).ready(function(){FORMALIZE.go()});
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/themes/omega/omega/js/jquery.formalize.js. */
/* Source and licensing information for the line(s) below can be found at http://www.theshoppingpro.com/sites/all/themes/omega/omega/js/omega-mediaqueries.js. */
Drupal.omega=Drupal.omega||{};(function($){var current,previous,setCurrentLayout=function(index){index=parseInt(index);previous=current;current=Drupal.settings.omega.layouts.order.hasOwnProperty(index)?Drupal.settings.omega.layouts.order[index]:'mobile';if(previous!=current){$('body').removeClass('responsive-layout-'+previous).addClass('responsive-layout-'+current);$.event.trigger('responsivelayout',{from:previous,to:current})}};Drupal.omega.getCurrentLayout=function(){return current};Drupal.omega.getPreviousLayout=function(){return previous};Drupal.omega.crappyBrowser=function(){return $.browser.msie&&parseInt($.browser.version,10)<9};Drupal.omega.checkLayout=function(layout){if(Drupal.settings.omega.layouts.queries.hasOwnProperty(layout)&&Drupal.settings.omega.layouts.queries[layout]){var output=Drupal.omega.checkQuery(Drupal.settings.omega.layouts.queries[layout]);if(!output&&layout==Drupal.settings.omega.layouts.primary){var dummy=$('<div id="omega-check-query"></div>').prependTo('body');dummy.append('<style media="all">#omega-check-query { position: relative; z-index: -1; }</style>');dummy.append('<!--[if (lt IE 9)&(!IEMobile)]><style media="all">#omega-check-query { z-index: 100; }</style><![endif]-->');output=parseInt(dummy.css('z-index'))==100;dummy.remove()};return output};return false};Drupal.omega.checkQuery=function(query){var dummy=$('<div id="omega-check-query"></div>').prependTo('body');dummy.append('<style media="all">#omega-check-query { position: relative; z-index: -1; }</style>');dummy.append('<style media="'+query+'">#omega-check-query { z-index: 100; }</style>');var output=parseInt(dummy.css('z-index'))==100;dummy.remove();return output};Drupal.behaviors.omegaMediaQueries={attach:function(context){$('body',context).once('omega-mediaqueries',function(){var primary=$.inArray(Drupal.settings.omega.layouts.primary,Drupal.settings.omega.layouts.order),dummy=$('<div id="omega-media-query-dummy"></div>').prependTo('body');dummy.append('<style media="all">#omega-media-query-dummy { position: relative; z-index: -1; }</style>');dummy.append('<!--[if (lt IE 9)&(!IEMobile)]><style media="all">#omega-media-query-dummy { z-index: '+primary+'; }</style><![endif]-->');for(var i in Drupal.settings.omega.layouts.order)dummy.append('<style media="'+Drupal.settings.omega.layouts.queries[Drupal.settings.omega.layouts.order[i]]+'">#omega-media-query-dummy { z-index: '+i+'; }</style>');$(window).bind('resize.omegamediaqueries',function(){setCurrentLayout(dummy.css('z-index'))}).load(function(){$(this).trigger('resize.omegamediaqueries')})})}}})(jQuery);
/* Source and licensing information for the above line(s) can be found at http://www.theshoppingpro.com/sites/all/themes/omega/omega/js/omega-mediaqueries.js. */
