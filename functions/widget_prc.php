<?php
/**
 * Register "Popular, recent, comments" widget
 */
add_action('widgets_init', create_function('', 'register_widget( "widget_prc" );'));

/**
 * Widget user login Class
 */
class widget_prc extends WP_Widget 
{ 
	public function __construct() 
	{
	    parent::__construct(
	        'widget_prc', 
	        'Popular, recent, comments widget', 
	        array( 'description' => 'This widget shows Popular, recent, comments' )
	    );
	} 

    /**
     * Print widget to page
     */
    public function widget($args, $instance)
    {
    	extract($args);	

		$count_popular  = $instance['count_popular'];
		$count_recent   = $instance['count_recent'];
		$count_comments = $instance['count_comments'];
		
		echo $before_widget;		
    ?>
    	<ul class="buttons">
    		<li><a href="#tab-1" class="active">Popular</a></li>
    		<li><a href="#tab-2">Recent</a></li>
    		<li><a href="#tab-3">Comments</a></li>
    	</ul>
    	<div id="tab-1" class="tab-content">		
    		<?php popular_posts($count_popular); ?>
    	</div>
    	<div id="tab-2" class="tab-content">
    		<?php recent_posts($count_recent); ?>		
    	</div>
    	<div id="tab-3" class="tab-content">
	    	<ul class="recent-comments">				
	    		<?php recent_comments($count_comments); ?>			
	    	</ul>
    	</div>
    <?php
       	echo $after_widget;
    }   
     
    /**
     * Update data
     */
    public function update( $new_instance, $old_instance )
    {
		$instance                   = array();		
		$instance['count_popular']  = trim($new_instance['count_popular']);
		$instance['count_recent']   = trim($new_instance['count_recent']);
		$instance['count_comments'] = trim($new_instance['count_comments']);
			
        return $instance;
    }

    /**
     * Create widget form on the admin panel
     */
    public function form( $instance )
    {		
		$count_popular  = isset( $instance[ 'count_popular' ] )  ? intval($instance[ 'count_popular' ]) : 0;		
		$count_recent   = isset( $instance[ 'count_recent' ] )  ? intval($instance[ 'count_recent' ]) : 0;		
		$count_comments = isset( $instance[ 'count_comments' ] )  ? intval($instance[ 'count_comments' ]) : 0;		

		?>		

		<p>
			<label for="<?php echo $this->get_field_id( 'count_popular' ); ?>"><?php _e( 'Count popular:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'count_popular' ); ?>" name="<?php echo $this->get_field_name( 'count_popular' ); ?>" type="text" value="<?php echo esc_attr($count_popular); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count_recent' ); ?>"><?php _e( 'Count popular:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'count_recent' ); ?>" name="<?php echo $this->get_field_name( 'count_recent' ); ?>" type="text" value="<?php echo esc_attr($count_recent); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count_comments' ); ?>"><?php _e( 'Count popular:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'count_comments' ); ?>" name="<?php echo $this->get_field_name( 'count_comments' ); ?>" type="text" value="<?php echo esc_attr($count_popular); ?>" />
		</p>
		
		<?php
    }   
}

function set_post_views($postID) 
{
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count == '')
    {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }
    else
    {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


/**
 * Show most popular posts.
 * @param  integer $posts    
 * @param  string  $post_type 
 */
function popular_posts($posts = 5, $post_type = 'post')
{   
    $args = array(
    'posts_per_page'   => $posts,
    'meta_key'         => 'wpb_post_views_count',
    'orderby'          => 'meta_value_num',
    'order'            => 'DESC',
    'post_type'        => $post_type,
    'post_status'      => 'publish',
    'suppress_filters' => true );

    $posts = get_posts($args);
    foreach ($posts as $key => $value) 
    {
    ?>
        <article>
            <h1><a href="<?php echo get_permalink($value->ID); ?>"><?php echo $value->post_title; ?></a></h1>
            <p><?php echo get_short_string(70, $value->post_content); ?></p>            
            <div class="date"><?php echo date("F j, Y", strtotime($value->post_date)); ?></div>
        </article>
    <?php 
    }
}

/**
 * Get latest posts
 */
function recent_posts($posts = 5, $post_type = 'post')
{   
    $args = array(
    'posts_per_page'   => $posts,   
    'orderby'          => 'post_date',
    'order'            => 'DESC',
    'post_type'        => $post_type,
    'post_status'      => 'publish',
    'suppress_filters' => true );

    $posts = get_posts($args);

    if(!$posts) 
    {
        return "";
    }
    foreach ($posts as $key => $value) 
    {
    ?>
        <article>
            <h1><a href="<?php echo get_permalink($value->ID); ?>"><?php echo $value->post_title; ?></a></h1>
            <p><?php echo get_short_string(70, $value->post_content); ?></p>
            <div class="date"><?php echo date("F j, Y", strtotime($value->post_date)); ?></div>
        </article>
    <?php 
    }
}

/**
 * Get latest posts
 */
function recent_comments($comments = 5)
{   
    $args = array(
        'number' => $comments,
        'status' => 'approve');

    $posts = get_comments($args);

    if(!$posts) 
    {
        return "";
    }
    foreach ($posts as $key => $value) 
    {
    ?>
        <article>
            <a href="<?php echo get_permalink($value->comment_post_ID); ?>"><?php echo $value->comment_author; ?></a>
            on
            <a href="<?php echo get_permalink($value->comment_post_ID); ?>"><?php echo $value->comment_content; ?></a>
        </article>
    <?php 
    }
}

/**
 * Get short string.
 * @param  [integer] $symbols Count symbols
 * @param  [string]  $str     String
 * @return [string]       
 */
function get_short_string($symbols, $str)
{
    return preg_match("/^(.{".$symbols.",}?)\s+/s", $str, $m) ? $m[1] . '...' : $str; 
}