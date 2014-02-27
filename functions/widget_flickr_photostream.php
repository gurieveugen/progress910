<?php
/**
 * Register "Flickr photostream" widget
 */
add_action('widgets_init', create_function('', 'register_widget( "widget_flickr_photostream" );'));

/**
 * Widget user login Class
 */
class widget_flickr_photostream extends WP_Widget 
{ 
	public function __construct() 
	{
	    parent::__construct(
	        'widget_flickr_photostream', 
	        'Flickr photostream widget', 
	        array( 'description' => 'This widget shows Flickr photostream' )
	    );
	} 

    /**
     * Print widget to page
     */
    public function widget($args, $instance)
    {
    	extract($args);	

		$title         = $instance['title'];
		$user_id       = $instance['user_id'];	
		$flickr_images = $this->get_flickr_photostream($instance);	

		echo $before_widget;		
		echo $before_title.$title.$after_title;
		echo '<ul class="social-gallery">';
		foreach ($flickr_images as $key => $value) 
		{?>
			<li><a href="<?php echo $value['url_o'] ?>"><img src="<?php echo $value['url_sq'] ?>" alt=""><i></i></a></li>
		<?php
		}			
		echo '</ul>';
		echo '<a href="http://www.flickr.com/photos/'.$user_id.'" class="social-link">view our flickr <br>Photostream</a>';
		echo $after_widget;
    }   
     
    /**
     * Update data
     */
    public function update( $new_instance, $old_instance )
    {
		$instance             = array();		
		$instance['title']    = trim($new_instance['title']);
		$instance['api_key']  = trim($new_instance['api_key']);
		$instance['user_id']  = trim($new_instance['user_id']);
		$instance['per_page'] = intval($new_instance['per_page']);
			
        return $instance;
    }

    /**
     * Create widget form on the admin panel
     */
    public function form( $instance )
    {		
		$title    = isset( $instance[ 'title' ] )  ? $instance[ 'title' ] : '';		
		$api_key  = isset( $instance[ 'api_key' ] )  ? $instance[ 'api_key' ] : '';
		$user_id  = isset( $instance[ 'user_id' ] )  ? $instance[ 'user_id' ] : '';
		$per_page = isset( $instance[ 'per_page' ] )  ? $instance[ 'per_page' ] : '';

		?>		

		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Api key:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'api_key' ); ?>" name="<?php echo $this->get_field_name( 'api_key' ); ?>" type="text" value="<?php echo esc_attr($api_key); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'User ID:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'user_id' ); ?>" name="<?php echo $this->get_field_name( 'user_id' ); ?>" type="text" value="<?php echo esc_attr($user_id); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Images per page:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'per_page' ); ?>" name="<?php echo $this->get_field_name( 'per_page' ); ?>" type="text" value="<?php echo esc_attr($per_page); ?>" />
		</p>
						
		<?php
    }  


    /**
     * Get images from Flickr photostream
     */
    public function get_flickr_photostream($instance)
    {		
		$api_key  = $instance['api_key'];
		$user_id  = $instance['user_id'];
		$per_page = $instance['per_page'];

		$params   = array(
    		'api_key'      => $api_key,
    		'method'       => 'flickr.people.getPhotos',
    		'user_id'      => $user_id,
    		'per_page'     => $per_page,
    		'content_type' => '7',
    		'extras'	   => 'url_sq, url_o',
    		'format'       => 'php_serial'
    	);

    	$encoded_params = array();
    	foreach ($params as $k => $v)
    	{
    		$encoded_params[] = urlencode($k).'='.urlencode($v);
    	}
    	$url     = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);
    	$rsp     = file_get_contents($url);
    	$rsp_obj = unserialize($rsp);
    	// ========================================================
    	// display the photo title (or an error if it failed)
    	// ========================================================
    	return $rsp_obj["photos"]["photo"];
    }  
}