jQuery(function() {
	// =========================================================
	// TWITTER CLICKS
	// =========================================================
	jQuery('.reply, .retweet, .favorite, .share').click(function(e){
		window.open(this.href, 'Twitter', 'width=500,height=300');		
		e.preventDefault();
	});

	// =========================================================
	// MASONRY BRICS
	// =========================================================		
	jQuery(window).load(function(){ 
		jQuery(social_hub.container).masonry({ 
			itemSelector: '.social-post', 
			columnWidth: 117
		});			
	});	
	// =========================================================
	// FILTER CLICK
	// 1. Set active filter.
	// 2. Hide all.
	// 3. Show only filtered.
	// 4. Refresh Masonry
	// =========================================================
	jQuery('.sp-navigation li a').click(function(e){
		var filter = jQuery(this).data('filter');

		jQuery('.sp-navigation li').each(function(){ jQuery(this).removeClass('active'); });
		if(!jQuery(this).parent().hasClass('active')) jQuery(this).parent().addClass('active');

		if(filter != 'all')
		{
			jQuery('.social-post').each(function(){ jQuery(this).hide(); });
			jQuery(filter).each(function(){ jQuery(this).show(); });	
		}
		else
		{
			jQuery('.social-post').each(function(){ jQuery(this).show(); });
		}
		
		jQuery(social_hub.container).masonry('layout');

		e.preventDefault();
	});

	// =========================================================
	// MORE SOCIAL HUB ITEMS
	// =========================================================
	jQuery('.more-social-posts').click(function(e){
		jQuery.ajax({
			type: "POST",
			url: social_hub.ajax_url + '?action=more',
			dataType: 'json',
			data: { 
				count: social_hub.count,
				more_count: social_hub.more_count
			},    			
			success: function(data){   
				if(data.result)
				{
					var append_html = jQuery(data.html);
					social_hub.more_count++;   

					jQuery(social_hub.container).append(append_html);
					jQuery(social_hub.container).masonry('appended', append_html, true); 
					setTimeout(function() { jQuery(social_hub.container).masonry('layout'); }, 1000);
					
					if(data.count < social_hub.count) jQuery('.more-social-posts').remove(); // END --- remove Load More button
				} 				    				
			}
		});
		e.preventDefault();
	});
});
