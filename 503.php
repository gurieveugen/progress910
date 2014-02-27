<?php
/*
 * @package WordPress
 * Template Name: Coming Soon Page
*/

ini_set("display_errors", "1"); 
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
?>
<?php get_header('coming-soon'); ?>
<div class="media-area">
	<div class="center-wrap">
		<h2>new luxury apartments available for fall 2014 move-in</h2>
		<div class="video-box">
			<div class="heading">Web Screen Presentation</div>
			<!--<img src="<?php echo TDU; ?>/images/img-13.jpg" alt="">
			<a href="#" class="play">play</a>-->
			<iframe src="//player.vimeo.com/video/68866163" width="700" height="328" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		</div>
	</div>
</div>
<section class="soon-section">
	<div class="center-wrap">
		<h3>Full Website Launching Soon ~ Stay Tuned!</h3>
		<div class="r-time">
			<div class="block">
				<strong>20</strong>
				<span>days</span>
			</div>
			<div class="block">
				<i></i>
			</div>
			<div class="block">
				<strong>12</strong>
				<span>hours</span>
			</div>
			<div class="block">
				<i></i>
			</div>
			<div class="block">
				<strong>48</strong>
				<span>minutes</span>
			</div>
			<div class="block">
				<i></i>
			</div>
			<div class="block">
				<strong>26</strong>
				<span>seconds</span>
			</div>
		</div>
		<form action="#" class="subscribe-form">
			<h4>Please subscribe to our mailing list to be notified once we launch:</h4>
			<input type="text" placeholder="Your name">
			<input type="text" placeholder="Your email *">
			<input type="submit" value="send">
		</form>
	</div>
</section>
<?php get_footer('coming-soon'); ?>