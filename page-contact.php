<?php
/*
 * @package WordPress
 * Template Name: Contact Page
*/
?>
<?php get_header(); ?>
<?php 

$p_phone                  = trim(get_option('p_phone'));
$p_fax                    = trim(get_option('p_fax'));
$p_email                  = trim(get_option('p_email'));
$p_email_leasing          = trim(get_option('p_email_leasing'));
$p_progress_910_address   = trim(get_option('p_progress_910_address'));
$p_leasing_office_address = trim(get_option('p_leasing_office_address'));

?>
<script>show_uncw = false;</script>
<div class="heading">
	<ul class="breadcrumbs">
		<li><a href="#">Home</a></li>
		<li>Contact</li>
	</ul>
	<h1 class="text-contact">Contact</h1>
</div>
<div id="main">
	<?php if(have_posts()): the_post(); ?>
	<?php the_content(); ?>
	<?php endif; ?>
	<div class="contact-section first">
		<div class="address">
			<div class="column">
				<h5>progress 910</h5>
				<address><?php echo $p_progress_910_address; ?></address>
			</div>
			<div class="column">
				<h5>Leasing Office</h5>
				<address><?php echo $p_leasing_office_address; ?></address>
			</div>
		</div>
		<div class="column phone">
			<dl>
				<dt>phone:</dt><dd><?php echo $p_phone; ?></dd>
				<dt>fax:</dt><dd><?php echo $p_fax; ?></dd>
			</dl>
		</div>
		<div class="right email">
			<dl>
				<dt>General:</dt><dd><a href="mailto:<?php echo $p_email; ?>"><?php echo $p_email; ?></a></dd>
				<dt>leasing:</dt><dd><a href="mailto:<?php echo $p_email_leasing; ?>"><?php echo $p_email_leasing; ?></a></dd>
			</dl>
		</div>
	</div>
	<div class="contact-section last">
		<div class="column hours">
			<h5>Office hours:</h5>
			<p>Mon-Fri: 10 AM - 8 PM</p>
			<p>Saturday: 11 AM - 5 PM</p>
			<p>Sunday: 1 PM - 5 PM</p>

		</div>
		<div class="right social">
			<h4>We’re Social</h4>
			<ul class="socials-contact">
				<?php
				$p_facebook    = trim(get_option('p_facebook'));
				$p_twitter     = trim(get_option('p_twitter'));
				$p_pinterest   = trim(get_option('p_pinterest'));
				$p_google_plus = trim(get_option('p_google_plus'));
				$p_instagram   = trim(get_option('p_instagram'));
				$p_vimeo       = trim(get_option('p_vimeo'));
				$p_wordpress   = trim(get_option('p_wordpress'));
				
				$facebook      = (empty($p_facebook)) ? "" : '<li><a href="'.$p_facebook.'" class="facebook">facebook</a></li>';
				$twitter       = (empty($p_twitter)) ? "" : '<li><a href="'.$p_twitter.'" class="twitter">twitter</a></li>';
				$pinterest     = (empty($p_pinterest)) ? "" : '<li><a href="'.$p_pinterest.'" class="pinterest">pinterest</a></li>';
				$google        = (empty($p_google_plus)) ? "" : '<li><a href="'.$p_google_plus.'" class="google">google</a></li>';
				$instagram     = (empty($p_instagram)) ? "" : '<li><a href="'.$p_instagram.'" class="instagram">instagram</a></li>';
				$vimeo         = (empty($p_vimeo)) ? "" : '<li><a href="'.$p_vimeo.'" class="vimeo">vimeo</a></li>';
				$wordpress     = (empty($p_wordpress)) ? "" : '<li><a href="'.$p_wordpress.'" class="wordpress">wordpress</a></li>';
				echo $facebook.$twitter.$pinterest.$google.$instagram.$vimeo.$wordpress;
				?>

				<!-- <li><a href="https://www.facebook.com/Progress910" class="facebook">facebook</a></li>
				<li><a href="https://twitter.com/Progress910" class="twitter">twitter</a></li>
				<li><a href="#" class="pinterest">pinterest</a></li>
				<li><a href="#" class="google">google</a></li>
				<li><a href="#" class="instagram">instagram</a></li>
				<li><a href="#" class="vimeo">vimeo</a></li>
				<li><a href="http://progress910.com/blog/" class="wordpress">wordpress</a></li> -->
			</ul>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.formstyler.min.js" ></script>
	<script type="text/javascript">
		(function($) {
			$(function() {
				$('select').styler();
			})
		})(jQuery)
	</script>
	<div class="contact-forms">
		<div class="column">
			<h4>SEND US A QUICK MESSAGE</h4>
			<p>Please fill out the form; one of our representatives will contact you as soon as possible.</p>
			<div class="form-message">
			<?php echo apply_filters('the_content', '[contact-form-7 id="197" title="Form Message"]'); ?>
			</div>
		</div>
		<div class="column right">
			<img src="<?php echo TDU; ?>/images/artwork.png" alt="">
			<!--<h4>TXT our contact info to your phone:</h4>
			<p><em>Standard text message fees apply. Only for U.S. residents.</em></p>
			<div class="form-phone">
				<?php echo apply_filters('the_content', '[contact-form-7 id="198" title="Form Phone"]'); ?>
			</div>-->
		</div>
	</div>
	<div class="map">
		<div id="map-canvas"></div>
	</div>
</div>
<?php get_footer(); ?>