<?php
add_shortcode('space', function($atts, $content){
	if( !isset($atts['width']) ) $atts['width'] = 1;
	$width = intval($atts['width']);
	$spaces = '';
	do {
	   $spaces .= '&nbsp;';
	   --$width;
	} while ($width > 0);
	
return $spaces;

});
