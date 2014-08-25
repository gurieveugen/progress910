<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
if(get_option('p_coming_soon') == "on")
{
	if ( !is_user_logged_in() ) 
	{
		wp_redirect('/coming-soon/');
		exit;
	}	
}
?>
<?php
// ========================================================
// Constants
// ========================================================
$DEFAULT_GALLERY_ITEMS = 10;
$DEFAULT_GALLERY_CLASS = "default_gallery_class";          
// ========================================================
// Hooks
// ========================================================
add_action( 'wp_print_scripts', 'addmap', 1 );
add_action( 'wp_print_styles', 'addmap_styles', 1 );
add_action( 'wp_print_scripts', 'add_gallery_vars', 1 );
function addmap() 
{
	$p_lat                  = (get_option('p_lat') != "") ? get_option('p_lat') : 0;
	$p_lng                  = (get_option('p_lng') != "") ? get_option('p_lng') : 0;
	$p_lat2                 = (get_option('p_lat2') != "") ? get_option('p_lat2') : 0;
	$p_lng2                 = (get_option('p_lng2') != "") ? get_option('p_lng2') : 0;
	$p_lat_lease_office     = (get_option('p_lat_lease_office') != "") ? get_option('p_lat_lease_office') : 0;
	$p_lng_lease_office     = (get_option('p_lng_lease_office') != "") ? get_option('p_lng_lease_office') : 0;
	$p_lat_lng              = $p_lat.', '.$p_lng; 
	$p_lat_lng2             = $p_lat2.', '.$p_lng2;
	$p_lat_lng_lease_office = $p_lat_lease_office.', '.$p_lng_lease_office;
	?>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
	<script>
	var gmap;
	var show_910          = true;
	var show_uncw         = false;
	var show_lease_office = false;
	function initialize() 
	{
		var mapOptions = 
		{
		zoom: 13,
		center: new google.maps.LatLng(<?php echo $p_lat_lng ?>),
		disableDefaultUI: false,
    	mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		if(document.getElementById('map-canvas')) gmap = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		if(show_910)
		{
			var image = '<?php bloginfo('template_url'); ?>/images/911.png';
			var myLatLng = new google.maps.LatLng(<?php echo $p_lat_lng ?>);
			var beachMarker = new google.maps.Marker({
				position: myLatLng,
				map: gmap,
				icon: image
			});
		}
		
		if(show_uncw)
		{
			var image2 = '<?php bloginfo('template_url'); ?>/images/uncw.png';
			var myLatLng2 = new google.maps.LatLng(<?php echo $p_lat_lng2 ?>);
			var beachMarker2 = new google.maps.Marker({
				position: myLatLng2,
				map: gmap,
				icon: image2
			});
		}
		if(show_lease_office)
		{
			var image_lease_office = '<?php bloginfo('template_url'); ?>/images/lease_office.png';
			var myLatLng_lease_office = new google.maps.LatLng(<?php echo $p_lat_lng_lease_office ?>);
			var beachMarker_lease_office = new google.maps.Marker({
				position: myLatLng_lease_office,
				map: gmap,
				icon: image_lease_office
			});
		}
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);		
	</script>
	<?php
} 
function addmap_styles()
{
	?>
	<style>
	#map-canvas {
	height: 340px;
	margin: 0px;
	padding: 0px;	
	}
	#map-canvas img,
	.google-maps img {
	  max-width: none;
	}
	#searchTxt{
		display: none;
	}
	#searchButton{
		display: none;
	}
	</style>
	<?php
}
function add_gallery_vars()
{
	$_SESSION["gallery_items"] = (isset($_SESSION["gallery_items"]) && !empty($_SESSION["gallery_items"])) ? $_SESSION["gallery_items"] : $DEFAULT_GALLERY_ITEMS;
	$_SESSION["gallery_class"] = (isset($_SESSION["gallery_class"]) && !empty($_SESSION["gallery_class"])) ? $_SESSION["gallery_class"] : $DEFAULT_GALLERY_CLASS;
	?>
		<script>
		var gallery_items = <?php echo intval($_SESSION["gallery_items"]); ?>;
		var gallery_class = "<?php echo $_SESSION['gallery_class']; ?>";
		</script>
	<?php
}
$p_facebook               = trim(get_option('p_facebook'));
$p_twitter                = trim(get_option('p_twitter'));
$facebook                 = (empty($p_facebook)) ? "" : '<li><a href="'.$p_facebook.'" class="facebook">facebook</a></li>';
$twitter                  = (empty($p_twitter)) ? "" : '<li><a href="'.$p_twitter.'" class="twitter">twitter</a></li>';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php bloginfo('name'); ?> <?php wp_title("",true); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />	
	<!-- <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/images_layouts.css" />	 -->
	<link rel="stylesheet" href="<?php echo TDU; ?>/css/jquery.formstyler.css">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="stylesheet" href="<?php echo TDU; ?>/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo TDU; ?>/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo TDU; ?>/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
	
	
	
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); 
		wp_head(); ?>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.flexslider-min.js" ></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.jcarousel.min.js" ></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.main.js" ></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.cookie.js" ></script>
	<!--[if lt IE 9]>
		<script type="text/javascript" src="<?php echo TDU; ?>/js/html5.js"></script>
		<script type="text/javascript" src="<?php echo TDU; ?>/js/pie.js"></script>
		<script type="text/javascript" src="<?php echo TDU; ?>/js/init-pie.js"></script>
	<![endif]-->
	<!--[if lte IE 9]>
		<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.placeholder.min.js"></script>
		<script type="text/javascript">
			jQuery(function(){
				jQuery('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	<!-- Add fancyBox -->
	<script type="text/javascript" src="<?php echo TDU; ?>/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
	<script type="text/javascript" src="<?php echo TDU; ?>/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script>
	var slide_seconds = <?php echo get_option('p_slideshow_interval'); ?>;
	</script>
	<script type="text/javascript" src="<?php echo TDU; ?>/lightbox/jquery.lightbox-0.5.min.js"></script>
    <script type="text/javascript">
        var wp_img_url = '<?php echo TDU; ?>/lightbox/';
        jQuery(function(){
            jQuery('a[rel^=lightbox]').lightBox({
            fixedNavigation:        false,
            imageLoading:           wp_img_url + 'lightbox-ico-loading.gif',      // (string) Path and the name of the loading icon
            imageBtnPrev:           wp_img_url + 'lightbox-btn-prev.gif',         // (string) Path and the name of the prev button image
            imageBtnNext:           wp_img_url + 'lightbox-btn-next.gif',         // (string) Path and the name of the next button image
            imageBtnClose:          wp_img_url + 'lightbox-btn-close.gif',        // (string) Path and the name of the close btn
            imageBlank:             wp_img_url + 'lightbox-blank.gif',            // (string) Path and the name of a blank image (one pixel)
            });
        });
    </script>
	<style>
	.isotopeContainer img{ height: 100% !important; }
	</style>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		<a href="https://progress910.prospectportal.com/Apartments/module/application_authentication/" id="btn-apply-now">APPLY NOW</a>
		<a href="http://modernmsg.com/progress-910" id="btn-reviews">Reviews</a>
		<a href="http://modernmsg.com/rewards/progress-910" id="btn-rewards">Rewards</a>
		<!--<a href="#" id="btn-pay-rent">PAY RENT</a>-->
		<div class="center-wrap">
			<header id="header">
				<div class="logo-area">
					<strong class="logo"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></strong>
					<strong class="slogan">Wilmington's premier Student housing</strong>
					<ul class="social-links">
						<?php echo $twitter.$facebook; ?>
						<!-- <li><a href="https://twitter.com/Progress910" class="twitter">twitter</a></li>
						<li><a href="https://www.facebook.com/Progress910" class="facebook">facebook</a></li> -->
					</ul>
				</div>
				<div class="header-contact">
					<a href="#dialog-login" onclick="jQuery('#dialog-login').show(); return false;" class="btn-login">Company Login</a>
					<?php wp_nav_menu( array(
					'container' => false,
					'theme_location' => 'top_nav',
					'menu_class' => 'buttons'
					)); ?>
					<span class="info">(910) 769-1494</span>
				</div>
				<?php wp_nav_menu( array(
				'container' => 'nav',
				'theme_location' => 'primary_nav',
				'menu_id' => 'nav'
				)); ?>
			</header>