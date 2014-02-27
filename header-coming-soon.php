<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
 
$email_result = false;
if ( isset($_POST['secure_id']) && isset($_POST['secure_hash']) && isset($_POST['user_email']) ) {
	if ( md5( 'Secure_id' . intval( $_POST['secure_id'] ) ) == $_POST['secure_hash'] 
		&& ( intval($_SERVER['REQUEST_TIME']) - intval($_POST['secure_id']) < 3600 ) ) {
		
		$email = strip_tags(stripslashes($_POST['user_email']));
		$name = strip_tags(stripslashes($_POST['user_name']));
		$email_result = mail( 
			'info@progress910.com', 
			'Email subscription', 
			'Please add my email address to news, offers and updates listings. ' . "\r\n" . $email
			."\r\n" . 'Name: '.$name
			."\r\n" . ' ------ Sent via "Join Our Email List" form on http://progress910.com/', 
			'From: administator <noreply@progress910.com>' 
		);
	}
} 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title>Progress910 - Student Housing Apartments at UNCW in Wilmington, NC </title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); 
		wp_head(); ?>	
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.flexslider-min.js" ></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.main.js" ></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/countdown.js" ></script>
	<!--[if lt IE 9]>
		<script type="text/javascript" src="<?php echo TDU; ?>/js/html5.js"></script>
		<script type="text/javascript" src="<?php echo TDU; ?>/js/pie.js"></script>
		<script type="text/javascript" src="<?php echo TDU; ?>/js/init-pie.js"></script>
	<![endif]-->
	<!--[if lte IE 9]>
		<script type="text/javascript" src="<?php echo TDU ?>/js/jquery.placeholder.min.js"></script>
		<script type="text/javascript">
		jQuery(function() {
			jQuery('input, textarea').placeholder();
		});
	</script>
 <![endif]-->
</head>
<body <?php body_class('coming-soon'); ?>>
	<div id="wrapper">
		<header id="header">
			<div class="center-wrap">
				<div class="logo-area">
					<strong class="logo"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></strong>
					<address class="address">316 Marlboro Street, Wilmington, NC  28403</address>
					<div class="contact-row">
						<strong class="phone"><span class="tel">Tel</span> (910) 769-1494</strong>
						<ul class="social-links">
							<li><a href="https://twitter.com/Progress910" class="twitter">facebook</a></li>
							<li><a href="https://www.facebook.com/Progress910" class="facebook">facebook</a></li>
						</ul>
					</div>
				</div>
				<h1 class="header-text">
					The Best In Student Living
				</h1>
			</div>
		</header>