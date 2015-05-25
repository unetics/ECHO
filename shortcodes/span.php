<?php
add_shortcode('span', function($atts, $content){
if( !isset($atts['class']) ) $atts['class'] = '';

	return '<span>'.$content.'</span>';

});