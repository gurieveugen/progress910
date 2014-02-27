<?php
/*
 * @package WordPress
 * Template Name: Parents Page
*/
?>
<?php get_header(); ?>
<div class="heading">
	<ul class="breadcrumbs">
		<li><a href="#">Home</a></li>
		<li>Parents</li>
	</ul>
	<h1 class="text-parents">Parents</h1>
</div>
<div id="main">
	<div id="content" class="left">
		<div class="widget widget-image">
			<?php if(have_posts()): the_post(); ?>
			<?php the_content(); ?>
			<?php endif; ?>
		</div>
		
		<h2>Parent FAQ</h2>
		<div class="acc-wrapper">
		<?php 
		$parents = get_all_parents();
		foreach ($parents as $key => $value) 
		{?>
			<div class="acc-item">
				<div class="acc-head"><a href="#"><?php echo $value->post_title ?></a></div>
				<div style="display: none;" class="acc-body">
					<div class="content">
						<p><?php echo $value->post_content ?></p>
					</div>
				</div>
			</div>
		<?php	
		}
		?>
		</div>
	</div>
	<?php get_sidebar('parents'); ?>
	
	<script type="text/javascript">
		/* ----------------------------------------------------------- */
		/*  6. Accordion (Toggle)
		/* ----------------------------------------------------------- */
		(function($){
			$(function(){
				$(".acc-wrapper").each(function(){
					$(this).find('.acc-body').hide();
					$(this).find('.acc-head').first().addClass('active').next().show();
					$(this).find('.acc-head').last().addClass('last');
				});
				
				$(".acc-wrapper").each(function(){
					$(this).find(".acc-head").click(function() {
						if($(this).next().is(':hidden')) {
							$(this).parent().parent().find(".acc-head").removeClass('active').next().slideUp(300);
							$(this).toggleClass('active').next().slideDown(300);
						} else {
							$(this).parent().find(".acc-head").removeClass('active').next().slideUp(300);
						}
						return false;
					});
				});
				
			});
		})(jQuery);
	</script>
</div>
<?php get_footer(); ?>