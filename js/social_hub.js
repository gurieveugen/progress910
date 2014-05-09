jQuery(function() {
	// =========================================================
	// TWITTER CLICKS
	// =========================================================
	jQuery('.reply, .retweet, .favorite, .share').click(function(e){
		window.open(this.href, 'Twitter', 'width=500,height=300');		
		e.preventDefault();
	});
});
