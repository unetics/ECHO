<?php
add_shortcode('icon', function( $atts ){
	
	extract( shortcode_atts( array(
    'id'            => '',
    'colour'		=> '',
	), $atts ) );	
	
	$id = (htmlspecialchars_decode($id));
	
	static $widget_icon_families;
	static $widget_icons_enqueued = array();
	
	if( empty($widget_icon_families) ) $widget_icon_families = apply_filters('siteorigin_widgets_icon_families', array() );
	if( empty($widget_icon_families['elf'])){ return false;}
	
	$family = 'elf';
	
	if( !wp_style_is( 'siteorigin-widget-icon-font-'.$family ) ) {
		wp_enqueue_style('siteorigin-widget-icon-font-'.$family, $widget_icon_families[$family]['style_uri'] );
	}
	
	$icon = $widget_icon_families[$family]['icons'][$id];
	
	return "<i class='sow-icon-elf' data-sow-icon='$icon'></i>";
});