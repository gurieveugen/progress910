<?php
class SocialHubOptionsPage{
    //                          __              __      
    //   _________  ____  _____/ /_____ _____  / /______
    //  / ___/ __ \/ __ \/ ___/ __/ __ `/ __ \/ __/ ___/
    // / /__/ /_/ / / / (__  ) /_/ /_/ / / / / /_(__  ) 
    // \___/\____/_/ /_/____/\__/\__,_/_/ /_/\__/____/  
    const PARENT_PAGE = 'options-general.php';

    //                                       __  _          
    //     ____  _________  ____  ___  _____/ /_(_)__  _____
    //    / __ \/ ___/ __ \/ __ \/ _ \/ ___/ __/ / _ \/ ___/
    //   / /_/ / /  / /_/ / /_/ /  __/ /  / /_/ /  __(__  ) 
    //  / .___/_/   \____/ .___/\___/_/   \__/_/\___/____/  
    // /_/              /_/                                                       
    private $options;

    //                    __  __              __    
    //    ____ ___  ___  / /_/ /_  ____  ____/ /____
    //   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
    //  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
    // /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        add_submenu_page(self::PARENT_PAGE, __('Social hub options'), __('Social hub options'), 'administrator', __FILE__, array($this, 'create_admin_page'), ''); 
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        $this->options = $this->getAll();          

        ?>
        <div class="wrap">
            <?php screen_icon(); ?>                 
            <form method="post" action="options.php">
            <?php                
                settings_fields('social_hub_options_page');   
                do_settings_sections(__FILE__);                
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Get all options
     */
    public function getAll()
    {
        return get_option('social_hub_options');
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting('social_hub_options_page', 'social_hub_options', array($this, 'sanitize'));
        add_settings_section('default_settings', __('Options'), null, __FILE__);     

        add_settings_field('count', __('Items per page'), array($this, 'count_callback'), __FILE__, 'default_settings');
        add_settings_field('twitter_hash', __('Twitter hash tag'), array($this, 'twitter_hash_callback'), __FILE__, 'default_settings');
        add_settings_field('twitter_consumer_key', __('Twitter consumer key'), array($this, 'twitter_consumer_key_callback'), __FILE__, 'default_settings');
        add_settings_field('twitter_consumer_secret', __('Twitter consumer secret'), array($this, 'twitter_consumer_secret_callback'), __FILE__, 'default_settings');
        add_settings_field('twitter_access_token', __('Twitter access token'), array($this, 'twitter_access_token_callback'), __FILE__, 'default_settings');
        add_settings_field('twitter_access_token_secret', __('Twitter token secret'), array($this, 'twitter_access_token_secret_callback'), __FILE__, 'default_settings');       

        add_settings_field('instagram_hash', __('Instagram hash tag'), array($this, 'instagram_hash_callback'), __FILE__, 'default_settings');
        add_settings_field('instagram_app_key', __('Client ID'), array($this, 'instagram_app_key_callback'), __FILE__, 'default_settings');
        add_settings_field('instagram_app_secret', __('Client Secret'), array($this, 'instagram_app_secret_callback'), __FILE__, 'default_settings');
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input)
    {
        $new_input = array();     

        if(isset($input['count'])) $new_input['count']                                             = intval($input['count']);
        if(isset($input['twitter_hash'])) $new_input['twitter_hash']                               = strip_tags($input['twitter_hash']);
        if(isset($input['twitter_consumer_key'])) $new_input['twitter_consumer_key']               = strip_tags($input['twitter_consumer_key']);
        if(isset($input['twitter_consumer_secret'])) $new_input['twitter_consumer_secret']         = strip_tags($input['twitter_consumer_secret']);
        if(isset($input['twitter_access_token'])) $new_input['twitter_access_token']               = strip_tags($input['twitter_access_token']);
        if(isset($input['twitter_access_token_secret'])) $new_input['twitter_access_token_secret'] = strip_tags($input['twitter_access_token_secret']);
        if(isset($input['instagram_hash'])) $new_input['instagram_hash']                           = strip_tags($input['instagram_hash']);
        if(isset($input['instagram_app_key'])) $new_input['instagram_app_key']                     = strip_tags($input['instagram_app_key']);
        if(isset($input['instagram_app_secret'])) $new_input['instagram_app_secret']               = strip_tags($input['instagram_app_secret']);
            

        return $new_input;
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function count_callback()
    {
        printf('<input type="text" class="regular-text" id="count" name="social_hub_options[count]" value="%s" />', isset($this->options['count']) ? intval($this->options['count']) : 1);
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function twitter_hash_callback()
    {
        printf('<input type="text" class="regular-text" id="twitter_hash" name="social_hub_options[twitter_hash]" value="%s" />', isset($this->options['twitter_hash']) ? esc_attr($this->options['twitter_hash']) : '');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function twitter_consumer_key_callback()
    {
        printf('<input type="text" class="regular-text" id="twitter_consumer_key" name="social_hub_options[twitter_consumer_key]" value="%s" />', isset($this->options['twitter_consumer_key']) ? esc_attr($this->options['twitter_consumer_key']) : '');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function twitter_consumer_secret_callback()
    {
        printf('<input type="text" class="regular-text" id="twitter_consumer_secret" name="social_hub_options[twitter_consumer_secret]" value="%s" />', isset($this->options['twitter_consumer_secret']) ? esc_attr($this->options['twitter_consumer_secret']) : '');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function twitter_access_token_callback()
    {
        printf('<input type="text" class="regular-text" id="twitter_access_token" name="social_hub_options[twitter_access_token]" value="%s" />', isset($this->options['twitter_access_token']) ? esc_attr($this->options['twitter_access_token']) : '');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function twitter_access_token_secret_callback()
    {
        printf('<input type="text" class="regular-text" id="twitter_access_token_secret" name="social_hub_options[twitter_access_token_secret]" value="%s" />', isset($this->options['twitter_access_token_secret']) ? esc_attr($this->options['twitter_access_token_secret']) : '');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function instagram_hash_callback()
    {
        printf('<input type="text" class="regular-text" id="instagram_hash" name="social_hub_options[instagram_hash]" value="%s" />', isset($this->options['instagram_hash']) ? esc_attr($this->options['instagram_hash']) : '');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function instagram_app_key_callback()
    {
        printf('<input type="text" class="regular-text" id="instagram_app_key" name="social_hub_options[instagram_app_key]" value="%s" />', isset($this->options['instagram_app_key']) ? esc_attr($this->options['instagram_app_key']) : '');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function instagram_app_secret_callback()
    {
        printf('<input type="text" class="regular-text" id="instagram_app_secret" name="social_hub_options[instagram_app_secret]" value="%s" />', isset($this->options['instagram_app_secret']) ? esc_attr($this->options['instagram_app_secret']) : '');
    }
}
// =========================================================
// LAUNCH
// =========================================================
$GLOBALS['social_hub_options'] = new SocialHubOptionsPage();