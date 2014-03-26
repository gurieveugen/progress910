<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php
$p_facebook               = trim(get_option('p_facebook'));
$p_twitter                = trim(get_option('p_twitter'));
$p_pinterest              = trim(get_option('p_pinterest'));
$p_google_plus            = trim(get_option('p_google_plus'));
$p_in                     = trim(get_option('p_in'));
$p_youtube                = trim(get_option('p_youtube'));
$p_phone                  = trim(get_option('p_phone'));
$p_email                  = trim(get_option('p_email'));
$p_progress_910_address   = trim(get_option('p_progress_910_address'));
$p_leasing_office_address = trim(get_option('p_leasing_office_address'));

$facebook                 = (empty($p_facebook)) ? "" : '<li><a href="'.$p_facebook.'" class="facebook">facebook</a></li>';
$twitter                  = (empty($p_twitter)) ? "" : '<li><a href="'.$p_twitter.'" class="twitter">twitter</a></li>';
$pinterest                = (empty($p_pinterest)) ? "" : '<li><a href="'.$p_pinterest.'" class="pinterest">pinterest</a></li>';
$google                   = (empty($p_google_plus)) ? "" : '<li><a href="'.$p_google_plus.'" class="google">google</a></li>';
$in                       = (empty($p_in)) ? "" : '<li><a href="'.$p_in.'" class="in">in</a></li>';
$youtube                  = (empty($p_youtube)) ? "" : '<li><a href="'.$p_youtube.'" class="youtube">youtube</a></li>';
?>
		</div> <!-- .center-wrap -->
		<footer id="footer">
			<div class="center-wrap">
				<aside class="twitter-area">
					<a href="https://twitter.com/Progress910" class="icon"><img src="<?php echo TDU; ?>/images/icon-910.png" alt=""></a>
					<div class="container">
						<h5><a href="https://twitter.com/Progress910">@Progress910</a></h5>
						<div class="t-switcher"></div>						
							<?php
								$args = array(
									'before_widget' => '',
									'after_widget' => '',
									'before_title' => '',
									'after_title' => '',
								);
								xmt($args, 'Primary');
							?>						
					</div>
				</aside>
				<aside class="contact-area">
					<div class="column">
						<h3>Leasing Office</h3>
						<address><?php echo $p_leasing_office_address; ?></address>						
					</div>
					<div class="column">
						<h3>Progress910</h3>
						<address class="ico"><?php echo $p_progress_910_address; ?></address>						
					</div>
					<div class="column">
						<h3>Get in touch</h3>
						Phone: <?php echo $p_phone; ?>
						<a href="mailto:<?php echo $p_email; ?>" class="ico link"><?php echo $p_email; ?></a>						
					</div>
					<div class="social-column column">
						<h3>We’re Social</h3>
						<ul class="socials">
						<?php echo $facebook.$twitter.$in.$google.$pinterest.$youtube; ?>							
						</ul>
					</div>
				</aside>
			</div>
		</footer>
		<div class="footer-bottom">
			<div class="center-wrap">
				<p class="right">Designed &amp; Developed by <a href="http://www.inkhaus.com"<?php if(!is_front_page()) echo ' rel="nofollow"'; ?>>INKHAUS</a></p>	
				<p>&copy; 2013 All rights reserved. Progress Student Living</p>
			</div>
		</div>
		<div style="display: none;" id="dialog-login">
			<div class="popup-signin">
				<div class="header">
					<h2>Project Management &amp; File Sharing Portal</h2>
				</div>
				<h3>Sign In</h3>
				<form id="loginform" name="loginform" method="post" class="sign-form" action="/wp-login.php">
					<input type="text" name="log" placeholder="Login">
					<input type="password" name="pwd" placeholder="Password" class="password">
					<div class="row">
						<div class="check">
							<input type="checkbox" name="rememberme" value="forever" id="remember">
							<label for="remember">Remember me</label>
						</div>
						<a href="/wp-login.php?action=lostpassword">Forgot password?</a>
					</div>
					<input type="submit" value="LOG IN">
				</form>
				<a href="#" onclick="jQuery('#dialog-login').hide()" class="close">close</a>
			</div>
			<div class="lightbox-mask"></div>
		</div>
	</div>
	<!--[if lt IE 9]>
	<script type="text/javascript">
		jQuery(function(){
			jQuery('input[type="radio"],input[type="checkbox"]').each(function() {
				if (jQuery(this).is(':checked')) {
					jQuery(this).addClass('checked');
				}
				else {
					jQuery(this).removeClass('checked');
				}
			});
			jQuery('input[type="radio"],input[type="checkbox"]').click(function(){
				if (jQuery(this).parent().find('input[type="checkbox"]').is(':checked')) {
					jQuery(this).addClass('checked');
				}
				else {
					jQuery(this).removeClass('checked');
				}
			});
		});
	</script>
	<![endif]-->
	<?php wp_footer(); ?>
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-40821346-2', 'progress910.com');
	ga('send', 'pageview');

	</script>
</body>
</html>