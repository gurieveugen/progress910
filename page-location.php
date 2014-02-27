<?php

/*

 * @package WordPress

 * Template Name: Location Page

*/

?>

<?php 

get_header(); 



$p_phone                  = trim(get_option('p_phone'));

$p_progress_910_address   = trim(get_option('p_progress_910_address'));

$p_leasing_office_address = trim(get_option('p_leasing_office_address'));

?>

<div class="heading">

	<ul class="breadcrumbs">

		<li><a href="#">Home</a></li>

		<li>Location</li>

	</ul>

	<h1 class="text-location">Location</h1>

</div>

<div id="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php echo get_the_content(); ?>		

	<?php endwhile; ?>	

	<div class="contact-section inner first">

		<h3 class="address">Address</h3>

		<div class="column">

			<h5>progress910</h5>

			<address><?php echo $p_progress_910_address."<br>".$p_phone; ?></address>

		</div>

		<div class="column">

			<h5>Leasing Office</h5>

			<address><?php echo $p_leasing_office_address."<br>".$p_phone; ?></address>

		</div>

		<div class="gadget-holder">			

			<div class="gadget">				

				<script src="//www.gmodules.com/ig/ifr?url=http://www.google.com/ig/modules/driving_directions.xml&amp;up_from=&amp;up_to=5214%20Market%20Street%20Suite%20101%20Wilmington,%20NC%2028405&amp;up_country=0&amp;synd=open&amp;w=410&amp;h=102&amp;title=Directions+by+Google+Maps&amp;lang=all&amp;country=ALL&amp;output=js"></script>				

			</div>			

		</div>

	</div>

	<div class="map">

		<div id="map-canvas"></div>

	</div>

	<section class="neighborhood-area">

		<h2>What’s in your neighborhood</h2>

		<div class="clearfix">

			<aside class="neighborhood-widget">

				<div class="holder">

					<h4>Banking</h4>

					<ul>

						<li>

							BB&amp;T <em>(1 mi)</em>

						</li>

						<li>

							Bank of America <em>(1.1 mi)</em>

						</li>

						<li>

							Wells Fargo <em>(1.3 mi)</em>

						</li>

					</ul>

					<h4>Dining</h4>

					<ul>

						<li>College Diner  (1.6 mi)</li>

						<li>Cookout  (2 mi)</li>

						<li>Chili's  (1.5 mi)</li>

						<li>Little Ceasar's  (1.4 mi)</li>

						<li>Szechuan  (1.2 mi)</li>

						<li>McAlister’s Deli  (1.7 mi)</li>

						<li>Port City Java  (2.6 mi)</li>

						<li>Starbucks  (1.5 mi)</li>

					</ul>

					<h4>EMERGENCY SERVICES</h4>

					<ul>

						<li>Cape Fear Hospital  (3.1 mi)</li>

						<li>Student Health Services  (1.5 mi)</li>

						<li>Southeastern Medical Group  (.9 mi)</li>

					</ul>

					<h4>Entertainment</h4>

					<ul>

						<li>Carmike Cinema (.8 mi)</li>

						<li>Cameron Art Museum  (6.7 mi)</li>

						<li>Downtown Entertainment District  (4.2 mi)</li>

					</ul>

					<h4>Recreation</h4>

					<ul>

						<li>Hugh Macrae Park  (2.5 mi)</li>

						<li>Wilmington Municipal Golf Course  (2.6 mi)</li>

					</ul>

					<h4>RETAIL SERVICES</h4>

					<ul>

						<li>University Commons  (1.4 mi)</li>

						<li>Wilmington Shops  (1.4 mi)</li>

						<li>Mayfaire Town Center  (5.0 mi)</li>

					</ul>

				</div>

			</aside>

			<div class="content">

				<p>Use our interactive Point of Interest Map to find out where to grab some food, take in a movie, stock up on groceries or do a little shopping. It also works on your tablet or smartphone so you can use it on the go. Just zoom in or out to explore the area and get directions from Google Maps for driving or walking.</p>				

				<!-- <div class="map-block"><img src="<?php echo TDU; ?>/images/map-1.jpg" alt=""></div> -->

				<?php echo apply_filters('the_content', "[store_wpress]"); ?>

			</div>

		</div>

	</section>

</div>

<?php get_footer(); ?>