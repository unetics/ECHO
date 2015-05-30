<?php global $theme_options ?>   
<footer class="sticky">
	<div class="copyrights clearfix">
		<?= do_shortcode($theme_options['copyright']);?>	
	</div>
	<?php wp_footer(); ?>
</footer>
