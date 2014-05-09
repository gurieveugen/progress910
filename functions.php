<?php
/*
 * @package WordPress
 * @subpackage Base_Theme
 */

define('TDU', get_bloginfo('template_url'));

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
add_filter( 'use_default_gallery_style', '__return_false' );
add_editor_style( array( 'css/editor-style.css'));

register_sidebar(array(
	'id' => 'blog-sidebar',
	'name' => 'Blog Sidebar',
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));
register_sidebar(array(
	'id' => 'parents-sidebar',
	'name' => 'Parents Sidebar',
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));
register_sidebar(array(
	'id' => 'living-sidebar',
	'name' => '910 Living Sidebar',
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 604, 270, true );
add_image_size( 'single-post-thumbnail', 400, 9999, false );

register_nav_menus( array(
	'primary_nav' => __( 'Primary Navigation', 'theme' ),
	'top_nav' => __( 'Top Navigation', 'theme' )
) );

function change_menu_classes($css_classes){
	$css_classes = str_replace("current-menu-item", "current-menu-item active", $css_classes);
	$css_classes = str_replace("current-menu-parent", "current-menu-parent active", $css_classes);
	return $css_classes;
}
add_filter('nav_menu_css_class', 'change_menu_classes');

function filter_template_url($text) {
	return str_replace('[template-url]',get_bloginfo('template_url'), $text);
}
add_filter('the_content', 'filter_template_url');
add_filter('get_the_content', 'filter_template_url');
add_filter('widget_text', 'filter_template_url');

function theme_paging_nav() {
	global $wp_query;
	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<a href="<?php echo  get_pagenum_link(1); ?>" class="left">First</a>
		<a href="<?php echo  get_pagenum_link($wp_query->max_num_pages); ?>" class="right">Last</a>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'theme' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'theme' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
function theme_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'theme' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'theme' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
function theme_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'theme' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
function theme_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'theme' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		theme_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'theme' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'theme' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'theme' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
function scripts_method() {
	if(!is_page('coming-soon'))
	{
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', TDU.'/js/jquery-1.9.1.min.js');
		wp_enqueue_script( 'jquery' );
	}
}
add_action('wp_enqueue_scripts', 'scripts_method');

add_action('wp_ajax_send_invite', 'send_ivite_ajax');
add_action('wp_ajax_nopriv_send_invite', 'send_ivite_ajax');
add_action('wp_ajax_more', 'moreAJAX');
add_action('wp_ajax_nopriv_more', 'moreAJAX');

/**
 * Load the Short code, widget
 */
require(TEMPLATEPATH . '/functions/widget_short_code.php');
require(TEMPLATEPATH . '/functions/widget_testimonial.php');
require(TEMPLATEPATH . '/functions/widget_latest_news.php');
require(TEMPLATEPATH . '/functions/widget_flickr_photostream.php');
require(TEMPLATEPATH . '/functions/widget_facebook_photostream.php');
require(TEMPLATEPATH . '/functions/widget_prc.php');
require(TEMPLATEPATH . '/functions/widget_instagram_hashtag.php');
require(TEMPLATEPATH . '/functions/meta_box_is_floor_page.php');
require(TEMPLATEPATH . '/functions/page_theme_options.php');
require(TEMPLATEPATH . '/functions/post_type_parents_faq.php');
require(TEMPLATEPATH . '/functions/gallery_images_layout.php');
require(TEMPLATEPATH . '/functions/social_hub_options_page.php');
require(TEMPLATEPATH . '/functions/social_hub.php');

/**
 * Adding the ability to add widgets.
 */
if(function_exists('register_sidebar'))
{
	//=======================================================
	// TOP Sidebar
	//=======================================================
	register_sidebar(array(
		'id'            => 'facebook_photos_sidebar',
		'name'          => 'Facebook photos sidebar',
		'before_widget' => '',
		'after_widget'  => ''		
	));	
}

add_shortcode('page_socials','add_socials_to_content');
function add_socials_to_content()
{
	global $post;
	$lnk = get_bloginfo('url') . $_SERVER['REQUEST_URI'];
	$ref = urlencode($lnk);
	$html = '';
	$html .= '<div class="share-block"><strong class="title">Share:</strong>';

	$html .= '<ul class="buttons">
	 	<li class="facebook">'.HV_facebook_button($ref).'</li>
	 	<li>
	 	  <a target="_blank" href="http://twitter.com/share?url='.$ref.'" class="but-tweet"><img src="'.get_bloginfo('template_url').'/images/tweet.png" alt=" " /></a>
	 	  <div class="number-tweet">
	 		<div class="left-bg">
	 		  <div class="right-bg">'.get_tweet_count($ref).'</div>
	 		</div>
	 	  </div>
	 	</li>	
		<li><a href="mailto:?body=Reading '.esc_attr(get_the_title()).' at '.esc_attr($lnk).'"><img src="'.get_bloginfo('template_url').'/images/email.png" alt=" " /></a></li>
		</ul>';
	$html .= '</div>';
	return $html;
}
	
function get_tweet_count($url) 
{
	$count = 0;
	$data = wp_remote_get('ht'.'tp://urls.api.twitter.com/1/urls/count.json?url='.$url);
	if (!is_wp_error($data)) 
	{
		$resp = json_decode($data['body'],true);
		if ($resp['count']) $count = $resp['count'];
	}
	return $count;
}

function HV_facebook_button($ref) 
{
	return '<iframe src="http://www.facebook.com/plugins/like.php?href='.$ref.'&amp;layout=button_count&amp;show_faces=false&amp;width=115&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:115px; height:21px;" allowTransparency="true"></iframe>';
}

add_filter('body_class','browser_body_class');

function browser_body_class($classes = array()) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if(strpos($_SERVER['HTTP_USER_AGENT'], 'Win') !== false) $classes[] = 'win';
	elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Mac') !== false) $classes[] = 'mac';
	
	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif ($is_IE) {
		$classes[] = 'ie';
		$browser = get_browser(null, true);
		switch ($browser['version']) {
			case '10.0':
				$classes[] = 'ie10';
				break;
			case '9.0':
				$classes[] = 'ie9';
				break;
			case '8.0':
				$classes[] = 'ie8';
				break;
			case '7.0':
				$classes[] = 'ie7';
				break;	
			case '6.0':
				$classes[] = 'ie6';
				break;		
		}
		unset($browser);
	}	
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	
	return $classes;
}

add_filter('login_redirect', 'admin_default_page');
function admin_default_page() 
{
  return '/wp-admin/admin.php?page=cpm_projects';
}


/**
 * Get latest parent NEWS
 */
function get_latest_parent_news()
{
	$news    = NULL;
	$args    = array(
		'posts_per_page'   => 1,
		'offset'           => 0,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'suppress_filters' => true );
	$parents = get_posts($args);

	foreach ($parents as $key => $value) 
	{
		$news = $value;
	}
	return $news;
}

/**
 * Get the text page to the specific mark
 */
function get_anons($id, $mark = "<!--more-->")
{	
	$the_post = get_post($id, ARRAY_A);
	$anons = explode($mark, $the_post["post_content"]);
	$anons = $anons[0];

	return $anons;
}

/**
 * Get lastest events from "calendar events" plugin
 * @param  integer $count_events how mutch events we need to get
 * @return array
 */
function get_latest_events($count_events = 5)
{
	$upcoming = tribe_get_events( array('eventDisplay'=>'upcoming', 'posts_per_page'=>5) );	
	
	$res    = array();
	$i      = 0;

	foreach ($upcoming as $key => $value) 
	{
		$res[$i]['ID']			   = $value->ID;
		$res[$i]['title']          = $value->post_title;		
		$res[$i]['content']		   = $value->post_content;
		$res[$i]['venue']          = tribe_get_venue($value->ID);
		$res[$i]['venue_link']     = tribe_get_venue_link( $value->ID, false);
		$res[$i]['datetime_start'] = tribe_get_start_date( $value, false, "c" );
		$res[$i]['datetime_end']   = tribe_get_end_date( $value, false, "c" );	

		$i++;
	}	
	return $res;
}

/**
 * Send invite from "910 living" page
 * @return AJAX MESSAGE
 */
function send_ivite_ajax()
{
	if(isset($_POST['email']))
	{
		$message = "New invite from page( 910 living )\n";
		$message.= "email: ".$_POST['email'];
		if(mail('info@progress910.com', 'New invite', $message))
		{
			echo "OK";
		}
		else
		{
			echo "ERROR";
		}
	}
	die();
}

/**
 * Get more items to social hub
 */
function moreAJAX()
{
	$off            = intval($_POST['count']) * intval($_POST['more_count']);
	$items          = $GLOBALS['social_hub']->getItems();
	$items          = array_slice($items, $off, intval($_POST['count']));
	$json['count']  = count($items);
	$json['html']   = trim($GLOBALS['social_hub']->wrapItems($items));
	$json['result'] = true;
	
	echo json_encode($json);
	die();
}

