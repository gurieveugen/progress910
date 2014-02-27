<?php
/*
 * @package WordPress
 * Template Name: Coming Soon Page
*/
?>
<?php get_header('coming-soon'); ?>
<div class="media-area">
	<div class="center-wrap">
		<h2>new luxury apartments available for fall 2014 move-in</h2>
		<div class="video-box" id="video-box">
			<div class="heading"></div>
			<img src="<?php echo TDU; ?>/images/img-13.jpg" alt="">
			<a href="#" class="play" onclick="msg_box_open('msg-box-coming-soon')">play</a>
			<div class="message" id="msg-box-coming-soon">Video is coming soon - stay tuned! <a href="#" class="close" onclick="msg_box_close('msg-box-coming-soon')">close</a></div>
			<div class="info" id="info-box">Video Coming Soon</div>
			<!--<iframe src="//player.vimeo.com/video/68866163" width="700" height="328" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>-->
		</div>
	</div>
</div>
<section class="soon-section">
	<div class="center-wrap" style="width: 950px">
		<h3>Full Website Launching Soon ~ Stay Tuned!</h3>
			<div class="r-time">
			<!-- Countdown -->
							<div id="count" class="time clearfix"></div>
							<!-- Countdown / End -->
			
			<!--
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
			-->
		</div>
		<form action="<?php bloginfo('template_url') ?>/sendmail.php" class="subscribe-form" method="post">
			<h4>Please subscribe to our mailing list to be notified once we launch:</h4>
			<div class="holder">
				<input type="hidden" name="secure_id" value="<?php echo $_SERVER['REQUEST_TIME']; ?>" />
				<input type="hidden" name="secure_hash" value="<?php echo md5( 'Secure_id' . $_SERVER['REQUEST_TIME'] ); ?>" />
				<input type="text" name="user_name" placeholder="Your name">
				<input type="text" name="user_email" placeholder="Your email *"  required>
				<input type="submit" value="send">
			</div>
		</form>
	</div>
</section>
<?php get_footer('coming-soon'); ?>