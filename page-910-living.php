<?php
/*
 * @package WordPress
 * Template Name: 910 living Page
*/
?>
<?php get_header(); ?>
<div class="heading">
	<ul class="breadcrumbs">
		<li><a href="#">Home</a></li>
		<li>910 living</li>
	</ul>
	<h1 class="text-910-living">910 living</h1>
</div>
<div id="main">
	<div id="content" class="left">
		<?php if(have_posts()): the_post(); ?>
			<?php the_content(); ?>
		<?php endif; ?>
		<div class="data-block">
			<h2>calendar event list</h2>
			<div class="event-list">
				<?php
				$latest_events = get_latest_events(5);
				foreach ($latest_events as $key => $value) 
				{
					$ID          = $value['ID'];			
					$day         = date("jS", strtotime($value["datetime_start"]));
					$month       = date("M", strtotime($value["datetime_start"]));
					$month_full  = date("F", strtotime($value["datetime_start"]));
					$year		 = date("Y", strtotime($value["datetime_start"]));
					$time_start  = date("H:i a", strtotime($value["datetime_start"]));
					$time_end    = date("H:i a", strtotime($value["datetime_end"]));
					$title       = $value['title'];
					$content     = $value['content'];
					$venue_title = $value['venue'];
					$venue_link  = $value['venue_link'];
					$thumb_id    = get_post_thumbnail_id($ID);
					$thumb_url   = wp_get_attachment_image_src($thumb_id,'full', true);
				?>					
					<article>
						<header>
							<div class="holder">
								<div class="row">
									<h2 class="date"><?php echo $month_full." ".$day." ".$year; ?></h2> <h2><?php echo $time_start." - ".$time_end; ?></h2> <h2>@<?php echo $venue_title; ?></h2>
								</div>
								<h3><?php echo $title; ?></h3>
							</div>
							<div class="more-info">
								<h2>MORE INFO</h2>
							</div>
						</header>
						<div class="content">
							<?php 
							if(has_post_thumbnail($ID))
							{
							?>
							<a href="<?php echo $thumb_url[0]; ?>" class="image">
								<?php echo get_the_post_thumbnail($ID, 'thumbnail'); ?>																
								<span class="zoom"></span>
							</a>
							<?php
							}
							?>
							<div class="text">
								<p><?php echo $content; ?></p>
							</div>
						</div>
					</article>
				<?php
				}
				?>				
			</div>
		</div>
	</div>
	<script type="text/javascript">
		/* ----------------------------------------------------------- */
		/*  6. Accordion (Toggle)
		/* ----------------------------------------------------------- */
		(function($){
			$(function(){
				$(".event-list").each(function(){
					$(this).find('.content').hide();
					$(this).find('header').first().addClass('active').next().show();
					$(this).find('header').last().addClass('last');
				});
				
				$(".event-list").each(function(){
					$(this).find("header").click(function() {
						if($(this).next().is(':hidden')) {
							$(this).parent().parent().find("header").removeClass('active').next().slideUp(300);
							$(this).toggleClass('active').next().slideDown(300);
						} else {
							$(this).parent().find("header").removeClass('active').next().slideUp(300);
						}
						return false;
					});
				});
				
			});
		})(jQuery);
	</script>
	<!-- start living sidebar -->
	<?php get_sidebar('living'); ?>
	<!-- end living sidebar -->

</div>
<section class="social-posts-content">
	<div class="clearfix">
		<h1 class="text-social-hub">Social Hub</h1>
		<div class="content right">
			<p>Want to keep up with the Progress910 community and explore our social networks? Catch the latest tweets, photos, videos, and news  on all things 910 Living as well as engage and get involved via the many platforms available to you.</p>
			<p>Join the conversation by using <span class="green-text">#Progress910</span> to get your social media posts in the mix below.</p>
		</div>
	</div>
	<ul class="sp-navigation">
		<li class="active"><a href="#" class="home" data-filter="all"></a></li>
		
		<li><a href="#" class="twitter" data-filter=".filter-twitter"></a></li>
		<li><a href="#" class="instagram" data-filter=".filer-instagram"></a></li>
		<!-- <li><a href="#" class="facebook"></a></li> -->
		<!-- <li><a href="#" class="youtube"></a></li> -->
	</ul>
	<?php	
	$items = $GLOBALS['social_hub']->getItems();
	$items = array_slice($items, 0, $GLOBALS['social_hub']->options['count']);
	?>
	<div class="social-posts">
		<?php echo $GLOBALS['social_hub']->wrapItems($items); ?>
		<!-- <div class="social-post">
			<span class="post-type-ico"></span>
			<div class="image">
				<img src="<?php echo TDU; ?>/images/img-16.jpg" alt="">
			</div>
			<div class="text">
				<p><a href="#">So Happy to be back at what Feels Like My Actual Home #progress910</a></p>
				<div class="sub-row">
					3 minutes ago
					<div class="tweet-control">
						<a href="#" class="reply">reply</a>
						<a href="#" class="retweet">retweet</a>
						<a href="#" class="favorite">favorite</a>
					</div>
				</div>
			</div>
			<div class="footer">
				<a href="#" class="user">
					<img src="<?php echo TDU; ?>/images/img-17.jpg" alt="">
					<span><b>Amy Romanello</b> <br>@aron2013</span>
				</a>
				<a href="#" class="share">share</a>
			</div>
		</div>
		<div class="social-post">
			<span class="post-type-ico twitter"></span>
			<div class="image">
				<img src="<?php echo TDU; ?>/images/img-16.jpg" alt="">
			</div>
			<div class="text">
				<p><a href="#">So Happy to be back at what Feels Like My Actual Home #progress910</a></p>
				<div class="sub-row">
					3 minutes ago
					<div class="tweet-control">
						<a href="#" class="reply">reply</a>
						<a href="#" class="retweet">retweet</a>
						<a href="#" class="favorite">favorite</a>
					</div>
				</div>
			</div>
			<div class="footer">
				<a href="#" class="share">share</a>
				<a href="#" class="user">
					<img src="<?php echo TDU; ?>/images/img-17.jpg" alt="">
					<span><b>Amy Romanello</b> <br>@aron2013</span>
				</a>
			</div>
		</div>
		<div class="social-post">
			<span class="post-type-ico instagram"></span>
			<div class="image">
				<img src="<?php echo TDU; ?>/images/img-16.jpg" alt="">
			</div>
			<div class="text">
				<p><a href="#">So Happy to be back at what Feels Like My Actual Home #progress910</a></p>
				<div class="sub-row">
					3 minutes ago
					<div class="tweet-control">
						<a href="#" class="reply">reply</a>
						<a href="#" class="retweet">retweet</a>
						<a href="#" class="favorite">favorite</a>
					</div>
				</div>
			</div>
			<div class="footer">
				<a href="#" class="share">share</a>
				<a href="#" class="user">
					<img src="<?php echo TDU; ?>/images/img-17.jpg" alt="">
					<span><b>Amy Romanello</b> <br>@aron2013</span>
				</a>
			</div>
		</div>
		<div class="social-post">
			<span class="post-type-ico youtube"></span>
			<div class="image">
				<img src="<?php echo TDU; ?>/images/img-16.jpg" alt="">
				<div class="ico-play"></div>
			</div>
			<div class="text">
				<p><a href="#">So Happy to be back at what Feels Like My Actual Home #progress910</a></p>
				<div class="sub-row">
					3 minutes ago
					<div class="tweet-control">
						<a href="#" class="reply">reply</a>
						<a href="#" class="retweet">retweet</a>
						<a href="#" class="favorite">favorite</a>
					</div>
				</div>
			</div>
			<div class="footer">
				<a href="#" class="share">share</a>
				<a href="#" class="user">
					<img src="<?php echo TDU; ?>/images/img-17.jpg" alt="">
					<span><b>Amy Romanello</b> <br>@aron2013</span>
				</a>
			</div>
		</div> -->
	</div>
	<div class="more-posts-holder">
		<a href="#" class="more-social-posts">LOAD MORE</a>
	</div>
	<a id="to_top" class="btn-top" href="#">BACK TO TOP</a>
	<!-- <div class="no-social-posts">
		<h2 class="text-coming-soon">Coming Soon</h2>
		<div class="center">
			<div class="text">
				<h4>Want an invite?</h4>
				<p>We are currently developing this area of our website, please register to receive notice of our launch and other great stuff that happens here. *We respect your privacy.</p>
			</div>
			<form action="#" class="notify-form" onsubmit="send_invite(); return false;">
				<div class="row">
					<label>Enter your email</label>
					<input type="email" value="" name="email_invite" id="email_invite" required>
				</div>
				<input type="submit" value="Notify Me">
			</form>
		</div>
	</div> -->
</section>
<script type="text/javascript">
	jQuery(function(){
		jQuery('#to_top').click(function(e) {
			jQuery('body,html').animate({scrollTop:0}, 800);
			e.preventDefault();
		});
	});
</script>
<?php get_footer(); ?>