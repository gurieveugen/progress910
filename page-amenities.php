<?php
/*
 * @package WordPress
 * Template Name: AMENITIES Page
*/
?>
<?php 
$_SESSION["gallery_items"] = 11;
$_SESSION["gallery_class"] = "amenities";
get_header(); 
?>
<div class="heading">
	<ul class="breadcrumbs">
		<li><a href="#">Home</a></li>
		<li>Amenities</li>
	</ul>
	<h1 class="text-amenities">Amenities</h1>
</div>
<div id="main">
	<div class="content-block left">
		<h2>AMENITIES RIGHT OUTSIDE YOUR DOOR</h2>
		<p><strong>With everything from state-of-the-art 24-hour fitness centers to study lounges to hammock gardens, we have your needs and wants are covered!</strong></p>
		<p>Progress910 residents want privacy, security, amenities, and comfort to create the ideal space for their student lifestyle.</p>
		<br>
		<h2>unit features</h2>
		<ul class="list">
			<li>Contemporary Professional Interior Design</li>
			<li>Designer, Modern Furniture</li>
			<li>Private Bedroom and Bath</li>
			<li>Sound-insulated Walls</li>
			<li>Utilities and High-speed Internet</li>
			<li>Private Balconies/Patios</li>
			<li>Modern Kitchens with Stainless Steel Appliances</li>
			<li>Luxury Vinyl Woodgrain Tile</li>
			<li>Fully Furnished</li>
			<li>Walk-in Closet</li>
		</ul>
		<h2>Building amenities</h2>
		<ul class="list">
			<li>State-of-the-Art 24-Hour Fitness Center</li>
			<li>Fitness Locker Room with Showers</li>
			<li>Game Cove</li>
			<li>Upright Tanning Beds</li>
			<li>Activity/Club Room with Lounge Areas, Fireplace, and Billiards</li>
                        <li>Secluded Cyber Café Study Lounge</li>
			<li>Resort Style “Zero” Entry Pool</li>
			<li>In-Pool Fountains</li>
			<li>Spray Deck</li>
			<li>Lighted Sand Volleyball Court</li>
			<li>Ping Pong Tables</li>
			<li>In-Pool Sun Deck Lounge</li>
			<li>Poolside Cabanas</li>
			<li>Hammock Gardens</li>
			<li>Outdoor Covered Lounge</li>
			<li>Poolside Elevated Tanning & Activity Deck</li>
			<li>Oversized Outdoor Fire Pits</li>
			<li>Outdoor Shaded Café Patio with Barbecue Grills</li>
			<li>Private Outdoor Courtyards</li>
			<li>Ample Bicycle Parking</li>
		</ul>
		<h2>progress910 features</h2>
		<ul class="list">
			<li>24-hour Emergency Maintenance</li>
			<li>Emergency Call Stations</li>
			<li>Security Cameras</li>
			<li>Secure Building Entrance</li>
			<li>Cable and WiFi Included</li>
			<li>Private Onsite Parking</li>
			<li>Individual Leases</li>
			<li>Roommate Matching Available</li>
			<li>Pet Friendly!</li>
		</ul>
	</div>
	<div class="gallery-content">
		<!-- <div class="g-filter-holder">
			<ul class="g-filter">
				<li><a href="#">Unit</a></li>
				<li><a href="#">Building</a></li>
			</ul>
		</div> -->
		<!-- <div class="isotope-gallery">
			<div class="slides">
				<div class="slide">
					<div class="holder">
						<div class="box">
							<img src="<?php echo TDU; ?>/images/img-1.gif" alt="">
							<a href="#" class="text">
								<h5>Resort Pool</h5>
								<h6>Building amenities</h6>
							</a>
						</div>
						<div class="box violet">
							<div class="text">
								<h5 class="text-click">Click to Enlarge Photos</h5>
							</div>
						</div>
						<div class="box">
							<img src="<?php echo TDU; ?>/images/img-2.gif" alt="">
							<a href="#" class="text">
								<h5>Resort Pool</h5>
								<h6>Building amenities</h6>
							</a>
						</div>
						<div class="box">
							<img src="<?php echo TDU; ?>/images/img-3.gif" alt="">
							<a href="#" class="text">
								<h5>Resort Pool</h5>
								<h6>Building amenities</h6>
							</a>
						</div>
						<div class="box">
							<img src="<?php echo TDU; ?>/images/img-2.gif" alt="">
							<a href="#" class="text">
								<h5>Resort Pool</h5>
								<h6>Building amenities</h6>
							</a>
						</div>
						<div class="box">
							<img src="<?php echo TDU; ?>/images/img-4.gif" alt="">
							<a href="#" class="text">
								<h5>Resort Pool</h5>
								<h6>Building amenities</h6>
							</a>
						</div>
						<div class="box">
							<img src="<?php echo TDU; ?>/images/img-2.gif" alt="">
							<a href="#" class="text">
								<h5>Resort Pool</h5>
								<h6>Building amenities</h6>
							</a>
						</div>
						<div class="box">
							<img src="<?php echo TDU; ?>/images/img-3.gif" alt="">
							<a href="#" class="text">
								<h5>Resort Pool</h5>
								<h6>Building amenities</h6>
							</a>
						</div>
						<div class="box">
							<img src="<?php echo TDU; ?>/images/img-2.gif" alt="">
							<a href="#" class="text">
								<h5>Resort Pool</h5>
								<h6>Building amenities</h6>
							</a>
						</div>
					</div>
				</div>
				<div class="slide">
					<div class="holder">
						<div class="box">
							<img src="<?php echo TDU; ?>/images/img-1.gif" alt="">
							<a href="#" class="text">
								<h5>Resort Pool</h5>
								<h6>Building amenities</h6>
							</a>
						</div>
						<div class="box violet">
							<div class="text">
								<h5 class="text-click">Click to Enlarge Photos</h5>
							</div>
						</div>
						<div class="box">
							<img src="<?php echo TDU; ?>/images/img-1.gif" alt="">
							<div class="text">
								<h5>Resort Pool</h5>
								<h6>Building amenities</h6>
							</div>
						</div>
						<div class="box violet">
							<div class="text">
								<h5 class="text-click">Click to Enlarge Photos</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="slide">
					<div class="holder">
						<div class="box">
							<img src="<?php echo TDU; ?>/images/img-1.gif" alt="">
							<div class="text">
								<h5>Resort Pool</h5>
								<h6>Building amenities</h6>
							</div>
						</div>
						<div class="box violet">
							<div class="text">
								<h5 class="text-click">Click to Enlarge Photos</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<?php echo apply_filters( 'the_content', '[isotope_gallery id="80"]' ); ?>		
		<script src="<?php echo TDU; ?>/js/jquery.isotope.min.js"></script>
		<script>
			jQuery(function(){
				jQuery('.isotope-gallery').flexslider({
					animation: "slide",
					selector: ".slides > .slide",
					animationSpeed: 600,
					slideshow: false,
					smoothHeight: true
				});
				var $container = jQuery('.isotope-gallery .slide .holder');
				$container.toggleClass('variable-sizes').isotope({
					itemSelector: '.box'
				});
			});
		</script>
	</div>
</div>
<?php get_footer(); ?>