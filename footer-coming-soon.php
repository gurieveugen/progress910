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
			</div>
		</footer>
		<div class="footer-bottom">			<div class="center-wrap">
				<p class="right">Designed &amp; Developed by <a href="http://www.inkhaus.com">INKHAUS</a></p>	
				<p>&copy; 2013 All rights reserved.  Progress Student Living</p>			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>