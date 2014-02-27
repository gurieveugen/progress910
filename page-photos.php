<?php
/*
 * @package WordPress
 * Template Name: Photos Page
*/
?>
<?php 

$_SESSION["gallery_items"] = 15;
$_SESSION["gallery_class"] = "photos";
get_header(); 
?>

<div class="heading">
	<ul class="breadcrumbs">
		<li><a href="/">Home</a></li>
		<li>Photos</li>
	</ul>
	<h1 class="text-photos">Photos</h1>
</div>
<div class="main-photos">
	<?php if(have_posts()): the_post(); ?>
	<?php the_content(); ?>
	<?php endif; ?>
	<a href="#" id="to_top" class="btn-top">BACK TO TOP</a>
</div>
<script type="text/javascript">
	jQuery(function(){
		jQuery('#to_top').click(function(e) {
			jQuery('body,html').animate({scrollTop:0}, 800);
			e.preventDefault();
		});
	});
</script>
<?php get_footer(); ?>