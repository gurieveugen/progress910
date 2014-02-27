<div id="sidebar" class="right">
	<?php
	if (has_post_thumbnail()) 
	{
	?>
	<div id="text-3" class="widget widget_text widget-image">			
		<div class="textwidget">
			<?php echo the_post_thumbnail('full'); ?>
		</div>
	</div>
	<?php		
	}
	?>
	<?php dynamic_sidebar( 'Parents Sidebar' ); ?>	
</div>