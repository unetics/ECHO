<?php
add_action( 'wp_enqueue_scripts', 'parent_prefix_load_classes', 10 );

function parent_prefix_load_classes()
{
	$primaryContrast = getContrastYIQ(tr_option_field("[primary]"));	

	$vars = array();
	$vars['primary'] = tr_option_field("[primary]");
	$vars['primary_contrast'] = $primaryContrast;
	$vars['rounding'] = tr_option_field("[rounding]");
	
	$vars['base_font_size'] = tr_option_field("[base_font_size]");
	$vars['small_heading'] = tr_option_field("[small_heading]");
	$vars['medium_heading'] = tr_option_field("[medium_heading]");
	$vars['large_heading'] = tr_option_field("[large_heading]");
	$vars['huge_heading'] = tr_option_field("[huge_heading]");

	$vars = array_filter($vars, 'strlen'); // removes unset array values
// 	$plugins = ['forms'];
	
	$css = csscrush_file(__DIR__.'/assets/css/site.css',array('vars'=>$vars, 'minify'=>false));
	wp_enqueue_style ( 'site', $css, false);

}

add_filter('wp_nav_menu_items', 'do_shortcode'); // add shortcodes to menus
