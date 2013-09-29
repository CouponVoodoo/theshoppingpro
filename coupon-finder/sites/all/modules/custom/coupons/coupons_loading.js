(function($) {

  $(document).ready(function(){
    $("#edit-submit").click(function(){
      $("#content").css('background-color', '#fff');
      $("#content-area").html($("#loading_image_div").html());
    });
  });

}(jQuery));  
