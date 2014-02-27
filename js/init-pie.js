jQuery(function() {
	if(window.PIE){
		jQuery('.header-contact .buttons a, .popup-signin, .popup-signin .header').each(function(){
			PIE.attach(this);
		});
	}
});