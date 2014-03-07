<?php
/**
 * @package WordPress
 * @subpackage Base_theme
 */
?>
<?php if ( is_active_sidebar('Right Sidebar') ) : ?>
<div id="sidebar" class="right">
	<?php dynamic_sidebar( 'Blog Sidebar' ); ?>
	
	<!-- <div class="widget widget-event-calendar">
		<h3>Event Calendar</h3>
		<img src="<?php echo TDU; ?>/images/calendar.png" alt="">
	</div> -->
	<!-- <div class="widget widget-testimonials">
		<h3>Testimonials</h3>
		<div class="testimonial">
			<blockquote>
				<q>“As a mother, safety is most important to me. The added security at Progress made my decision very easy.”</q>
			</blockquote>
			<cite>PAT EISENMANN</cite>
		</div>
	</div>
	<div class="widget widget-latest-news">
		<h3>Latest Parent News</h3>
		<article>
			<header>
				<strong class="date">
					24
					<span class="month">OCT</span>
				</strong>
				<h1>How Progress 910 will receive mail and packages</h1>
			</header>
			<div class="content">
				<p>
					Residents received USPS delivery to their designated mailboxes. Should you receive an oversized package or a UPS or Fedex delivery those services will deliver to your door. We suggest that you advise all delivery.... <a href="#" class="more-link">Read more</a>
				</p>
			</div>
		</article>
	</div>
	<div class="widget widget-flickr">
		<h3>Construction Progress</h3>
		<ul class="social-gallery">
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-100.jpg" alt=""><i></i></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-100.jpg" alt=""><i></i></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-100.jpg" alt=""><i></i></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-100.jpg" alt=""><i></i></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-100.jpg" alt=""><i></i></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-100.jpg" alt=""><i></i></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-100.jpg" alt=""><i></i></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-100.jpg" alt=""><i></i></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-100.jpg" alt=""><i></i></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-100.jpg" alt=""><i></i></a></li>
		</ul>
		<a href="#" class="social-link">view our flickr <br>Photostream</a>
	</div> -->
	
</div>
<script type="text/javascript">
	jQuery(function(){
		jQuery('.widget-posts-feed .buttons').each(function(){
			var _list = jQuery(this);
			var _links = _list.find('a');
			var li = _list.find('li');
		
			_links.each(function() {
				var _link = jQuery(this);
				var _href = _link.attr('href');
				var _tab = jQuery(_href);
		
				if(_link.hasClass('active')) _tab.show();
				else _tab.hide();
		
				_link.click(function(){
					_links.filter('.active').each(function(){
						jQuery(jQuery(this).removeClass('active').attr('href')).hide();
					});
					_link.addClass('active');
					_tab.show();
					return false;
				});
			});
		});
	});
</script>
<?php endif; ?>

