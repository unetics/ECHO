<?php
/*
 * Toggle
 * @since v1.0
 */
if( !function_exists('toggle_shortcode') ) {
	function toggle_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'			=> 'Toggle Title',
			'class'			=> '',
			'visibility'	=> 'all',
		), $atts ) );
		
		// Enque scripts
		wp_enqueue_script( 'toggle', get_template_directory_uri() . '/assets/js/toggle.js', array(), '1.0.0', true );
		
		// Display the Toggle
		return '<div class="toggle '. $class .' '. $visibility .'"><h3 class="toggle-trigger">'. $title .'</h3><div class="toggle-container">' . do_shortcode($content) . '</div></div>';
	}
}
add_shortcode('toggle', 'toggle_shortcode');
