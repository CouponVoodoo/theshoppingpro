(function($) {

  $(document).ready(function(){
    $("#edit-submit").click(function(){
      $("#content").css('background-color', '#fff');
      $("#content").append($("#loading_image_div").html());
      $("#content-area").attr('style', 'display:none');
      return true;
    });
  });

}(jQuery));  
