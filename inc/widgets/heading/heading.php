<?php
/**
* Plugin Name: Front to Back
* Plugin URI: http://unetics.org
* Description: widget
* Version: 1.0
*/

class heading extends WP_Widget {
	function __construct(){
		parent::__construct(
			'heading',
			'Heading',
			array(
				'classname' 	=> 'heading',
				'description' 	=> 'Add a Text Heading'
			));	
	}
	
	function form( $instance ){
		$instance = wp_parse_args((array)$instance, 
			array(
				// Heading
				'heading' 		=> '',
				'headingType' 	=> 'h3',
				'headingSize' 	=> 'small_heading',
				'headingAlign' 	=> 'center',
				'colour' 		=> '',
				'shadow' 		=> false
			));
			extract($instance);
			include(__DIR__.'/views/admin.php');
	}
	
	function update( $new_instance, $old_instance ){
		$instance = $old_instance;
			// Heading
			$instance['heading'] = $new_instance['heading'];
			$instance['headingType'] = $new_instance['headingType'];
			$instance['headingSize'] = $new_instance['headingSize'];
			$instance['headingAlign'] = $new_instance['headingAlign'];
			$instance['colour'] = $new_instance['colour'];
			$instance['shadow'] = $new_instance['shadow'];
		return $instance;
	}
	
	function widget( $args, $instance){
		echo $args['before_widget'];
		extract($instance);	
		include(__DIR__.'/views/widget.php');
		echo $args['after_widget'];
	}
	
	function register_admin_styles(){}
	function register_admin_scripts(){}
}
add_action('widgets_init', create_function('', 'register_widget("heading");'));

