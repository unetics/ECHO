<footer>
	<div class="copyrights clearfix">
		<div class="container">
			<div class="col half">
				<?= do_shortcode(tr_option_field("[copyright]")); ?>
			</div>
			<div class="col half">
				<?php if(is_active_sidebar('footer-sidebar-1')){ dynamic_sidebar('footer-sidebar-1'); } ?>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</footer>