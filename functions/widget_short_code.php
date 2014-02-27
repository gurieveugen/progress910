<?php
/**
 * Register "Contact form" widget
 */
add_action('widgets_init', create_function('', 'register_widget( "widget_contact_form" );'));

/**
 * Widget user login Class
 */
class widget_contact_form extends WP_Widget 
{ 
	public function __construct() 
	{
	    parent::__construct(
	        'widget_contact_form', 
	        'Short code widget', 
	        array( 'description' => 'This widget shows Short code widget' )
	    );
	} 
   
    /**
     * Print widget to page
     */
    public function widget($args, $instance)
    {
    	extract($args);	

		$short_code = $instance['short_code'];

		echo $before_widget;	
		echo '<div class="contact-form">';
		echo apply_filters('the_content', $short_code);
		echo '</div>';
    	echo $after_widget;
    }   
     
    /**
     * Update data
     */
    public function update( $new_instance, $old_instance )
    {
		$instance               = array();		
		$instance['short_code'] = $new_instance['short_code'];
			
        return $instance;
    }

    /**
     * Create widget form on the admin panel
     */
    public function form( $instance )
    {		
		$short_code = isset( $instance[ 'short_code' ] )  ? $instance[ 'short_code' ] : '';		

		?>		

		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Short code:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'short_code' ); ?>" name="<?php echo $this->get_field_name( 'short_code' ); ?>" type="text" value="<?php echo esc_attr($short_code); ?>" />
		</p>
		
		<?php
    }    
}