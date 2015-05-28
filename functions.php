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

function scripts() {
wp_enqueue_script('jquery'); 
wp_enqueue_script( 'js', get_template_directory_uri() . '/js/site-min.js');
wp_enqueue_script( 'funk', get_template_directory_uri() . '/js/functions.js');
}
add_action('wp_enqueue_scripts', 'scripts', 100);

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

// HTML 5 tags for old ie
if(preg_match('/(?i)msie [4-8]/',$_SERVER['HTTP_USER_AGENT']))
{
// if IE<=8
add_action('wp_head', function(){ ?>
	  <script>
		  !function(a,b){function c(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function d(){var a=t.elements;return"string"==typeof a?a.split(" "):a}function e(a,b){var c=t.elements;"string"!=typeof c&&(c=c.join(" ")),"string"!=typeof a&&(a=a.join(" ")),t.elements=c+" "+a,j(b)}function f(a){var b=s[a[q]];return b||(b={},r++,a[q]=r,s[r]=b),b}function g(a,c,d){if(c||(c=b),l)return c.createElement(a);d||(d=f(c));var e;return e=d.cache[a]?d.cache[a].cloneNode():p.test(a)?(d.cache[a]=d.createElem(a)).cloneNode():d.createElem(a),!e.canHaveChildren||o.test(a)||e.tagUrn?e:d.frag.appendChild(e)}function h(a,c){if(a||(a=b),l)return a.createDocumentFragment();c=c||f(a);for(var e=c.frag.cloneNode(),g=0,h=d(),i=h.length;i>g;g++)e.createElement(h[g]);return e}function i(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return t.shivMethods?g(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+d().join().replace(/[\w\-:]+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(t,b.frag)}function j(a){a||(a=b);var d=f(a);return!t.shivCSS||k||d.hasCSS||(d.hasCSS=!!c(a,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),l||i(a,d),a}var k,l,m="3.7.2",n=a.html5||{},o=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,p=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,q="_html5shiv",r=0,s={};!function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",k="hidden"in a,l=1==a.childNodes.length||function(){b.createElement("a");var a=b.createDocumentFragment();return"undefined"==typeof a.cloneNode||"undefined"==typeof a.createDocumentFragment||"undefined"==typeof a.createElement}()}catch(c){k=!0,l=!0}}();var t={elements:n.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video",version:m,shivCSS:n.shivCSS!==!1,supportsUnknownElements:l,shivMethods:n.shivMethods!==!1,type:"default",shivDocument:j,createElement:g,createDocumentFragment:h,addElements:e};a.html5=t,j(b)}(this,document);
	  </script>
 <?php });
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
