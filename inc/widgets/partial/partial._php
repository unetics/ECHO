<?php
/**
* Plugin Name: Front to Back
* Plugin URI: http://unetics.org
* Description: widget
* Version: 1.0
*/

class partial extends WP_Widget {
	
	function __construct(){
		parent::__construct(
			'partial',
			'partial',
			array(
				'classname' 	=> 'partial',
				'description' 	=> 'Add a Heading'
			));	
			
	}
	
	function form( $instance ){
		$instance = wp_parse_args((array)$instance, 
			array(
				// Heading
				'hea' 	=> 'h3',
			));
			extract($instance);
			
			include(__DIR__.'/views/admin.php');
	}
	
	function update( $new_instance, $old_instance ){
		$instance = $old_instance;
			// Heading
			$instance['hea'] = $new_instance['hea'];
		return $instance;
	}
	
	function widget( $args, $instance){
		echo $args['before_widget'];
		extract($instance);	
		include(__DIR__.'/views/widget.php');
		echo $args['after_widget'];
	}
	
	function textInput($name, $settings){
		$instance = apply_filters( 'widget_form_callback', $instance, $this );
			$placeholder = '';
		if (isset($settings['placeholder'] ) ){
			$placeholder = 'placeholder="'. $settings['placeholder'] .'"';
		}	
		
		ob_start();
        	include(locate_template('partials/textInput.php'));
		return ob_get_clean();
	}

	
	
	function register_admin_styles(){}
	function register_admin_scripts(){}
}
add_action('widgets_init', create_function('', 'register_widget("partial");'));

