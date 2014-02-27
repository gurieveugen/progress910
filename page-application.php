<?php
/*
 * @package WordPress
 * Template Name: Application Page
*/
?>
<?php get_header(); ?>
<div class="heading">

	<ul class="breadcrumbs">

		<li><a href="#">Home</a></li>

		<li>Application</li>

	</ul>

	<h1 class="text-application">Application</h1>

</div>
<div id="main">

	<?php if ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.formstyler.min.js" ></script>
			<script type="text/javascript">
				(function($) {
					$(function() {
						$('input[type="checkbox"], input[type="radio"], select').styler();
					})
				})(jQuery)
			</script>
			<div class="page-content application-form" id="application-form">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			</div><!-- .entry-content -->
	
		</article><!-- #post -->
	<?php endif; ?>

</div>
<?php get_footer(); ?>