<?php

/*

 * @package WordPress

 * Template Name: Floor Plans Page

*/

?>

<?php get_header(); ?>

<div class="heading">

	<ul class="breadcrumbs">

		<li><a href="#">Home</a></li>

		<li>Floor Plans</li>

	</ul>

	<h1 class="text-floor-plans">Floor plans</h1>

</div>

<div id="main">
	<div class="floor-plans">
<!--
		<div class="title-block">

			<h2>Floor Plans</h2>


		</div>
		<div class="clearfix">
			<ul class="scroll-nav">
	
				<li><a class="prev" onclick="jQuery('.slides').jcarousel('prev');">prev</a></li>
	
				<li>scroll</li>
	
				<li><a class="next" onclick="jQuery('.slides').jcarousel('next');">next</a></li>
	
			</ul>
		</div>
-->
		<div class="floor-plans-slider">

			<ul class="slides">

				<!-- <li><a href="#"><img src="<?php echo TDU; ?>/images/img-b1.png" alt=""><span>b1</span></a></li>

				<li><a href="#"><img src="<?php echo TDU; ?>/images/img-c0.png" alt=""><span>c0</span></a></li>

				<li><a href="#"><img src="<?php echo TDU; ?>/images/img-c1.png" alt=""><span>c1</span></a></li>

				<li><a href="#"><img src="<?php echo TDU; ?>/images/img-c2.png" alt=""><span>c2</span></a></li>

				<li><a href="#"><img src="<?php echo TDU; ?>/images/img-d1.png" alt=""><span>d1</span></a></li>

				<li><a href="#"><img src="<?php echo TDU; ?>/images/img-d2.png" alt=""><span>d2</span></a></li>
 -->
				
				<?php echo get_all_floor_plans(); ?>

			</ul>

		</div>

	</div>
	<div class="main-floor-plans">

		<?php if(have_posts()): the_post(); ?>

		<article class="content-block left">

			<h1 class="page-title"><?php the_title(); ?></h1>

			<?php the_content(); ?>

			<?php echo add_socials_to_content(); ?>

		</article>

		<aside class="content-right">

			<ul class="navigation">

				<li><a href="<?PHP echo get_permalink(get_next_floor_plan_url());?>">prev</a></li>				
				<li><a href="<?PHP echo get_permalink(get_prev_floor_plan_url());?>" class="next">next</a></li>

			</ul>

			<div class="featured-image">

				<?php the_post_thumbnail('full'); ?>

			</div>

		</aside>

	</div>

	<?php endif; ?>


	<!--<script>

		jQuery(function(){

			jQuery('.floor-plans-slider').flexslider({

				animation: "slide",

				animationSpeed: 600,

				slideshow: false,

				smoothHeight: false,

				controlNav: false,

				itemWidth: 160

			});

			$('.scroll-nav .prev').click(function() {

				$( ".floor-plans-slider .flex-prev" ).trigger( "click" );

				return false;

			});

			$('.scroll-nav .next').click(function() {

				$( ".floor-plans-slider .flex-next" ).trigger( "click" );

				return false;

			});

		});

	</script>-->

</div>



<?php get_footer(); ?>