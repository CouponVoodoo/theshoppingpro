var hasFlash = false;
    try {
        var fo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
        if (fo) {
            hasFlash = true;
        }
    } catch (e) {

        if (navigator.mimeTypes && navigator.mimeTypes['application/x-shockwave-flash'] != undefined && navigator.mimeTypes['application/x-shockwave-flash'].enabledPlugin) {
            hasFlash = true;
        }
    }
	//hasFlash=false;
    if (hasFlash) {
        copy_coupon_productPage_footer();
    } else {
   click_coupon_footer();
    }
function click_coupon_footer() {
	var divArray = document.getElementsByClassName("unlock_coupon")[0];
	var offer_type = divArray.getAttribute('data-clipboard-text');
	try {
		divArray.addEventListener('click', function () {
			try{
				var url = this.getAttribute("href");
				var coupon_code = this.getAttribute("data-clipboard-text");
				this.innerHTML = "Can't Copy";
				var classname = this.className+' popup_copied_coupon';
				this.setAttribute("class",classname);
				console.log('oc');
			}catch(e){}	
		});
	} catch (e) {
	}
	return false;        
}

function copy_coupon_productPage_footer(){
	var divArray = document.getElementsByClassName("unlock_coupon");
	try{
		var client = new ZeroClipboard( divArray, {moviePath:'/sites/all/themes/basic/js/zeroclipboard/ZeroClipboard.swf' } );
		client.on( 'load', function(client) { 
			client.on( 'complete', function(client, args) {
				try{
					var url = this.getAttribute("href");
					var coupon_code = this.getAttribute("data-clipboard-text");
					this.innerHTML = '✔ Copied';
					var classname = this.className+' popup_copied_coupon';
					this.setAttribute("class",classname);
					console.log('oc');   
				}catch(e){console.log(e.message); }
			} );
		} ); 
     }catch(e){console.log(e.message); }
 // }
 return false;
}