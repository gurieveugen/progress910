<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>
<script>
show_uncw = false;
show_910 = false;
</script>
<div class="heading">
	<ul class="breadcrumbs">
		<li><a href="#">Home</a></li>
		<li>Blog</li>
	</ul>
	<h1 class="text-blog">Blog</h1>
</div>
<div id="main">
	<?php if ( have_posts() ) : the_post(); ?>
	<article id="content" class="left single-content">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header>
				<?php the_post_thumbnail(); ?>
				<div class="header">
					<div class="date-cell cell">
						<strong class="date"><?php the_time('d'); ?> <span class="month"><?php the_time('F'); ?></span></strong>
					</div>
					<div class="cell">
						<h1><?php the_title(); ?></h1>
							
						<?php// theme_entry_meta(); ?>
						<div class="entry-tags"><?php the_tags(false, false, false); ?></div>
						
						<?php if ( comments_open() ) : ?>
							<div class="comments-info">
								Comments: <?php comments_popup_link( '0', '1', '%' ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</header>	
			<div class="entry-content">
				<?php the_content(" "); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'theme' ) . '</span>', 'after' => '</div>' ) ); ?>
			</div>
		</div>
		<!--<div id="nav-below" class="navigation nav-single">
			<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous Entry: %title', 'theme' ) ); ?></span>
			<span class="nav-next"><?php next_post_link( '%link', __( 'Next Entry: %title <span class="meta-nav">&rarr;</span>', 'theme' ) ); ?></span>
		</div>-->
		
		<?php echo add_socials_to_content(); ?>
		
		<?php comments_template( '', true ); ?>
		<div class="map" style="display:block; width: 600px; height: 400px;">
			<div id="map-canvas"></div>
		</div>
	</article>

	<?php endif; ?>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>