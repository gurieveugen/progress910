<?php
// ========================================================
// Hooks
// ========================================================
		
add_action( 'init', 'create_parents_faq_post_type' );

// ========================================================
// Methods
// ========================================================
/**
 * Create new post type
 */
function create_parents_faq_post_type() 
{
	register_post_type('parents_faq', array(
		'labels' => array(
			'name'          => __( 'Parents FAQ' ),
			'singular_name' => __( 'parents_faq' )
			),
		'public'      => true,
		'has_archive' => true,
		'supports'    => array( 'title', 'thumbnail', 'editor', 'author', 'custom-fields'),
		'rewrite'     => array( 'slug' => 'parents_faq' )
		)
	);
}

/**
 * Get All parents
 */
function get_all_parents()
{
	$args    = array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'post_type'        => 'parents_faq',
		'post_status'      => 'publish',
		'suppress_filters' => true );
	$parents = get_posts($args);

	return $parents;
}