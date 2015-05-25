<?php
add_shortcode('more', function($atts, $content){
if( !isset($atts['class']) ) $atts['class'] = '';

	return '<a class="read-more-show hide toggle" href="#">Read More</a><div class="read-more-content hide">'.$content.'<a class="read-more-hide hide toggle" href="#">Read Less</a></div>';

});