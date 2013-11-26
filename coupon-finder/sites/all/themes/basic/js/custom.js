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