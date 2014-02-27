<?php
/**
 * Register "facebook photostream" widget
 */
add_action('widgets_init', create_function('', 'register_widget( "widget_facebook_photostream" );'));

/**
 * Widget user login Class
 */
class widget_facebook_photostream extends WP_Widget 
{ 
	public function __construct() 
	{
	    parent::__construct(
	        'widget_facebook_photostream', 
	        'facebook photostream widget', 
	        array( 'description' => 'This widget shows facebook photostream' )
	    );
	} 

    /**
     * Print widget to page
     */
    public function widget($args, $instance)
    {
    	extract($args);	

		$title         = $instance['title'];
		$user          = $instance['user'];	
		$count         = intval($instance['count']);

		echo $before_widget;		
		echo $before_title.$title.$after_title;
		echo '<ul class="social-gallery">';
		// ========================================================
		// Paste Facebook photostream images
		// ========================================================	
		$json            = file_get_contents("https://graph.facebook.com/".$user."/photos/uploaded");
		$images_facebook = json_decode($json, true);
		$output          = array_slice($images_facebook["data"], 0, $count);		
		foreach ($output as $key => $value) 
		{			
			$thumb_url       = $value['picture'];			
			$imageCaption    = $value['name'];
			$link 			 = $value['link'];

			echo '<li><a href="'.$link.'"><img src="'.$thumb_url.'" alt="'.$imageCaption.'"><i></i></a></li>';
		}
		echo '</ul>';
		echo '<a class="social-link" href="https://www.facebook.com/'.$user.'/photos_stream">view more facebook <br>photos from past <br>events</a>';
		echo $after_widget;		
    }   
     
    /**
     * Update data
     */
    public function update( $new_instance, $old_instance )
    {
		$instance          = array();		
		$instance['title'] = trim($new_instance['title']);
		$instance['user']  = trim($new_instance['user']);
		$instance['count'] = intval($new_instance['count']);
			
        return $instance;
    }

    /**
     * Create widget form on the admin panel
     */
    public function form( $instance )
    {		
		$title = isset( $instance[ 'title' ] )  ? $instance[ 'title' ] : '';		
		$user  = isset( $instance[ 'user' ] )  ? $instance[ 'user' ] : '';
		$count = isset( $instance[ 'count' ] )  ? intval($instance[ 'count' ]) : 0;
		

		?>		

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'user' ); ?>"><?php _e( 'Facebook user:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'user' ); ?>" name="<?php echo $this->get_field_name( 'user' ); ?>" type="text" value="<?php echo esc_attr($user); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Count:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
		</p>
						
		<?php
    } 
}