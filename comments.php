<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				echo number_format_i18n( get_comments_number()) . __(' comments');
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 0,
					'callback' => 'themeComment'
				) );
			?>
		</ol><!-- .comment-list -->

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'theme' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'theme' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'theme' ) ); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'theme' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>
	
	<?php 
		$fields   =  array(
		'author' => '<div class="left"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="Name'. ($req ? '*' : '') .'" />',
		'email'  => '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="Email ' . ($req ? '*' : '') .'" /></div>'
		);
		$f_args = array(
			'fields' => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">Message*</textarea>',
			'title_reply'          => __( 'Leave a comment' ),
			'comment_notes_before' => '',
			'comment_notes_after' =>'<div class="clearfix"></div><p class="comment-info">* All fields are required</p>',
			'label_submit'         => __( 'Send Comment' )
		);
	?>
	
	<?php comment_form( $f_args ); ?>

</div><!-- #comments -->
<?php
function themeComment( $comment, $args, $depth ) {
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>
		
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
		
		<div class="comment-meta commentmetadata">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s' ), get_comment_date() ); ?>
				<?php edit_comment_link( __( '(Edit)' ), '&nbsp;&nbsp;', '' );
			?>
		</div>
		
		<div class="comment-author vcard">
			<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
		</div>
		
		<?php if ( '0' == $comment->comment_approved ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ) ?></em>
		<br />
		<?php endif; ?>


		<?php comment_text( get_comment_id(), array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
	}
?>