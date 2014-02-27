<?php

/**
 * Create new sub menu on Appearance page
 */
add_action('admin_menu', 'omr_create_menu');
function omr_create_menu() 
{	
	add_submenu_page( 'themes.php', 'Theme options', 'Theme options', 'administrator', __FILE__, 'omr_settings_page', 'favicon.ico' );
	add_action( 'admin_init', 'register_mysettings' );
}

/**
 * Register our settings
 */
function register_mysettings() 
{
	register_setting('progress_group', 'p_coming_soon');	
	register_setting('progress_group', 'p_slideshow_interval');	
	// ========================================================
	// Google maps
	// ========================================================
	register_setting('progress_group', 'p_lat');	
	register_setting('progress_group', 'p_lng');	
	register_setting('progress_group', 'p_lat2');	
	register_setting('progress_group', 'p_lng2');	
	register_setting('progress_group', 'p_lat_lease_office');	
	register_setting('progress_group', 'p_lng_lease_office');	
	// ========================================================
	// Social icons
	// ========================================================
	register_setting('progress_group', 'p_facebook');
	register_setting('progress_group', 'p_twitter');
	register_setting('progress_group', 'p_pinterest');
	register_setting('progress_group', 'p_google_plus');
	register_setting('progress_group', 'p_instagram');
	register_setting('progress_group', 'p_vimeo');
	register_setting('progress_group', 'p_wordpress');
	register_setting('progress_group', 'p_in');
	register_setting('progress_group', 'p_youtube');
	// ========================================================
	// Get in touch information
	// ========================================================
	register_setting('progress_group', 'p_phone');
	register_setting('progress_group', 'p_fax');
	register_setting('progress_group', 'p_email');
	register_setting('progress_group', 'p_email_leasing');
	register_setting('progress_group', 'p_progress_910_address');
	register_setting('progress_group', 'p_leasing_office_address');
}
/**
 * Show Theme options page on WP Admin
 */
function omr_settings_page() 
{
?>
	<div class="wrap">		
		<form method="post" action="options.php">
			<h2><?php _e('Theme options'); ?></h2>
			<?php settings_fields('progress_group'); ?>			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Coming Soon page (ON/OFF):'); ?></th>
					<td>
						<select name="p_coming_soon" id="p_coming_soon">
							<?php
							$selected_on  = "";
							$selected_off = "";
							if(get_option('p_coming_soon') == "on")
							{
								$selected_on = 'selected="selected"';
							}
							else
							{
								$selected_off = 'selected="selected"';
							}
							?>
							<option value="on" <?php echo $selected_on; ?>>ON</option>
							<option value="off"  <?php echo $selected_off; ?>>OFF</option>
						</select>						
					</td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Slideshow interval (floor plans):'); ?></th>
					<td><input type="text" name="p_slideshow_interval" value="<?php echo get_option('p_slideshow_interval')?>"></td>	
				</tr>
			</table>	
			
			<h2><?php _e('Google maps options'); ?></h2>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Latitude (910):'); ?></th>
					<td><input type="text" name="p_lat" value="<?php echo get_option('p_lat')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Longitude (910):'); ?></th>
					<td><input type="text" name="p_lng" value="<?php echo get_option('p_lng')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Latitude (uncw):'); ?></th>
					<td><input type="text" name="p_lat2" value="<?php echo get_option('p_lat2')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Longitude (uncw):'); ?></th>
					<td><input type="text" name="p_lng2" value="<?php echo get_option('p_lng2')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Latitude (lease office):'); ?></th>
					<td><input type="text" name="p_lat_lease_office" value="<?php echo get_option('p_lat_lease_office')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Longitude (lease office):'); ?></th>
					<td><input type="text" name="p_lng_lease_office" value="<?php echo get_option('p_lng_lease_office')?>"></td>	
				</tr>
			</table>

			<h2><?php _e('Social'); ?></h2>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('facebook:'); ?></th>
					<td><input type="text" name="p_facebook" value="<?php echo get_option('p_facebook')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('twitter:'); ?></th>
					<td><input type="text" name="p_twitter" value="<?php echo get_option('p_twitter')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('pinterest:'); ?></th>
					<td><input type="text" name="p_pinterest" value="<?php echo get_option('p_pinterest')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('google plus:'); ?></th>
					<td><input type="text" name="p_google_plus" value="<?php echo get_option('p_google_plus')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('instagram:'); ?></th>
					<td><input type="text" name="p_instagram" value="<?php echo get_option('p_instagram')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('vimeo:'); ?></th>
					<td><input type="text" name="p_vimeo" value="<?php echo get_option('p_vimeo')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('wordpress:'); ?></th>
					<td><input type="text" name="p_wordpress" value="<?php echo get_option('p_wordpress')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('In:'); ?></th>
					<td><input type="text" name="p_in" value="<?php echo get_option('p_in')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('youtube:'); ?></th>
					<td><input type="text" name="p_youtube" value="<?php echo get_option('p_youtube')?>"></td>	
				</tr>
			</table>

			<h2><?php _e('Get in touch information'); ?></h2>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Phone:'); ?></th>
					<td><input type="text" name="p_phone" value="<?php echo get_option('p_phone')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Fax:'); ?></th>
					<td><input type="text" name="p_fax" value="<?php echo get_option('p_fax')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Email:'); ?></th>
					<td><input type="text" name="p_email" value="<?php echo get_option('p_email')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Email leasing:'); ?></th>
					<td><input type="text" name="p_email_leasing" value="<?php echo get_option('p_email_leasing')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Progress 910 address:'); ?></th>
					<td><input type="text" name="p_progress_910_address" value="<?php echo get_option('p_progress_910_address')?>"></td>	
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Leasing office address:'); ?></th>
					<td><input type="text" name="p_leasing_office_address" value="<?php echo get_option('p_leasing_office_address')?>"></td>	
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
	</div>	
<? 
}  