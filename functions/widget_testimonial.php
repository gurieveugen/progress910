<?php
/**
 * Register "Testimonials" widget
 */
add_action('widgets_init', create_function('', 'register_widget( "widget_testimonial" );'));

/**
 * Widget user login Class
 */
class widget_testimonial extends WP_Widget 
{ 
	public function __construct() 
	{
	    parent::__construct(
	        'widget_testimonial', 
	        'Testimonials widget', 
	        array( 'description' => 'This widget shows Testimonial' )
	    );
	} 

    /**
     * Print widget to page
     */
    public function widget($args, $instance)
    {
    	extract($args);	

		$title   = $instance['title'];
		$content = $instance['content'];
		$author  = $instance['author'];

		echo $before_widget;		
		echo $before_title.$title.$after_title;
		echo '<div class="testimonial"><blockquote><q>'.$content.'</q></blockquote><cite>'.$author.'</cite></div>';
    	echo $after_widget;
    }   
     
    /**
     * Update data
     */
    public function update( $new_instance, $old_instance )
    {
		$instance            = array();		
		$instance['title']   = trim($new_instance['title']);
		$instance['content'] = trim($new_instance['content']);
		$instance['author']  = trim($new_instance['author']);
			
        return $instance;
    }

    /**
     * Create widget form on the admin panel
     */
    public function form( $instance )
    {		
		$title   = isset( $instance[ 'title' ] )  ? $instance[ 'title' ] : '';		
		$content = isset( $instance[ 'content' ] )  ? $instance[ 'content' ] : '';
		$author  = isset( $instance[ 'author' ] )  ? $instance[ 'author' ] : '';

		?>		

		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Content:' ); ?></label>
		<textarea name="<?php echo $this->get_field_name( 'content' ); ?>" id="<?php echo $this->get_field_id( 'content' ); ?>" cols="30" rows="10"><?php echo esc_attr($content); ?></textarea>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'author:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'author' ); ?>" name="<?php echo $this->get_field_name( 'author' ); ?>" type="text" value="<?php echo esc_attr($author); ?>" />
		</p>
		
		<?php
    }    
}