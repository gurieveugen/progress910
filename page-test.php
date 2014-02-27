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
			<h5>progress 910</h5>
			<address><?php echo $p_progress_910_address."<br>".$p_phone; ?></address>
		</div>
		<div class="column">
			<h5>Leasing Office</h5>
			<address><?php echo $p_leasing_office_address."<br>".$p_phone; ?></address>
		</div>
		<div class="gadget-holder">			
			<div class="gadget">				
				<script src="//www.gmodules.com/ig/ifr?url=http://www.google.com/ig/modules/driving_directions.xml&amp;up_from=&amp;up_to=514%20Market%20Street%20Suite%20101%20Wilmington,%20NC%2028405&amp;up_country=0&amp;synd=open&amp;w=410&amp;h=102&amp;title=Directions+by+Google+Maps&amp;lang=all&amp;country=ALL&amp;output=js"></script>				
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
							BB&amp;T <em>(1.3 mi)</em>
						</li>
						<li>
							Bank of America <em>(1.3 mi)</em>
						</li>
						<li>
							Credit Union ~ Wells Fargo ATM <em>(2.3 mi)</em>
						</li>
					</ul>
					<h4>Dining</h4>
					<ul>
						<li>Little Caesar’s Pizza  (1.3 mi)</li>
						<li>Chili’s  (1.3 mi)</li>
						<li>Szechuan  (3.3 mi)</li>
						<li>McAlister’s Deli  (4.3 mi)</li>
						<li>Port City Java  (5.3 mi)</li>
					</ul>
					<h4>EMERGENCY SERVICES</h4>
					<ul>
						<li>Cape Fear Hospital  (1.3 mi)</li>
						<li>Southeastern Medical Group PA  (2.1 mi)</li>
					</ul>
					<h4>Entertainment</h4>
					<ul>
						<li>Grand Station Entertainment (1.3 mi)</li>
						<li>Cinemark  (2.1 mi)</li>
						<li>The Theater Company  (1.3 mi)</li>
					</ul>
					<h4>Recreation</h4>
					<ul>
						<li>Parks and Recreation Dept  (1.3 mi)</li>
					</ul>
					<h4>RETAIL SERVICES</h4>
					<ul>
						<li>Harris Teeter  (1.3 mi)</li>
						<li>Kmart  (2.1 mi)</li>
						<li>Hot Wax Surf Shop  (1.3 mi)</li>
						<li>The Salt Shaker Bookstore & Cafe  (2.1 mi)</li>
					</ul>
				</div>
			</aside>
			<div class="content">
				<p>Doming blandit formas consuetudium ea ex. Liber claritatem ipsum aliquip clari decima. Dolore nunc liber me ipsum etiam. Nonummy Investigationes diam lectorum ii ut. Claritatem placerat sit lobortis quis assum.</p>								
				<?php echo apply_filters('the_content', "[poiautomap]"); ?>
			</div>
		</div>
	</section>
</div>
<?php get_footer(); ?>

