<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>
<div class="heading">
	<ul class="breadcrumbs">
		<li><a href="#">Home</a></li>
		<li>Blog</li>
	</ul>
	<h1 class="text-blog">Blog</h1>
</div>
<div id="main">
	<div id="content" class="left">
		<?php include("loop.php"); ?>
	</div>
	<?php get_sidebar(); ?>
	<a href="#" id="to_top" class="btn-top">BACK TO TOP</a>
</div>
<?php get_footer(); ?>
