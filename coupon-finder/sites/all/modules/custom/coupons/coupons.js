/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    // VERTICALLY ALIGN FUNCTION
    $.fn.vAlign = function() {
        return this.each(function(i){
            var ah = $(this).height();
            console.log(ah);
            var ph = $(this).parent().height();
            console.log(ph);
            var mh = Math.ceil((ph-ah) / 2);
            console.log(mh);
            $(this).css('margin-top', mh);
        });
    };
})(jQuery);
jQuery(document).ready(function($){
    jQuery('.search_listing_right').vAlign();
});
