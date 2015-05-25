<?php
add_shortcode('current-year', function(){
	$year =date('Y');
	return $year;
});
