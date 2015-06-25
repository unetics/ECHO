<?php
include_once 'shortcodes/init.php';
include_once 'gallery/init.php';

function ps_add_main_styles($styles) { 
	$extra_styles = array(
		get_template_directory().'/assets/less/site.less'
	);
 	// combine the two arrays
	$styles = array_merge($extra_styles, $styles);
 	return $styles;
}
add_filter('ps_add_styles', 'ps_add_main_styles');

$styleVars = array(	);	

function load_scripts() {
	wp_enqueue_script( 'js', get_template_directory_uri() . '/js/site-min.js', '','1.8.7',false);
}
add_action('wp_enqueue_scripts', 'load_scripts', 100);

function register_main_menus() {
	register_nav_menus( array( 
						'primary-menu' 		=> 'Primary Menu',
						'footer-menu' 		=> 'footer-menu',
	 ) );
}
if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );


add_theme_support( 'post-thumbnails' );

if (is_admin()) {
     require('admin/functions.php');    
}

// Settings to Page Builder
require('pageBuilder/init.php');

// Add googleWT to header
function add_googleWT() { 
	get_template_part('partials/GoogleWT');
}
add_action('wp_head', 'add_googleWT');

// Add Analytics to footer
function add_googleanalytics() { 
	get_template_part('partials/analitics');
}
add_action('wp_footer', 'add_googleanalytics');	

// Activate Slabtext
function add_slabtext() { 
	echo "<script>jQuery(':header.fit').slabText();</script>";
}
add_action('wp_footer', 'add_slabtext');	

function getContrastYIQ($hexcolor){
	$r = hexdec(substr($hexcolor,0,2));
	$g = hexdec(substr($hexcolor,2,2));
	$b = hexdec(substr($hexcolor,4,2));
	$yiq = (($r*299)+($g*587)+($b*114))/1000;
	return ($yiq >= 128) ? 'black' : 'white';
}

$ptd = get_template_directory()."/inc/widgets/*/*.php";
foreach (glob($ptd) as $filename) {
    include $filename;
}

if ( current_user_can('administrator') ) {
   function prebuilt_page_layouts($layouts){
	$ptd = get_template_directory()."/inc/layouts/*.php";
		foreach (glob($ptd) as $filename) {
	    	$name = basename($filename, ".php");
	    	include $filename;   	
		}
	return $layouts;
	}
add_filter('siteorigin_panels_prebuilt_layouts', 'prebuilt_page_layouts');  

} else {/* echo('not admin'); */}

$ptd = get_template_directory()."/shortcodes/*.php";
foreach (glob($ptd) as $filename) {
    include $filename;
}


