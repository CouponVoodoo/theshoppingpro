/**
 * @file liquidslider.js
 */
(function ($) {
  Drupal.behaviors.viewsSlideshowLiquidSlider = {
    attach: function (context, settings) {
      var fullId;
      var slideshowSettings;
      var slideshowContainer;

      $('.views_slideshow_liquid_slider_main:not(.viewsSlideshowLiquidSlider-processed)', context).addClass('viewsSlideshowLiquidSlider-processed').each(function() {
        // The id of the slider.
        fullId = '#' + $(this).attr('id');
        slideshowSettings = settings.viewsSlideshowLiquidSlider[fullId];
        slideshowSettings.autoslideinterval = parseInt(slideshowSettings.autoslideinterval);
        slideshowSettings.autoheightmin = parseInt(slideshowSettings.autoheightmin);
        slideshowSettings.autoheight = (slideshowSettings.autoheight == 1) ? true : false;
        slideshowSettings.dynamicarrows = (slideshowSettings.dynamicarrows == 1) ? true : false;
        slideshowSettings.autoslide = (slideshowSettings.autoslide == 1) ? true : false;

        slideshowSettings.targetId = '#' + $(fullId + " :first").attr('id');
        slideshowContainer = $(slideshowSettings.targetId);

        // Check if liquidSlider has been loaded.
        if (!jQuery.isFunction(slideshowContainer.liquidSlider)) {
          return;
        }

// preloader at true do stop to load ? ...

        slideshowContainer.liquidSlider({
          autoHeight:slideshowSettings.autoheight,
          autoHeightMin:slideshowSettings.autoheightmin,
          autoSlideInterval:slideshowSettings.autoslideinterval,
          autoSlide:slideshowSettings.autoslide,
          dynamicarrows:slideshowSettings.dynamicarrows,
          hashLinking:true,
          crossLinks:true,
          hashCrossLinks:false,
          preloader:false,
        });
      });
    }
  };
})(jQuery);
