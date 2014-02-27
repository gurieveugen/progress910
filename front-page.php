<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */

?>
<?php get_header(); ?>

<?php
	$args    = array(
		'posts_per_page'   => 1,
		'offset'           => 0,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'suppress_filters' => true );
	$recent_posts = get_posts($args);
	$recent_post  = null;
	$rp_out       = array();

	foreach ($recent_posts as $key => $value) 
	{
		$recent_post = $value;
	}
	if($recent_post)
	{
		$rp_out['month']     = date('F', strtotime($recent_post->post_date));
		$rp_out['day']       = date('d', strtotime($recent_post->post_date)); 
		$rp_out['title']     = $recent_post->post_title;
		$rp_out['content']   = get_anons($recent_post->ID);
		$rp_out['permalink'] = get_permalink($recent_post->ID);
	}
?>

<!--<div class="visual">
	<img src="<?php echo TDU; ?>/images/video.jpg" alt="">
</div>-->
<?php //echo do_shortcode('[rev_slider home-slider]'); ?>
<?php
if($_COOKIE['front_page_video'] == 'hide')
{
	$autoplay = 'autoplay=0';
}
else
{
	$autoplay = 'autoplay=1';
	echo '	<script type="text/javascript">
				jQuery(function(){
					jQuery.cookie("front_page_video", "hide");
				});
		  	</script>';

}
?>
<figure class="top-img-page border-top"><iframe src="//player.vimeo.com/video/84918961?byline=0&amp;portrait=0&amp;color=ffffff&amp;<?php echo $autoplay; ?>" width="100%" height="595" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></figure>

<!-- <iframe src="//player.vimeo.com/video/84918961" width="100%" height="481" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> -->
<section class="widgets-section">
	<article class="widget">
		<header>
			<img src="<?php echo TDU; ?>/images/ico-student.png" alt="">
			<h1>Student experience</h1>
		</header>
		<p>With academics, convenience, and comfort as our first priority, we have everything you need to experience the UNCW student life to the fullest!</p>
		<footer>
			<a href="/910-living/" class="btn-more">LEARN MORE</a>
		</footer>
	</article>
	<article class="widget widget-2">
		<header>
			<img src="<?php echo TDU; ?>/images/ico-search.png" alt="">
			<h1>view our plans & options</h1>
		</header>
		<p>To accommodate our residents, we've created individualized floor plans and interiors that are fully-furnished and designed specifically for the student lifestyle.</p>
		<footer>
			<a href="/floor-plans/" class="btn-more">LEARN MORE</a>
		</footer>
	</article>
	<article class="widget widget-3">
		<header>
			<img src="<?php echo TDU; ?>/images/ico-parents.png" alt="">
			<h1>PARENTS’ PEACE OF MIND</h1>
		</header>
		<p>Just like you, we have our students’ best interests in mind. We’ve created the ideal environment for, comfortable living and an emphasis on success.</p>
		<footer>
			<a href="/910-living/parents/" class="btn-more">LEARN MORE</a>
		</footer>
	</article>
</section>
<script type="text/javascript">
	jQuery(function(){
		jQuery.fn.equalHeightColumns = function() {
			var tallest = 0;
			
			jQuery(this).each(function() {
				if (jQuery(this).outerHeight(true) > tallest) {
					tallest = jQuery(this).outerHeight(true);
				}
			});
			
			jQuery(this).each(function() {
				var diff = 0;
				diff = tallest - jQuery(this).outerHeight(true);
				jQuery(this).height(jQuery(this).height() + diff);
			});
		};
		jQuery(".widgets-section .widget").equalHeightColumns();
	});
</script>
<section class="data-section">
	<aside class="instagram-section">
		<div class="header">
			<h2 class="instagram">instagram</h2>
			<a href="http://instagram.com/progress910">use #progress910 ~ join us</a>
		</div>
		<?php
		if (is_active_sidebar('facebook_photos_sidebar'))
		{
			dynamic_sidebar('facebook_photos_sidebar');
		}  
		?>
		<!-- <ul class="photo-list">
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-1.jpg" alt=""></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-2.jpg" alt=""></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-3.jpg" alt=""></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-4.jpg" alt=""></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-5.jpg" alt=""></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-6.jpg" alt=""></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-7.jpg" alt=""></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-8.jpg" alt=""></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-9.jpg" alt=""></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-10.jpg" alt=""></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-11.jpg" alt=""></a></li>
			<li><a href="#"><img src="<?php echo TDU; ?>/images/img-12.jpg" alt=""></a></li>
		</ul> -->
	</aside>
	<article class="recent-post">
		<h2>Recent Blog Post</h2>
		<header>		
			<a href="<?php echo $rp_out['permalink']; ?>" class="date">
				<?php echo $rp_out['day']; ?>
				<span class="month"><?php echo $rp_out['month']; ?></span>
			</a>
			<h1><a href="<?php echo $rp_out['permalink']; ?>"><?php echo $rp_out['title']; ?></a></h1>
		</header>
		<p><?php echo $rp_out['content']; ?>... <a href="<?php echo $rp_out['permalink']; ?>" class="more-link">Read more</a></p>
	</article>
</section>
<section class="events-section">
	<h2>upcoming events</h2>
	<!-- <div class="slider-events">
		<div class="slider-holder">
			<ul class="slides">
				<li>
					<span class="date">
						18
						<span class="month">sep</span>
					</span>
					<div class="holder">
						<h3><a href="#">Sunday Football</a></h3>
						<span class="time">1:00PM - 6:00PM</span>
						@The 901 Clubhouse
					</div>
					<a href="#" class="link">+</a>
				</li>
				<li>
					<span class="date">
						18
						<span class="month">sep</span>
					</span>
					<div class="holder">
						<h3><a href="#">Breakfast Bonanza</a></h3>
						<span class="time">9:00am - 10:00am</span>
						@lava bar
					</div>
					<a href="#" class="link">+</a>
				</li>
				<li>
					<span class="date">
						18
						<span class="month">sep</span>
					</span>
					<div class="holder">
						<h3><a href="#">Super market bingo</a></h3>
						<span class="time">c6:00pm - 7:00pm</span>
						@sports lounge
					</div>
					<a href="#" class="link">+</a>
				</li>
				<li>
					<span class="date">
						18
						<span class="month">sep</span>
					</span>
					<div class="holder">
						<h3><a href="#">Sunday Football</a></h3>
						<span class="time">1:00PM - 6:00PM</span>
						@The 901 Clubhouse
					</div>
					<a href="#" class="link">+</a>
				</li>
				<li>
					<span class="date">
						18
						<span class="month">sep</span>
					</span>
					<div class="holder">
						<h3><a href="#">Breakfast Bonanza</a></h3>
						<span class="time">9:00am - 10:00am</span>
						@lava bar
					</div>
					<a href="#" class="link">+</a>
				</li>
				<li>
					<span class="date">
						18
						<span class="month">sep</span>
					</span>
					<div class="holder">
						<h3><a href="#">Super market bingo</a></h3>
						<span class="time">c6:00pm - 7:00pm</span>
						@sports lounge
					</div>
					<a href="#" class="link">+</a>
				</li>
			</ul>
		</div>
	</div> -->	
	<ul id="mycarousel" class="jcarousel-skin-tango">	  
		<?php
		$latest_events = get_latest_events();
		foreach ($latest_events as $key => $value) 
		{
			$ID          = $value['ID'];			
			$day         = date("d", strtotime($value["datetime_start"]));
			$month       = date("M", strtotime($value["datetime_start"]));
			$time_start  = date("H:i a", strtotime($value["datetime_start"]));
			$time_end    = date("H:i a", strtotime($value["datetime_end"]));
			$title       = $value['title'];
			$venue_title = $value['venue'];
			$venue_link  = $value['venue_link'];
		?>
		   <li>
				<span class="date">
					<?php echo $day; ?>
					<span class="month"><?php echo $month; ?></span>
				</span>
				<div class="holder">
					<h3><a href="<?php echo get_permalink($ID); ?>"><?php echo $title; ?></a></h3>
					<span class="time"><?php echo $time_start; ?> - <?php echo $time_end; ?></span>
					@<?php echo $venue_title; ?>
				</div>
				<a href="<?php echo get_permalink($ID); ?>" class="link">+</a>
			</li>
		<?php
		}
		?>
	   <!-- <li>
			<span class="date">
				18
				<span class="month">sep</span>
			</span>
			<div class="holder">
				<h3><a href="#">Sunday Football</a></h3>
				<span class="time">1:00PM - 6:00PM</span>
				@The 901 Clubhouse
			</div>
			<a href="#" class="link">+</a>
		</li>
		<li>
			<span class="date">
				18
				<span class="month">sep</span>
			</span>
			<div class="holder">
				<h3><a href="#">Breakfast Bonanza</a></h3>
				<span class="time">9:00am - 10:00am</span>
				@lava bar
			</div>
			<a href="#" class="link">+</a>
		</li>
		<li>
			<span class="date">
				18
				<span class="month">sep</span>
			</span>
			<div class="holder">
				<h3><a href="#">Super market bingo</a></h3>
				<span class="time">c6:00pm - 7:00pm</span>
				@sports lounge
			</div>
			<a href="#" class="link">+</a>
		</li>
		<li>
			<span class="date">
				18
				<span class="month">sep</span>
			</span>
			<div class="holder">
				<h3><a href="#">Sunday Football</a></h3>
				<span class="time">1:00PM - 6:00PM</span>
				@The 901 Clubhouse
			</div>
			<a href="#" class="link">+</a>
		</li>
		<li>
			<span class="date">
				18
				<span class="month">sep</span>
			</span>
			<div class="holder">
				<h3><a href="#">Breakfast Bonanza</a></h3>
				<span class="time">9:00am - 10:00am</span>
				@lava bar
			</div>
			<a href="#" class="link">+</a>
		</li>
		<li>
			<span class="date">
				18
				<span class="month">sep</span>
			</span>
			<div class="holder">
				<h3><a href="#">Super market bingo</a></h3>
				<span class="time">c6:00pm - 7:00pm</span>
				@sports lounge
			</div>
			<a href="#" class="link">+</a>
		</li>	 -->	
	 </ul>
</section>
<?php get_footer(); ?>