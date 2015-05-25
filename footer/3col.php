<?php
	register_sidebar( array(
'name' => 'Footer Sidebar 1',
'id' => 'footer-sidebar-1',
'description' => 'Appears in the footer area',
'before_widget' => '',
'after_widget' => '',
) );
register_sidebar( array(
'name' => 'Footer Sidebar 2',
'id' => 'footer-sidebar-2',
'description' => 'Appears in the footer area',
'before_widget' => '',
'after_widget' => '',
) );
register_sidebar( array(
'name' => 'Footer Sidebar 3',
'id' => 'footer-sidebar-3',
'description' => 'Appears in the footer area',
'before_widget' => '',
'after_widget' => '',
) );
?>

<footer>
	<div class="container">
		<div class="footer-widgets clearfix">
			<div class="col one_third">
				<?php if(is_active_sidebar('footer-sidebar-1')){ dynamic_sidebar('footer-sidebar-1'); } ?>
			</div>
			<div class="col one_third">
				<?php if(is_active_sidebar('footer-sidebar-2')){ dynamic_sidebar('footer-sidebar-2'); } ?>
			</div>
			<div class="col one_third">
				<?php if(is_active_sidebar('footer-sidebar-3')){ dynamic_sidebar('footer-sidebar-3'); } ?>
			</div>
		</div>
	</div>
	<div class="copyrights clearfix">
		<div class="container">
			<div class="col half">
				<?= do_shortcode(tr_option_field("[copyright]")); ?>
			</div>
			<div class="col half copyrights-menu copyright-links ">
				<?php
				
				$menuParameters = array(
					'theme_location'  => 'footer-menu',
					  'container'       => false,
					  'echo'            => false,
					  'items_wrap'      => '%3$s',
					  'depth'           => 1,
					);

					echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
				
				
				?>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</footer>