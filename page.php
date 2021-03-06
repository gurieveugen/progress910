<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>
<div id="main">
	<div id="content" class="page-content">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="page-header">
				<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
				<div class="page-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
				<?php endif; ?>
	
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->
	
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	
			<footer class="entry-meta">
				<?php edit_post_link( __( 'Edit', 'theme' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-meta -->
		</article><!-- #post -->
	<?php endwhile; ?>
	</div>
	<a href="#" id="to_top" class="btn-top">BACK TO TOP</a>
</div>
<?php get_footer(); ?>