<?php
/**
 * Register "Latest parent news" widget
 */
add_action('widgets_init', create_function('', 'register_widget( "widget_latest_parent_news" );'));

/**
 * Widget user login Class
 */
class widget_latest_parent_news extends WP_Widget 
{ 
	public function __construct() 
	{
	    parent::__construct(
	        'widget_latest_parent_news', 
	        'Latest news widget', 
	        array( 'description' => 'This widget shows Latest parent news' )
	    );
	} 

    /**
     * Print widget to page
     */
    public function widget($args, $instance)
    {
    	extract($args);	

		$latest_news = get_latest_parent_news();
		$month       = date('F', strtotime($latest_news->post_date));
		$day         = date('d', strtotime($latest_news->post_date)); 
		$post_title  = $latest_news->post_title;
		$content     = get_anons($latest_news->ID);
		$permalink   = get_permalink($latest_news->ID);
		$title       = $instance['title'];

		echo $before_widget;		
		echo $before_title.$title.$after_title;
		echo '<article>';
		echo '<header>';
		echo '<a href="'.$permalink.'"><strong class="date">'.$day.'<span class="month">'.$month.'</span></strong>';
		echo '<h1>'.$post_title.'</h1></a>';				
		echo '</header><!-- /header -->';
		echo '<div class="content"><p>'.$content.' <a href="'.$permalink.'" class="more-link">Read more</a></p></div>';
		echo '</article>';
    	echo $after_widget;
    }   
     
    /**
     * Update data
     */
    public function update( $new_instance, $old_instance )
    {
		$instance          = array();		
		$instance['title'] = trim($new_instance['title']);
			
        return $instance;
    }

    /**
     * Create widget form on the admin panel
     */
    public function form( $instance )
    {		
		$title = isset( $instance[ 'title' ] )  ? $instance[ 'title' ] : '';		

		?>		

		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		<?php
    }    
}