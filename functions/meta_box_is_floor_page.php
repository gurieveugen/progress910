<?php
/**
 * HOOKS
 */
add_action('do_meta_boxes', 'meta_boxes');
add_action('save_post', 'is_floor_page_update', 0);

/**
 * Add meta boxes
 */
function meta_boxes() {
	add_meta_box('is_floor_page', 'Is floor page', 'is_floor_page_box_func', 'page', 'side', 'high');
}

/**
 * Show URL meta Box
 */
function is_floor_page_box_func( $post )
{
	$is_floor_page = get_post_meta($post->ID, 'is_floor_page', 1);
	if($is_floor_page == "on")
	{
		$checked = "checked";
	}
	else
	{
		$checked = "";
	}	
?>
	<p>
		<label for="title">Title:</label>
		<input type="text" name="title" value="<?php echo get_post_meta($post->ID, 'title', 1) ; ?>">
	</p>

	<p>
		<label for="is_floor_page">Is floor page? </label>
		<input type="checkbox" name="is_floor_page" <?php echo $checked; ?>>
	</p>	

	<input type="hidden" name="is_floor_page_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
<?php
}

/**
 * Update URL Meta box
 */
function is_floor_page_update($post_id)
{
	if ( !wp_verify_nonce($_POST['is_floor_page_nonce'], __FILE__) ) return false; 
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; 
	if ( !current_user_can('edit_post', $post_id) ) return false; 

	$is_floor_page = isset( $_POST[ 'is_floor_page' ] )  ? $_POST[ 'is_floor_page' ] : '';
	$title       = isset( $_POST[ 'title' ] )  ? $_POST[ 'title' ] : '';
	$is_floor_page = trim($is_floor_page);
	$title		= trim($title);
	
	
	if(empty($is_floor_page))
	{
		delete_post_meta($post_id, 'is_floor_page');
	}
	update_post_meta($post_id, 'is_floor_page', $is_floor_page);

	if(empty($title))
	{
		delete_post_meta($post_id, 'title');
	}
	update_post_meta($post_id, 'title', $title);

	return $post_id;
}


/**
 * Get all floor plans
 */
function get_all_floor_plans()
{
	global $post;
	$args = array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'orderby'          => 'title',
		'order'            => 'ASC',
		'post_type'        => 'page',
		'post_status'      => 'publish');

	$floor_plans = get_posts($args);
	$str = "";
	
	foreach ($floor_plans as $key => $value) 
	{
		if(get_post_meta($value->ID, 'is_floor_page', 1) == "on")
		{
			if($value->ID == $post->ID) $active = ' class="active" ';
			else $active = "";

			$url = wp_get_attachment_url( get_post_thumbnail_id($value->ID));

			$str.= '<li '.$active.'><a href="'.get_permalink($value->ID).'"><img src="'.$url.'" alt=""><span>'.get_post_meta($value->ID, 'title', 1).'</span></a></li>';			
		}
	}
	return $str;
}

function get_floor_plans()
{
	$args = array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'orderby'          => 'title',
		'order'            => 'DESC',
		'post_type'        => 'page',
		'post_status'      => 'publish');

	$floor_plans = get_posts($args);
	$str = array();
	
	foreach ($floor_plans as $key => $value) 
	{
		if(get_post_meta($value->ID, 'is_floor_page', 1) == "on")
		{
			$str[] = $value->ID;
		}	
	}
	return $str;
}

function get_next_floor_plan_url($current = "")
{
	if(empty($current))
	{
		$current = get_the_ID();
	}

	$next = -1;
	$arr  = get_floor_plans();

	for ($i=0; $i <= count($arr); $i++) 
	{ 
		if($arr[$i] == $current)
		{			
			if(isset($arr[$i+1]))
			{
				$next = $arr[$i+1];	
			}
			else
			{
				$next = $arr[0];
			}
			
		}
	}	
	return $next;
}

function get_prev_floor_plan_url($current = "")
{
	if(empty($current))
	{
		$current = get_the_ID();
	}
	
	$prev = -1;
	$arr  = get_floor_plans();

	for ($i=0; $i <= count($arr); $i++) 
	{ 
		if($arr[$i] == $current)
		{
			if(isset($arr[$i-1]))
			{
				$prev = $arr[$i-1];	
			}
			else
			{
				$prev = $arr[count($arr)-1];
			}
			
		}
	}
	return $prev;
}
