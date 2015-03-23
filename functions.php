<?php
function generateCss()
{
	$primaryContrast = getContrastYIQ(tr_option_field("[primary]"));	

	$vars = array();
	//styles
	$vars['primary'] = tr_option_field("[primary]");
	$vars['primary_contrast'] = $primaryContrast;
	$vars['rounding'] = tr_option_field("[rounding]");
	//fonts
	$vars['base_font_size'] = tr_option_field("[base_font_size]");
	$vars['small_heading'] = tr_option_field("[small_heading]");
	$vars['medium_heading'] = tr_option_field("[medium_heading]");
	$vars['large_heading'] = tr_option_field("[large_heading]");
	$vars['huge_heading'] = tr_option_field("[huge_heading]");
	//navs
	switch (tr_option_field("[nav]")) {
    case "none":
        break;
    case "fixed":
        $vars['navFixed'] = true;
        break;
    case "trans":
        $vars['navFixedTrans'] = true;
        break;
	}

	//fonts
	switch (tr_option_field("[fonts]")) {
    case "none":
        break;
    case 1:
        $vars['fontSet1'] = true;
        break;
    case 2:
        $vars['fontSet2'] = true;
        break;
	}

	$vars = array_filter($vars, 'strlen'); // removes unset array values
	$plugins = array('svg');
	
	$css = csscrush_file(__DIR__.'/assets/css/site.css',array('vars'=>$vars, 'minify'=>false, 'plugins'=>$plugins));
}
add_action( 'updateCss', 'generateCss');
	
add_action( 'wp_enqueue_scripts', 'loadCss', 10 );

function loadCss()
{
	wp_enqueue_style ( 'site',get_stylesheet_directory_uri().'/assets/css/site.crush.css', false);
	wp_enqueue_style ( 'icons',get_stylesheet_directory_uri().'/assets/css/font-icons.css', false);
}

add_filter('wp_nav_menu_items', 'do_shortcode'); // add shortcodes to menus

if(isset($_SERVER['APPLICATION_ENV']) && $_SERVER['APPLICATION_ENV'] == 'development') {
	add_action( 'wp_enqueue_scripts', 'generateCss', 10 );
}else{
	add_action( 'updateCss', 'generateCss');
}