var DEFAULT_ISOTOPE_FILTER    = ".isotopeItem";
var DEFAULT_PAGINATION_ITEM   = ".pagination li";
var DEFAULT_ISOTOPE_CONTAINER = ".isotopeContainer";                                                              
jQuery(function() {
	// ========================================================
	// Add class sizer for gallery
	// ========================================================
	if(typeof(gallery_class) !== 'undefined')
	{
		jQuery(DEFAULT_ISOTOPE_CONTAINER).addClass(gallery_class);
	}	
	
	jQuery('.slider-events .slider-holder').flexslider({
		animation : "slide",
		animationLoop : false,
		itemWidth : 278,
		itemMargin : 2,
		minItems : 3,
		maxItems : 3,
		controlNav: false
	});
	jQuery('.t-flexslider').flexslider({
		animation: "slide",
		directionNav: false,
		selector: ".t-slider > div",
		slideshow: false
	});

	if(jQuery("#mycarousel").length)
	{
	    jQuery('#mycarousel').jcarousel(
		{
			scroll: 1,
			buttonNextHTML: '<a class="btn-next">Next</a>',
	    	buttonPrevHTML: '<a class="btn-prev">Prev</a>',
	    	wrap: 'circular'
		});
	}

	jQuery('#video-box').mouseenter(function(event){		
		jQuery('#info-box').stop();
		jQuery('#info-box').animate({opacity: 1}, 500);
	});

	jQuery('#video-box').mousemove(function(event){
		var left = event.pageX - jQuery(this).offset().left-109;
		var top = event.pageY - jQuery(this).offset().top-60;
		jQuery('#info-box').css({top: top, left: left});
	});

	jQuery('#video-box').mouseleave(function(){
		jQuery('#info-box').stop();
		jQuery('#info-box').animate({opacity: 0}, 500);
	});	

	// ========================================================
	// add Gallery items
	// ========================================================			
	if(typeof(gallery_items) !== 'undefined')
	{
		jQuery('.rx_isotope_ui').append(get_pagination(".*", gallery_items));


		show_isotope_items(gallery_items, 1, '.pagination li:first', '.*');

		jQuery('.isotopeMenu li a').click(function(e){			
			filter = "." + jQuery(this).attr('href');				
			jQuery('.pagination-holder').remove();
			jQuery('.rx_isotope_ui').append(get_pagination(filter, gallery_items));
			show_isotope_items(gallery_items, 1, '.pagination li:first', filter);
			e.preventDefault();
		});
		jQuery('.isotopeMenu li:first').find('a').click();
	}

	jQuery(".fancybox-thumb").fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'inside'
			}
		}
	});

	jQuery(".various").fancybox({       
        fitToView: false,
        autoSize: true,
        closeClick: false,
        scrolling: 'no',
        openEffect: 'none',
        closeEffect: 'none',
        tpl: {
        	wrap     : '<div class="fancybox-wrap popup-s" tabIndex="-1"><div class="fancybox-skin CHANGETHIS"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
			closeBtn : '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;">Close</a>'
		}
    });

});

(function(jQuery) {
			jQuery(function() {
				if(jQuery("#count").length>0)
				{
					jQuery("#count").countdown({
						//to change lunch date just replace the current date with yours.
						date: "november 9, 2013",
						htmlTemplate: "<div id='days' class='holder'><div class='days-count number'>%d</div><div class='days-label desc'>Days</div></div><div id='hours' class='holder'><div class='hours-count number'>%h</div><div class='hours-label desc'>Hours</div></div><div id='mins' class='holder'><div class='mins-count number'>%i</div><div class='mins-label desc'>Minutes</div></div><div id='secs' class='holder'><div class='secs-count number'>%s</div><div class='secs-label desc'>Seconds</div></div>",
						yearsAndMonths: false,
						hoursOnly: false,
						leadingZero: true
					});
				}
			});
			
		})(jQuery); 

function msg_box_close(id)
{
	jQuery('#'+id).hide();	
}

function msg_box_open(id)
{
	jQuery('#'+id).show();	
}

/**
 * Get pagination HTML
 * @return html code
 */
function get_pagination(filter, limit_items)
{
	var count_items    = 0;
	var items_per_page = limit_items;
	var pages          = 0;
	var pages_int      = 0;
	var str            = "";

	if(filter == ".*") filter = DEFAULT_ISOTOPE_FILTER;
	count_items = get_count_items(filter);

	pages     = count_items/items_per_page;
	pages_int = parseInt(count_items/items_per_page);

	if(pages > pages_int) pages_int++;

	str = '<div class="pagination-holder"><button class="prev" onclick="prev_pagination()">Prev</button><ul class="pagination">';
	for (var i = 1; i <= pages_int; i++) 
	{
		str+= '<li data-index="'+i+'" onclick="show_isotope_items(' + items_per_page + ', '+i+', this, \'' + filter + '\')">' + i + '</li>';
	};
	str+= '</ul><button class="next flex-next"  onclick="next_pagination()">Next</button></div>';

	return str;
}

function next_pagination()
{
	var active = parseInt(jQuery('.pagination li.active').attr('data-index'));
	var next   = active + 1;
	
	if(jQuery('[data-index=' + next + ']').length > 0)
	{
		jQuery('[data-index=' + next + ']').click();
	}
	else
	{
		jQuery('[data-index=1]').click();
	}
}

function prev_pagination()
{
	var active = parseInt(jQuery('.pagination li.active').attr('data-index'));
	var prev   = active - 1;
	
	if(jQuery('[data-index=' + prev + ']').length > 0)
	{
		jQuery('[data-index=' + prev + ']').click();
	}
	else
	{
		jQuery('[data-index=' + jQuery('.pagination li').length + ']').click();
	}
}

/**
 * Count isotope items
 * @return {integer} count
 */
function get_count_items(obj)
{
	var count_items    = 0;
	jQuery(obj).each(function(){ count_items++;	});
	return count_items;
}

/**
 * Set active pagination
 * @param {class selector} obj
 */
function set_active_pagination(obj)
{
	// ========================================================
	// Remove active class
	// ========================================================
	jQuery(DEFAULT_PAGINATION_ITEM).each(function(){ jQuery(this).removeClass('active'); });
	// ========================================================
	// Remove active class
	// ========================================================
	jQuery(obj).addClass('active');
}

/**
 * Show/Hide isotope items ( filtering )
 * @param  {integer} items_per_page
 * @param  {integer} count          
 * @param  {integer} offset         
 */
function show_isotope_items(items_per_page, count, obj, filter)
{
	
	var last_count = count;
	var offset     = (count-1)*items_per_page;	
	count_items    = 1;
	count          = count*items_per_page;

	set_active_pagination(obj);
	if(filter == '.*') filter = DEFAULT_ISOTOPE_FILTER;
	
	if(clear_items(items_per_page))
	{
		jQuery(filter).each(function()
		{	
			if(count_items >= count+1 || count_items <= offset)
			{
				//jQuery(this).removeClass('show-items');			
			}	
			else
			{
				jQuery(this).addClass('show-items');					
				jQuery(this).addClass('item' + (count_items-offset));
			}		
			count_items++;
		});	
		jQuery(DEFAULT_ISOTOPE_CONTAINER).isotope({ 
			masonry: { columnWidth: 1 },
			filter: ".show-items", 
			layoutMode: 'masonry'
			
		});
		
	}
}

function clear_items(items_per_page)
{
	jQuery(DEFAULT_ISOTOPE_FILTER).each(function()
	{
		jQuery(this).removeClass('show-items');	
		for (var i = items_per_page; i >= 1; i--) 
		{
			jQuery(this).removeClass('item' + i);
		}	
	});	
	return true;
}

function send_invite()
{
	jQuery.post('/wp-admin/admin-ajax.php', 
    {
		action: 'send_invite',
		email: jQuery('#email_invite').val()
    }, 
    function(data) 
    {
    	if(data == "OK")
    	{
    		alert("Congratulations! The invitation will be sent to you as soon as we launch page.");

    	}
    	else
    	{
    		alert("Sorry! At the moment, your letter could not be sent! Try to contact us at info@progress910.com.");
    	}
    	jQuery('#email_invite').val("");    	
    });
    return false;
}