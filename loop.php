<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>

<?php if ( have_posts() ) : ?>

<div class="posts-holder">
<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<header>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
		</header>
		<?php endif; ?>
		<div class="entry-main">
			<div class="date-cell cell">
				<strong class="date"><?php the_time('d'); ?> <span class="month"><?php the_time('F'); ?></span></strong>
			</div>
			<div class="cell">
				<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	
				<?php// theme_entry_meta(); ?>
				<div class="entry-tags"><?php the_tags(false, false, false); ?></div>
				<div class="entry-content">
				<?php
					if(strpos($post->post_content, '<!--more-->'))
						the_content( " " );
					else {
						the_excerpt();
					}
				?>
				</div>
				<footer>
					<?php if ( comments_open() && ! is_single() ) : ?>
						<a href="<?php the_permalink(); ?>" class="more-link">More</a>
						<div class="comments-info">
							Comments: <?php comments_popup_link( '0', '1', '%' ); ?>
						</div>
					<?php endif; ?>
				</footer>
			</div>
		</div>
	</article><!-- #post -->

<?php endwhile; ?>
</div> <!-- .posts-holder -->

<?php theme_paging_nav(); ?>

<?php else: ?>
	
	<h1 class="page-title"><?php _e( 'Nothing Found', 'theme' ); ?></h1>
	
	<div class="page-content">

		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'theme' ); ?></p>
		<?php get_search_form(); ?>

	</div><!-- .page-content -->
	
<?php endif; ?>