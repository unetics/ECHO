<?php
add_action( 'wp_loaded', 'parent_prefix_load_classes', 10 );

function parent_prefix_load_classes()
{

	$vars = [];
	$vars['background'] = tr_option_field("[background]");
	$vars['dark'] = tr_option_field("[dark]");
	$vars['light'] = tr_option_field("[light]");
	$vars['primary'] = tr_option_field("[primary]");
	$vars['secondary'] = tr_option_field("[secondary]");
	
	$vars['base_font_size'] = tr_option_field("[base_font_size]");
	$vars['small_heading'] = tr_option_field("[small_heading]");
	$vars['medium_heading'] = tr_option_field("[medium_heading]");
	$vars['large_heading'] = tr_option_field("[large_heading]");
	$vars['huge_heading'] = tr_option_field("[huge_heading]");

	$vars = array_filter($vars, 'strlen'); // removes unset array values

	
	$css = csscrush_file(__DIR__.'/assets/css/site.css',['vars'=>$vars, 'minify'=>false]);
	wp_enqueue_style ( 'site', $css, false);

}