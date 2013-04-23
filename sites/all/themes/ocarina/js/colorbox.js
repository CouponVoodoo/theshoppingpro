jQuery(function(){if (jQuery('a.colorbox_form').length > 0) {
  var link = jQuery("a.colorbox_form").attr('href');
  link = link.concat('?colorbox=true');
  // colorbox=true is attached for later use (read below).
  jQuery("a.colorbox_form").attr('href', link);
  jQuery("a.colorbox_form").colorbox({iframe:true, width:200, height:250, onClosed:function(){ location.reload(true); } });
}
});