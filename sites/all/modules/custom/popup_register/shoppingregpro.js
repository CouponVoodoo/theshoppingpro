/* Generate a script for Popup register Program */
var referral_url = 'http://theshoppingpro.com/';
document.write('<link href="'+referral_url+'version4.css" rel="stylesheet" type="text/css" />');
document.write('<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>');

jQuery(function($) {
	$("a.topopup").click(function() {
			loading(); // loading
			setTimeout(function(){ // then show popup, deley in .5 second
				loadPopup(); // function show popup
			}, 500); // .5 second
	return false;
	});

	/* event for close the popup */
	$("div.close").hover(
					function() {
						$('span.ecs_tooltip').show();
					},
					function () {
    					$('span.ecs_tooltip').hide();
  					}
				);

	$("div.close").click(function() {
		disablePopup();  // function close pop up
	});

	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			disablePopup();  // function close pop up
		}
	});

        $("div#backgroundPopup").click(function() {
		disablePopup();  // function close pop up
	});

	$('a.livebox').click(function() {
		//alert('Hello World!');
	return false;
	});

	 /************** start: functions. **************/
	function loading() {
		$("div.loader").show();
	}
	function closeloading() {
		$("div.loader").fadeOut('normal');
	}

	var popupStatus = 0; // set value

	function loadPopup() {
		if(popupStatus == 0) { // if value is 0, show popup
			closeloading(); // fadeout loading
			$("#toPopup").fadeIn(0500); // fadein popup div
			$("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
			$("#backgroundPopup").fadeIn(0001);
			popupStatus = 1; // and set value to 1
		}
	}

	function disablePopup() {
		if(popupStatus == 1) { // if value is 1, close popup
			$("#toPopup").fadeOut("normal");
			$("#backgroundPopup").fadeOut("normal");
			popupStatus = 0;  // and set value to 0
		}
	}
	/************** end: functions. **************/
}); // jQuery End

//Validation
 jQuery(function(){
 jQuery("#user-register-form").validate();
 jQuery("#user-login-form").validate();
  });

var social_plugins=('<ul class="hybridauth-widget"><li><a onclick="popup_window = window.open(this.href, \'hybridauth\', \'location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,titlebar=yes,toolbar=no,channelmode=yes,fullscreen=yes,width=800,height=500\'); popup_window.focus(); return false;" rel="nofollow" title="Facebook" href="http://www.theshoppingpro.com/hybridauth/window/Facebook?destination=modal_forms/ajax/login"><span title="Facebook" class="hybridauth-icon-hybridauth-32 hybridauth-facebook-hybridauth-32"></span></a></li><li><a onclick="popup_window = window.open(this.href, \'hybridauth\', \'location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,titlebar=yes,toolbar=no,channelmode=yes,fullscreen=yes,width=800,height=500\'); popup_window.focus(); return false;" rel="nofollow" title="Google" href="http://www.theshoppingpro.com/hybridauth/window/Google?destination=modal_forms/ajax/login"><span title="Google" class="hybridauth-icon-hybridauth-32 hybridauth-google-hybridauth-32"></span></a></li><li><a onclick="popup_window = window.open(this.href, \'hybridauth\', \'location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,titlebar=yes,toolbar=no,channelmode=yes,fullscreen=yes,width=800,height=500\'); popup_window.focus(); return false;" rel="nofollow" title="Twitter" href="http://www.theshoppingpro.com/hybridauth/window/Twitter?destination=modal_forms/ajax/login"><span title="Twitter" class="hybridauth-icon-hybridauth-32 hybridauth-twitter-hybridauth-32"></span></a></li><li class="last"><a onclick="popup_window = window.open(this.href, \'hybridauth\', \'location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,titlebar=yes,toolbar=no,channelmode=yes,fullscreen=yes,width=800,height=500\'); popup_window.focus(); return false;" rel="nofollow" title="Windows Live" href="http://www.theshoppingpro.com/hybridauth/window/Live?destination=modal_forms/ajax/login"><span title="Windows Live" class="hybridauth-icon-hybridauth-32 hybridauth-live-hybridauth-32"></span></a></li></ul>');

var conent_form='<div class="reg_form"><form accept-charset="UTF-8" action="'+referral_url+'/user/register" id="user-register-form" method="post" target="test"><ul><li class="text"><input type="hidden" value="user_register_form" name="form_id"><input type="text" maxlength="60" size="30" value="" name="name" id="edit-name" placeholder="User Name" class="username form-text required"><input type="text" class="form-text required email" maxlength="254" size="30" value="" name="mail" id="edit-mail" placeholder="E-mail address"><input type="password" maxlength="128" size="30" name="pass[pass1]" id="edit-pass-pass1" placeholder="Password" class="password-field form-text required"><input type="password" maxlength="128" size="30" name="pass[pass2]" id="edit-pass-pass2" placeholder="Confirm password" class="password-confirm form-text required"><input type="hidden" value="Asia/Kolkata" name="timezone"><input type="checkbox" class="form-checkbox required" value="1" name="terms_of_use" id="edit-terms-of-use--2"><label for="edit-terms-of-use--2">By clicking here you agree to the <a target="_blank" href="'+ referral_url +'terms">Terms and Conditions</a> of the site</label><input class="form-submit regbox" id="edit-submit" name="op" type="submit" value="Create new account" /></li></ul><input id="edit-user-register" name="form_id" type="hidden" value="user_register_form" /><input type="hidden" value="Asia/Kolkata" name="timezone"></form></div><form accept-charset="UTF-8" action="'+referral_url+'user" id="user-login-form" method="post" target="test"><ul><li class="text"><input class="form-text required" id="edit-name" maxlength="60" name="name" size="30" type="text" value="" placeholder="Username"/><input class="form-text required" id="edit-pass" maxlength="60" name="pass" size="30" type="password" placeholder="Password"/></li><li><a class="reg_link" href="#">Create a New Account</a></li><li class="submit"><input class="form-submit" id="edit-submit" name="op" type="submit" value="Log in" /></li></ul><input id="edit-user-login" name="form_id" type="hidden" value="user_login" /></form><iframe style="width:50px;height:50px;visibility:hidden;" name="test"></iframe> ';


document.write('<a href="" class="topopup">Click Here</a><div id="toPopup"><div class="close"></div><span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span><div class="modal-header popups-title"><span class="modal-title" id="modal-title">Login</span></div><div id="popup_content"><p class="replace_cont">'+ social_plugins +' '+ conent_form +'</p></div></div><div class="loader"></div><div id="backgroundPopup"></div>');



jQuery(function(){
jQuery('.reg_form').hide();				
 jQuery(".reg_link").click(function() {
jQuery(".reg_form").show();
jQuery('#user-login-form').hide();
 });


jQuery("#user-login-form").submit(function() {
if (jQuery("#user-login-form .required").val() != "") {
$('.replace_cont').replaceWith('<h4>Congratulations! Your cashback is set for both login and registration</h4>');	
$('#user-login-form').hide();
return true;
}
return false;
});

jQuery("#user-register-form").submit(function() {
if (jQuery("#user-register-form .required").val() != "") {
$('.replace_cont').replaceWith('<h4>Congratulations! Your cashback is set for both login and registration</h4>');
$('#user-register-form').hide();
return true;
}
return false;
});
});
