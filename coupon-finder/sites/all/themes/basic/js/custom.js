jQuery.noConflict();
jQuery(document).ready(function () {
    locader = function(url){
        ///alert('url==>' + url);
        jQuery('.locader').css({display:'block'})
        jQuery('#content').css({display:'none'})
        jQuery('#sidebar-second').css({display:'none'})
        jQuery('#sidebar-first').css({display:'none'})
        
        window.location = url;
    }
});

// To show only 3 coupons and hide rest with show more option

jQuery(document).ready(function() {
  jQuery('#search_listing_li_row_1').show();
  jQuery('#search_listing_li_row_2').show();
  jQuery('#search_listing_li_row_3').show();
});

function show_more_coupon_list() {
  jQuery("li[id^='search_listing_li_row']").show();
}